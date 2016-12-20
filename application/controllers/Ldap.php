<?php
defined('BASEPATH')OR exit('No direct script access allowes');

class Ldap extends Public_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library(array('session','form_validation','email'));
		$this->load->helper(array('form','url','cookie','url_helper'));
		$this->load->model('ldap_model');
	}
	public function index()
	{
		$data = array();
		$this->_data['title'] = '账号管理';
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/ldap',$this->_data);
		$this->load->view('default/footer');
	}
	public function update()
	{
		$username = $this->session->userdata('username');
		$this->form_validation->set_rules('oldpassword','oldpassword','required');
		$this->form_validation->set_rules('newpassword1','newpassword1','requiredeq');
		$oldpassword = $this->input->post('oldpassword');
		$newpassword1 = $this->input->post('newpassword1');
		$reslut = $this->ldap_model->judge_ldap_pwd($username,$oldpassword);
		if($reslut){
			$modify = $this->ldap_model->change_ldap_pwd($username,$newpassword1);
			if ($modify) {
				echo"<script>
        		alert('密码修改成功，请重新登录！');
        		location.href='../login/logout';
        		</script>";
			}
			// redirect('/login');
		}
		else if($reslut == false){
			echo "<script>
					alert('旧密码验证错误，请检查！');
					location.href='../ldap?type=update';
					</script>";
		}
	}
}