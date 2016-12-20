<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Project_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}

	public function get_platform_list() {
		$query = $this->db->query("select * from ops_platform");
		$row = $query->result();
		return $row;
	}

	public function get_project_by_id($id) {
		$query = $this->db->query("select * from ops_project WHERE id = '".$id."'");
		$data = $query->result();
		return $data;
	}

	public function insert_project($data) {
		$this->db->insert('ops_project', $data);
		$result = $this->db->insert_id();
		return $result;
	}

	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}

	public function get_id_by_name($name) {
		$this->db->select('id');
		$this->db->from('ops_user');
		$this->db->where('name', $name);
		$data = $this->db->get()->row('id');
		return $data;
	}

	public function get_user_list() {
		$query = $this->db->query("select * from ops_user where group_leader = 1");
		$data = $query->result();
		return $data;
	}	
	public function get_user_id_by_id($id) {
		$this->db->select('user_id');
		$this->db->from('ops_project');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('user_id');
		return $data;
	}	
	public function get_alias_by_ip($ip) {
		$query = $this->db->query("select ip_alias from ops_ip WHERE ip ='".$ip."'");
		$row = $query->row_array();
		$data = '<span class="label label-info">'.$row['ip_alias'].'</span>&nbsp';
		return $data;
	}
	public function get_alias_name_by_server_project($server_project) {
		$this->db->select('name');
		$this->db->from('ops_project');
		$this->db->where('id', $server_project);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function get_repeat_id($container_sql_where) {
		$query = $this->db->query("select group_concat(CONCAT(server_deploy_ip,':',server_deploy_port)) from ops_app_server".$container_sql_where."  group by server_name");
		$data = $query->result();
		return $data;
	}
	public function get_project_id_by_server_name($server_name){
		$query = $this->db->query("select id from ops_app_server where server_name='".$server_name."'");
		$row = $query->result();
		return $row;
	}
	public function get_num_all_by_server_name($server_name){
		$sum = 0;
		$s = 0;
		$ID = $this->get_project_id_by_server_name($server_name);
		foreach ($ID as $key => $value)
		{
            $id = $value->id;
            $s += 1;
        }
        $sum += $s;
		return $sum;
	}
	public function get_alias_by_id($id) {
		$this->db->select('server_deploy_ip');
		$this->db->from('ops_app_server');
		$this->db->where('id', $id);
		$ip = $this->db->get()->row('server_deploy_ip');
		$query = $this->db->query("select ip_alias from ops_ip WHERE ip ='".$ip."'");
		$row = $query->row_array();
		$data = '<span class="label label-info">'.$row['ip_alias'].'</span> '.$ip;
		return $data;
	}
	public function get_vhost_alias_by_ip($ip) { 
		$this->db->select('ip_alias');
		$this->db->from('ops_ip');
		$this->db->where('ip', $ip);
		$ip = $this->db->get()->row('ip_alias');
		return str_replace(PHP_EOL, '', $ip);
	}
	public function get_server_name_by_id($id) {
		$this->db->select('server_name');
		$this->db->from('ops_app_server');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('server_name');
		return $data;
	}	
	public function get_server_type_by_id($id) {
		$this->db->select('server_type');
		$this->db->from('ops_app_server');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('server_type');
		return $data;
	}	
	public function get_server_deploy_port_by_id($id) {
		$this->db->select('server_deploy_port');
		$this->db->from('ops_app_server');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('server_deploy_port');
		return $data;
	}	
	public function get_app_domain_by_name($app_name) {
		$this->db->select('app_domain');
		$this->db->from('ops_app_domain');
		$this->db->where('app_name', $app_name);
		$data = $this->db->get()->row('app_domain');
		return $data;
	}	

	public function add_nginx_conf_upstream($upstream_name, $ip_servers) {
		$str = "upstream ".$upstream_name." {".PHP_EOL;
		foreach ($ip_servers as $key => $value) {
			$str .= "    server ".$value."; #".$this->project_model->get_vhost_alias_by_ip(strstr($value,':',true)).PHP_EOL;
		}
		$str .= "}".PHP_EOL;

		return $str;
	}		
	public function add_nginx_conf_tmp1() {
		$str = "server{".PHP_EOL;
		$str .= "    listen 80;".PHP_EOL;
		$str .= "    server_name xkeshi.net;".PHP_EOL;
		return $str;
	}	
	public function add_nginx_conf_tmp2() {
		$str = "}".PHP_EOL;
		return $str;
	}	
	public function add_nginx_conf_server($upstream_name) {
		$str = "    location /".$upstream_name."/{".PHP_EOL;
		$str .= "        proxy_pass "."http://".$upstream_name."/;".PHP_EOL;	
		$str .= "        include proxy.conf;".PHP_EOL;
		$str .= "    }".PHP_EOL;
		return $str;
	}	
}
