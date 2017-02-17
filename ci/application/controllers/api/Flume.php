<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flume extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','zip'));
		$this->load->helper(array('form', 'url', 'cookie','download','date'));
		$this->load->model('flume_model');
	}
	public function agent()
	{
		$ip = $this->input->get('ip', TRUE);
		$flume = $this->flume_model->GetAgentConf($ip);
		echo $flume;
	}
}