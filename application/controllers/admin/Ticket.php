<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','pagination','email'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
		$this->load->model('admin/ticket_model');
	}

	public function index()
	{
		$data = array();
		$query = $this->db->query('select * from ops_ticket_level');
		$data = $query->result();
		$this->_data['tickets_level'] = $data;
		$level_id = $this->input->get('level_id', TRUE);
		$this->_data['ticket_message'] = $this->ticket_model->get_message_by_id($level_id);
		$this->_data['title'] = '工单管理';
		$uri = "ticket";
	    $config['base_url'] = base_url($uri);

		$this->_data['ticket_list'] = $this->ticket_model->get_ticket_list($level_id);

		$this->load->view('admin/header');
		$this->load->view('admin/ticket',$this->_data);
		$this->load->view('admin/footer');
	}

	public function view($id = NULL)
	{
		$level_id = $this->session->userdata('u_level_id');
		$submitter = $this->ticket_model->get_submitter_by_id($id);
		$user_id = $this->session->userdata('u_id');
		$status = $this->ticket_model->get_status_by_id($id);
		if ($level_id == 2 || $submitter == $user_id || $status == 4) {
		$data = array();
		$this->_data['title'] = '添加工单';
		$this->_data['user_level_list'] = $this->ticket_model->get_user_level_list();
		$this->_data['get_ticket_by_id'] = $this->ticket_model->get_ticket_by_id($id);
		$title = $this->ticket_model->get_ticket_by_id($id);
		$this->_data['get_reply_by_ticket_id'] = $this->ticket_model->get_reply_by_ticket_id($id);
		$data = array();
		$this->_data['user_level_list'] = $this->ticket_model->get_user_level_list();
		$this->load->view('admin/header');
		$this->load->view('admin/ticket_view',$this->_data);
		$this->load->view('admin/footer');
		}
		else {
			redirect('admin/ticket');
		}
        //echo "<script>
		//location.href='".$_SERVER["HTTP_REFERER"]."';
		//</script>";
	}

		public function view_add($id_hidden = FALSE)
	{
		$this->form_validation->set_rules('contents', 'contents', 'required');
		$contents = $this->input->post('contents');
		$id_hidden = $this->input->post('id_hidden');
		$email_hidden = $this->input->post('email_hidden');
		$title_hidden = $this->input->post('title_hidden');
		$name_hidden = $this->input->post('name_hidden');
		$select = $this->input->post('select');
		$ticket_user_level = $this->session->userdata('u_level_id');
		if($ticket_user_level == '2' ){
			$this->_data['update_status_by_id'] = $this->ticket_model->update_status_by_id($id_hidden);
		}
		if ($select == 1) {
			$this->ticket_model->update_status_over_by_id($id_hidden);
		}
		if ($this->form_validation->run() == FALSE)
        {
        	//$id_hidden = $this->uri->segment(3,0);
			//form_hidden('id_hidden',$id_hidden);
			redirect('admin/ticket/view/'.$id_hidden);
			$data = array();
			$this->_data['user_level_list'] = $this->ticket_model->get_user_level_list();
			$this->load->view('admin/header');
			$this->load->view('admin/ticket_view',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
	    $data =[
					'contents' => $contents,
					'submitter' => $this->session->userdata('u_id'),
					'ticket_id' => $id_hidden
				];
		$result = $this->ticket_model->insert_ticket_reply($data);
		if ($result) {
			if($ticket_user_level == '2' ){
					$this->ticket_model->Email_to_user($id_hidden,$email_hidden,$title_hidden,$name_hidden);
				}
			else if ($ticket_user_level != '2') {
					$this->ticket_model->Email_reply($id_hidden,$title_hidden,$name_hidden,$contents);
			}
					redirect('admin/ticket/view/'.$id_hidden);
        }	
       }	
	}
}
