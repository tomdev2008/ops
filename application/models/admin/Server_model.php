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