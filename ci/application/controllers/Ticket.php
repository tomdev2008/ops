<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends Public_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','pagination','email'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
		$this->load->model('ticket_model');
		$this->load->model('login_model');
	}
	
	public function index()
	{
		$data = array();
		$query = $this->db->query('select * from ops_ticket_level');
		$data = $query->result();
		$this->_data['tickets_level'] = $data;
		$level_id = $this->db->escape($this->input->get('level_id'));
		$this->_data['ticket_message'] = $this->ticket_model->get_message_by_id($level_id);
		$this->_data['title'] = '工单管理';
		$page = $this->uri->segment(2,0);
		$config['uri_segment'] = 2;
		$uri = "ticket";
	    $config['base_url'] = base_url($uri);
	    $config['full_tag_open'] = '<div class="pagination" style="text-align:right"><ul>';
	    $config['full_tag_close'] = '</ul></div>';
	    $config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';	
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';					
	    $config['reuse_query_string'] = TRUE;
	    $config['next_link'] = '&gt;';
	    $config['prev_link'] = '&lt;';
	    $pagenum = 20;
	    $rows = ceil(count($this->ticket_model->get_ticket_all($level_id))/$pagenum);
	    $config['total_rows'] = $rows;
	    $config['per_page'] = 1;
	    $this->_data['page_num'] = $this->ticket_model->page_num($pagenum);
	    $this->pagination->initialize($config);
	    $this->_data['create_links'] = $this->pagination->create_links();
		$this->_data['ticket_list'] = $this->ticket_model->get_ticket_list($level_id,$page*$pagenum,$pagenum);
		$this->_data['ticket_all'] = $this->ticket_model->get_ticket_all($level_id);
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/ticket',$this->_data);
		$this->load->view('default/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('title', 'title','required');
		$this->form_validation->set_rules('category', 'category','required');
		$this->form_validation->set_rules('contents', 'contents','required');
		$title = $this->input->post('title');
		$category = $this->input->post('category');
		$contents = $this->input->post('contents');
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '添加工单';
			$this->_data['user_level_list'] = $this->ticket_model->get_user_level_list();
			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/ticket_add',$this->_data);
			$this->load->view('default/footer');
        }
        else
        {
		 		$data =[
				    'title' => $title,
				    'status' => 3,
				    'ticket_user_level' => $category,
				    'contents' => $contents,
				    'submitter' => $this->session->userdata('u_id')
				];       	
				$result = $this->ticket_model->insert_ticket($data);  //
				if ($result) {
					if ($ticket_user_level != '1' && $ticket_user_level != '2') {
						$id = $this->session->userdata('u_id');
						$name = $this->ticket_model->get_name_by_id($id);
						$this->ticket_model->Email_to_ops($contents,'ops@xkeshi.com',$title,$name);
					}
					redirect('/ticket');
				}
	    }
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
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/ticket_view',$this->_data);
		$this->load->view('default/footer');
		}
		else {
			redirect('/ticket');
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
		$status = $this->ticket_model->get_status_by_id($id_hidden);
		if($ticket_user_level == '2'){
			if ($select == 1) {
				if ($status == 2) {
					$this->ticket_model->update_status_over_by_id($id_hidden);
				}
				else if ($status == 3 && $contents == '') {
					echo "<script>
					  alert('请填写完留言再结束工单！');
					  location.href='../ticket/view/$id_hidden'
					  </script>";
					exit();
				}
				else if ($status == 3 && $contents != '') {
					$this->ticket_model->update_status_over_by_id($id_hidden);
				}
			}
			else if ($select != 1) {
				if ($status == 3) {
					if ($contents != '') {
						$this->ticket_model->update_status_by_id($id_hidden);
					}	
				}
			}
		}
		if ($this->form_validation->run() == FALSE)
        {
        	//$id_hidden = $this->uri->segment(3,0);
			//form_hidden('id_hidden',$id_hidden);
			redirect('/ticket/view/'.$id_hidden);
			$data = array();
			$this->_data['user_level_list'] = $this->ticket_model->get_user_level_list();
			$this->load->view('default/header',$this->_data_header);
			$this->load->view('default/ticket_view',$this->_data);
			$this->load->view('default/footer');
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
					redirect('/ticket/view/'.$id_hidden);
        }	
       }	
	}
}
