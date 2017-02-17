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
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}		
	public function get_user_level_list() {
		$query = $this->db->query("select * from ops_user_level");
		$row = $query->result();
		return $row;
	}
	public function get_user_role_list() {
		$query = $this->db->query("select * from ops_user_role");
		$row = $query->result();
		return $row;
	}
	public function get_front_power_list() {
		$query = $this->db->query("select * from ops_user_power where power_type = '1'");
		$data = $query->result();
		return $data;
	}
	public function get_user_by_level_id($level_id){
		$user_sql_where = $level_id ? " and level_id = '".$level_id."'" : "";
		$query = $this->db->query('select * from ops_user where is_dimission = 1 '.$user_sql_where.' order by group_leader desc,id desc');
		$data = $query->result();
		return $data;
	}
	public function get_users_desc(){
		$query = $this->db->query('select * from ops_user where is_dimission = 1 order by id DESC');
		$data = $query->result();
		return $data;
	}
	public function get_user_dimission(){
		$query = $this->db->query('select * from ops_user WHERE is_dimission = 0 order by group_leader DESC');
		$data = $query->result();
		return $data;
	}


	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}	

	public function get_role_by_id($id) {
		$this->db->select('role_id');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('role_id');
		return $data;
	}	
	public function get_role_name_by_id($id) {
		$this->db->select('role_name');
		$this->db->from('ops_user_role');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('role_name');
		return $data;
	}	
	public function get_level_id_by_id($id) {
		$this->db->select('level_id');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_id');
		return $data;
	}	

	public function get_email_by_id($id) {
		$this->db->select('email');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('email');
		return $data;
	}	

	public function get_id_by_email($email) {
		$this->db->select('id');
		$this->db->from('ops_user');
		$this->db->where('email', $email);
		$data = $this->db->get()->row('id');
		return $data;
	}	

	public function get_disconfig_by_id($user_id) {
		$this->db->select('power_status');
		$this->db->from('ops_user_action');
		$this->db->where('user_id', $user_id);
		$this->db->where('power_type', 2);
		$this->db->where('power_id', 26);
		$data = $this->db->get()->row('power_status');
		return $data;
	}	

	public function get_db_by_id($user_id) {
		$this->db->select('power_status');
		$this->db->from('ops_user_action');
		$this->db->where('user_id', $user_id);
		$this->db->where('power_type', 2);
		$this->db->where('power_id', 27);
		$data = $this->db->get()->row('power_status');
		return $data;
	}		

	public function get_man_by_id($id,$man) {
		$this->db->select($man);
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('qq');
		return $data;
	}	
	public function get_user_level(){
		$query = $this->db->query('SELECT * FROM ops_user');
		$data = $query->result();
		return $data;
	}

	public function get_users_level(){
		$data = array();
		$query = $this->db->query('select * from ops_user_level');
		$data = $query->result();
		return $data;
	}
	public function jundge_disconfig_by_user_id($user_id) {
		$this->db->select('id');
		$this->db->from('ops_user_action');
		$this->db->where('power_id', '26');
		$this->db->where('user_id', $user_id);
		$data = $this->db->get()->row('id');
		return $data;
	}
	public function jundge_db_by_user_id($user_id) {
		$this->db->select('id');
		$this->db->from('ops_user_action');
		$this->db->where('power_id', '27');
		$this->db->where('user_id', $user_id);
		$data = $this->db->get()->row('id');
		return $data;
	}
}