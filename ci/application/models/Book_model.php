<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Book_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie']);		
		$this->load->database();
	}
	public function insert_book($data) {
		$this->db->insert('ops_bookinfo', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function get_booksum(){
		$this->db->select('count(id)');
		$this->db->from('ops_bookinfo');
		$data = $this->db->get()->row('count(id)');
		return $data;
	}
	public function get_lendbooksum(){
		$this->db->select('count(id)');
		$this->db->from('ops_bookinfo');
		$this->db->where('borrow',1);
		$data = $this->db->get()->row('count(id)');
		return $data;
	}
	public function get_bookinfo_desc(){
		$this->db->select('*');
		$this->db->from('ops_bookinfo');
		$this->db->order_by('borrow','DESC');
		$this->db->order_by('id','ASC');
		$data = $this->db->get()->result();
		return $data;
	}
	public function get_bookinfo_asc(){
		$this->db->select('*');
		$this->db->from('ops_bookinfo');
		$this->db->order_by('borrow','ASC');
		$this->db->order_by('id','ASC');
		$data = $this->db->get()->result();
		return $data;
	}
	public function get_bookinfo_by_level_desc($level){
		$this->db->select('*');
		$this->db->from('ops_bookinfo');
		$this->db->where('level', $level);
		$this->db->order_by('borrow','DESC');
		$this->db->order_by('id','ASC');
		$data = $this->db->get()->result();
		return $data;
	}
	public function get_bookinfo_by_level_asc($level){
		$this->db->select('*');
		$this->db->from('ops_bookinfo');
		$this->db->where('level', $level);
		$this->db->order_by('borrow','ASC');
		$this->db->order_by('id','ASC');
		$data = $this->db->get()->result();
		return $data;
	}
	public function get_bookname_by_id($id){
		$this->db->select('name');
		$this->db->from('ops_bookinfo');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function get_booklevel(){
		$this->db->select('id,level_name');
		$this->db->from('ops_user_level');
		$this->db->where('id <> 1');
		$this->db->where('id <> 5');
		$this->db->where('id <> 15');
		$data = $this->db->get()->result();
		return $data;
	}
	public function get_booklevel_by_id($id){
		$this->db->select('level_name');
		$this->db->from('ops_user_level');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_name');
		return $data;
	}
	public function return_book($id){
		$where = " id=".$id;
		$query = $this->db->update('ops_bookinfo',['borrow'=>0],$where);
		return $query;
	}
	public function order_book($id){
		$where = " id=".$id;
		$query = $this->db->update('ops_bookinfo',['borrow'=>2],$where);
		return $query;
	}
	public function update_book_log($id,$data){
		$where = " id=".$id;
		$query = $this->db->update('ops_book_borrow',$data,$where);
		return $query;
	}
	public function lend_book($id){
		$where = " id=".$id;
		$query = $this->db->update('ops_bookinfo',['borrow'=>1],$where);
		return $query;
	}
	public function lend_book_log($data) {
		$this->db->set('lendtime', 'NOW()', false);
		$this->db->insert('ops_book_borrow', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function order_book_log($data) {
		$this->db->insert('ops_book_borrow', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function search_booklog_by_id($id){
		$this->db->select('*');
		$this->db->from('ops_book_borrow');
		$this->db->where('book_id', $id);
		//$this->db->where('returntime <> null');
		$data = $this->db->get()->result();
		return $data;
	}
	public function search_log_by_id($id){
		$query = $this->db->query("select user,lendtime from ops_book_borrow where book_id = '".$id."' and returntime is null");
		$data = $query->result();
		return $data;
	}
	public function search_orderlog_by_id($id){
		$query = $this->db->query("select id,user from ops_book_borrow where book_id = '".$id."' and lendtime is null and returntime is null");
		$data = $query->result();
		return $data;
	}
	public function search_all_booklogs(){
		$this->db->select('*');
		$this->db->from('ops_book_borrow');
		$this->db->order_by('returntime','ASC');
		$data = $this->db->get()->result();
		return $data;
	}
	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function Email_to_MrsLin($book_id,$book_name,$user){
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.exmail.qq.com';
		$config['smtp_user'] = 'opsalerts@xkeshi.com';
		$config['smtp_pass'] = 'Xkeshi@123';
		$config['mailtype'] = 'html';
		//$config['validate'] = true;
		//$config['priority'] = 1;
		$config['smtp_port'] = 465;
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$config['crlf'] = "\r\n";
		$this->email->set_newline("\r\n");
		$this->email->from('opsalerts@xkeshi.com', '【运维借书系统】');
		$this->email->to('lxc@xkeshi.com');
		$this->email->subject('通知：有新的借书预定，请查看~');
		$link = "<a href='http://ops.xkeshi.so/book/'>http://ops.xkeshi.so/book/</a>";
		$footer = "
		<br>
		<hr/>
		<p>
		<font size=4><strong>爱客仕运维部</strong></font>
		<br>
		电话：0571-87179065
		<br>
		地址：杭州市江干区钱江路1366号华润大厦A座14楼
		<br>
		网址：<a href=http://www.xkeshi.com>http://www.xkeshi.com</a>
		</p>
		";
		$message = "<strong>".$user."</strong> to 晓聪：<br>
		已预订A".$book_id."号图书，书面：".$book_name."需要马上处理。
		<br>点击查看：<strong>".$link."</strong>".$footer;
		$this->email->message($message);
		$this->email->send();
	}
}