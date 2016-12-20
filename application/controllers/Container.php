<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container extends Public_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('container_model');
		
	}
	public function index()
	{
		$data = array();
		$this->_data['title'] = '容器列表';

		$pid_id = $this->input->get('pid', TRUE);

		$pid_sql_where = $pid_id ? " WHERE id = '".$pid_id."'" : "";
		
		$query = $this->db->query("select * from ops_project".$pid_sql_where);
		$data_container = $query->result();
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
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/container',$this->_data);
		$this->load->view('default/footer');
	}

	public function server_list() 
	{
		$data = array();
		$this->_data['title'] = '服务器容器列表';

		$sid_id = $this->input->get('sid', TRUE);

		$sid_sql_where = $sid_id ? " and id = '".$sid_id."'" : "";
		
		$query = $this->db->query("select * from ops_ip WHERE type='Linux'".$sid_sql_where);
		$data_container = $query->result();
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

	}
}
