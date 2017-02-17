<?php
defined('BASEPATH')OR exit('No direct script access allowes');

class Ldap extends Public_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library(array('session','form_validation','email','PHPRequests'));
		$this->load->helper(array('form','url','cookie','url_helper'));
		$this->load->model(array('ldap_model','admin/email_model','register_model'));
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
	// 邮箱密码重置页面
	public function EmailPasswordReset()
	{
		$data = array();
		$this->_data['title'] = '邮箱密码重置页面';
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/email_passwordreset',$this->_data);
		$this->load->view('default/footer');
	}
	// 邮箱密码重置接口(20170205停用)
	// public function PasswordReset()
	// {
	// 	$this->form_validation->set_rules('email','email','required');// 邮箱信息表单验证
	// 	$cTMailAlias = $this->input->post('email');//post获取重置密码的邮箱账号
	// 	$cTMailID = $this->config->item('ops_email_id');// 企业邮箱的管理员ID
	// 	$cTMailSecret = $this->config->item('ops_email_key');// 接口Key
	// 	$email_whitelist = $this->config->item('email_whitelist');// 企业邮箱白名单（总裁办等）
	// 	$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);// 获取OAuth验证授权
	// 	$password = 'Abc110';//初始化密码
	// 	$res = 0;
	// 	foreach ($email_whitelist as $key => $value) {
	// 		if ($cTMailAlias == $value) {
	// 			$res = 1;
	// 		}else{
	// 			$res = 0;
	// 		}
	// 	}
	// 	if ($res == 0) {
	// 		$result = $this->email_model->mod_email($access_token,$cTMailAlias,$password);// 企业邮箱密码重置操作
	// 		//$this->email_model->open_wxtoken($access_token,$cTMailAlias);// 开启强制启用微信动态密码
	// 		if ($result == NULL) {
	// 			redirect('/ldap/ResetShow');
	// 		}
	// 		else{
	// 			echo "<script>
	// 				alert('邮箱密码重置失败，请联系运维同事！');
	// 				location.href='../ldap/';
	// 				</script>";
	// 		}
	// 	}
	// 	else if($res == 1){

	// 	}
	// }
	// 邮箱账号信息补全（添加手机号）
	public function add_EmailInfo()
	{
		$this->form_validation->set_rules('email','email','required');// 邮箱信息表单验证
		$this->form_validation->set_rules('telephone','telephone','required');// 邮箱信息表单验证
		$cTMailAlias = $this->input->post('email');//post获取重置密码的邮箱账号
		$telephone = $this->input->post('telephone');//post获取需要添加的手机号
		$cTMailID = $this->config->item('ops_email_id');// 企业邮箱的管理员ID
		$cTMailSecret = $this->config->item('ops_email_key');// 接口Key
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);// 获取OAuth验证授权
		$email_whitelists = $this->config->item('email_whitelist');// 企业邮箱白名单（总裁办等）
		$res = 0;
		$u_id = $this->session->userdata('u_id');
		foreach ($email_whitelists as $key => $value) {
			if ($cTMailAlias == $value) {
				$res = 1;
			}else{
				$res = 0;
			}
		}// 邮箱账号遍历白名单
		if ($res == 0) {
			$result = $this->email_model->add_email_mobie($access_token,$cTMailAlias,$telephone);// 邮箱信息添加手机号
			$this->ldap_model->insert_email_update_logs($u_id);// 添加邮箱手机号绑定日志
			// print_r($result);
			// exit();
			if ($result == NULL) {
				redirect('/ldap/EmailPasswordReset');
			}
			else{
				echo "<script>
					alert('邮箱密码重置失败，请联系运维同事！');
					location.href='../ldap/';
					</script>";
			}
		}
		else if($res == 1){
			echo "<script>
				alert('邮箱密码重置失败！');
				location.href='../ldap/';
				</script>";
		}
	}
	// 邮箱验证AJAX
	public function ajax_email()
	{
		$email = $this->input->get('email');//邮箱账号
		$cTMailID = $this->config->item('ops_email_id');// 企业邮箱的管理员ID
		$cTMailSecret = $this->config->item('ops_email_key');// 接口Key
		$access_token = $this->register_model->get_access_token($cTMailID,$cTMailSecret);// 获得access_token
		$result = $this->register_model->check_email($access_token,$email);
		// 输出查询结果 -1：不可用 0:可注册 1：主账号 2：别名账号 3：邮件群组账号
		echo $result['List'][0]['Type'];
	}
	// 邮箱信息获取（手机号）
	public function ajax_EmailInfo()
	{
		$cTMailAlias = $this->input->get('email');//get获取重置密码的邮箱账号
		$cTMailID = $this->config->item('ops_email_id');// 企业邮箱的管理员ID
		$cTMailSecret = $this->config->item('ops_email_key');// 接口Key
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);// 获取OAuth验证授权
		$email = $this->email_model->get_account_info($access_token,$cTMailAlias);
		print_r($email['Mobile']);
	}
	// 跳转腾讯企业邮箱重置页面
	public function TXResetView()
	{
		redirect("https://exmail.qq.com/cgi-bin/readtemplate?check=false&t=biz_rf_portal#recovery");
	}
	// 邮箱密码重置结果页面(20170205停用)
	// public function ResetShow()
	// {
	// 	$data = array();
	// 	$this->_data['title'] = '邮箱密码重置结果';
	// 	$this->load->view('default/header',$this->_data_header);
	// 	$this->load->view('default/email_show',$this->_data);
	// 	$this->load->view('default/footer');
	// }
}