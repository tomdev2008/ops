<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','cool_captcha'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('login_model');
	}

	public function index()
	{
		$this->login_model->logged_in_redirect();
		$this->_data['title'] = '运维管理平台 - 登录';
		$this->form_validation->set_rules('username', 'Email address','required');
		$this->form_validation->set_rules('password', 'password','required');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$rememberme = $this->input->post('remember-me');
		$redirect_url = $this->input->post('redirect');
		if ($rememberme) $this->login_model->set_username_remember($username);
        if ($this->form_validation->run() == FALSE)
        {
        	$this->load->view('default/login',$this->_data);
        }
        else
        {
				$user = $this->login_model->get_user_id_from_username($username, $password, '@xkeshi.com');
				$user_data = explode(',',$user);
				if ($user != FALSE) {
					$data = [
					'u_id'	=> $user_data[0],
					'u_level_id' => $user_data[1],
					'username' => $username.'@xkeshi.com',
					'is_logged_in' => true
					];
				}
				$uid = $username.'@xkeshi.com';
				$result = $this->login_model->search_user_by_ldap($uid,$password);
				if ( $user && $result) {
				$this->session->set_userdata($data);
				$this->login_model->insert_user_login_logs();  //记录用户登录日志。
				/*if ($redirect_url) {
					redirect('/'.$redirect_url);
				} else {
					redirect('/'.$this->login_model->get_first_login_url());
				}*/
				redirect('/'.$redirect_url);
				}
				else if(!$user){
					echo"<script>alert('账号不存在或人员已离职，请重新输入！');</script>";
					$this->load->view('default/login',$this->_data);
				}
				else if(!$result){
					echo"<script>alert('密码错误，请重新输入！');</script>";
					$this->load->view('default/login',$this->_data);
				}
			// } else {
			// 	$this->load->view('default/login',$this->_data);
			// }
	    }
	}

	public function reset()
	{
		$data = array();
		$this->_data['title'] = '密码重置';
		$this->form_validation->set_rules('username', 'username','required');
		$username = $this->input->post('username');
		$name = $this->login_model->get_name_by_email($username);
		// $this->form_validation->set_rules('tel', 'tel','required');
		// $tel = $this->input->post('tel');
		$checktel = $this->login_model->check_tel_by_email($username);
		if ($this->form_validation->run() == FALSE)
        {
        	$this->load->view('default/reset',$this->_data);
        }
        else
        {
        	if ($this->session->userdata('captcha') != $this->input->post('captcha')){
					echo "<script>
						alert('验证码错误！');
						location.href='../login/reset';
						</script>";
			}
			else{
	        	$search = $this->login_model->search_user_by_uid($username);
	        	if ($search) {
	        		// if ($checktel == $tel) {
						$reset = $this->login_model->reset_ldap_pwd($username);
		        		if ($reset) {
		        			$this->login_model->Email_to_user($username,$name);
		        			$this->session->sess_destroy();
		        			echo"<script>
		        			alert('密码已重置，请查收邮件！');
		        			parent.window.location.reload();
		          			var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
		          			parent.layer.close(index);
		        			</script>";
		        		// }
					// }else if($checktel != $tel && $checktel != ""){
					// 	echo"<script>
	    //     			alert('手机号码验证错误，请检查！');
	    //     			parent.window.location.reload();
	    //       			var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
	    //       			parent.layer.close(index);
	    //     			</script>";
					// }else if($checktel != $tel && $checktel == ""){
					// 	echo"<script>
	    //     			alert('预留手机号码为空，请联系运维组！');
	    //     			parent.window.location.reload();
	    //       			var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
	    //       			parent.layer.close(index);
	    //     			</script>";
					// }
	        	}
	        	else{
	        		echo"<script>
	        			alert('账号不存在，请重新输入！');
	        			parent.window.location.reload();
	          			var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
	          			parent.layer.close(index);
	        			</script>";
	        		}
	        	}
	        }
        }
	}
	public function captcha()//验证码
	 {
	 	$this->cool_captcha->createImage();
	 }
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/login');
	}	
}
