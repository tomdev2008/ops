<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends Public_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('gallery_model');
	}

	public function index()
	{
		$data = array();
		$platform_id = $this->db->escape($this->input->get('platform_id', TRUE));
		$this->_data['platform'] = $this->gallery_model->get_gallery_platform_list();
		$this->_data['gallerys'] = $this->gallery_model->get_gallerys($platform_id);

		$data_platform = $this->gallery_model->get_platform_url();
		$this->_data['platform'] = $data_platform;		
		foreach ($data_platform as $value) {
			$query = $this->db->query("select * from ops_gallery where gallery_platform_id='$value->id' ");
			$data_gallery = $query->result();

			// foreach ($data_gallery as $key => $value_user) {
			// 	$data_gallery[$key]->userid = $value_user->user_id;
			// }
			$this->_data['platform_'.$value->id.''] = $data_gallery;
		}
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/gallery',$this->_data);
		$this->load->view('default/footer');
	}
}
