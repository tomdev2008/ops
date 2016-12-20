<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Release extends Public_Controller {


	public function index()
	{
		$data = array();
		$this->_data['title'] = '项目列表';

		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/release',$this->_data);
		$this->load->view('default/footer');
	}
}
