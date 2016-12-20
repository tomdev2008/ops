<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends Public_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','pagination','email'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
		$this->load->model('statistics_model');
	}
	public function index(){
		$this->_data['title'] = '项目发布统计';
		$this->_data['get_project_all'] = $this->statistics_model->get_project_all();
		$this->_data['get_product_project_name'] = $this->statistics_model->get_product_project_name();
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/statistics',$this->_data);
		$this->load->view('default/footer');
	}
	public function add(){
		$this->form_validation->set_rules('project_time', 'project_time','required');
		$this->form_validation->set_rules('project_name', 'project_name','required');
		$this->form_validation->set_rules('env_name', 'env_name','required');
		//$this->form_validation->set_rules('change_log', 'change_log','required');
		$time = $this->input->post('project_time');
		$project_name = $this->input->post('project_name');
		$project_env_name = $this->input->post('env_name');
		$change_log = $this->input->post('change_log');
		$select = $this->input->post('select');
		if ($this->form_validation->run() == FALSE)
        {
		$this->_data['title'] = '项目发布添加';
		$this->_data['get_project_name'] = $this->statistics_model->get_project_name();
		$this->_data['get_server_name'] = $this->statistics_model->get_server_name();
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/statistics_add',$this->_data);
		$this->load->view('default/footer');
		}
		else{
			$user_id = $this->session->userdata('u_id');
			$user_name = $this->statistics_model->get_name_by_id($user_id);
			$data = [
				'time' =>$time,
				'project_id' => $project_name,
				'project_env_name' => $project_env_name,
				'change_log' => $change_log,
				'leader_name' => $user_name,
				'select' => $select
			];
			$result = $this->statistics_model->insert($data);
			if ($result) {
				if ($select == 1) {
					$sel = "紧急发布";
				}
				else{
					$sel = "正常发布";
				}
				$projectname = $this->statistics_model->get_project_name_by_id($project_name);
				$res = $this->statistics_model->Email_to_ops($time,$user_name,$projectname,$project_env_name,$change_log,$sel);
				redirect('/statistics');
			}
		}
	}
	public function ajax_project() {
		$project_id = $this->input->get('project_id', TRUE);
		$server_name = $this->statistics_model->get_name_by_project($project_id);
		echo json_encode($server_name);
	}
	public function change_log() {
		$time = $this->input->get('time', TRUE);
		$env = $this->input->get('env', TRUE);
		$change_log = $this->statistics_model->get_change_by_time_env($time,$env);
		echo nl2br_except_pre($change_log);
	}
	// public function test()
}
