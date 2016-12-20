<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analysis extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','pagination','email'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
	}


	public function index()
	{
		$query = $this->db->query('SELECT * FROM ops_nginxlog_analysis ORDER BY id desc');
		$data = $query->result();
		$this->_data['analysis'] = $data;
		$this->_data['title'] = 'NGINX日志列表';
		$this->load->view('default/header');
		$this->load->view('default/analysis',$this->_data);
		$this->load->view('default/footer');
	}

}
