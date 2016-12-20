<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/login_model');
		
	}
	public function index()
	{
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
        	$this->load->view('/admin/login',$this->_data);
        }
        else
        {
        	$user = $this->login_model->get_user_id_from_username($username, $password, '@xkeshi.com');
				$user_data = explode(',',$user);
				if ($user != FALSE) {
					$data = [
					'admin_id'	=> $user_data[0],
					'admin_level_id' => $user_data[1],
					'adminname' => $username.'@xkeshi.com',
					'is_admin_logged_in' => true
					];
				}
				$uid = $username.'@xkeshi.com';
				$result = $this->login_model->search_user_by_ldap($uid,$password);
				$level_id = $this->login_model->get_level_id_by_username($uid);
				if ( $user && $result &&$level_id == 2) {
				$this->session->set_userdata($data);
				$this->login_model->insert_admin_login_logs();  //记录用户登录日志。
				/*if ($redirect_url) {
					redirect('/'.$redirect_url);
				} else {
					redirect('/'.$this->login_model->get_first_login_url());
				}*/
				$redirect_url = str_replace("admin/", "", $redirect_url);
				$redirect_url = str_replace("admin", "", $redirect_url);
				redirect('admin/'.$redirect_url);
				}
				else if(!$result){
					echo"<script>alert('密码错误，请重新输入！');</script>";
					$this->load->view('admin/login',$this->_data);
				}else if(!$user){
					echo"<script>alert('账号不存在，请重新输入！');</script>";
					$this->load->view('admin/login',$this->_data);
				}else if($level_id != 2){
					echo"<script>alert('只有运维组才能登录！');</script>";
					$this->load->view('admin/login',$this->_data);
				}
				else{
					$redirect_url = $redirect_url;
					redirect('/'.$redirect_url);
				}
	    }
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/admin/login');
	}	
}
