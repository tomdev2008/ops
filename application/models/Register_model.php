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
}