<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Ot_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}
	
	public function get_ot($month){
		$query = $this->db->query("SELECT * FROM ops_ot where release_date like '".$month."%'");
		$data = $query->result();
		foreach ($data as $key => $name_id) {
			$key1 = $data[$key]->release_date;
			$key2 = $data[$key]->name_id;

			$data_project[$key1][$key2] = $data[$key]->start_time.','.$data[$key]->end_time;
		}
		if (isset($data_project)) {
			return $data_project;
		}
		
	}

	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}	

	public function get_level_id_by_id($id) {
		$this->db->select('level_id');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_id');
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

	public function get_ot_users($level_id){
		$user_sql_where = $level_id ? " WHERE level_id = '".$level_id."'" : "";
		$query = $this->db->query('SELECT * from ops_user'.$user_sql_where.'ORDER BY group_leader DESC');
		$data = $query->result();
		return $data;
	}

	public function get_ot_date($month){
		$month_sql_where = $month ? " WHERE release_date like '".$month."%'" : "";
		$query = $this->db->query('select * from ops_ot_date'.$month_sql_where);
		$data = $query->result();
		return $data;
	}

	public function get_time_by_id() {
		$this->db->select('start_time');
		$this->db->from('ops_ot');
		$this->db->where('id', $id);
		$data1 = $this->db->get()->row('start_time');
		$this->db->select('over_time');
		$this->db->from('ops_ot');
		$this->db->where('id', $id);
		$data2 = $this->db->get()->row('over_time');
		$data = $data1.'——'.$data2;
		return $data;
	}	
	public function get_ot_list($count) {
		for ($i=0; $i < $count; $i++) { 
			$ot_list = array('name' => $this->get_name_by_id($i) ,'time' => $this->get_time_by_id($i));

		}
		return $ot_list;
	}

	public function insert_ot($data) {
		$this->db->insert('ops_ot', $data);
		$result = $this->db->insert_id();
		return $result;
	}		
	public function insert_release($data) {
		$this->db->insert('ops_ot_date', $data);
		$result = $this->db->insert_id();
		return $result;
	}		

	public function get_group_leader_by_id($id) {
		$this->db->select('group_leader');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('group_leader');
		return $data;
	}	

	public function get_start_time_by_ot($release_date,$name_id){
		$this->db->select('start_time');
		$this->db->from('ops_ot');
		$this->db->where('release_date', $release_date,'name_id',$name_id);
		$data = $this->db->get()->row('start_time');
		return $data;
	}
	
	public function get_end_time_by_ot($release_date,$name_id){
		$this->db->select('end_time');
		$this->db->from('ops_ot');
		$this->db->where('release_date', $release_date,'name_id',$name_id);
		$data = $this->db->get()->row('end_time');
		return $data;
	}

	public function get_release_date_by_release_date($release_date) {
		$query = $this->db->query('SELECT * FROM ops_ot_date WHERE release_date = ' .$release_date);
		$data = $query->result();
		return $data;
	}	

	        
	    	

}