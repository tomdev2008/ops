<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Dailylog_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}

	public function get_users_level_list() {
		$query = $this->db->query("select * from ops_user_level");
		$data = $query->result();
		return $data;
	}
	public function get_ops_list() {
		$query = $this->db->query("select * from ops_user where level_id = '2'");
		$data = $query->result();
		return $data;
	}	
	public function get_user_list() {
		$query = $this->db->query("select * from ops_user");
		$data = $query->result();
		return $data;
	}	
	public function get_id_by_name($name) {
		$this->db->select('id');
		$this->db->from('ops_user');
		$this->db->where('name', $name);
		$data = $this->db->get()->row('id');
		return $data;
	}	
	public function get_user_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}	
	public function insert_dailylog($data) {
		$this->db->insert('ops_dailylog', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function insert_daily_reply($data) {
		$this->db->set('opr_time', 'NOW()', false);
		$this->db->insert('ops_daily_reply', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function get_dailylogs($user_sql_where){
		$query = $this->db->query('select * from ops_dailylog'.$user_sql_where);
		$data = $query->result();
		return $data;
	}
	public function get_content_by_id($id) {
		$this->db->select('daily_content');
		$this->db->from('ops_dailylog');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('daily_content');
		return $data;
	}	
	public function get_dailylog_by_id($id = FALSE) {
	if ($id === FALSE)
    {
        $query = $this->db->get('ops_dailylog');
        return $query->result_array();
    }
    $query = $this->db->get_where('ops_dailylog', array('id' => $id));
    $data = $query->row_array();
    return $data;
	}

	public function get_reply_by_daily_id($daily_id) {
		$query = $this->db->query("select * from ops_daily_reply where daily_id='".$daily_id."' order by id desc ");
		$data = $query->result();
		return $data;
	}
	public function get_level_id_by_id($id) {
		$this->db->select('level_id');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_id');
		return $data;
	}

	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
 	 public function makeLinks($string) {
		$string = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', $string);
		$string = nl2br_except_pre($string);
		echo $string;
	}
	public function get_user_id_by_daily($id) {
		$this->db->select('user_id');
		$this->db->from('ops_dailylog');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('user_id');
		return $data;
	}
	public function get_daily_title_by_id($id) {
		$this->db->select('daily_title');
		$this->db->from('ops_dailylog');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('daily_title');
		return $data;
	}
	public function get_daily_content_by_id($id) {
		$this->db->select('daily_content');
		$this->db->from('ops_dailylog');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('daily_content');
		return $data;
	}
	public function get_daily_reply_text_by_id($id) {
		$this->db->select('daily_text');
		$this->db->from('ops_daily_reply');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('daily_text');
		return $data;
	}	
	public function get_daily_reply_content_by_id($id) {
		$this->db->select('daily_content');
		$this->db->from('ops_daily_reply');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('daily_content');
		return $data;
	}	
	public function get_daily_reply_id_by_id($id) {
		$this->db->select('daily_id');
		$this->db->from('ops_daily_reply');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('daily_id');
		return $data;
	}
}