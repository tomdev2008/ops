<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Gallery_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}

	public function get_gallery_platform_list() {
		$query = $this->db->query("select * from ops_gallery_platform");
		$row = $query->result();
		return $row;
	}
	public function get_gallery_list_by_id($id) {
		$query = $this->db->query("select * from ops_gallery where id='".$id."'");
		$row = $query->result();
		return $row;
	}	
	public function insert_gallery($data) {
		$this->db->insert('ops_gallery', $data);
		$result = $this->db->insert_id();
		return $result;
	}

	public function get_gallery_platform(){
		$data = array();
		$query = $this->db->query('select * from ops_gallery_platform');
		$data = $query->result();
		return $data;
	}

	public function get_url_by_id($id) {
		$this->db->select('gallery_url');
		$this->db->from('ops_gallery');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('gallery_url');
		return $data;
	}	
	public function get_gallery_name_by_id($id) {
		$this->db->select('gallery_name');
		$this->db->from('ops_gallery');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('gallery_name');
		return $data;
	}
	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}	
	public function get_user_name_by_id($id) {
		$this->db->select('user_name');
		$this->db->from('ops_gallery');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('user_name');
		return $data;
	}	
	public function get_gallery_name_by_platform_id($id) {
		$this->db->select('gallery_name');
		$this->db->from('ops_gallery_platform');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('gallery_name');
		return $data;
	}
	public function get_platform_id_by_gallery_name($name) {
		$this->db->select('id');
		$this->db->from('ops_gallery_platform');
		$this->db->where('gallery_name', $name);
		$data = $this->db->get()->row('id');
		return $data;
	}
	public function get_platform_id_by_id($id) {
		$this->db->select('gallery_platform_id');
		$this->db->from('ops_gallery');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('gallery_platform_id');
		return $data;
	}
}