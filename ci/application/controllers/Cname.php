<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cname extends Public_Controller {
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
		$power_permission_flag = $this->rbac_model->get_permission_by_id_cname($role_id);
		if ($power_permission_flag == 1) {
			$data = array();
			$this->_data['title'] = 'CNAME列表';
			$query = $this->db->query("select domain from ops_cname_list group by domain");
			$data_cname = $query->result();
			$this->_data['cname'] = $data_cname;

			foreach ($data_cname as $key => $value) {
				$value_domain = $value->domain;
				$query = $this->db->query("select a.*, GROUP_CONCAT(b.pub_ip) as pub_ip,GROUP_CONCAT(b.ip_alias) as ip_alias from  ops_cname_list as a left join ops_ip as b on FIND_IN_SET(b.id ,a.ops_pub_ip) WHERE domain='$value_domain' group by constellation");
	//			$query = $this->db->query("select * from ops_cname_list where domain='$value_domain'");
				//$data_cname[''.$key.'']['count'] = $query->num_rows();
				$data_cname_ip = $query->result();
				$this->_data['cname_'.$key.''] = $data_cname_ip;
			}

			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/cname',$this->_data);
			$this->load->view('default/footer');
		} else {
			echo '很抱歉，您没有权限访问，请联系运维部！';
		}
	}
}