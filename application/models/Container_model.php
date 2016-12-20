<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Container_model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie']);		
		$this->load->database();
		
	}

	public function get_alias_by_ip($ip) {
		if (!isset($ip)) return false;
		$jetty_ip_data = explode(',', $ip);
		$data = [];
		foreach ($jetty_ip_data as $key => $value_ip) {
			$data_ip = strpos($value_ip, ':') ? strstr($value_ip,":",true) : $value_ip;		
			$query = $this->db->query("select ip_alias from ops_ip WHERE ip ='".$data_ip."'");
			$row = $query->row_array();
			$data[$key] = '<span class="label label-info">'.$row['ip_alias'].'</span> '.$value_ip;
		}
		return implode(",",$data);
	}


	public function get_alias_by_ipv2($ip) {
		$query = $this->db->query("select ip_alias from ops_ip WHERE ip ='".$ip."'");
		$row = $query->row_array();
		$data = '<span class="label label-info">'.$row['ip_alias'].'</span> '.$ip;
		return $data;
	}

	/*$env_id:1,开发，2，测试3，预发，4，正式*/
	public function get_app_server_by_env_pro($project_id, $env_id) {
		$query = $this->db->query("select * from ops_app_server where server_env = '".$env_id."' and server_project = '".$project_id."'");
		$row = $query->result();
		foreach ($row as $key => $value) {
			$row[$key]->server_deploy_ip = $this->get_alias_by_ipv2($value->server_deploy_ip);
		}
		return $row;
	}

	/*$env_id:1,开发，2，测试3，预发，4，正式*/
	public function get_app_server_by_server($server_id, $env_id) {
		$query = $this->db->query("select * from ops_app_server where server_env = '".$env_id."' and server_deploy_ip = '".$server_id."'");
		$row = $query->result();
		foreach ($row as $key => $value) {
			$row[$key]->server_deploy_ip = $this->get_alias_by_ipv2($value->server_deploy_ip);
		}
		return $row;
	}

}