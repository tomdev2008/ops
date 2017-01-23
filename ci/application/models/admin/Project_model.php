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

	public function get_platform_list() {
		$query = $this->db->query("select * from ops_platform");
		$row = $query->result();
		return $row;
	}

	public function get_project_by_id($id) {
		$query = $this->db->query("select * from ops_project WHERE id = '".$id."'");
		$data = $query->result();
		return $data;
	}

	public function insert_project($data) {
		$this->db->insert('ops_project', $data);
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

	public function get_id_by_name($name) {
		$this->db->select('id');
		$this->db->from('ops_user');
		$this->db->where('name', $name);
		$data = $this->db->get()->row('id');
		return $data;
	}

	public function get_user_list() {
		$query = $this->db->query("select * from ops_user");
		$data = $query->result();
		return $data;
	}	
	public function get_user_id_by_id($id) {
		$this->db->select('user_id');
		$this->db->from('ops_project');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('user_id');
		return $data;
	}	
	public function get_alias_by_ip($ip) {
		$query = $this->db->query("select ip_alias from ops_ip WHERE ip ='".$ip."'");
		$row = $query->row_array();
		$data = '<span class="label label-info">'.$row['ip_alias'].'</span>&nbsp';
		return $data;
	}
	public function get_alias_name_by_server_project($server_project) {
		$this->db->select('name');
		$this->db->from('ops_project');
		$this->db->where('id', $server_project);
		$data = $this->db->get()->row('name');
		return $data;
	}
	public function get_repeat_id($container_sql_where) {
		$query = $this->db->query("select group_concat(CONCAT(server_deploy_ip,':',server_deploy_port)) from ops_app_server".$container_sql_where."  group by server_name");
		$data = $query->result();
		return $data;
	}
	public function get_project_id_by_server_name($server_name){
		$query = $this->db->query("select id from ops_app_server where server_name='".$server_name."'");
		$row = $query->result();
		return $row;
	}
	public function get_num_all_by_server_name($server_name){
		$sum = 0;
		$s = 0;
		$ID = $this->get_project_id_by_server_name($server_name);
		foreach ($ID as $key => $value)
		{
            $id = $value->id;
            $s += 1;
        }
        $sum += $s;
		return $sum;
	}
	public function get_alias_by_id($id) {
		$this->db->select('server_deploy_ip');
		$this->db->from('ops_app_server');
		$this->db->where('id', $id);
		$ip = $this->db->get()->row('server_deploy_ip');
		$query = $this->db->query("select ip_alias from ops_ip WHERE ip ='".$ip."'");
		$row = $query->row_array();
		$data = '<span class="label label-info">'.$row['ip_alias'].'</span> '.$ip;
		return $data;
	}
	public function get_vhost_alias_by_ip($ip) { 
		$this->db->select('ip_alias');
		$this->db->from('ops_ip');
		$this->db->where('ip', $ip);
		$ip = $this->db->get()->row('ip_alias');
		return str_replace(PHP_EOL, '', $ip);
	}
	public function get_server_name_by_id($id) {
		$this->db->select('server_name');
		$this->db->from('ops_app_server');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('server_name');
		return $data;
	}	
	public function get_server_type_by_id($id) {
		$this->db->select('server_type');
		$this->db->from('ops_app_server');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('server_type');
		return $data;
	}	
	public function get_server_deploy_port_by_id($id) {
		$this->db->select('server_deploy_port');
		$this->db->from('ops_app_server');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('server_deploy_port');
		return $data;
	}	
	public function get_app_domain_by_name($app_name) {
		$this->db->select('app_domain');
		$this->db->from('ops_app_domain');
		$this->db->where('app_name', $app_name);
		$data = $this->db->get()->row('app_domain');
		return $data;
	}	
	public function get_server_name_by_id_and_env($server_project,$container_env) {
		switch ($container_env) {
			case '1':
				$env = 'dev_url';
				break;
			case '2':
				$env = 'test_url';
				break;
			case '3':
				$env = 'pre_url';
				break;
			case '4':
				$env = 'product_url';
				break;			
			default:
				$env = 'product_url';
				break;
		}
		$this->db->select($env);
		$this->db->from('ops_project');
		$this->db->where('id', $server_project);
		$data = $this->db->get()->row($env);
		return $data;
	}	
	public function add_nginx_conf_upstream($upstream_name, $ip_servers) {
		$str = "upstream ".$upstream_name." {".PHP_EOL;
		foreach ($ip_servers as $key => $value) {
			$str .= "    server ".$value."; #".$this->project_model->get_vhost_alias_by_ip(strstr($value,':',true)).PHP_EOL;
		}
		$str .= "}".PHP_EOL;

		return $str;
	}		
	public function add_nginx_conf_tmp1($server_name) {
		$str = "server{".PHP_EOL;
		$str .= "    listen 80;".PHP_EOL;
		$str .= "    server_name ".$server_name.";".PHP_EOL;
		return $str;
	}	
	public function add_nginx_conf_tmp2() {
		$str = "}".PHP_EOL;
		return $str;
	}	
	public function add_nginx_conf_server($upstream_name) {
		$str = "    location /".$upstream_name."/{".PHP_EOL;
		$str .= "        proxy_pass "."http://".$upstream_name."/;".PHP_EOL;	
		$str .= "        include proxy.conf;".PHP_EOL;
		$str .= "    }".PHP_EOL;
		return $str;
	}	
	public function get_user_name_by_id($id) {
		$this->db->select('name');
		$this->db->from('ops_user');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('name');
		return $data;
	}	
	public function get_AliasName_by_id($id){
		$this->db->select('alias_name');
		$this->db->from('ops_project');
		$this->db->where('id',$id);
		$data = $this->db->get()->row('alias_name');
		return $data;
	}
	public function get_platform_id_by_id($id) {
		$this->db->select('platform_id');
		$this->db->from('ops_project');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('platform_id');
		return $data;
	}	
	public function get_env_alias_by_env($env) {
		switch ($env) {
			case '1':
				$env_name = '开发环境';
				break;
			case '2':
				$env_name = '测试环境';
				break;
			case '3':
				$env_name = '预发布环境';
				break;
			case '4':
				$env_name = '生产环境';
				break;			
			default:
				$env_name = '';
				break;
		}
		return $env_name;
	}
	public function get_env_name_by_env($env) {
		switch ($env) {
			case '1':
				$env_name = 'dev';
				break;
			case '2':
				$env_name = 'test';
				break;
			case '3':
				$env_name = 'pre';
				break;
			case '4':
				$env_name = 'product';
				break;			
			default:
				$env_name = '';
				break;
		}
		return $env_name;
	}
	public function get_ServerName_by_ServerEnv($server_env,$platform_id){
		$query = $this->db->query("select a.ip_alias,a.ip,count(b.server_deploy_port) as server_num from ops_ip as a left join ops_app_server as b on a.ip = b.server_deploy_ip where a.server_env ='".$server_env."' and a.type='Linux' and a.platform_id ='".$platform_id."' group by a.ip order by server_num limit 0,5");
		$row = $query->result();
		return $row;
	}
	public function get_former_ip($server_name){
		$this->db->select('server_deploy_ip');
		$this->db->from('ops_app_server');
		$this->db->where('server_name',$server_name);
		$data = $this->db->get()->row('server_deploy_ip');
		return $data;
	}
	public function get_ServerName_by_ServerEnv_copy($server_env,$platform_id,$former_ip){
		$query = $this->db->query("select a.ip_alias,a.ip,count(b.server_deploy_port) as server_num from ops_ip as a left join ops_app_server as b on a.ip = b.server_deploy_ip where a.server_env ='".$server_env."' and a.type='Linux' and a.platform_id ='".$platform_id."' and a.ip <> '".$former_ip."' group by a.ip order by server_num limit 0,5");
		$row = $query->result();
		return $row;
	}
	public function get_PortNum_by_ip($ip){
		$this->db->select('count(server_deploy_port)');
		$this->db->from('ops_app_server');
		$this->db->where('server_deploy_ip',$ip);
		$data = $this->db->get()->row('count(server_deploy_port)');
		return $data;
	}
	public function get_MaxPort_by_ip(){
		$this->db->select_max('ops_port');
		$this->db->from('ops_app_jenkins');
		$data = $this->db->get()->row('ops_port');
		return $data;
	}
	public function get_Max_dubbo_Port_by_ip(){
		$this->db->select_max('ops_dubbo_port');
		$this->db->from('ops_app_jenkins');
		$data = $this->db->get()->row('ops_dubbo_port');
		return $data;
	}
	public function insert_jenkins($data) {
		$this->db->insert('ops_app_jenkins', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function insert_app_server($data) {
		$this->db->insert('ops_app_server', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function Email_to_ops($name,$server_name,$cn_alias_name,$server_type,$server_env2,$server_deploy_ip,$http_port){
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
		$env_alias = $this->get_env_alias_by_env($server_env2);
		$message = "<strong>".$name."</strong> to 运维组：<br>
		提交了新的子项目，请马上处理。
		<br>项目Jenkins名称：<strong>".$server_name."</strong>
		<br>项目中文名称：<strong>".$cn_alias_name."</strong>
		<br>项目部署环境：<strong>".$env_alias."</strong>
		<br>项目容器：<strong>".$server_type."</strong>
		<br>服务器：<strong>".$server_deploy_ip."</strong>
		<br>端口:<strong>".$http_port."</strong>
		<br>".$footer;
		$this->email->message($message);
		$this->email->send();
	}
	public function search_port_id($ServerName) {
		$this->db->select('id');
		$this->db->from('ops_app_server');
		$this->db->where('server_name', $ServerName);
		$data = $this->db->get()->row('id');
		return $data;
	}	
	public function search_port($port_id) {
		$this->db->select('server_deploy_port');
		$this->db->from('ops_app_server');
		$this->db->where('id', $port_id);
		$data = $this->db->get()->row('server_deploy_port');
		return $data;
	}	
	public function get_jenkins_list_by_ServerEnv($env,$server_project) {
		$sql_where = " WHERE server_env = '".$env."' and server_project = '".$server_project."' group by server_name" ;
		$query = $this->db->query("select * from ops_app_server".$sql_where);
		$data = $query->result();
		return $data;
	}
	public function get_jenkins_copy_by_server_name($server_name) {
		$sql_where = " WHERE server_name = '".$server_name."' group by server_name" ;
		$query = $this->db->query("select server_alias_name,server_type,server_env,server_project,server_deploy_port,server_deploy_path,server_bin_start,server_bin_stop,server_logs_path from ops_app_server".$sql_where);
		$data = $query->result();
		return $data;
	}
	/**
	 * 对象 转 数组
	 *
	 * @param object $obj 对象
	 * @return array
	 */
	function object_to_array($obj)
	{
	    $obj = (array)$obj;
	    foreach ($obj as $k => $v)
	    {
	        if (gettype($v) == 'resource')
	        {
	            return;
	        }
	        if (gettype($v) == 'object' || gettype($v) == 'array')
	        {
	            $obj[$k] = (array)object_to_array($v);
	        }
	    }
	 
	    return $obj;
	}
	public function get_project_by_server_name($server_name){
		$this->db->select('server_project');
		$this->db->from('ops_app_server');
		$this->db->where('server_name',$server_name);
		$data = $this->db->get()->row('server_project');
		return $data;
	}
	public function get_platform_by_project($server_project){
		$this->db->select('platform_id');
		$this->db->from('ops_project');
		$this->db->where('id',$server_project);
		$data = $this->db->get()->row('platform_id');
		return $data;
	}
	public function get_env_by_server_name($server_name){
		$this->db->select('server_env');
		$this->db->from('ops_app_server');
		$this->db->where('server_name',$server_name);
		$data = $this->db->get()->row('server_env');
		return $data;
	}
}
