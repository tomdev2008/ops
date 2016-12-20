<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boardroom extends Public_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','pagination','email'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
		$this->load->model('boardroom_model');
		$this->load->model('login_model');
	}
	
	public function index()
	{
		$date = array();
		$query = $this->db->query('select * from ops_boardroom order by starttime ASC ');
		$data = $query->result();
		$this->_data['boardroom_applys'] = $data;
		$this->_data['title'] = '会议室申请';
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/boardroom',$this->_data);
		$this->load->view('default/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('reason', 'reason','required');
		$this->form_validation->set_rules('room_id', 'room_id','required');
		$this->form_validation->set_rules('starttime', 'starttime','required');
		$this->form_validation->set_rules('overtime', 'overtime','required');
		$this->form_validation->set_rules('contents', 'contents','required');
		$this->form_validation->set_rules('name', 'name','required');
		$reason = $this->input->post('reason');
		$room_id = $this->input->post('room_id');
		$starttime = $this->input->post('starttime');
		$overtime = $this->input->post('overtime');
		$contents = $this->input->post('contents');
		$submitter = $this->session->userdata('u_id');
		$name = $this->input->post('name');
		 if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '会议室申请';
			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/boardroom_add',$this->_data);
			$this->load->view('default/footer');
        }
        else
        {
		 		$data =[
				    'reason' => $reason,
				    'room_id' => $room_id,
				    'starttime' => $starttime,
				    'overtime' => $overtime,
				    'contents' => $contents,
				    'name' => $name,
				    'submitter' => $submitter
				];
				$result = $this->boardroom_model->boardroom_insert($data);
				if ($result) {
					echo "<script>
					alert('会议申请成功！');
					location.href='../boardroom'
					</script>";
				}
	    }
	}
	public function get_contents_by_id()
	{
		$id = $this->input->get('id',TRUE);
		$contents = $this->boardroom_model->get_contents_by_id($id);
		echo nl2br_except_pre($contents);
	}
	public function apply($id =NULL)
	{
		$submitter = $this->session->userdata('u_id');
		$this->form_validation->set_rules('id', 'id','required');
		$id = $this->input->post('id');
		if ($this->form_validation->run() == FALSE)
        {
		$this->_data['get_apply_by_submitter'] = $this->boardroom_model->get_apply_by_submitter($submitter);
        	$data = array();
			$this->_data['title'] = '更改会议情况';
			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/boardroom_apply',$this->_data);
			$this->load->view('default/footer');
		}
		else
		{
			redirect('boardroom/amend?id='.$id);
		}
	}
	public function amend($id = NULL)
	{
		$submitter = $this->session->userdata('u_id');
		$id = $this->input->get('id',TRUE);
		$this->form_validation->set_rules('reason', 'reason','required');
		$this->form_validation->set_rules('room_id', 'room_id','required');
		$this->form_validation->set_rules('starttime', 'starttime','required');
		$this->form_validation->set_rules('overtime', 'overtime','required');
		$this->form_validation->set_rules('contents', 'contents','required');
		$this->form_validation->set_rules('name', 'name','required');
		$reason = $this->input->post('reason');
		$room_id = $this->input->post('room_id');
		$starttime = $this->input->post('starttime');
		$overtime = $this->input->post('overtime');
		$contents = $this->input->post('contents');
		$name = $this->input->post('name');
		if ($this->form_validation->run() == FALSE)
        {
        	$data = array();
			$this->_data['title'] = '更改会议情况';
			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/boardroom_amend',$this->_data);
			$this->load->view('default/footer');
		}
		else
		{
			$data =[
				    'reason' => $reason,
				    'room_id' => $room_id,
				    'starttime' => $starttime,
				    'overtime' => $overtime,
				    'contents' => $contents,
				    'name' => $name,
				];
				$result = $this->boardroom_model->boardroom_amend($id,$data);
				if ($result) {
					echo "<script>
					alert('会议更改成功');
					location.href='../boardroom'
					</script>";
				}
		}
	}
	public function del()
	{			
			$submitter = $this->session->userdata('u_id');
			$this->_data['get_apply_by_submitter'] = $this->boardroom_model->get_apply_by_submitter($submitter);
			$this->form_validation->set_rules('id', 'id','required');
			$id = $this->input->post('id');
			if ($this->form_validation->run() == FALSE)
        {
        	$data = array();
			$this->_data['title'] = '取消会议室申请';
			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/boardroom_del',$this->_data);
			$this->load->view('default/footer');
		}
		else
		{
			$result = $this->boardroom_model->boardroom_delete($id);
			if ($result) {
					echo "<script>
					alert('已取消会议');
					location.href='../boardroom'
					</script>";
				}
		}
	}
	// public function ajax_boardroom() {
	// 	$id = $this->input->get('id', TRUE);
	// 	$result = $this->boardroom_model->get_by_id($id);
	// 	echo json_encode($result);
	// }
}