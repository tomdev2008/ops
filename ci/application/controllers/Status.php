<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		//$this->load->model('login_model');
		$this->_data_header['col_name'] = "";
		
	}
	public function index()
	{
		$data = array();
		$this->_data['title'] = '应用服务状态';
		$query = $this->db->query('select * from ops_platform');
		$data_platform = $query->result();
		$this->_data['platform'] = $data_platform;
		
		foreach ($data_platform as $value) {
			$query = $this->db->query("select * from ops_project where platform_id='$value->id'");
			$data_project = $query->result();

			foreach ($data_project as $key => $value_user) {
				$query_user = $this->db->query("select * from ops_user where id='$value_user->user_id'");
				$data_user =  $query_user->row_array();
				$data_project[$key]->username = $data_user['name'];
				$data_project[$key]->username_room = $data_user['room'];
			}

			$this->_data['platform_'.$value->id.''] = $data_project;
		}

		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/status',$this->_data);
		$this->load->view('default/footer');
	}
}
