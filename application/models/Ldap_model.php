<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Ldap_model class.
 * 
 * @extends CI_Model
 */
class Ldap_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie']);
		$this->load->database();
	}
	public function judge_pwd($password1,$password2){
		if ($password1 == $password2) {
			return TRUE;
		}
		else if($password1 != $password2) {
			return FALSE;
		}
	}
	public function judge_ldap_pwd($username,$pwd){
		$ds = ldap_connect("192.168.184.101:389");//Connect to ldap server
		ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);// Binding to ldap server
		$r = ldap_bind($ds,"cn=admin,dc=xkeshi,dc=so","Xkeshi@123");//Admin login ldap server
		$sr = ldap_search($ds,"ou=chengdao,dc=xkeshi,dc=so", "(uid=$username)");
		$info = ldap_get_entries($ds, $sr);
		if ($info) {
			@$userPassword = substr($info[0]["userpassword"][0],5);
		}
		if ($userPassword != base64_encode(md5($pwd,true))) {
			return FALSE;
		}
		else if ($userPassword == base64_encode(md5($pwd,true))) {
			return TRUE;
		}
	}
	public function change_ldap_pwd($username,$pwd){
		$ds = ldap_connect("192.168.184.101:389");//Connect to ldap server
		ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);// Binding to ldap server
		$r = ldap_bind($ds,"cn=admin,dc=xkeshi,dc=so","Xkeshi@123");//Admin login ldap server
		$tr = ldap_search($ds,"ou=chengdao,dc=xkeshi,dc=so", "(uid=$username)");
		$dn = ldap_get_entries($ds, $tr)[0]["dn"];//dn
		$info["userpassword"] = "{MD5}".base64_encode(md5($pwd,true));//输入新的密码
		$sr = ldap_modify($ds, $dn, $info);//修改密码
		if ($sr) {
			return true;
		}
		else{
			return false;
		}
	}
}