<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Group_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}

	public function insert_user_level($data) {
		$this->db->insert('ops_user_level', $data);
		$result = $this->db->insert_id();
		return $result;
	}

	public function get_user_level_list(){
		$data = array();
		$query = $this->db->query('select * from ops_user_level');
		$data = $query->result();
		return $data;
	}

	public function get_level_by_id($id) {
		$this->db->select('level_name,ldap_ou');
		$this->db->from('ops_user_level');
		$this->db->where('id', $id);
		$data = $this->db->get()->row();
		return $data;
	}	

}