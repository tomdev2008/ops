<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esxi extends Public_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('cookie','url_helper','typography'));
		$this->load->model('rbac_model');
	}

	public function index()
	{
		$id = $this->session->userdata('u_id');
		$role_id = $this->rbac_model->get_role_id_by_id($id);
		$power_permission_flag = $this->rbac_model->get_permission_by_id_esxi($role_id);
		if ($power_permission_flag == 1) {
			$data = array();
			$this->_data['title'] = 'ESXi列表';
			$query = $this->db->query("select * from ops_ip where type='ESXi'");
			$data_esxi = $query->result();
			$this->_data['esxi'] = $data_esxi;

			foreach ($data_esxi as $key => $value) {
				$value_id = $value->id;
				$query = $this->db->query("select * from ops_ip where is_esxi='$value_id'");
				//$data_esxi[''.$key.'']['count'] = $query->num_rows();
				$data_esxi_ip = $query->result();
				$this->_data['esxi'.$value_id.''] = $data_esxi_ip;
			}

			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/esxi',$this->_data);
			$this->load->view('default/footer');
		} else {
			echo '很抱歉，您没有权限访问，请联系运维部！';
		}
	}
}