<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','zip'));
		$this->load->helper(array('form', 'url', 'cookie','download','date'));
		$this->load->model('admin/disconfig_model');
		$this->check_whitelist_ip();
	}

	private function check_whitelist_ip() {
		$current_ip = $this->input->ip_address();
		$ips = $this->config->item('ops_disconf_whitelist_ip');
		if ( !in_array($current_ip, $ips) ) {
        	echo show_error($current_ip.' is not a valid IP address!', 401, 'Disconf');
		}
	}

	public function file(){
		// $app = $this->input->get('app', TRUE);
		$env = $this->input->get('env', TRUE);
		$type = $this->input->get('type', TRUE);
		$version = $this->input->get('version', TRUE);
		$key = $this->input->get('key', TRUE);
		// $ENV_MAP = [
		// 	"dev" => 1,
		// 	"test" => 2,
		// 	"pre" => 3,
		// 	"product" => 4
		// ];
		$disconf = $this->disconfig_model->get_conf_data($env,$type,$version,$key);
		$name = $disconf->name;
		$data = $disconf->value;
		force_download($name, $data);		
	}
}