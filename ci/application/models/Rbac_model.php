<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Rbac_model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie']);		
		$this->load->database();
		
	}
	public function get_role_id_by_id($id) {
		$this->db->select('role_id');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('role_id');
		return $data;
	}
	public function get_permission_by_id_cname($id) {
		$this->db->select('power_status');
		$this->db->from('ops_user_role_to_power');
		$this->db->where('role_id', $id);
		$this->db->where('power_id', 1);
		$this->db->where('power_type', 1);
		$data = $this->db->get()->row('power_status');
		return $data;
	}
	public function get_permission_by_id_server($id) {
		$this->db->select('power_status');
		$this->db->from('ops_user_role_to_power');
		$this->db->where('role_id', $id);
		$this->db->where('power_id', 2);
		$this->db->where('power_type', 1);
		$data = $this->db->get()->row('power_status');
		return $data;
	}
	public function get_permission_by_id_esxi($id) {
		$this->db->select('power_status');
		$this->db->from('ops_user_role_to_power');
		$this->db->where('role_id', $id);
		$this->db->where('power_id', 3);
		$this->db->where('power_type', 1);
		$data = $this->db->get()->row('power_status');
		return $data;
	}
	public function get_permission_by_id_project($id) {
		$this->db->select('power_status');
		$this->db->from('ops_user_role_to_power');
		$this->db->where('role_id', $id);
		$this->db->where('power_id', 4);
		$this->db->where('power_type', 1);
		$data = $this->db->get()->row('power_status');
		return $data;
	}
	public function get_permission_by_id_container($id) {
		$this->db->select('power_status');
		$this->db->from('ops_user_role_to_power');
		$this->db->where('role_id', $id);
		$this->db->where('power_id', 5);
		$this->db->where('power_type', 1);
		$data = $this->db->get()->row('power_status');
		return $data;
	}
	public function get_permission_by_id_analysis($id) {
		$this->db->select('power_status');
		$this->db->from('ops_user_role_to_power');
		$this->db->where('role_id', $id);
		$this->db->where('power_id', 9);
		$this->db->where('power_type', 1);
		$data = $this->db->get()->row('power_status');
		return $data;
	}
}