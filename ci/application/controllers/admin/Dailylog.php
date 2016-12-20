<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dailylog extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/dailylog_model');
		
	}
	public function index()
	{
		$data = array();
		$id = $this->input->get('id', TRUE);
		$user_sql_where = $id ? " WHERE user_id = '".$id."'" : "";
		$this->_data['ops_list'] = $this->dailylog_model->get_ops_list();
		$this->_data['dailylogs'] = $this->dailylog_model->get_dailylogs($user_sql_where);
		$this->_data['title'] = '常用链接列表';
		$this->load->view('admin/header');
		$this->load->view('admin/dailylog',$this->_data);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('daily_title', 'daily_title','required');
		$this->form_validation->set_rules('daily_time', 'daily_time','required');
		$this->form_validation->set_rules('user_id', 'user_id','required');
		$daily_title = $this->input->post('daily_title');
		$daily_content = $this->input->post('daily_content');
		$user_id = $this->input->post('user_id');
		$daily_time = $this->input->post('daily_time');
		$get_user_name = $this->dailylog_model->get_ops_list();
		$this->_data['get_user_name'] = $get_user_name;
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '添加工作日志';
			$this->_data['users_level'] = $this->dailylog_model->get_users_level_list();
			$this->load->view('admin/header');
			$this->load->view('admin/dailylog_add',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
		 		$data =[
				    'daily_title' => $daily_title,
				    'daily_content' => $daily_content,
				    'user_id' => $user_id,
				    'daily_time' => $daily_time,
				];       	
				$result = $this->dailylog_model->insert_dailylog($data);  
				if ($result) {
					redirect('admin/dailylog');
				}				
	    }
	}

	public function view($id = NULL)
	{
		$level_id = $this->session->userdata('admin_level_id');
		$user_id = $this->session->userdata('admin_id');
		$data = array();
	
		$this->_data['title'] = '工作日志';
		$this->_data['user_level_list'] = $this->dailylog_model->get_users_level_list();
		$this->_data['get_dailylog_by_id'] = $this->dailylog_model->get_dailylog_by_id($id);
		$title = $this->dailylog_model->get_dailylog_by_id($id);
		$this->_data['get_reply_by_daily_id'] = $this->dailylog_model->get_reply_by_daily_id($id);
		$data = array();
		$this->_data['user_level_list'] = $this->dailylog_model->get_users_level_list();
		$this->load->view('admin/header');
		$this->load->view('admin/dailylog_view',$this->_data);
		$this->load->view('admin/footer');
	}

	public function view_add($id_hidden = FALSE)
	{

		$this->form_validation->set_rules('daily_text', 'daily_text', 'required');
		$daily_content = $this->input->post('daily_content');
		$id_hidden = $this->input->post('id_hidden');
		$title_hidden = $this->input->post('title_hidden');
		$daily_text = $this->input->post('daily_text');

		if ($this->form_validation->run() == FALSE)
        {
        	//$id_hidden = $this->uri->segment(3,0);
			//form_hidden('id_hidden',$id_hidden);
			redirect('admin/dailylog/view/'.$id_hidden);
			$data = array();
			$this->_data['user_level_list'] = $this->dailylog_model->get_user_level_list();
			$this->load->view('admin/header',$this->_data_header);
			$this->load->view('admin/dailylog_view',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
	    $data =[
					'daily_content' => $daily_content,
					'daily_text' =>$daily_text,
					'daily_id' => $id_hidden,
					'submitter_id' => $this->session->userdata('admin_id')
				];
		$result = $this->dailylog_model->insert_daily_reply($data);
		if ($result) {
			redirect('admin/dailylog/view/'.$id_hidden);
        }	
       }	
	}
	public function reply()
	{
		$this->form_validation->set_rules('daily_text', 'daily_text','required');
		$id = $this->input->get('id', TRUE);
		$daily_id = $this->dailylog_model->get_daily_reply_id_by_id($id);
		$daily_text = $this->dailylog_model->get_daily_reply_text_by_id($id);
		$daily_content = $this->dailylog_model->get_daily_reply_content_by_id($id);
		$this->_data['daily_id'] = $daily_id;
		$this->_data['id'] = $id;		
		$this->_data['daily_text'] = $daily_text;
		$this->_data['daily_content'] = $daily_content;
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '修改工作';
			$this->_data['id'] = $id;
			$this->_data['daily_text'] = $daily_text;
			$this->_data['daily_content'] = $daily_content;
			$this->_data['daily_id'] = $daily_id;
			$this->load->view('admin/dailylog_reply',$this->_data);
        }
        else
        {	
        	$id = $this->input->post('id', TRUE);	
			$daily_text = $this->input->post('daily_text', TRUE);
			$daily_content = $this->input->post('daily_content', TRUE);
			$submitter_id = $this->session->userdata('admin_id');
			$result = $this->db->query("UPDATE ops_daily_reply SET submitter_id = '".$submitter_id."',daily_content = '".$daily_content."',daily_text = '".$daily_text."' WHERE id = '".$id."'");	
				if ($result) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(reply.name); //获取窗口索引
         			parent.layer.close(index);  	
					</script>";
        }
        }	
	}
	public function update()
	{
		$this->form_validation->set_rules('daily_title', 'daily_title','required');
		$id = $this->input->get('id', TRUE);
		$daily_title = $this->dailylog_model->get_daily_title_by_id($id);
		$daily_content = $this->dailylog_model->get_daily_content_by_id($id);
		$user_id = $this->dailylog_model->get_user_id_by_daily($id);	
		$get_user_name = $this->dailylog_model->get_ops_list();
		$this->_data['get_user_name'] = $get_user_name;	
		$this->_data['id'] = $id;
		$this->_data['daily_title'] = $daily_title;
		$this->_data['daily_content'] = $daily_content;
		$this->_data['user_id'] = $user_id;

        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '修改工作日志信息';
			$this->_data['id'] = $id;
			$this->_data['daily_title'] = $daily_title;
			$this->_data['daily_content'] = $daily_content;
			$this->_data['user_id'] = $user_id;
			$this->load->view('admin/dailylog_update',$this->_data);
        }
        else
        {	
        	$id = $this->input->post('id', TRUE);	
			$daily_title = $this->input->post('daily_title', TRUE);
			$daily_content = $this->input->post('daily_content', TRUE);
			$user_id = $this->input->post('user_id', TRUE);
			$result = $this->db->query("UPDATE ops_dailylog SET user_id = '".$user_id."',daily_title = '".$daily_title."',daily_content = '".$daily_content."' WHERE id = '".$id."'");	
				if ($result) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
         			parent.layer.close(index);  	
					</script>";
        }
        }	
	}
	// public function delete()
	// {
	// 	$id = $this->input->get('id', TRUE);
	// 	$result = $this->db->delete('ops_dailylog', array('id' => $id));

	// 	// $result2 = $this->db->delete('ops_dailylog_reply', array('daily_id' => $id));
	// }
	// public function delete_reply()
	// {
	// 	$id = $this->input->get('id', TRUE);
	// 	$result2 = $this->db->delete('ops_dailylog_reply', array('daily_id' => $id));
	// }
}
