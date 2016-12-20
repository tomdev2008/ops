<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Login_model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie']);		
		$this->load->database();
		
	}
	public function get_level_id_by_username($username){
		$this->db->select("level_id");
		$this->db->from("ops_user");
		$this->db->where('email',$username);
		$data = $this->db->get()->row('level_id');
		return $data;
	}
	public function get_user_id_from_username($username, $password, $domain) {
		$level_id = ['1', '2', '3'];  //后端管理组和运维组,API组
		$this->db->select('id, level_id');
		$this->db->from('ops_user');
		$this->db->where('email', $username.$domain);
		//$this->db->where_in('level_id', $level_id);
		$data = $this->db->get()->row();
		if ($data) {
			return $data->id.','.$data->level_id;
		} else {
			return false;
		}
	}

	public function insert_admin_login_logs() {
		$admin_id = $this->session->userdata('admin_id');
		$query = $this->db->query("select * from ops_user where id='$admin_id'");
		$row = $query->row();
		$data =[
		    'email' => $this->session->userdata('adminname'),
		    'name' => $row->name,
		    'login_ip' => $this->input->ip_address(),
		    'operation' => 0
		];
		$this->db->insert('ops_user_logs', $data);
		//echo $this->db->set($data)->get_compiled_insert('ops_user_logs');

		$data = [
		    'user_ip'  => $this->input->ip_address()
		];
		$this->db->where('id', $admin_id);
		$this->db->update('ops_user', $data);
	}

	public function logged_in_redirect(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(isset($is_logged_in) && $is_logged_in == true){
			$redirect_url = $this->input->get('redirect', TRUE);
			redirect('/'.$redirect_url);		
		}		
	}

	public function set_username_remember($username) {
			$cookie = [
			    'name'   => 'cookie_username',
			    'value'  => $username,
			    'expire' => '86500',
			];
			$this->input->set_cookie($cookie);
	}

	public function get_first_login_url() {   //登录默认进入页
		$user_level_id = $this->session->userdata('u_level_id');
		$this->db->select('col_route_name');
		$this->db->from('ops_col_permissions');
		$this->db->where("FIND_IN_SET('$user_level_id',ops_permissions) !=", 0);
		return $this->db->get()->row('col_route_name');
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
}