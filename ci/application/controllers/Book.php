<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends Public_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','pagination','email'));
		$this->load->helper(array('form', 'url', 'cookie','url_helper','typography'));
		$this->load->model('book_model');
	}
	public function index()
	{
		$date = array();
		//$this->_data['book_info'] = $this->book_model->get_bookinfo();
		$this->_data['book_level'] = $this->book_model->get_booklevel();
		$this->_data['book_sum'] = $this->book_model->get_booksum();
		$this->_data['book_lend_sum'] = $this->book_model->get_lendbooksum();
		$this->_data['title'] = '图书借阅情况';
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/book',$this->_data);
		$this->load->view('default/footer');
	}
	public function add(){
		$user_id = $this->session->userdata('u_id');
		if ($user_id != 168) {
			redirect('/');
		}
		else{
			$this->form_validation->set_rules('level', 'level','required');
			$this->form_validation->set_rules('name', 'name','required');
			$level = $this->input->post('level');
			$name = $this->input->post('name');
			$remark = $this->input->post('remark');
			$this->_data['book_level'] = $this->book_model->get_booklevel();
			if ($this->form_validation->run() == FALSE){
				$data = array();
	      		$this->_data['title'] = '添加书籍';
				$this->load->view('default/book_add',$this->_data);
			}
			else{
				$data = [
					'level' => $level,
					'name' => $name,
					'remark' => $remark
				];
				$result = $this->book_model->insert_book($data);
				if ($result) {
					echo "<script>
							alert('书籍添加成功！！');
							parent.window.location.reload();
				         	var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
				         	parent.layer.close(index);
							location.href='".$_SERVER["HTTP_REFERER"]."';
						</script>";
				}
			}
		}
	}
	public function book_return(){
		$user_id = $this->session->userdata('u_id');
		if ($user_id != 168) {
			redirect('/');
		}
		else{
			$id = $this->input->get('id');
			$book = $this->book_model->get_bookname_by_id($id);
			$log = $this->book_model->search_booklog_by_id($id);
			$result = $this->book_model->return_book($id);
			if ($result) {
				foreach ($log as $key => $value) {
					if ($value->returntime == "") {
						$data = [
							'returntime' =>  date("Y-m-d H:i",time()),
						];
						$this->book_model->update_book_log($value->id,$data);
					}
				}
				echo $book;
			}
		}
	}
	public function book_order(){
		$user_id = $this->session->userdata('u_id');
		$name = $this->book_model->get_name_by_id($user_id);
		$id = $this->input->get('id');
		$book = $this->book_model->get_bookname_by_id($id);
		$result = $this->book_model->order_book($id);
		if ($result) {
			$data=[
					'book_id' => $id,
					'user' => $name
				];
			$this->book_model->order_book_log($data);
			echo $book;
		}
	}
	public function book_lend(){
		$user_id = $this->session->userdata('u_id');
		if ($user_id != 168) {
			redirect('/');
		}
		else{
			$id = $this->input->get('id');
			$name = $this->input->get('name');
			$book = $this->book_model->get_bookname_by_id($id);
			$result = $this->book_model->lend_book($id);
			if ($result) {
				$data=[
					'book_id' => $id,
					'user' => $name
				];
				$this->book_model->lend_book_log($data);
				echo $book;
			}
		}
	}
	public function book_order_lend(){
		$user_id = $this->session->userdata('u_id');
		if ($user_id != 168) {
			redirect('/');
		}
		else{
			$id = $this->input->get('id');
			$book = $this->book_model->get_bookname_by_id($id);
			$log = $this->book_model->search_orderlog_by_id($id);
			$result = $this->book_model->lend_book($id);
			if ($result) {
				$data = [
					'lendtime' => date("Y-m-d H:i",time()),
				];
				$this->book_model->update_book_log($log[0]->id,$data);
				echo $book;
			}
		}
	}
	public function book_borrow_log(){
		$id = $this->input->get('id');
		$log = $this->book_model->search_booklog_by_id($id);
		foreach ($log as $key => $value) {
			if ($value->returntime == "") {
				echo $value->user."于".$value->lendtime."借出";
			}
		}
	}
	public function books_borrow_logs(){
		$logs = $this->book_model->search_all_booklogs();
		foreach ($logs as $key => $value) {
			$bookname = $this->book_model->get_bookname_by_id($value->book_id);
			if ($value->returntime == "") {
				echo $bookname."于".date("Y-m-d H:i",strtotime($value->lendtime))."被".$value->user."借出，尚未归还。<br>";
			}
			else{
				echo $bookname."于".date("Y-m-d H:i",strtotime($value->lendtime))."被".$value->user."借出，在".date("Y-m-d H:i",strtotime($value->returntime))."归还。<br>";
			}
		}
	}
}