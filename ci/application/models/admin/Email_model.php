<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Email_model class.
 * 
 * @extends CI_Model
 */
class Email_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}
	public $api_address = 'http://openapi.exmail.qq.com:12211/openapi/';
	// 获取access_token
 	public function get_access_token($cTMailID,$cTMailSecret)
 	{
 		// 获取Token的地址
		$cTMailGetAccessTokenURL = 'https://exmail.qq.com/cgi-bin/token';
		$cTMailContentData = [
			'grant_type' => 'client_credentials',
			'client_id' => $cTMailID,
			'client_secret' => $cTMailSecret
		];
 		// 创建会话
 		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($cTMailGetAccessTokenURL,$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		$cTMailAccessToken = $json_obj['access_token'];
		// 返回获取的AccessToken
		return $cTMailAccessToken;
 	}
 	// 检查邮箱账号是否可用
	public function check_email($cTMailAccessToken,$cTMailAlias)
	{
		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'email' => $cTMailAlias
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/check',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
	}
 	// 添加新成员邮箱(已测试)
 	public function add_email($cTMailAccessToken,$cTMailAlias,$name,$password,$partypath,$mobile)
 	{
 		// post地址
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 2,//添加为2
			'alias' => $cTMailAlias,
			'name' => $name,
			'password' => $password,
			'partypath' => $partypath,
			'mobile' => $mobile
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 添加群组成员（已测试）
	public function add_email_in_group($cTMailAccessToken,$group_alias,$members)
	{
		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'group_alias' => $group_alias,
			'members' => $members
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'group/addmember',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
	}
	// 获得子部门成员信息
	public function get_PartyUser($cTMailAccessToken,$partypath)
	{

		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'partypath' => $partypath
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'partyuser/list',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
	}
	//添加邮箱审核操作日志
	public function insert_email_check_logs($u_id) {
		$query = $this->db->query("select * from ops_user where id='$u_id'");
		$row = $query->row();
		$data =[
		    'email' => $row->email,
		    'name' => $row->name,
		    'login_ip' => $this->input->ip_address(),
		    'operation' => "5"
		];
		$this->db->insert('ops_user_logs', $data);
		//echo $this->db->set($data)->get_compiled_insert('ops_user_logs');
	}
	// 添加邮箱手机号绑定日志
	public function insert_email_update_logs($u_id) {
		$query = $this->db->query("select * from ops_user where id='$u_id'");
		$row = $query->row();
		$data =[
		    'email' => $row->email,
		    'name' => $row->name,
		    'login_ip' => $this->input->ip_address(),
		    'operation' => "7"
		];
		$this->db->insert('ops_user_logs', $data);
		//echo $this->db->set($data)->get_compiled_insert('ops_user_logs');
	}
	// 重置邮箱密码（已测试）
 	public function mod_email($cTMailAccessToken,$cTMailAlias,$password)
 	{ 		
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 3,//修改为3
			'alias' => $cTMailAlias,
			'password' => $password,
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 修改邮箱信息
 	public function update_email($cTMailAccessToken,$cTMailAlias,$name,$sex,$mobile,$tel,$position,$partypath)
 	{
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 3,//修改为3
			'alias' => $cTMailAlias,
			'name' => $name,
			'gender' => $sex,
			'position' => $position,
			'tel' => $tel,
			'mobile' => $mobile,
			'position' => $position,
			'partypath' => $partypath,
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 修改个人邮箱信息（添加手机号）
 	public function add_email_mobie($cTMailAccessToken,$cTMailAlias,$mobile)
 	{
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 3,//修改为3
			'alias' => $cTMailAlias,
			'mobile' => $mobile,
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 开启强制启用微信动态密码
 	public function open_wxtoken($cTMailAccessToken,$cTMailAlias)
 	{
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'alias' => $cTMailAlias,
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/openwxtoken',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 获取用户信息
 	public function get_account_info($cTMailAccessToken,$cTMailAlias)
 	{
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'alias' => $cTMailAlias
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/get',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 禁用邮箱
 	public function email_disable($cTMailAccessToken,$cTMailAlias,$opentype)
 	{ 		
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 3,//修改为3
			'alias' => $cTMailAlias,
			'opentype' => $opentype
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 运维人员密码校验
 	public function search_user_by_ldap($uid,$password){
		$ds = ldap_connect("192.168.184.101:389");
		ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);// Binding to ldap server
		$r = ldap_bind($ds,"cn=admin,dc=xkeshi,dc=so","Xkeshi@123");
		$filter = "(|(uid=$uid))";
		$sr = ldap_search($ds, "ou=chengdao,dc=xkeshi,dc=so",$filter);
		$info = ldap_get_entries($ds, $sr);
		if ($info) {
			@$userPassword = substr($info[0]["userpassword"][0],5);
		}
		if ($userPassword == base64_encode(md5($password,true))) {
			return true;
		}
		else if ($userPassword != base64_encode(md5($password,true))) {
			return false;
		}
		ldap_unbind($ds);
	}
}