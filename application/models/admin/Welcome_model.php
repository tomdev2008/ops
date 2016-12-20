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
}