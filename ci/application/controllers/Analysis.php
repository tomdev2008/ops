<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analysis extends Public_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','pagination','email'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
		$this->load->model('rbac_model');
	}


	public function index()
	{
		$id = $this->session->userdata('u_id');
		$role_id = $this->rbac_model->get_role_id_by_id($id);
		$power_permission_flag = $this->rbac_model->get_permission_by_id_analysis($role_id);
		if ($power_permission_flag == 1) {
			$query = $this->db->query('SELECT * FROM ops_nginxlog_analysis ORDER BY id desc');
			$data = $query->result();
			$this->_data['analysis'] = $data;
			$this->_data['title'] = 'NGINX日志列表';
			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/analysis',$this->_data);
			$this->load->view('default/footer');
		} else {
			echo '很抱歉，您没有权限访问，请联系运维部！';
		}
	}

}
