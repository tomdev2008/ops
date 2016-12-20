<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Statistics_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);
		$this->load->database();
	}
	public function insert($data) {
		$this->db->set('opr_time', 'NOW()', false);
		$this->db->insert('ops_project_statistics', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function get_project_all(){
		$query = $this->db->query("select * from ops_project_statistics ");
		$row = $query->result();
		return $row;
	}
	public function get_project_by_id($id){
		$query = $this->db->query("select * from ops_project_statistics where project_id=".$id);
		$row = $query->result();
		return $row;
	}
	public function get_project_by_time($time){
		$query = $this->db->query("select * from ops_project_statistics where time=".$time);
		$row = $query->result();
		return $row;
	}
	public function get_project_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_project');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function get_id_by_name($name) {
		$this->db->select('id');
		$this->db->from('ops_project');
		$this->db->where('name', $name);
		$data = $this->db->get()->row('id');
		return $data;
	}
	public function get_project_name() {
		$query = $this->db->query("select name from ops_project");
		$row = $query->result();
		return $row;
	}
	public function get_leader_user_id_by_id($id) {
		$this->db->select('user_id');
		$this->db->from('ops_project');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('user_id');
		return $data;
	}
	public function get_leader_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}

	public function get_product_project_num(){
		$query = $this->db->query("select COUNT(distinct time) from ops_project_statistics");
		$row = $query->result();
		return $row;
	}
	public function get_product_project_name(){
		$query = $this->db->query("select distinct time from ops_project_statistics order by time DESC");
		$row = $query->result();
		return $row;
	}
	public function get_project_num_by_time($time){
		$query = $this->db->query("select distinct project_id from ops_project_statistics where time=".$time);
		$row = $query->result();
		return $row;
	}
	public function get_project_id_by_time($time){
		$query = $this->db->query("select distinct project_id from ops_project_statistics where time=".$time);
		$row = $query->result();
		return $row;
	}
	public function get_project_env_num_by_time_id($time,$id){
		$query = $this->db->query("select * from ops_project_statistics where time='".$time."' and project_id='".$id."'");
		$row = $query->result();
		return $row;
	}
	public function get_project_env_name_by_time_id($time,$id){
		$query = $this->db->query("select * from ops_project_statistics where time='".$time."' and project_id='".$id."'");
		$row = $query->result();
		return $row;
	}
	public function get_num_all_by_time($time){
		$sum = 0;
		$s = 0;
		$project_ID = $this->get_project_id_by_time($time);
		foreach ($project_ID as $key => $value)
		{
            $project_id = $value->project_id;
            //print_r($project_name);
            $project_env_num = count($this->get_project_env_num_by_time_id($time,$project_id));
            $s += $project_env_num;
        }
        $sum += $s;
		return $sum;
	}
	public function get_name_by_time_name($time,$name){
		$this->db->select('leader_name');
		$this->db->from('ops_project_statistics');
		$this->db->where('time', $time);
		$this->db->where('project_env_name', $name);
		$data = $this->db->get()->row('leader_name');
		return $data;
	}
	public function get_oprtime_by_time_name($time,$name){
		$this->db->select('opr_time');
		$this->db->from('ops_project_statistics');
		$this->db->where('time', $time);
		$this->db->where('project_env_name', $name);
		$data = $this->db->get()->row('opr_time');
		return $data;
	}
	public function get_change_by_time_env($time,$env){
		$this->db->select('change_log');
		$this->db->from('ops_project_statistics');
		$this->db->where('time', $time);
		$this->db->where('project_env_name', $env);
		$data = $this->db->get()->row('change_log');
		return $data;
	}
	public function get_name_by_project($project_id){
		$query = $this->db->query("select server_name, server_alias_name from ops_app_server where server_env = '4' and server_project = '".$project_id."' group by server_name order by id ");
		$row = $query->result();
		return $row;
	}
	public function get_server_name(){
		$query = $this->db->query("select server_name from ops_app_server where server_env = '4'");
		$row = $query->result();
		return $row;
	}
	public function get_alias_name($server_name){
		$this->db->select("server_alias_name");
		$this->db->from("ops_app_server");
		$this->db->where('server_name',$server_name);
		$data = $this->db->get()->row('server_alias_name');
		return $data;
	}
	// public function get_test($usename,$password){
	// 	$query = $this->db->query("select * from ops_test where username= ".$username." AND password= ".$password);
	// }
	public function Email_to_ops($time,$name,$projectname,$env_name,$change_log,$select){
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
		$this->email->from('opsalerts@xkeshi.com', '【运维项目发布系统】');
		$this->email->to('ops@xkeshi.com');
		$this->email->subject('通知：有新的项目发布，项目编号：'.$time);
		$link = "<a href='http://ops.xkeshi.so/statistics/'>http://ops.xkeshi.so/statistics/</a>";
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
		if ($select == "紧急发布") {
			$select = "<font color='red'>".$select."</font>";
		}
		else{
			$select = "<font color='green'>".$select."</font>";
		}
		$message = "<strong>".$name."</strong> to 运维组：<br>
			新的项目发布，需要马上处理。<br>
			项目名称：<strong>".$projectname."</strong>
			<br>容器名称：<strong>".$env_name."</strong>
			<br>修改记录：<strong>".$change_log."</strong>
			<br>发布状态：<strong>".$select."</strong>
			<br>点击查看：".$link;
		$this->email->message($message.$footer);
		$this->email->send();
	}
}