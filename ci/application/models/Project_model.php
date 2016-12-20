<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Project_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}
	public function insert_project($data) {
		$this->db->insert('ops_app_server', $data);
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
	public function get_ServerName_by_ServerEnv($server_env,$platform_id){
		$query = $this->db->query("select a.ip_alias,a.ip,count(b.server_deploy_port) as server_num from ops_ip as a left join ops_app_server as b on a.ip = b.server_deploy_ip where a.server_env ='".$server_env."' and a.type='Linux' and a.platform_id ='".$platform_id."' group by a.ip order by server_num limit 0,5");
		$row = $query->result();
		return $row;
	}
	public function get_MaxPort_by_ip($ip){
		$this->db->select_max('server_deploy_port');
		$this->db->from('ops_app_server');
		$this->db->where('server_deploy_ip',$ip);
		$data = $this->db->get()->row('server_deploy_port');
		return $data;
	}
	public function get_PortNum_by_ip($ip){
		$this->db->select('count(server_deploy_port)');
		$this->db->from('ops_app_server');
		$this->db->where('server_deploy_ip',$ip);
		$data = $this->db->get()->row('count(server_deploy_port)');
		return $data;
	}
	public function get_AliasName_by_id($id){
		$this->db->select('alias_name');
		$this->db->from('ops_project');
		$this->db->where('id',$id);
		$data = $this->db->get()->row('alias_name');
		return $data;
	}
	public function Email_to_ops($name,$server_name,$server_alias_name,$server_type,$server_env,$server_deploy_ip,$server_deploy_port){
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
		$this->email->subject('通知：有新子项目被提交，名称：'.$server_name);
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
		switch($server_env){
			case '1':
			$env = "开发环境";
			break;
			case '2':
			$env = "测试环境";
			break;
			case '3':
			$env = "预发布环境";
			break;
			case '4':
			$env = "生产环境";
			break;
		}
		$message = "<strong>".$name."</strong> to 运维组：<br>
		提交了新的子项目，请马上处理。
		<br>项目Jenkins名称：<strong>".$server_name."</strong>
		<br>项目中文名称：<strong>".$server_alias_name."</strong>
		<br>项目部署环境：<strong>".$env."</strong>
		<br>项目容器：<strong>".$server_type."</strong>
		<br>服务器：<strong>".$server_deploy_ip."</strong>
		<br>端口:<strong>".$server_deploy_port."</strong>
		<br>".$footer;
		$this->email->message($message);
		$this->email->send();
	}
}