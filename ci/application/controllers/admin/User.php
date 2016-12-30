<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','PHPRequests'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/user_model');
		
	}
	public function index()
	{
		$users_level = $this->user_model->get_user_level_list();
		$this->_data['users_level'] = $users_level;
		$level_id = $this->input->get('level_id', TRUE);
		$this->_data['users'] = $this->user_model->get_user_by_level_id($level_id);//在职人员名单(按组长和id降序)
		$this->_data['users_all'] = $this->user_model->get_users_desc();//全部人员名单(按id降序)
		$this->_data['users_dimission'] = $this->user_model->get_user_dimission();//离职人员名单
		$this->_data['title'] = '员工列表';
		$this->load->view('admin/header');
		$this->load->view('admin/user',$this->_data);
		$this->load->view('admin/footer');
	}
	public function update()
	{
		$this->form_validation->set_rules('name', 'name','required');
		$this->form_validation->set_rules('level_id', 'level_id','required');
		$this->form_validation->set_rules('tel', 'tel','required');
		$this->form_validation->set_rules('group_leader', 'group_leader','required');
		$user_id = $this->input->get('user_id', TRUE);
		$name = $this->user_model->get_name_by_id($user_id);
		$level_id = $this->user_model->get_level_id_by_id($user_id);
		$email = $this->user_model->get_email_by_id($user_id);
		$tel = $this->user_model->get_tel_by_id($user_id);
		$qq = $this->user_model->get_qq_by_id($user_id);
		$group_leader = $this->user_model->get_group_leader_by_id($user_id);		
		$this->_data['user_id'] = $user_id;
		$this->_data['name'] = $name;
		$this->_data['level_id'] = $level_id;
		$this->_data['email'] = $email;
		$this->_data['tel'] = $tel;		
		$this->_data['group_leader'] = $group_leader;
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '人员信息修改';
			$this->_data['user_id'] = $user_id;
			$this->_data['name'] = $name;
			$this->_data['level_id'] = $level_id;
			$this->_data['email'] = $email;
			$this->_data['tel'] = $tel;	
			$this->_data['qq'] = $qq;		
			$this->_data['user_level_list'] = $this->user_model->get_user_level_list();
			$this->load->view('admin/user_update',$this->_data);
        }
        else
        {	
        	$user_id = $this->input->post('user_id', TRUE);	
        	$name = $this->input->post('name', TRUE);
        	$level_id = $this->input->post('level_id', TRUE);
        	$email = $this->input->post('email', TRUE);
        	$tel = $this->input->post('tel', TRUE);
        	$qq = $this->input->post('qq', TRUE);    	
        	$group_leader = $this->input->post('group_leader',TRUE);
			$result = $this->db->query("UPDATE ops_user SET qq = ".$qq.",level_id = ".$level_id.",group_leader = ".$group_leader." ,tel = ".$tel." WHERE id = '".$user_id."'");
				if ($result) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(add_view.name); //获取窗口索引
         			parent.layer.close(index);  	
					</script>";
        		}
        }	
	}	
	public function delete()
	{
		$user_id = $this->input->get('user_id', TRUE);
		$adminname = $this->session->userdata('adminname');
		$admin_id = $this->session->userdata('admin_id');
		$pwd = $this->input->get('pwd', TRUE);
		$email = $this->user_model->get_email_by_id($user_id);
		$name = $this->user_model->get_name_by_id($user_id);
		$res = $this->user_model->search_user_by_ldap($adminname,$pwd);
		if ($res) {
			$ops_user_ssh_server = $this->db->delete('ops_user_ssh_server', array('user_id' => $user_id));//删除权限
			if ($ops_user_ssh_server) {
				$result = $this->user_model->user_dimission($user_id);//控制人员离职
				$search =$this->user_model->search_user_by_uid($email);//查询ldap
				if ($search) {
					$ldap_del = $this->user_model->ldap_del($email);//删除ldap
					if ($ldap_del) {
						$this->user_model->insert_user_login_logs($admin_id);//添加记录操作日志
						echo $name;//删除操作成功，输出姓名
					}
					else if (!$ldap_del) {
					echo "error_ldap_del";//ldap删除错误
					}
				}
				else{
					echo "error_ldap_search";//ldap查询失败
				}
			}		
		}
		else{
			echo "error_pwd";//密码错误
		}
	}
	// 邮箱禁用接口
	public function email_disable()
	{
		$adminname = $this->session->userdata('adminname');
		$admin_id = $this->session->userdata('admin_id');
		$email = $this->input->get("email");
		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获取OAuth验证授权
		$access_token = $this->user_model->get_access_token($cTMailID,$cTMailSecret);

		$opentype = '2';//状态（0不设置状态；1启用账号；2禁用账号）
		$res = $this->user_model->email_disable($access_token,$email,$opentype);// 邮箱禁用
		if ($res == "") {
			$this->user_model->insert_email_dislogs($admin_id);//添加邮箱禁用操作日志
			$result = $this->user_model->update_email_disabled($email);// 修改成员邮箱状态
			if ($result) {
				echo "success";
			}
		}
		else{
			echo $res['error'];
		}
	}
	public function logs()
	{
		$query = $this->db->query('SELECT * FROM ops_user_logs ORDER BY id DESC LIMIT 100');
		$data = $query->result();
		$this->_data['logs'] = $data;
		$this->_data['title'] = '登录日志列表';
		$this->load->view('admin/header');
		$this->load->view('admin/user_logs',$this->_data);
		$this->load->view('admin/footer');
	}
	public function modify() {
		$ssh_rsa = $this->input->post('ssh-rsa');
		$u_id = $this->session->userdata('admin_id');
		$data = [
		    'ssh-rsa'  => $ssh_rsa
		];
		$this->db->where('id', $u_id);
		$this->db->update('ops_user', $data);
		redirect('/');
	}
	public function user_permission()
	{
		$id = $this->input->get('id');
		$permission = $this->user_model->get_permission_by_id($id);
		$this->_data['permission'] = $permission;	
		$this->load->view('admin/user_permission',$this->_data);
	}
	// 添加邮箱
	public function add_email()
	{
		$user_id = $this->input->get('id');
		$user_info = $this->user_model->get_userinfo_by_id($user_id);
		//print_r($user_info[0]);
		@$this->_data['level_id'] =  $user_info[0]->level_id;//组别
		@$this->_data['email'] = $user_info[0]->email;//邮箱号（必填）
		@$this->_data['name'] =  $user_info[0]->name;//姓名（必填）
		$this->_data['group'] =  $this->user_model->get_EmailGroup();//邮箱组别（必填）
		$this->_data['password'] = 'Abc110';//初始密码（必填）
		$this->_data['partypath'] = 'IT部';//部门（必填）
		$this->form_validation->set_rules('email', 'email','required');
		$this->form_validation->set_rules('name', 'name','required');
		$this->form_validation->set_rules('password', 'password','required');
		$this->form_validation->set_rules('partypath', 'partypath','required');
		if ($this->form_validation->run() == FALSE) {
			$data = array();
			$this->_data['title'] = '邮箱开通页面';
			$this->load->view('admin/user_email',$this->_data);
		}
		else{
			// 添加的账号信息
			$id = $this->input->post('id');
			$partypath = $this->input->post('partypath');	
        	$name = $this->input->post('name');
        	$password = $this->input->post('password');
        	$cTMailAlias = $this->input->post('email')."@".$this->input->post('domain');
        	$group = $this->input->post('group');
        	$admin_id = $this->session->userdata('admin_id');
			// 企业邮箱的管理员ID
			$cTMailID = $this->config->item('ops_email_id');
			// 接口Key
			$cTMailSecret = $this->config->item('ops_email_key');
			// 获取OAuth验证授权
			$access_token = $this->user_model->get_access_token($cTMailID,$cTMailSecret);

			$result = $this->user_model->add_email($access_token,$cTMailAlias,$name,$password,$partypath);
			$errors = [
				'user_existed' => '账号已存在！',
				'pwd_invalid' => '密码不符合安全设定！',
				'party_not_found' => '邮箱组别不存在！'
			];
			if ($result == NULL) {
				$error = [
					'user_existed' => '邮箱开通失败，该群组中已存在该成员！',
					'user_not_found' => '邮箱开通失败，该成员不存在！',
					'error unknown' => '邮箱开通失败，群组不存在！'
				];
				$this->user_model->update_email($id);
				$res = $this->user_model->add_email_in_group($access_token,$group,$cTMailAlias);
				if ($res == NULL) {
					$this->user_model->insert_email_check_logs($admin_id);//添加记录操作日志
					echo "<script>
						alert('注册成功！');
						parent.window.location.reload();
				        var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
				        parent.layer.close(index);
					</script>";
				}else{
					echo "<script>
						alert('".$error[$res['error']]."');
						parent.window.location.reload();
				        var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
				        parent.layer.close(index);
					</script>";
				}
				
			}
			else{
				echo "<script>
						alert('".$errors[$result['error']]."');
						parent.window.location.reload();
				        var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
				        parent.layer.close(index);
					</script>";
			}
		}
	}
	// 验证码打印接口
	public function captcha()
	{
	 	$this->cool_captcha->createImage();
	}
}
