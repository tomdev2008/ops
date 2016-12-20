<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie','text'));
		$this->load->model('admin/welcome_model');
		
	}
	public function index()
	{
		$data = array();
		$query = $this->db->query('select * from ops_user_level');
		$data = $query->result();
		$this->_data['users_level'] = $data;
		$level_id = $this->input->get('level_id', TRUE);
		$user_sql_where = $level_id ? " WHERE level_id = '".$level_id."'" : "";
		$query = $this->db->query('select * from ops_user'.$user_sql_where);
		$data = $query->result();
		$this->_data['users'] = $data;
		$this->_data['title'] = '后端管理';
		$this->_data['ticket_list_undo'] = $this->welcome_model->get_ticket_list_undo();
		$this->_data['ticket_list_done'] = $this->welcome_model->get_ticket_list_done();		
		$this->load->view('admin/header');
		$this->load->view('admin/index',$this->_data);
		$this->load->view('admin/footer');

	}
}