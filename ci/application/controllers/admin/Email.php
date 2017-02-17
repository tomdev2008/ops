<?php 
defined('BASEPATH')OR exit('No direct script access allowed');
/**
*开通集团邮箱账号
*/
class Email extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('session','form_validation','PHPRequests'));
		$this->load->helper(array('form','url','cookie'));
		$this->load->model(array('admin/email_model','admin/user_model'));
	}
	// 集团企业邮箱统计
	// public function info()
	// {
	// 	$DepartmentId = $this->input->get("id");
	// 	if ($DepartmentId == NULL) {
	// 		$DepartmentId = 0;
	// 	}
	// 	$data = array();
	// 	$this->_data['title'] = '集团邮箱管理';
	// 	//邮箱部门
	// 	$department = $this->_data['department'] = $this->config->item('email_department');
	// 	// 企业邮箱的管理员ID
	// 	$cTMailID = $this->config->item('ops_email_id');
	// 	// 接口Key
	// 	$cTMailSecret = $this->config->item('ops_email_key');
	// 	// 获取OAuth验证授权
	// 	$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
	// 	$DepartmentName = $department[$DepartmentId];
	// 	$this->_data['employees'] = $this->email_model->get_PartyUser($access_token,$DepartmentName);
	// 	$this->load->view('admin/header');
	// 	$this->load->view('admin/email_info',$this->_data);
	// 	$this->load->view('admin/footer');
	// }
	// 添加邮箱
	public function index()
	{
		$key = $this->input->get('key');
		$this->form_validation->set_rules('name','name','required');
		$this->form_validation->set_rules('account','account','required');
		$this->form_validation->set_rules('eamil','eamil','required');
		$this->form_validation->set_rules('department','department','required');
		$this->form_validation->set_rules('telephone','telephone','required');
		// $this->form_validation->set_rules('group','group','required');
		if ($this->form_validation->run() == FALSE) {
			$this->_data['department'] = $this->config->item('email_department');//邮箱部门
			$this->_data['email'] = $this->config->item('email_domain');//邮箱域名
			// $this->_data['group'] = [
			// 	"IT群组" => 'it@xkeshi.com',
			// 	"项目管理群" => 'project@xkeshi.so'
			// ];//邮箱群组
			$data = array();
			$this->_data['title'] = '集团邮箱开通';
			$this->load->view('admin/header');
			$this->load->view('admin/email_add',$this->_data);
			$this->load->view('admin/footer');
		}
		else{
			$name = $this->input->post('name');
			$account = $this->input->post('account');
			$eamil = $this->input->post('eamil');
			$EamilAccount = $account.$eamil;
			$department = $this->input->post('department');
			$moblie = $this->input->post('telephone');
			// $group = $this->input->post('group');
			$password = 'Abc110';//初始密码
			$admin_id = $this->session->userdata('admin_id');
			// 企业邮箱的管理员ID
			$cTMailID = $this->config->item('ops_email_id');
			// 接口Key
			$cTMailSecret = $this->config->item('ops_email_key');
			// 获取OAuth验证授权
			$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
			$result = $this->email_model->add_email($access_token,$EamilAccount,$name,$password,$department,$moblie);
			$errors = [
				'user_existed' => '账号已存在！',
				'pwd_invalid' => '密码不符合安全设定！',
				'party_not_found' => '邮箱组别不存在！'
			];
			if ($result == NULL) {
				// $error = [
				// 	'user_existed' => '邮箱开通失败，该群组中已存在该成员！',
				// 	'user_not_found' => '邮箱开通失败，该成员不存在！',
				// 	'error unknown' => '邮箱开通失败，群组不存在！'
				// ];
				//$res = $this->email_model->add_email_in_group($access_token,$group,$EamilAccount);
				//if ($res == NULL) {
					//$this->email_model->open_wxtoken($access_token,$EamilAccount);//开启微信验证
					$this->email_model->insert_email_check_logs($admin_id);//添加记录操作日志
				 	echo "<script>
				 		alert('注册成功！');
				 		window.location.href='/admin/email/show?name=".$name."&email=".$EamilAccount."&department=".$department."'; 
				 	</script>";
				// }else{
				// 	echo "<script>
				// 		alert('".$error[$res['error']]."');
				// 		window.location.href='/admin/email';
				// 	</script>";
				//}
			}
			else{
				echo "<script>
						alert('".$errors[$result['error']]."');
						window.location.href='/admin/email'; 
					</script>";
			}
		}
	}
	// 邮箱开通信息
	public function show()
	{
		$data = array();
		$this->_data['title'] = '集团邮箱开通';
		$this->load->view('admin/header');
		$this->load->view('admin/email_addinfo',$this->_data);
		$this->load->view('admin/footer');
	}
	// 邮箱检测
	public function check_email()
	{
	 	$email = $this->input->get('email');
	 	// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获得access_token
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		$result = $this->email_model->check_email($access_token,$email);
		// 输出查询结果 -1：不可用 0:可注册 1：主账号 2：别名账号 3：邮件群组账号
		echo $result['List'][0]['Type'];
	}
	// 密码重置
	// public function PasswordReset()
	// {
	// 	// 企业邮箱的管理员ID
	// 	$cTMailID = $this->config->item('ops_email_id');
	// 	// 接口Key
	// 	$cTMailSecret = $this->config->item('ops_email_key');
	// 	// 获取OAuth验证授权
	// 	$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
	// 	$cTMailAlias = $this->input->get('email');//重置密码的账号
	// 	$password = 'Abc110';//初始化密码
	// 	$result = $this->email_model->mod_email($access_token,$cTMailAlias,$password);
	// 	if ($result == NULL) {
	// 		echo "success";
	// 	}
	// 	else{
	// 		echo $result['error'];
	// 	}
	// }
	// 邮箱禁用接口
	// public function email_disable()
	// {
	// 	$adminname = $this->session->userdata('adminname');
	// 	$admin_id = $this->session->userdata('admin_id');
	// 	$email = $this->input->get("email");
	// 	$pwd = $this->input->get('pwd', TRUE);
	// 	$result = $this->email_model->search_user_by_ldap($adminname,$pwd);
	// 	if ($result) {
	// 		// 企业邮箱的管理员ID
	// 		$cTMailID = $this->config->item('ops_email_id');
	// 		// 接口Key
	// 		$cTMailSecret = $this->config->item('ops_email_key');
	// 		// 获取OAuth验证授权
	// 		$access_token = $this->user_model->get_access_token($cTMailID,$cTMailSecret);
	// 		$opentype = '2';//状态（0不设置状态；1启用账号；2禁用账号）
	// 		$res = $this->user_model->email_disable($access_token,$email,$opentype);// 邮箱禁用
	// 		if ($res == "") {
	// 			$this->user_model->insert_email_dislogs($admin_id);//添加邮箱禁用操作日志
	// 			echo "success";
	// 		}
	// 		else{
	// 			echo $res['error'];
	// 		}
	// 	}
	// 	else{
	// 		echo "error_pwd";//密码错误
	// 	}
	// }
	// 邮箱信息修改
	// public function email_update()
	// {
	// 	// $email = $this->input->get("email");
	// 	$this->form_validation->set_rules('email','email','required');
	// 	$this->form_validation->set_rules('name','name');
	// 	$this->form_validation->set_rules('sex','sex');
	// 	$this->form_validation->set_rules('mobile','mobile');
	// 	$this->form_validation->set_rules('tel','tel');
	// 	$this->form_validation->set_rules('position','position');
	// 	$this->form_validation->set_rules('partypath','partypath');
	// 	if ($this->form_validation->run() == FALSE) {
	// 		$data = array();
	// 		$this->_data['title'] = '邮箱信息修改';
	// 		$this->load->view('admin/email_mod',$this->_data);
	// 	}
	// 	else{
	// 		$email = $this->input->post('email');
	// 		$name = $this->input->post('name');
	// 		$sex = $this->input->post('sex');
	// 		$mobile = $this->input->post('mobile');
	// 		$tel = $this->input->post('tel');
	// 		$position = $this->input->post('position');
	// 		$partypath = $this->input->post('partypath');
	// 		$admin_id = $this->session->userdata('admin_id');
	// 		$gender = [
 //                  "未设置" => 0,
 //                  "男" => 1,
 //                  "女" => 2,
 //                ];
 //            // 性别数字化
 //            $sex = $gender[$sex];
	// 		// 企业邮箱的管理员ID
	// 		$cTMailID = $this->config->item('ops_email_id');
	// 		// 接口Key
	// 		$cTMailSecret = $this->config->item('ops_email_key');
	// 		// 获取OAuth验证授权
	// 		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
	// 		$result = $this->email_model->update_email($access_token,$email,$name,$sex,$mobile,$tel,$position,$partypath);
	// 		if ($result == NULL) {
	// 			$this->email_model->insert_email_update_logs($admin_id);
	// 			echo "<script>
	// 					alert('修改成功！');
	// 					parent.window.location.reload();
	// 					var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
 //        				parent.layer.close(index);
	// 				</script>";
	// 		}else if($result['error'] == "party_not_found"){
	// 			echo "<script>
	// 					alert('部门不存在,请重试！！');
	// 					var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
 //        				parent.layer.close(index);
	// 				</script>";
	// 		}else{
	// 			echo "<script>
	// 					alert('修改失败,请重试！！');
	// 					var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
 //        				parent.layer.close(index);
	// 				</script>";
	// 		}
	// 	}
	// }
}
 ?>