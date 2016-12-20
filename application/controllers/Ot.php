<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ot extends Public_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','pagination','email'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
		$this->load->model('ot_model');
		$this->load->model('login_model');
	}

	public function index()
	{
		$month = $this->input->get('month',TRUE);
		if($month == NULL)
		{
            $month =  date('m');
        }

		$this->_data['ot_date'] = $this->ot_model->get_ot_date($month);
		$this->_data['data_project'] = $this->ot_model->get_ot($month);
		$this->_data['user_level'] = $this->ot_model->get_user_level();
		$this->_data['users_level'] = $this->ot_model->get_users_level();

		$level_id = $this->input->get('level_id', TRUE);
        if($level_id == NULL){
           $ot_user_id = $this->session->userdata('u_id');
           $level_id = $this->ot_model->get_level_id_by_id($ot_user_id);
         }	
        $this->_data['users'] = $this->ot_model->get_ot_users($level_id);
		$this->_data['title'] = '人员加班统计';

		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/ot',$this->_data);
		$this->load->view('default/footer');
	}
	
 
	public function add()
	{
	
		$month = $this->input->get('month',TRUE);
		$this->_data['ot_date'] = $this->ot_model->get_ot_date($month);
		$this->_data['data_project'] = $this->ot_model->get_ot($month);
		$this->_data['user_level'] = $this->ot_model->get_user_level();
		$this->_data['users_level'] = $this->ot_model->get_users_level();

		$level_id = $this->input->get('level_id', TRUE);
		$this->_data['users'] = $this->ot_model->get_ot_users($level_id);
		$this->_data['title'] = '人员加班统计';
		$this->load->view('default/ot_add',$this->_data);
	
		
	}
	public function make()
	{

		$month = $this->input->get('month',TRUE);
		$this->_data['ot_date'] = $this->ot_model->get_ot_date($month);
		$this->_data['data_project'] = $this->ot_model->get_ot($month);
		$this->_data['user_level'] = $this->ot_model->get_user_level();
		$this->_data['users_level'] = $this->ot_model->get_users_level();

		$level_id = $this->input->get('level_id', TRUE);
		$this->_data['users'] = $this->ot_model->get_ot_users($level_id);
		$this->_data['title'] = '人员加班统计';
		$this->load->view('default/ot_make',$this->_data);
	
		
	}	

	public function add_view()	
	{
		$this->form_validation->set_rules('start_time', 'start_time','required');
		$this->form_validation->set_rules('end_time', 'end_time','required');

		$ot_date = $this->input->get('ot_date', TRUE);
		$name_id = $this->input->get('name_id', TRUE);
		$name = $this->ot_model->get_name_by_id($name_id);
		$start_time = $this->input->post('start_time',TRUE);
		$end_time = $this->input->post('end_time',TRUE);
		$month = $this->input->get('month',TRUE);		
		$this->_data['ot_date'] = $ot_date;
		$this->_data['name_id'] = $name_id;
		$this->_data['name'] = $name;

        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '人员加班信息添加';
			$this->_data['data_project'] = $this->ot_model->get_ot($month);

			$this->load->view('default/ot_add_view',$this->_data);
        }
        else
        {		
        	$ot_date = $this->input->post('ot_date', TRUE);
        	$name_id = $this->input->post('name_id', TRUE);
        	$start_time = $this->input->post('start_time',TRUE);
			$end_time = $this->input->post('end_time',TRUE);
		 		$haha =[
				    'release_date' => $ot_date,
				    'name_id' => $name_id,
				    'start_time' => $start_time,
				    'end_time' => $end_time,

				];  
				$result = $this->ot_model->insert_ot($haha); 			
				if ($result) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(add_view.name); //获取窗口索引
         			parent.layer.close(index);  	
					</script>";

        }
        }	
	}
		
	public function add_release()
	{
		$this->form_validation->set_rules('release', 'release','required');
		$this->form_validation->set_rules('release_shuoming', 'release_shuoming','required');

		$release = $this->input->post('release',TRUE);
		$release_shuoming = $this->input->post('release_shuoming',TRUE);

		$release1 = (substr($release,5,2));
		$release2 = (substr($release,8,2));	
		$release3 = $release1.$release2;
		
		$this->_data['release'] = $release3;
		$this->_data['release_shuoming'] = $release_shuoming;

        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '项目发布信息添加';
			$this->load->view('default/ot_add_release',$this->_data);
        }
        else
        {		
        		$release_tmp = $this->ot_model->get_release_date_by_release_date($release3);
				if (count($release_tmp) == 0) {
		 		$haha =[
				    'release_date' => $release3,
				    'release_name' => $release_shuoming,

				];  
				$result = $this->ot_model->insert_release($haha);
				}else{
					$result = 0;
					$data = array();
					$this->_data['title'] = '项目发布信息添加';    
					echo "<script>
					alert('该日期已经存在项目发布信息！请重新选择日期！');			
					</script>";
					$this->load->view('default/ot_add_release',$this->_data);
				}			
				if ($result) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(add_view.name); //获取窗口索引
         			parent.layer.close(index);  			
					</script>";
        }
        }	
    }

	public function make_view()	
	{
		$this->form_validation->set_rules('start_time', 'start_time','required');
		$this->form_validation->set_rules('end_time', 'end_time','required');

		$ot_date = $this->input->get('ot_date', TRUE);
		$name_id = $this->input->get('name_id', TRUE);
		$name = $this->ot_model->get_name_by_id($name_id);
		$start_time1 = $this->ot_model->get_start_time_by_ot($ot_date,$name_id);
		$end_time1 = $this->ot_model->get_end_time_by_ot($ot_date,$name_id);
		$month = $this->input->get('month',TRUE);		
		$this->_data['ot_date'] = $ot_date;
		$this->_data['name_id'] = $name_id;
		$this->_data['name'] = $name;
		$this->_data['start_time1'] = $start_time1;
		$this->_data['end_time1'] = $end_time1;

        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '人员加班信息修改';
			$this->_data['data_project'] = $this->ot_model->get_ot($month);

			$this->load->view('default/ot_make_view',$this->_data);
        }
        else
        {		
        	$ot_date = $this->input->post('ot_date', TRUE);
        	$name_id = $this->input->post('name_id', TRUE);
        	$start_time = $this->input->post('start_time',TRUE);
			$end_time = $this->input->post('end_time',TRUE);
		 		$haha =[
				    'release_date' => $ot_date,
				    'name_id' => $name_id,
				    'start_time' => $start_time,
				    'end_time' => $end_time,

				];  
				$result = $this->ot_model->insert_ot($haha); 			
				if ($result) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(add_view.name); //获取窗口索引
         			parent.layer.close(index);  	
					</script>";

        }
        }	
	}

}
