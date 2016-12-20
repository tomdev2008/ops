<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Server_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}

	public function judge_expire_flag($opr_time) {
		$data = substr($opr_time,0,2) - date('m');
		return $data;
	}

	public function get_servers_data_list($server_env,$platform_id) {
		$array = [];
		$server_env != '' ? $array['server_env'] = $server_env : "";
		$platform_id != '' ? $array['platform_id'] = $platform_id : "";
		// print_r($array);
		$query = $this->db->select('*')
        ->where($array)
        ->get('ops_ip');
        // print_r($query);
		$servers = $query->result();
		return $servers;
	}

	public function get_servers_data_list_bak($server_env,$platform_id) {
		$empty_env = empty($server_env);
		$empty_platform = empty($platform_id);
		if ($server_env == 'NULL' && $platform_id == 'NULL') {
			$server_sql_where = " ";
		}
		if ($server_env == 'NULL' && $platform_id != 'NULL') {
			$server_sql_where = " WHERE platform_id = ".$platform_id;
		} 
		if ($server_env == '0' && $platform_id == 'NULL') {
			$server_sql_where = " WHERE server_env = '0'";
		}
		if ($server_env == '0' && $platform_id != 'NULL') {
			$server_sql_where = " WHERE server_env = '0' and platform_id = ".$platform_id;
		}
		if ($server_env != 'NULL' && $platform_id == 'NULL' && $server_env != '0') {		
			$server_sql_where = " WHERE server_env = ".$server_env;
		}		
		if ($server_env != 'NULL' && $platform_id != 'NULL' && $server_env != '0') {		
			$server_sql_where = " WHERE server_env = ".$server_env." and platform_id = ".$platform_id;
		}	
		echo $server_sql_where;
		$query = $this->db->query("select * from ops_ip".$server_sql_where." order by id desc");
		$servers = $query->result();
		return $servers;
	}
	public function get_env_list() {
		$query = $this->db->query("select * from ops_project_env");
		$row = $query->result();
		return $row;
	}

	public function get_location_list() {
		$query = $this->db->query("select * from ops_ip_location");
		$row = $query->result();
		return $row;
	}
	public function get_project_env_list() {
		$query = $this->db->query("select * from ops_project_env");
		$data = $query->result();
		return $data;
	}
	public function insert_server($data) {
		$this->db->insert('ops_ip', $data);
		$result = $this->db->insert_id();
		return $result;
	}

	public function get_platform_list() {
		$query = $this->db->query("select * from ops_platform");
		$row = $query->result();
		return $row;
	}

	public function get_esxi_list() {
		$query = $this->db->query("SELECT * FROM ops_ip WHERE type = 'ESXi'");
		$row = $query->result();
		return $row;
	}
}