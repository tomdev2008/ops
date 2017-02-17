<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Disconfig_model class.
 * 
 * @extends CI_Model
 */
class Disconfig_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);
		$this->load->database();
	}
	public function insert_disconfig_batch($data) {
		foreach ($data as $value) {
			$this->db->set('create_time', 'NOW()', false);
			$this->db->set('update_time', 'NOW()', false);
			$this->db->insert('ops_disconfig', $value);
			$result = $this->db->insert_id();
		}
		return $result;
	}
	public function insert_disconfig($data) {
		$this->db->set('create_time', 'NOW()', false);
		$this->db->set('update_time', 'NOW()', false);
		$this->db->insert('ops_disconfig', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function get_env(){
		$query = $this->db->query("select id,server_env from ops_project_env");
		$data = $query->result();
		return $data;
	}
	public function get_version_by_appid_env($app,$env){
		$query = $this->db->query("select distinct version from ops_disconfig where app_id= '".$app."' and env_id= '".$env."' order by version desc limit 0,6");
		$data = $query->result();
		return $data;
	}

	public function get_name_by_project($project_id,$env_id){
		$query = $this->db->query("select distinct server_name,server_alias_name from ops_app_server where server_env = '".$env_id."' and server_project = '".$project_id."'");
		$row = $query->result();
		return $row;
	}
	public function get_id_by_name($name) {
		$this->db->select('id');
		$this->db->from('ops_project');
		$this->db->where('name', $name);
		$data = $this->db->get()->row('id');
		return $data;
	}
	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_project');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function get_by_server_name($server_name) {
		$this->db->select('server_name');
		$this->db->from('ops_app_server');
		$this->db->where('server_name', $server_name);
		$data = $this->db->get()->row('server_name');
		return $data;
	}
	public function get_server_alias_name_by_server_name($server_name) {
		$this->db->select('server_alias_name');
		$this->db->from('ops_app_server');
		$this->db->where('server_name', $server_name);
		$data = $this->db->get()->row('server_alias_name');
		return $data;
	}
	public function get_project_name() {
		$query = $this->db->query("select id,name from ops_project order by platform_id,id asc");
		$row = $query->result();
		return $row;
	}
	public function env_switch($env){
		switch ($env) {
			case '1':
				return $env = "dev";
				break;
			case '2':
				return $env = "test";
				break;
			case '3':
				return $env = "pre";
				break;
			case '4':
				return $env = "product";
				break;
			// case '5':
			// 	return $env = "local";
			// 	break;
			// case '6':
			// 	return $env = "autoprepub";
			// 	break;
			default:
				return $env = "";
				break;
		}
	}
	public function get_info_by_app_env_version($app,$env,$version){
		$query = $this->db->query("select * from ops_disconfig where app_id= '".trim($app)."' and env_id= '".trim($env)."' and version= '".trim($version)."' order by sensitive_status desc,create_time desc ");
		$data = $query->result();
		return $data;
	}
	public function get_conf_data_by_id($id){
		$this->db->select('name,value,app_id,sensitive_status,redundance');
		$this->db->from('ops_disconfig');
		$this->db->where('config_id',$id);
		$data = $this->db->get()->row();
		return $data;
	}
	public function get_server_data($server_name){
		if ($server_name == "") show_404();
		$query = $this->db->query("select * from ops_app_server where server_name = '".$server_name."'");
		$data = $query->result();
		// if (!$data) show_404();
		return $data;
	}
	// public function get_server_data_one($server_name){
	// 	if ($server_name == "") show_404();
	// 	$this->db->select('*');
	// 	$this->db->from('ops_app_server');
	// 	$this->db->where('server_name',$server_name);
	// 	$data = $this->db->get()->row();
	// 	return $data;
	// }	
	public function get_jenkins_data($server_name){
		if ($server_name == "") show_404();
		$this->db->select('*');
		$this->db->from('ops_app_jenkins');
		$this->db->where('ops_server_name',$server_name);
		$data = $this->db->get()->row();
		// if (!$data) show_404();
		return $data;
	}
	public function get_conf_data($env,$type,$version,$key){
		// if ($env == "" || $version == "" || $key == "") {
		// 	show_404();
		// }
		$this->db->select('name,value');
		$this->db->from('ops_disconfig');
		$this->db->where('app_id',$env);
		$this->db->where('type',0);
		$this->db->where('version',$version);
		$this->db->where('name',$key);
		$data = $this->db->get()->row();
		// if (!$data) show_404();
		return $data;
		
	}
	public function mac(){
		$query = $this->db->query("select * from ops_user where mac=''");
		$email = $query->result();
		return $email;
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
		$this->email->from('opsalerts@xkeshi.com', '【运维部】');
		$this->email->to($email);
		$this->email->subject('From 运维部的友情提醒');
		//$link = "http://ops.xkeshi.so/ticket/view/".$id_hidden;
		$link = "运维平台地址:<a href='http://ops.xkeshi.so/'>点击进入</a>";
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
		$message = "<h3>MAC地址登记</h3>".
					$name.":你好，由于运维工作需要（为了公司网络安全）<br>
					请尽快将自己工作电脑的物理MAC地址在运维平台中做好登记。<br>
					以下链接中有详细操作方法： <a href='ftp://ftp.ops.xkeshi.so/FAQ/mac-find-post.html'>ftp://ftp.ops.xkeshi.so/FAQ/mac-find-post.html</a><br>
		".$link.$footer;
		$this->email->message($message);
		$this->email->send();
	}
	public function update_value($id,$data){
		$where = " config_id = ".$id;
		$query = $this->db->update('ops_disconfig',$data,$where);
		return $query;
	}
	public function change_version($id,$data){
		$where = " config_id = ".$id;
		$query = $this->db->update('ops_disconfig',$data,$where);
		return $query;
	}
	public function delete_disconf($id){
		$data = [
			'config_id' => $id
		];
		$del = $this->db->delete('ops_disconfig',$data);
		return $del;
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
	public function get_disconf_recently(){
		$query = $this->db->query("select * from ops_disconfig order by update_time desc limit 0,10");
		$data = $query->result();
		return $data;
	}
	public function insert_admin_opearte_log_del($admin_id){
		$query = $this->db->query("select * from ops_user where id='$admin_id'");
		$row = $query->row();
		$data =[
		    'email' => $row->email,
		    'name' => $row->name,
		    'login_ip' => $this->input->ip_address(),
		    'operation' => "3"
		];
		$this->db->insert('ops_user_logs', $data);
		//echo $this->db->set($data)->get_compiled_insert('ops_user_logs');
		// $data = [
		//     'user_ip'  => $this->input->ip_address()
		// ];
		// $this->db->where('id', $u_id);
		// $this->db->update('ops_user', $data);
	}
	public function insert_admin_opearte_log_update($admin_id){
		$query = $this->db->query("select * from ops_user where id='$admin_id'");
		$row = $query->row();
		$data =[
		    'email' => $row->email,
		    'name' => $row->name,
		    'login_ip' => $this->input->ip_address(),
		    'operation' => "4"
		];
		$this->db->insert('ops_user_logs', $data);
	}
	public function DisconfigTemplet($env,$registry_address,$monitor_address)
	{
		$templet = $this->config->item['dubbo.properties'];
		return $this->parser->parse_string($templet,true);
	}
}