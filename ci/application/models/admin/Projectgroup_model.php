<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Projectgroup_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}

	public function insert_projectgroup($data) {
		$this->db->insert('ops_platform', $data);
		$result = $this->db->insert_id();
		return $result;
	}

	public function get_projectgroup_list(){
		$data = array();
		$query = $this->db->query('select * from ops_platform');
		$data = $query->result();
		return $data;
	}

	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_platform');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}	

}