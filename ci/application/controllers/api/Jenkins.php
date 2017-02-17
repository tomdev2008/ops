<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenkins extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','zip'));
		$this->load->helper(array('form', 'url', 'cookie','download','date'));
		$this->load->model('admin/disconfig_model');	}
	public function server(){
		$server_name = $this->input->get('server_name', TRUE);
		$pretty = $this->input->get('pretty', TRUE);
		$server_key = $this->input->get('server', TRUE);
		$server = $this->disconfig_model->get_server_data($server_name);
		$jenkins = $this->disconfig_model->get_jenkins_data($server_name);
		$server = json_decode(json_encode($server),true);
		$array = array();
		$array['ops_app_jenkins'] = $jenkins;
		$array['ops_app_server'] = $server;
		if($pretty){
			if($server_key == "") {
				$res = str_replace(' "','"',json_encode($array, JSON_PRETTY_PRINT));
				echo str_replace('\/','/',$res);
			}
			else{
			 	$res = str_replace(' "','"',json_encode($server[$server_key-1], JSON_PRETTY_PRINT));
			 	echo str_replace('\/','/',$res);
			}
		}
		else if ($pretty == ""){
			if($server_key == "") {
				$res = str_replace(' "','"',json_encode($array));
				echo str_replace('\/','/',$res);
			}
			else{
				$res = str_replace(' "','"',json_encode($server[$server_key-1]));
				echo str_replace('\/','/',$res);
			}			
		}
	}
}