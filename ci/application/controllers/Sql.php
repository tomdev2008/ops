<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* Sql Controller
	*/
	class Sql extends Public_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library(array('session','form_validation'));
			$this->load->helper(array('form','url','cookie','url_helper','typography'));
			$this->load->model('sql_model');
		}
		
		public function index()
		{
			$id = $this->session->userdata('u_id');
			$power_permission_flag = $this->sql_model->get_permission_by_id($id);
			if ($power_permission_flag == 1) {
				$this->form_validation->set_rules('database','database','required');
				$this->form_validation->set_rules('table','table','required');
				$this->form_validation->set_rules('field','field','required');
				$this->form_validation->set_rules('value','value','required');
				if ($this->form_validation->run() == FALSE) {
					$this->_data['pre_database'] = $this->config->item("pre_database");
				}
				else{
					//$database = $this->_data['database'] = $this->input->get("database");
	                //$table = $this->_data['table'] = $this->input->get("table");
	                //$field = $this->_data['field'] = $this->input->get("field");
	                //$value = $this->_data['value'] = $this->input->get("value");
	                $this->_data['pre_database'] = $this->config->item("pre_database");
					//$this->_data['res'] = $this->sql_model->SelectResult($table,$field,$value);
					//$this->_data['fields'] = $this->sql_model->GetFieldsByTable($table);
				}

				$data = [];
				$this->_data['title'] = '数据库查询';
				$this->load->view('default/header',$this->_data_header);
				$this->load->view('default/sql',$this->_data);
				$this->load->view('default/footer');
			//print_r($this->sql_model->test());
			} else {
				echo '很抱歉，您没有权限访问，请联系运维部！';
			}
		}
		public function ajax_table()
		{
			$database = $this->config->item("pre_database");
			$select = $this->input->get("database");
			$table = $database[$select];
			echo json_encode($table);
		}
		public function ajax_fields()
		{
			$database = $this->input->get("database");
			$table = $this->input->get("table");
			$fields = $this->sql_model->GetFieldsByTable($database,$table);
			echo json_encode($fields);
		}
	}
 ?>