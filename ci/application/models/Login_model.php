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

	public function insert_user($data) {
		$this->db->insert('ops_user', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function get_user_id_from_username($username, $password, $domain) {
		$level_id = ['1', '2', '3'];  //后端管理组和运维组,API组
		$this->db->select('id, level_id,role_id');
		$this->db->from('ops_user');
		$this->db->where('email', $username.$domain);
		$this->db->where('is_dimission', 1);
		//$this->db->where_in('level_id', $level_id);
		$data = $this->db->get()->row();
		if ($data) {
			return $data->id.','.$data->level_id.','.$data->role_id;
		} else {
			return false;
		}
	}
	public function accountvalidate($account)// 用户登录验证()
	{
		$this->db->select('id, level_id,role_id');
		$this->db->from('ops_user');
		$this->db->where('email', $account);
		$this->db->where('is_dimission', 1);
		$data = $this->db->get()->row();
		if ($data) {
			return $data->id.','.$data->level_id.','.$data->role_id;
		} else {
			return false;
		}
	}
	public function get_name_by_email($email) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('email', $email);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function insert_user_login_logs() {
		$u_id = $this->session->userdata('u_id');
		$query = $this->db->query("select * from ops_user where id='$u_id'");
		$row = $query->row();
		$data =[
		    'email' => $this->session->userdata('username'),
		    'name' => $row->name,
		    'login_ip' => $this->input->ip_address(),
		    'operation' => "1"
		];
		$this->db->insert('ops_user_logs', $data);
		//echo $this->db->set($data)->get_compiled_insert('ops_user_logs');

		$data = [
		    'user_ip'  => $this->input->ip_address()
		];
		$this->db->where('id', $u_id);
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

	public function reset_ldap_pwd($username){
		$ds = ldap_connect("192.168.184.101:389");//Connect to ldap server
		ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);// Binding to ldap server
		$r = ldap_bind($ds,"cn=admin,dc=xkeshi,dc=so","Xkeshi@123");//Admin login ldap server
		$tr = ldap_search($ds,"ou=chengdao,dc=xkeshi,dc=so", "(uid=$username)");
		@$dn = ldap_get_entries($ds, $tr)[0]["dn"];//dn
		$info["userpassword"] = "{MD5}".base64_encode(md5("Abc123",true));//输入新的密码
		@$sr = ldap_modify($ds, $dn, $info);//修改密码
		if ($sr) {
			return true;
		}
		else{
			return false;
		}
	}
	public function Email_to_user($email,$name){
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
		$this->email->from('opsalerts@xkeshi.com', '【运维账号管理系统】');
		$this->email->to($email);
		$this->email->subject('通知：您的账号密码已重置');
		//$link = "http://ops.xkeshi.so/ticket/view/".$id_hidden;
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
		$message = "运维组：hi ，<strong>".$name."</strong> 你好~ <br>
		你的账号密码已重置，新密码：<strong>Abc123</strong>。<br><br>
		<strong>运维平台：</strong>
		<a href='http://ops.xkeshi.so'>http://ops.xkeshi.so/</a><br>
		<strong>VPN登录网址：</strong>
		<a href='http://vpn.xkeshi.so'>https://vpn.xkeshi.so/</a><br>".$footer;
		$this->email->message($message);
		$this->email->send();
	}
	public function check_tel_by_email($email){
		$this->db->select("tel");
		$this->db->from("ops_user");
		$this->db->where('email',$email);
		$data = $this->db->get()->row('tel');
		return $data;
	}
}