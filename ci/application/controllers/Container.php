<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container extends Public_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->model('container_model');
		$this->load->model('rbac_model');
		
	}
	public function index()
	{
		$id = $this->session->userdata('u_id');
		$role_id = $this->rbac_model->get_role_id_by_id($id);
		$power_permission_flag = $this->rbac_model->get_permission_by_id_container($role_id);
		if ($power_permission_flag == 1) {
			$data = array();
			$this->_data['title'] = '容器列表';

			$pid_id = $this->input->get('pid', TRUE);
			if ($pid_id == NULL) {
				$query = $this->db->query('select * from ops_project');
				$data_container = $query->result();
			} else {
				$sql = "SELECT * FROM ops_project WHERE id = ? ";
				$query = $this->db->query($sql, array($pid_id));	
				$data_container = $query->result();
			}
			foreach ($data_container as $key => $value) {
				$ip_environment = [
	                    [	
	                    	"server_env" => "1"
	                    ],

	                    [
	                    	"server_env" => "2"
	                    ],

	                    [
	                    	"server_env" => "3"
	                    ],

	                    [
	                    	"server_env" => "4"
	                    ]
	        	];
	        	foreach ($ip_environment as $key => $ip_server) {
	        		$app_server = 'app_server_'.$value->id.'_'.$ip_server['server_env'];
	        		$this->_data[''.$app_server.''] = $this->container_model->get_app_server_by_env_pro($value->id, $ip_server['server_env']);
	        		/*if ($value->$ip_server['jetty_ip']) {
	        				$value->$ip_server['jetty_ip'] = $this->container_model->get_alias_by_ipv2($value->$ip_server['jetty_ip']);
	        		}*/
				}
			}
			$this->_data['container'] = $data_container;
			$this->_data['pid_id'] = $pid_id;
			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/container',$this->_data);
			$this->load->view('default/footer');
		} else {
			echo '很抱歉，您没有权限访问，请联系运维部！';
		}
	}

	public function server_list() 
	{
		$id = $this->session->userdata('u_id');
		$role_id = $this->rbac_model->get_role_id_by_id($id);
		$power_permission_flag = $this->rbac_model->get_permission_by_id_container($role_id);
		if ($power_permission_flag == 1) {
			$data = array();
			$this->_data['title'] = '服务器容器列表';

			$sid_id = $this->input->get('sid', TRUE);

			if ($sid_id == NULL) {
				$query = $this->db->query('select * from ops_ip');
				$data_container = $query->result();
			} else {
				$sql = "SELECT * FROM ops_ip WHERE type = ? AND  id = ?";
				$query = $this->db->query($sql, array("Linux",$sid_id));	
				$data_container = $query->result();
			}

			foreach ($data_container as $key => $value) {
				$data_container[$key]->name = $value->ip_alias.':'.$value->ip;
				$ip_environment = [
	                    [	
	                    	"server_env" => "1"
	                    ],

	                    [
	                    	"server_env" => "2"
	                    ],

	                    [
	                    	"server_env" => "3"
	                    ],

	                    [
	                    	"server_env" => "4"
	                    ]
	        	];
	        	foreach ($ip_environment as $key => $ip_server) {
	        		$app_server = 'app_server_'.$value->id.'_'.$ip_server['server_env'];
	        		$this->_data[''.$app_server.''] = $this->container_model->get_app_server_by_server($value->ip, $ip_server['server_env']);
	        		/*if ($value->$ip_server['jetty_ip']) {
	        				$value->$ip_server['jetty_ip'] = $this->container_model->get_alias_by_ipv2($value->$ip_server['jetty_ip']);
	        		}*/
				}
			}
			$this->_data['container'] = $data_container;
			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/container',$this->_data);
			$this->load->view('default/footer');
		} else {
			echo '很抱歉，您没有权限访问，请联系运维部！';
		}
	}
}
