<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disconfig extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('disconfig_model');
		
	}
	public function index()
	{
		$data = array();
		$this->_data['users'] = $data;
		$this->_data['title'] = '配置中心';
		$this->load->view('default/header');
		$this->load->view('default/disconfig',$this->_data);
		$this->load->view('default/footer');
	}
}