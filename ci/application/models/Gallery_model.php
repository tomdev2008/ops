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
		$this->load->helper(['cookie']);		
		$this->load->database();
		
	}

	public function get_platform_url() {
		$query = $this->db->query('select * from ops_gallery_platform where display_id = "1"');
		$data = $query->result();
		return $data;
	}
	public function get_gallery_platform_list() {
		$query = $this->db->query("select * from ops_gallery_platform");
		$row = $query->result();
		return $row;
	}
	public function get_gallerys($platform_id){
		$sql = "select id from ops_gallery_platform where display_id = '1'";
		$query = $this->db->query($sql);
		foreach ($query->result_array() as $row)
		{
		    $data[] = $row['id'];
		}
		$ids = implode(",",$data); 
		$gallery_sql_where = $platform_id != 'NULL' ? " WHERE gallery_platform_id = ".$platform_id."" : " WHERE gallery_platform_id in($ids)";
		$query = $this->db->query('select * from ops_gallery'.$gallery_sql_where);
		$data = $query->result();
		return $data;
	}
	public function get_user_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
}