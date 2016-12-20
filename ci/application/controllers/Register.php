<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','email','cool_captcha','PHPRequests'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('register_model');
	}

	public function index()
	{
		$this->form_validation->set_rules('level_id', 'level_id','required');
		$this->form_validation->set_rules('name', 'name','required');
		$this->form_validation->set_rules('email', 'email','required');
		$this->form_validation->set_rules('email_end', 'email_end','required');
		$this->form_validation->set_rules('password1', 'password1','required');
		$this->form_validation->set_rules('tel', 'tel','required');
		$this->form_validation->set_rules('captcha', 'captcha','required');
		$level_id = $this->input->post('level_id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$email_end = $this->input->post('email_end');
		$password = $this->input->post('password1');
		$tel = $this->input->post('tel');
		$Email = $email.$email_end;
		if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '新员工注册';
			$this->_data['get_level_id'] = $this->register_model->get_level_id();
			$this->load->view('default/register',$this->_data);
		}
		else{
				$entry_time = date("Y-m-d",time());
				$data = [
						'level_id' => $level_id,
						'name' => $name,
						'email' => $Email,
						'tel' => $tel,
						'email_exist' => 0,
						'entry_time' => $entry_time
					];
					$ou = $this->register_model->get_ou_by_level_id($level_id);
					$i = 0;$j = 0;
					$email_all = $this->register_model->judge_email();
					$res = $this->register_model->search_user_by_ldap($Email);
					$telcheck = $this->register_model->get_tel();
					foreach ($telcheck as $value) {
						if ($value->tel == $tel) {
							$j = 1;
						}
					}
					if ($j == 1) {
						echo "<script>
							alert('手机号重复，请检查！');
							location.href='../register'
							</script>";
					}
					if ($j == 0) {
					if ($res == 1) {
						foreach ($email_all as $value) 
						{
							if ($value->email == $Email) 
							{
								$i = 1;
							}
						}
						if ($i == 1) {
							echo "<script>
							alert('运维平台账号和VPN账号都已存在，请检查！');
							location.href='../register'
							</script>";
						}
						if ($i == 0) {
							$result = $this->register_model->insert_user($data);
							echo "<script>
							alert('运维平台账号已开通，密码任意。VPN账号已存在，请检查！');
							location.href='../register'
							</script>";
						}
					}
					else if($res == 0)
					{
						foreach ($email_all as $value) {
							if ($value->email == $Email) {
							$i = 1;
							}
						}
						$this->register_model->ldapadmin($name,$Email,$password,$ou);
						if ($i == 0) {
								$result = $this->register_model->insert_user($data);
								if ($result) {
									echo "<script>
									alert('运维平台账号和VPN都已开通！');
									</script>";
									$this->register_model->Email_to_ops($name);
									redirect('/register/show?level_id='.$level_id.'&name='.$name.'&email='.$Email);
								}
							}
						else if ($i == 1) {
							echo "<script>
							alert('VPN已开通。运维平台账号已存在，请检查！');
							location.href='../register'
							</script>";
						}
					}
				
			}
		}
	}
	public function password_check()
	{
		$password = $this->input->get('password');
		if ($password == "" || !$this->register_model->check_password($password)) {
			echo "0";//密码匹配失败
		}
		else{
			echo "1";//密码匹配通过
		}
	}
	public function captcha_check()
	{
		$captcha = $this->input->get("captcha");
		if ($this->session->userdata('captcha') == $captcha){
				echo "1";//验证码验证通过
			}
			else{
				echo "0";//验证码验证失败
			}
	}
	public function show()
	 {
	 	$data = array();
		$this->_data['title'] = '项目添加结果';
		$this->load->view('default/register_show',$this->_data);
	 }
	 public function check_email()
	 {
	 	$email = $this->input->get('email');
	 	// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获得access_token
		$access_token = $this->register_model->get_access_token($cTMailID,$cTMailSecret);
		$result = $this->register_model->check_email($access_token,$email);
		// 输出查询结果 -1：不可用 0:可注册 1：主账号 2：别名账号 3：邮件群组账号
		echo $result['List'][0]['Type'];
	 }
	 public function captcha()
	 {
	 	$this->cool_captcha->createImage();
	 }
	//  public function ldapupdate()
	// {
	// 	$user = $this->register_model->get_user_all();
	// 	foreach ($user as $value) {
	// 		$search = $this->register_model->search_user_by_ldap($value->email);
	// 		if (!$search) {
	// 			$ou = $this->register_model->get_ou_by_level_id($value->level_id);
	// 			$this->register_model->ldapadmin($value->name,$value->email,"Abc123",$ou);
	// 		}
 // 		}
	// }
}