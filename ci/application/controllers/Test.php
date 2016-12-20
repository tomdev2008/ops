<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends Public_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->library(array('session', 'form_validation','email','PHPRequests'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
		$this->load->model('email_model');
	}
	public function index()
	{

		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 需要调用信息的邮箱名
		$cTMailAlias = 'ops@xkeshi.so';
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		//$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		print_r($this->email_model->get_account_info($access_token,$cTMailAlias));
	}
	// 邮箱添加 接口
	public function add_email()
	{
		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获取OAuth验证授权
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		// 添加的账号信息
		$cTMailAlias = 'yyx@xkeshi.so';//邮箱号（必填）
		$name = '严屹潇';//姓名（必填）
		$password = 'Ni123456';//密码（必填）
		$partypath = 'IT部/运维部';//部门（必填）

		$result = $this->email_model->add_email($access_token,$cTMailAlias,$name,$password,$partypath);
		if ($result == NULL) {
			echo "注册成功";
		}
		else if($result['error'] == "user_existed"){
			echo "账号已存在";
		}
		else if($result['error'] == "pwd_invalid"){
			echo "密码不符合安全设定";
		}
		else if ($result['error'] == "party_not_found") {
			echo "邮箱组别不存在";
		}
	}
	// 邮箱删除 接口
	public function del_email()
	{
		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获取OAuth验证授权
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		// 需要删除的账号信息
		$cTMailAlias = 'jh@xkeshi.so';

		$result = $this->email_model->del_email($access_token,$cTMailAlias);
		if ($result == NULL) {
			echo "删除成功";
		}
		else if($result['error'] == "user_not_found"){
			echo "未找到该邮箱";
		}
	}
	// 邮箱修改 接口
	public function mod_email()
	{
		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获取OAuth验证授权
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		// 需要修改的账号信息
		$cTMailAlias = 'jh@xkeshi.so';//邮箱名（不可改，但可以申请别名）
		$name = '姜杭';//姓名
		$gender = '1';//性别（男1,女2）
		$mobile = '12300000000';//手机号
		$password = 'Ni123456';//密码（有设定）
		$partypath = 'IT部/运维部';//部门（必须存在）
		$position = '网管';//职务

		$result = $this->email_model->mod_email($access_token,$cTMailAlias,$name,$gender,$position,$mobile,$password,$partypath);
		if ($result == NULL) {
			echo "修改成功";
		}
		else if($result['error'] == "user_not_found"){
			echo "未找到该邮箱";
		}
		else if($result['error'] == "pwd_invalid"){
			echo "密码不符合安全设定";
		}
		else if ($result['error'] == "party_not_found") {
			echo "邮箱组别不存在";
		}
	}
	// 检查邮箱账号是否可用
	public function check_email()
	{
		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获取OAuth验证授权
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		// 需要检测的账号信息
		$cTMailAlias = 'ops@xkeshi.com';

		print_r($this->email_model->check_email($access_token,$cTMailAlias));
	}
	// 添加部门 接口
	public function add_party()
	{
		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获取OAuth验证授权
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		// 需要添加的邮箱部门
		$dstparty = '销售部/会计部/算账部';//一定要写对，没有报错信息！！

		$result = $this->email_model->add_party($access_token,$dstparty);
		if ($result == NULL) {
			echo "部门添加成功";
		}
	}
	// 删除部门 接口
	public function del_party()
	{
		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获取OAuth验证授权
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		// 需要删除的邮箱部门
		$dstparty = '销售部/会计部/算账部';//一定要写对，没有报错！！

		$result = $this->email_model->del_party($access_token,$dstparty);
		if ($result == NULL) {
			echo "部门删除成功";
		}
		else if ($result['error'] == "party_has_subparty") {
			echo "该部门下还有子部门，请先删除子部门！";
		}
		else if ($result['error'] == "party_has_partyuser") {
			echo "该部门下还有成员，请先删除成员！";
		}
	}
	// 修改部门 接口（有问题）
	// public function mod_party()
	// {
	// 	// 企业邮箱的管理员ID
	//  $cTMailID = $this->config->item('ops_email_id');
	// 接口Key
	//	$cTMailSecret = $this->config->item('ops_email_key');
	// 	// 获取OAuth验证授权
	// 	$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
	// 	// 需要修改的邮箱部门
	// 	$dstpath = '销售部/会计部/算账部';
	// 	$srcpath = '销售部';

	// 	$result = $this->email_model->mod_party($access_token,$dstpath,$srcpath);
	// 	print_r($result);
	// }

	// 添加群组
	public function add_group()
	{
		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获取OAuth验证授权
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		// 添加群组信息
		$group_name = "开发";
		$group_admin = "dev@xkeshi.so";
		$status = "inner";
		$this->email_model->add_group($access_token,$group_name,$group_admin,$status);
	}
	// 添加群组成员
	public function add_email_in_group()
	{
		// 企业邮箱的管理员ID
		$cTMailID = $this->config->item('ops_email_id');
		// 接口Key
		$cTMailSecret = $this->config->item('ops_email_key');
		// 获取OAuth验证授权
		$access_token = $this->email_model->get_access_token($cTMailID,$cTMailSecret);
		//添加群组信息
		$group_alias = 'ops@xkeshi.so';
		$members = 'nxb@xkeshi.so';
		$res = $this->email_model->add_email_in_group($access_token,$group_alias,$members);
		print_r($res);
		$error = [
			'user_existed' => '该群组中已存在该成员',
			'user_not_found' => '该成员不存在',
			'error unknown' => '群组不存在'
		];
		if ($res == NULL) {
			echo "注册成功！";
		}else{
			echo $error[$res['error']];
		}
	}
}