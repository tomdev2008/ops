<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cname extends Public_Controller {


	public function index()
	{
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
	}
}