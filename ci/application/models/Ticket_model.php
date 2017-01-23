<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Ticket_model class.
 * 
 * @extends CI_Model
 */
class Ticket_model extends CI_Model {

	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}
	public function get_status_by_id($id){
		$this->db->select("status");
		$this->db->from("ops_ticket");
		$this->db->where("id",$id);
		$data = $this->db->get()->row("status");
		return $data;
	}
	public function get_user_level_list() {
		$query = $this->db->query("select * from ops_ticket_level");
		$row = $query->result();
		return $row;
	}
	public function get_message_by_id($id) {
		$this->db->select('level_message');
		$this->db->from('ops_ticket_level');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_message');
		return $data;
	}
	public function insert_ticket($data) {
		$this->db->set('opr_time', 'NOW()', false);
		$this->db->insert('ops_ticket', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function insert_ticket_reply($data) {
		$this->db->set('opr_time', 'NOW()', false);
		$this->db->insert('ops_ticket_reply', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function get_user_level_name_by_id($id) {
		$this->db->select('level_name');
		$this->db->from('ops_user_level');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_name');
		return $data;
	}
	public function get_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function get_level_id_by_id($id) {
		$this->db->select('level_id');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_id');
		return $data;
	}
	public function get_email_by_id($id) {
		$this->db->select('email');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('email');
		return $data;
	}
	public function get_submitter_by_id($id) {
		$this->db->select('submitter');
		$this->db->from('ops_ticket');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('submitter');
		return $data;
	}
	public function get_submitter_by_title($title) {
		$this->db->select('submitter');
		$this->db->from('ops_ticket');
		$this->db->where('title', $title);
		$data = $this->db->get()->row('submitter');
		return $data;
	}
	/*public function get_pid_by_id($id) {
		$this->db->select('pid');
		$this->db->from('ops_ticket');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('pid');
		return $data;
	}*/
	public function get_ticket_level_by_id($id) {
		$this->db->select('ticket_level');
		$this->db->from('ops_ticket');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('ticket_level');
		return $data;
	}
	public function get_ticket_overtime_by_ticket_id($ticket_id) {
		$sql="select opr_time from ops_ticket_reply where ticket_id=".$ticket_id." order by opr_time desc limit 0,1";
    	$query = $this->db->query($sql);
    	$row = $query->result();
		return $row;
	}
	public function get_reply_by_ticket_id($ticket_id) {
		$query = $this->db->query("select opr_time,contents,submitter from ops_ticket_reply where ticket_id='".$ticket_id."'");
		$row = $query->result();
		return $row;
	}/*
	public function get_contents_by_submitter($submitter,$id) {
		$query = $this->db->query("select opr_time,contents,submitter from ops_ticket where pid=1 and (submitter=".$submitter." or submitter=".$id." or ticket_user_level='1' or ticket_user_level='2' ".")");
		$row = $query->result();
		return $row;
	}*/
	public function get_level_name_by_id($id) {
		$this->db->select('level_name');
		$this->db->from('ops_ticket_level');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('level_name');
		return $data;
	}
	public function get_ticket_status_by_ticket_level($ticket_level) {
		$this->db->select('level_name');
		$this->db->from('ops_ticket_level');
		$this->db->where('id', $ticket_level);
		$data = $this->db->get()->row('ticket_level_name');
		return $data;
	}

	public function get_ticket_status_by_id($status_id) {
		switch ($status_id) {
			case '0':
				return '<span class="label label-important">审核拒绝</span>';
				break;
			case '1':
				return '<span class="label label-inverse">已完成</span>';
				break;
			case '2':
				return '<span class="label label-info">已处理</span>';
				break;
			case '3':
				return '<span class="label label-warning">正在处理</span>';
				break;
			case '4':
				return '<span class="label label-success">置顶</span>';
				break;	
			default:
				return '未知';
				break;
		}
	}

	public function get_ticket_all($level_id) {
		$user_level_id = $this->session->userdata('u_level_id');
		$user_id = $this->session->userdata('u_id');
		$query =NULL;
		if ($user_level_id != '2') {
			if ($level_id != 0) {
			$query = $this->db->query("select * from ops_ticket where submitter = ".$user_id." and ticket_user_level = ".$level_id."  or status =4");
			}
			else if ($level_id == 0) {
			$query = $this->db->query("select * from ops_ticket where submitter = ".$user_id." or status =4");
			}
		}
		else if ($user_level_id == '2') {
			if ($level_id != 0) {
				$query = $this->db->query("select * from ops_ticket where  ticket_user_level = ".$level_id);
			}
			else if ($level_id == 0) {
				$query = $this->db->query("select * from ops_ticket ");
			}
		}
		$row = $query->result();
		return $row;
	}	

	public function get_ticket_list($level_id,$page,$pagenum) {
		$where_sql = '';
		$user_level_id = $this->session->userdata('u_level_id');
		$user_id = $this->session->userdata('u_id');
		if ($user_level_id != '2') {
			if ($level_id != 'NULL') {
				$ticket_sql_where = " where ticket_user_level = ".$level_id." and submitter ='".$user_id."' or (status = 4 and ticket_user_level = ".$level_id.")";
			}
			else if ($level_id == 'NULL') {
				$ticket_sql_where = "where submitter ='".$user_id."' or status = 4 ";
			}					
		}
		else if ($user_level_id == '2'){
			 $ticket_sql_where = $level_id != 'NULL' ? " where ticket_user_level = ".$level_id : "";
		}
		form_hidden('pagenum',$pagenum);
		$query = $this->db->query("select * from ops_ticket ".$ticket_sql_where ." order by status desc,opr_time DESC limit ".$page.",".$pagenum);
		$row = $query->result();
		foreach ($row as $key => $value) {
			$row[$key]->ticket_user_level_name = $this->get_level_name_by_id($value->ticket_user_level);
			$row[$key]->submitter_name = $this->get_name_by_id($value->submitter);
			$row[$key]->auditor_name = $this->get_name_by_id($value->auditor);
			$row[$key]->transactor_name = $this->get_name_by_id($value->transactor);
			$row[$key]->status_name = $this->get_ticket_status_by_id($value->status);
			//$row[$key]->pid_name = $this->get_pid_by_id($value->pid);
			//$row[$key]->ticket_level_name = $this->get_ticket_status_by_ticket_level($value->ticket_level);
		}
		return $row;
	}
	public function get_ticket_by_id($id = FALSE) {
		if ($id === FALSE)
    {
        $query = $this->db->get('ops_ticket');
        return $query->result_array();
    }
    $query = $this->db->get_where('ops_ticket', array('id' => $id));
    $data = $query->row_array();
    //$data['contents'] = nl2br_except_pre($data['contents']);
    return $data;
	}
	public function update_status_by_id($id){
	$sql="update ops_ticket set status= 2 where id=".$id;
    $query = $this->db->query($sql);
    return $query;
	}
	public function update_status_over_by_id($id){
		$sql="update ops_ticket set status= 1 where id=".$id;
	    $query = $this->db->query($sql);
	    return $query;
	}
	public function page_num($pagenum)
	{
		return $pagenum;
	}
 	 public function makeLinks($string) {
		$string = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', $string);
		$string = nl2br_except_pre($string);
		echo $string;
	}
	public function Time($start,$end){
		$date=floor((strtotime($end)-strtotime($start))/86400);
		$hour=floor((strtotime($end)-strtotime($start))%86400/3600);
		$minute=floor((strtotime($end)-strtotime($start))%86400/60%60);
		$second=floor((strtotime($end)-strtotime($start))%86400%60);
		if ($date != 0) {
			echo $date."天";
		}
		if ($hour != 0) {
			echo $hour."小时";
		}
		if ($minute != 0) {
			echo $minute."分钟";
		}
		if ($date == 0 && $hour == 0 && $minute == 0) {
			echo $second."秒";
		}
	}
	public function emailmoban($body){
	  if (is_array($body))
	  {
	   $file = array_keys($body);
	   $file = $file[0];
	   $data = array_values($body);
	   $data = $data[0];
	   /* 检查邮件模板文件是否存在 */
	   if (!file_exists($file))
	   {
	    echo '模板不存在!';
	   }
	   $body = file_get_contents($file);
	   if(is_array($data)){
	    foreach ($data as $key=>$val)
	    {
	     $body  = str_replace('{'.$key.'}',$val,$body);
	    }
	    return $body;
	   } 
	  }
	 }
	public function Email_to_user($id_hidden,$email_hidden,$title_hidden,$name_hidden){
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
		$this->email->from('opsalerts@xkeshi.com', '【运维工单管理系统】');
		$this->email->to($email_hidden);
		$this->email->subject('通知：您的工单"'.$title_hidden.'"有新的回复');
		//$link = "http://ops.xkeshi.so/ticket/view/".$id_hidden;
		$link = "<a href='http://ops.xkeshi.so/ticket/view/".$id_hidden."'>http://ops.xkeshi.so/ticket/view/".$id_hidden."</a>";
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
		$message = "运维组：hi ，<strong>".$name_hidden."</strong> 你好~ <br>
		你的<strong>".$id_hidden."</strong>号工单已有新的进展，<br>
		点击查看：".$link.$footer;
		$this->email->message($message);
		$this->email->send();
	}
	public function Email_reply($id_hidden,$title_hidden,$name_hidden,$contents){
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
		$this->email->from('opsalerts@xkeshi.com', '【运维工单管理系统】');
		$this->email->to('ops@xkeshi.com');
		$this->email->subject('通知：'.$id_hidden.'号工单【'.$title_hidden.'】有新的回复');
		//$link = "http://ops.xkeshi.so/ticket/view/".$id_hidden;
		$link = "<a href='http://ops.xkeshi.so/admin/ticket/view/".$id_hidden."'>http://ops.xkeshi.so/admin/ticket/view/".$id_hidden."</a>";
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
		$message = "<strong>".$name_hidden."</strong> 的最新留言：<br><strong>"
		.$contents."</strong><br>
		请及时查看：".$link.$footer;
		$this->email->message($message);
		$this->email->send();
	}
	public function Email_to_ops($contents,$email,$title,$name){
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
		$this->email->from('opsalerts@xkeshi.com', '【运维工单管理系统】');
		$this->email->to($email);
		$this->email->subject('通知：有新的工单提交，内容：'.$title);
		$link = "<a href='http://ops.xkeshi.so/admin/ticket/'>http://ops.xkeshi.so/admin/ticket/</a>";
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
		$message = "<strong>".$name."</strong> to 运维组：<br>
		有新的工单被提交，需要马上处理。
		<br>工单号标题：<strong>".$title."</strong>
		<br>工单内容：<strong>".$contents."</strong>
		<br>点击查看：<strong>".$link."</strong>".$footer;
		$this->email->message($message);
		$this->email->send();
	}
	public function ubbReplace($str) {
	    $str = str_replace ( ">", '<；', $str );    
	    $str = str_replace ( ">", '>；', $str );
	    $str = str_replace ( "\n", '<br>', $str );  
	    $str = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank">$1</a>', $str);
	    $str = preg_replace ( "[\[em_([0-9]*)\]]", "<img src=\"http://ops.xkeshi.so/qqface/arclist/$1.gif\" />", $str );
	    return $str;
	}
}