<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Platform_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}

	public function insert_platform($data) {
		$this->db->insert('ops_gallery_platform', $data);
		$result = $this->db->insert_id();
		return $result;
	}

	public function get_gallery_platform_list(){
		$data = array();
		$query = $this->db->query('select * from ops_gallery_platform');
		$data = $query->result();
		return $data;
	}

	public function get_name_by_id($id) {
		$this->db->select('gallery_name');
		$this->db->from('ops_gallery_platform');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('gallery_name');
		return $data;
	}	

}