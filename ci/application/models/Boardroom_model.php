<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Boardroom_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','pagination','email'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
		$this->load->model('boardroom_model');
		$this->load->model('login_model');
	}
	public function get_apply_all(){
		$query = $this->db->query("select * from ops_boardroom");
		$row = $query->result();
		return $row;
	}
	public function judge_time($time){
		$today = date("Y-m-d");
		$meettime = date("Y-m-d",strtotime($time));
		$result = -1;
		if ($meettime == $today) {
			 $result = 0;
		}
		if (strtotime($meettime)-strtotime($today) > 0) {
			if ( date("Y-m") == date("Y-m",strtotime($time)) && (int)date("d",strtotime($time))-(int)date("d") == 1 ) {
				 $result = 1;
			}
			if (date("Y-m") == date("Y-m",strtotime($time)) && (int)date("d",strtotime($time))-(int)date("d") == 2) {
				 $result = 2;
			}
		}
		return $result;
	}
	public function boardroom_delete($id){
		$query = $this->db->query("delete from ops_boardroom where id =".$id);
		return $query;
	}
	public function boardroom_amend($id,$data){
		$where = " id = ".$id;
		$query = $this->db->update('ops_boardroom',$data,$where);
		return $query;
	}
	public function boardroom_insert($data){
		$this->db->insert('ops_boardroom', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function get_apply_by_id($id){
		$name = get_name_by_id($id);
		$query = $this->db->query("select * from ops_boardroom where name = ".$name);
		$row = $query->result();
		return $row;
	}
	public function get_apply_num($day){
		$date = array();
		$query = $this->db->query('select * from ops_boardroom order by starttime ASC ');
		$data = $query->result();
		$num_morning = 0;
		$num_afternoon = 0;
		foreach ($data as $apply) 
		{
			$meettime = $apply->starttime;
			if ($this->boardroom_model->judge_time($meettime) ==$day) 
			{
				$starttime = date("y-m-d H:i:s",strtotime($meettime));
				$time = date("y-m-d 13:00:00",strtotime($meettime));
				if (strtotime($starttime) < strtotime($time) ) {
					$num_morning++;
				}
				else if (strtotime($starttime) >= strtotime($time)) {
					$num_afternoon++;
				}
			}
		}
		return array($num_morning,$num_afternoon);
	}
	public function get_contents_by_id($id){
		$this->db->select('contents');
		$this->db->from('ops_boardroom');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('contents');
		return $data;
	}
	public function get_apply_by_submitter($submitter){
		$query = $this->db->query("select * from ops_boardroom where submitter = ".$submitter);
		$row = $query->result();
		return $row;
	}
	public function get_by_id($id){
		$query = $this->db->query("select * from ops_boardroom where id = ".$id);
		$row = $query->result();
		return $row;
	}
}