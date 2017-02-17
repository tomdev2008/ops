<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('welcome_model');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->_data['ops_on_duty'] = $this->welcome_model->get_ops_on_duty();
		$this->_data['gallery'] = $this->welcome_model->getGallery_byDisplay_id();
		$data = array();
		$query = $this->db->query('select * from ops_gallery_platform');
		$data_platform = $query->result();
		$this->_data['platform'] = $data_platform;
		foreach ($data_platform as $value) {
			$query = $this->db->query("select * from ops_gallery where gallery_platform_id='$value->id'");
			$data_gallery = $query->result();
			foreach ($data_gallery as $key => $value_user) {
				@$query_user = $this->db->query("select * from ops_user where id='$value_user->user_id'");
				$data_user =  $query_user->row_array();
				$data_gallery[$key]->username = $data_user['name'];
			}
			$this->_data['platform_'.$value->id.''] = $data_gallery;
		}
		//$this->welcome_model->get_mmonit_http_api('status/hosts/summary');
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/index',$this->_data);
		$this->load->view('default/footer');
	}
}
