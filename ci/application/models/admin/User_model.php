<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}
	public $api_address = 'http://openapi.exmail.qq.com:12211/openapi/';
	public function get_user_level_list() {
		$query = $this->db->query("select * from ops_user_level");
		$row = $query->result();
		return $row;
	}
	public function get_LevelName_by_LevelId($id){
		$this->db->select('level_name');
		$this->db->from('ops_user_level');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_name');
		return $data;
	}
	public function get_user_by_level_id($level_id){
		$user_sql_where = $level_id ? " and level_id = '".$level_id."'" : "";
		$query = $this->db->query('select * from ops_user where is_dimission = 1 '.$user_sql_where.' order by group_leader desc,id desc');
		$data = $query->result();
		return $data;
	}
	public function get_users_desc(){
		$query = $this->db->query('select * from ops_user where is_dimission = 1 order by id DESC');
		$data = $query->result();
		return $data;
	}
	public function get_user_dimission(){
		$query = $this->db->query('select * from ops_user WHERE is_dimission = 0 order by group_leader DESC');
		$data = $query->result();
		return $data;
	}
	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}	

	public function get_level_id_by_id($id) {
		$this->db->select('level_id');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_id');
		return $data;
	}	

	public function get_email_by_id($id) {
		$this->db->select('email');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('email');
		return $data;
	}	

	public function get_id_by_email($email) {
		$this->db->select('id');
		$this->db->from('ops_user');
		$this->db->where('email', $email);
		$data = $this->db->get()->row('id');
		return $data;
	}	

	public function get_tel_by_id($id) {
		$this->db->select('tel');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('tel');
		return $data;
	}	

	public function get_qq_by_id($id) {
		$this->db->select('qq');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('qq');
		return $data;
	}		

	public function get_man_by_id($id,$man) {
		$this->db->select($man);
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('qq');
		return $data;
	}	
	public function get_user_level(){
		$query = $this->db->query('SELECT * FROM ops_user');
		$data = $query->result();
		return $data;
	}

	public function get_users_level(){
		$data = array();
		$query = $this->db->query('select * from ops_user_level');
		$data = $query->result();
		return $data;
	}

	public function get_group_leader_by_id($id) {
		$this->db->select('group_leader');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('group_leader');
		return $data;
	}

	public function ldap_del($email){
		$ds = ldap_connect("192.168.184.101:389");
		ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);
		$r = ldap_bind($ds,"cn=admin,dc=xkeshi,dc=so","Xkeshi@123");
		$tr = ldap_search($ds,"ou=chengdao,dc=xkeshi,dc=so", "(uid=$email)");
		@$dn = ldap_get_entries($ds, $tr)[0]["dn"];//dn
		@$sr = ldap_delete($ds,$dn);
		ldap_unbind($ds);
		return $sr;
	}

	public function search_user_by_uid($uid){
		$ds = ldap_connect("192.168.184.101:389");
		ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);// Binding to ldap server
		//ldap_set_option ($ds,LDAP_OPT_REFERRALS,0);
		$r = ldap_bind($ds,"cn=admin,dc=xkeshi,dc=so","Xkeshi@123");
		// $justthese =array("cn","userPassword","uid","sn");
		// if ($r) {
		// 	echo "ok<br>";
		// }
		$filter = "(|(uid=$uid))";
		$sr = ldap_search($ds, "ou=chengdao,dc=xkeshi,dc=so",$filter);
		$info = ldap_get_entries($ds, $sr);
		// $info = ldap_get_entries($ds, $sr);
		if (@$info[0]["uid"][0] == $uid) {
			return true;
		}
		else{
			return flase;
		}
		ldap_unbind($ds);
	}

	public function search_user_by_ldap($uid,$password){
		$ds = ldap_connect("192.168.184.101:389");
		ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);// Binding to ldap server
		//ldap_set_option ($ds,LDAP_OPT_REFERRALS,0);
		$r = ldap_bind($ds,"cn=admin,dc=xkeshi,dc=so","Xkeshi@123");
		// $justthese =array("cn","userPassword","uid","sn");
		// if ($r) {
		// 	echo "ok<br>";
		// }
		$filter = "(|(uid=$uid))";
		$sr = ldap_search($ds, "ou=chengdao,dc=xkeshi,dc=so",$filter);
		$info = ldap_get_entries($ds, $sr);
		// print_r($info);
		// echo "</br>";
		// for ($i=0; $i < $info["count"]; $i++) { 
		// 	echo "</br>dn为：". $info[$i]["dn"];
		// 	echo "</br>cn为：". $info[$i]["cn"][0]; //显示cn
		// 	echo "</br>uid为：". $info[$i]["uid"][0]; //显示uid
		// 	echo "</br>givenname为：". $info[$i]["givenname"][0]; //显示givename
		// 	echo "</br>sn为：". $info[$i]["sn"][0]; //显示sn
		// 	echo "</br>uidnumber为：". $info[$i]["uidnumber"][0]; //显示uidnumber
		// 	echo "</br>objectclass为：". $info[$i]["objectclass"][0]; //显示uid
		// 	echo "</br>密码为：". $info[$i]["userpassword"][0]; //显示加密后的密码
		// 	$Password = base64_encode(md5($password,true));
		// }
		if ($info) {
			@$userPassword = substr($info[0]["userpassword"][0],5);
		}
		// echo $userPassword."  ".base64_encode(md5($password,true));
		// exit();
		if ($userPassword == base64_encode(md5($password,true))) {
			return true;
		}
		else if ($userPassword != base64_encode(md5($password,true))) {
			return false;
		}
		ldap_unbind($ds);
	}
	public function insert_user_login_logs($u_id) {//添加人员删除操作日志
		$query = $this->db->query("select * from ops_user where id='$u_id'");
		$row = $query->row();
		$data =[
		    'email' => $row->email,
		    'name' => $row->name,
		    'login_ip' => $this->input->ip_address(),
		    'operation' => "3"
		];
		$this->db->insert('ops_user_logs', $data);
		//echo $this->db->set($data)->get_compiled_insert('ops_user_logs');

		$data = [
		    'user_ip'  => $this->input->ip_address()
		];
		$this->db->where('id', $u_id);
		$this->db->update('ops_user', $data);
	}
	public function insert_email_check_logs($u_id) {//添加邮箱审核操作日志
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

		$data = [
		    'user_ip'  => $this->input->ip_address()
		];
		$this->db->where('id', $u_id);
		$this->db->update('ops_user', $data);
	}
	public function get_permission_by_id($id){
		$query = $this->db->query("select * from ops_user_ssh_server where user_id =".$id);
		$data = $query->result();
		return $data;
	}
	public function user_dimission($id){
		$data = [
			'is_dimission' => 0
		];
		$where = " id = ".$id;
		$query = $this->db->update('ops_user',$data,$where);
		return $query;
	}
	public function get_userinfo_by_id($id)
	{
		$query = $this->db->query("select * from ops_user where id = '".$id."'");
		$data = $query->result();
		return $data;
	}
	// 添加新成员邮箱(已测试)
 	public function add_email($cTMailAccessToken,$cTMailAlias,$name,$password,$partypath)
 	{
 		// post地址
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 2,//添加为2
			'alias' => $cTMailAlias,
			'name' => $name,
			'password' => $password,
			'partypath' => $partypath
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
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
 	public function update_email($id)
 	{
 		$data = [
			'email_exist' => 1
		];
		$where = " id = ".$id;
		$query = $this->db->update('ops_user',$data,$where);
		return $query;
 	}
 	public function get_EmailGroup()
 	{
 		$query = $this->db->query("select * from ops_user_level ");
		$data = $query->result();
		return $data;
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
	// 修改成员邮箱信息(改为禁用状态)
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
}