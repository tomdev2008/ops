<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Register_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie']);		
		$this->load->database();
	}
	public $api_address = 'http://openapi.exmail.qq.com:12211/openapi/';
	public function get_user_all(){
		$query = $this->db->query("select * from ops_user");
		$row = $query->result();
		return $row;
	}
	public function insert_user($data) {
		$this->db->insert('ops_user', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function get_level_id(){
		$query = $this->db->query("select * from ops_user_level");
		$row = $query->result();
		return $row;
	}
	public function get_name_by_level_id($id){
		$this->db->select('level_name');
		$this->db->from('ops_user_level');
		$this->db->where('id',$id);
		$data = $this->db->get()->row('level_name');
		return $data;
	}
	public function judge_email(){
		$query = $this->db->query("select email from ops_user");
		$row = $query->result();
		return $row;
	}
	public function get_ou_by_level_id($level_id){
		$this->db->select("ldap_ou");
		$this->db->from("ops_user_level");
		$this->db->where("id",$level_id);
		$data = $this->db->get()->row("ldap_ou");
		return $data;
	}
	public function ldapadmin($name,$email,$password,$ou){
		$ds = ldap_connect("192.168.184.101:389");
		ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);
		$sr = ldap_bind($ds,"cn=admin,dc=xkeshi,dc=so","Xkeshi@123");
		$info["cn"] = $email; 
		$info["uid"] = $email;
		// $info["sn"] = "qq";
		//$info["dn"] = "uid=".$email.",ou=".$ou.",ou=chengdao,dc=xkeshi,dc=so";
		$info["givenname"] = mb_substr($name,0,1,'utf-8');
		$info["sn"] = mb_substr($name,1,10,'utf-8');
		$info["userpassword"] = "{MD5}".base64_encode(md5($password,true));//密码
		$info['objectclass'][0] = "top";
	 	$info['objectclass'][1] = "posixAccount";
	 	$info['objectclass'][2] = "inetOrgPerson";
	 	$info["homedirectory"] = "/home/users/$email";
	 	$info["loginshell"] = "/bin/bash";
	 	$info["gidnumber"] = 0;
	 	$today = date("YmdHis");
	 	$info["uidnumber"] = (int)$today;
		// $info["userPassword"] = $password;//密码
		// $info["homedirectory"] = "/home/users/$email";
		// $info['objectclass'] = "inetOrgPerson";
		@$sr = ldap_add($ds,"uid=$email,ou=$ou,ou=chengdao,dc=xkeshi,dc=so",$info);
		ldap_unbind($ds);
	}
	public function search_user_by_ldap($uid){
		$result = 0;
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
			$result = 1;
		}
		ldap_unbind($ds);
		return $result;
	}
	public function get_tel(){
		$query = $this->db->query("select * from ops_user");
		$row = $query->result();
		return $row;
	}
	public function Email_to_ops($name){
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.exmail.qq.com';
		$config['smtp_user'] = 'opsalerts@xkeshi.com';
		$config['smtp_pass'] = 'Xkeshi@123';
		$config['mailtype'] = 'html';
		//$config['validate'] = true;
		//$config['priority'] = 1;
		$config['smtp_port'] = 465;
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$config['crlf'] = "\r\n";
		$this->email->set_newline("\r\n");
		$this->email->from('opsalerts@xkeshi.com', '【运维人员管理系统】');
		$this->email->to('nxb@xkeshi.com');
		$this->email->subject('通知：有新的员工入职');
		$link = "<a href='http://ops.xkeshi.so/admin/user/'>http://ops.xkeshi.so/admin/user/</a>";
		$footer = "
		<br>
		<hr/>
		<p>
		<font size=4><strong>爱客仕运维部</strong></font>
		<br>
		电话：0571-87179065
		<br>
		地址：杭州市江干区钱江路1366号华润大厦A座14楼
		<br>
		网址：<a href=http://www.xkeshi.com>http://www.xkeshi.com</a>
		</p>
		";
		$message = "<strong>".$name."</strong> to 运维组：<br>
		有新的员工入职，需要马上处理。
		<br>申请内容：<strong>邮箱申请已提交，请尽快审核~</strong>
		<br>点击查看：<strong>".$link."</strong>".$footer;
		$this->email->message($message);
		$this->email->send();
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
}