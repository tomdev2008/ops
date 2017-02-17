<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Welcome_model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie']);		
		$this->load->database();
		
	}

	public $mmonit_url = 'http://monit.ops.xkeshi.so:8080';

	public function get_mmonit_http_api($api_name,$debug=false) {
		$client = new GuzzleHttp\Client(['base_uri' => $this->mmonit_url]);
		$jar = new GuzzleHttp\Cookie\CookieJar();
		print_r($jar);
		$res = $client->request('GET', '/'.$api_name, ['cookies' => $jar, 'debug' => $debug]);
		//echo $res->getBody();

	}

	public function get_ops_on_duty() {
		$query = $this->db->query("select * from ops_user where level_id = '2'");
		$row = $query->result();
		$row['0']->count = $query->num_rows();
		return $row;
	}
	
	public function get_level_id_by_id($id) {
		$this->db->select('level_id');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_id');
		return $data;
	}

	public function get_permissions_by_class_id(){
		$query = $this->db->query("select * from ops_col_permissions where class_id = 2 ");
		$data = $query->result();
		return $data;
	}

	public function get_ticket_list_undo() {

		$query = $this->db->query("select * from ops_ticket where status = '3' order by opr_time DESC limit 5 ");
		$row = $query->result();
		foreach ($row as $key => $value) {
			$row[$key]->ticket_user_level_name = $this->get_level_name_by_id($value->ticket_user_level);
			$row[$key]->submitter_name = $this->get_name_by_id($value->submitter);
		}
		return $row;
	}
	public function get_ticket_list_done() {

		$query = $this->db->query("select * from ops_ticket where status = '2' order by opr_time DESC limit 5 ");
		$row = $query->result();
		foreach ($row as $key => $value) {
			$row[$key]->ticket_user_level_name = $this->get_level_name_by_id($value->ticket_user_level);
			$row[$key]->submitter_name = $this->get_name_by_id($value->submitter);
		}
		return $row;
	}
	public function get_level_name_by_id($id) {
		$this->db->select('level_name');
		$this->db->from('ops_ticket_level');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_name');
		return $data;
	}
	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function get_dev_server_percent(){
		$query = $this->db->query("select * from ops_app_server where server_env = '1' ");
		$data = $query->result();
		return $data;
	}
	public function get_test_server_percent(){
		$query = $this->db->query("select * from ops_app_server where server_env = '2' ");
		$data = $query->result();
		return $data;
	}
	public function get_pre_server_percent(){
		$query = $this->db->query("select * from ops_app_server where server_env = '3' ");
		$data = $query->result();
		return $data;
	}
	public function get_pro_server_percent(){
		$query = $this->db->query("select * from ops_app_server where server_env = '4' ");
		$data = $query->result();
		return $data;
	}
	public function get_server_percent(){
		$query = $this->db->query("select * from ops_app_server");
		$data = $query->result();
		return $data;
	}
}