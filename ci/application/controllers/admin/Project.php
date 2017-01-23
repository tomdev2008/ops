<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','typography'));
		$this->load->helper(array('form', 'url', 'cookie','download'));
		$this->load->database();
		$this->load->model('admin/project_model');
		
	}
	public function index()
	{
		$data = array();
		$query = $this->db->query('select * from ops_platform');
		$data = $query->result();
		$this->_data['platform'] = $data;
		$jenkins_url = 'http://jenkins.ops.xkeshi.so/search/?q=';
		$platform_id = $this->input->get('platform_id', TRUE);
		$project_sql_where = $platform_id ? " WHERE platform_id = '".$platform_id."'" : "";
		$query = $this->db->query('select * from ops_project'.$project_sql_where);
		$data = $query->result();
		$this->_data['projects'] = $data;
		$this->_data['jenkins_url'] = $jenkins_url;
		$this->_data['title'] = '项目列表';
		$this->load->view('admin/header');
		$this->load->view('admin/project',$this->_data);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('title', 'title','required');
		$this->form_validation->set_rules('category', 'category','required');
		$this->form_validation->set_rules('alias', 'alias','required');
		$title = $this->input->post('title');
		$category = $this->input->post('category');
		$alias = $this->input->post('alias');
		$user_id = $this->input->post('user_id');
		$dev_url = $this->input->post('dev_url');
		$test_url = $this->input->post('test_url');
		$pre_url = $this->input->post('pre_url');
		$product_url = $this->input->post('product_url');
		$get_user_name = $this->project_model->get_user_list();
		$this->_data['get_user_name'] = $get_user_name;
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '添加项目信息';
			$this->_data['platform_list'] = $this->project_model->get_platform_list();
			$this->_data['get_user_name'] = $this->project_model->get_user_list();
			$this->load->view('admin/header');
			$this->load->view('admin/project_add',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
		 		$data =[
				    'name' => $title,
				    'platform_id' => $category,
				    'alias_name' => $alias,
				    'user_id' => $user_id,
				    'dev_url' => $dev_url,
				    'test_url' => $test_url,
				    'pre_url' => $pre_url,
				    'product_url' => $product_url
				];       	
				$result = $this->project_model->insert_project($data);  
				if ($result) {
					redirect('admin/project');
				}				
	    }
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'name','required');
		$this->form_validation->set_rules('category', 'category','required');
		$id = $this->input->get('id', TRUE);
		$project = $this->project_model->get_project_by_id($id);
		$get_user_name = $this->project_model->get_user_list();
		$this->_data['id'] = $id;
		$this->_data['project'] = $project;		
		$this->_data['get_user_name'] = $get_user_name;
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '项目信息修改';
			$this->_data['get_user_name'] = $this->project_model->get_user_list();
			$this->_data['platform_list'] = $this->project_model->get_platform_list();
			$this->load->view('admin/project_update',$this->_data);
        }
        else
        {	
        	$id = $this->input->post('id', TRUE);	
        	$name = $this->input->post('name', TRUE);
			$user_id = $this->input->post('user_id', TRUE);
			$category = $this->input->post('category',TRUE);
			$dev_url = $this->input->post('dev_url');
			$test_url = $this->input->post('test_url');
			$pre_url = $this->input->post('pre_url');
			$product_url = $this->input->post('product_url');
			$data = [
        		'platform_id' => $this->input->post('category', TRUE),
        		'dev_url' => $this->input->post('dev_url', TRUE),
        		'test_url' => $this->input->post('test_url', TRUE),  	
        		'pre_url' => $this->input->post('pre_url',TRUE),
        		'product_url' => $this->input->post('product_url', TRUE),
        		'user_id' => $this->input->post('user_id', TRUE),
        		'name' => $this->input->post('name', TRUE)
				];
			$this->db->where('id', $id);
			$result = $this->db->update('ops_project', $data);
				if ($result) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
         			parent.layer.close(index);  	
					</script>";
        }
        }	
	}
	public function container()
	{
		$data = array();
		$this->_data['title'] = '容器列表';
		$container_env = $this->input->get('container_env', TRUE);
		$server_project = $this->input->get('server_project', TRUE);
		$container_sql_where = $container_env ? " WHERE server_env = '".$container_env."' and server_project = '".$server_project."'" : " WHERE server_project = '".$server_project."'";
		$query = $this->db->query("select id,server_name,server_type,server_project,server_env,server_alias_name,server_status,server_deploy_ip,group_concat(CONCAT(server_deploy_ip,':',server_deploy_port))as ip_repeat from ops_app_server".$container_sql_where."  group by server_name order by id desc");
		$containers = $query->result();
		$query = $this->db->query("select * from ops_project_env ");
		$server_env = $query->result();
		$this->_data['server_env'] = $server_env;
		$this->_data['server_project'] = $server_project;		
		$this->_data['containers'] = $containers;
		$this->load->view('admin/header');
		$this->load->view('admin/project_container',$this->_data);
		$this->load->view('admin/footer');
	}
	public function nginx()
	{
		$data = array();
		$this->_data['title'] = 'nginx信息';
		$container_env = $this->input->get('container_env', TRUE);
		$server_project = $this->input->get('server_project', TRUE);
		$container_sql_where = $container_env ? " WHERE server_env = '".$container_env."' and server_project = '".$server_project."'" : " WHERE server_project = '".$server_project."'";
		$query = $this->db->query("select id,server_name,server_deploy_ip,group_concat(CONCAT(server_deploy_ip,':',server_deploy_port))as ip_repeat from ops_app_server".$container_sql_where."  group by server_name order by id desc");
		$containers = $query->result();
		$query = $this->db->query("select * from ops_project_env ");
		$server_env = $query->result();
		$nginx_conf_upstream = '';
		$nginx_conf_server = '';	
		$server_name = $this->project_model->get_server_name_by_id_and_env($server_project,$container_env);	
		foreach ($containers as $key => $value) {
			$upstream_name = $value->server_name;
			$ip_servers = explode(",",$value->ip_repeat);
			$nginx_conf_upstream .= $this->project_model->add_nginx_conf_upstream($upstream_name, $ip_servers);
			$nginx_conf_server .= $this->project_model->add_nginx_conf_server($value->server_name);			
		}
		$nginx_conf_upstream_tmp1 = $this->project_model->add_nginx_conf_tmp1($server_name);
		$nginx_conf_upstream_tmp2 = $this->project_model->add_nginx_conf_tmp2();
		
		//$nginx_conf_upstream = $this->typography->nl2br_except_pre($nginx_conf_upstream);
		$download_data = $nginx_conf_upstream.$nginx_conf_upstream_tmp1.$nginx_conf_server.$nginx_conf_upstream_tmp2;
		setcookie('nginx_download',$download_data);
		$this->_data['download_data'] = $download_data;
		if (!isset($upstream_name)) {
			$upstream_name = '';
		}
		$this->_data['upstream_name'] = $upstream_name;
		$this->_data['server_env'] = $server_env;
		$this->_data['server_project'] = $server_project;		
		$this->_data['containers'] = $containers;
		$this->load->view('admin/project_container_nginx',$this->_data);
	}
	public function download()
	{
		$data = $_COOKIE['nginx_download'];
		$upstream_name = $this->input->get('upstream_name', TRUE);
		$name = $upstream_name.'.conf';
		force_download($name, $data);		
	}

	//添加jenkins页面1
	public function jenkins()
	{
		$user_id = $this->session->userdata('admin_id');
		$name = $this->project_model->get_name_by_id($user_id);
		$this->form_validation->set_rules('cn_alias_name', 'cn_alias_name','required');
		$this->form_validation->set_rules('ops_repo_url', 'ops_repo_url','required');
		$this->form_validation->set_rules('server', 'server','required');
		$this->form_validation->set_rules('http_port', 'http_port','required');
		//从上一页面获取项目信息
	    $server_project = $this->input->get('server_project');
	    $platform_id = $this->input->get('platform_id');
	    $server_env = $this->input->get('env');
	    //‘添加jenkins1’页面新增值
		$server_env_name = $this->input->post('server_env_name');
		$server_type_name = $this->input->post('server_type_name');
		$server_name = $this->input->post('server_name');
		$server_contents = $this->input->post('server_contents');
	    //POST页面url上的参数
	    $server_project2 = $this->input->post('server_project2');
	    $platform_id2 = $this->input->post('platform_id2');
	    $server_env2 = $this->input->post('server_env2');
		$alias_name = $this->project_model->get_AliasName_by_id($server_project);
		//判断获取server_name
		if ($server_contents != NULL) {
			$ServerName = $server_env_name."-".$server_type_name."-".$server_name."-".$server_contents;
		}
		else if ($server_contents == NULL) {
			$ServerName = $server_env_name."-".$server_type_name."-".$server_name;
		}

		//获取当前页面表单信息
		$cn_alias_name1 = $this->input->post('cn_alias_name');
		$cn_alias_name2 = $this->input->post('cn_alias_name2');
		$cn_alias_name = $cn_alias_name1.'-'.$cn_alias_name2;
		$ops_docker_deploy = $this->input->post('ops_docker_deploy');
		$ops_repo_type = $this->input->post('ops_repo_type');
		$ops_repo_url = $this->input->post('ops_repo_url');
		$ops_war_name = $this->input->post('ops_war_name');
		$server_type = $this->input->post('server_type');

		if ($this->form_validation->run() == FALSE)
        {
		$data = array();
		$this->_data['title'] = '添加子项目';
		$this->_data['ServerName'] = $ServerName;
		$this->_data['server_project'] = $server_project;
		$this->_data['platform_id'] = $platform_id;
		$this->_data['server_env'] = $server_env;
		$this->_data['alias_name'] = $alias_name;
		$this->_data['cn_alias_name'] = $cn_alias_name;
		$this->_data['ops_docker_deploy'] = $ops_docker_deploy;
		$this->_data['ops_repo_type'] = $ops_repo_type;
		$this->_data['ops_repo_url'] = $ops_repo_url;
		$this->_data['ops_war_name'] = $ops_war_name;
		$this->_data['server_type'] = $server_type;
		$this->load->view('admin/project_jenkins',$this->_data);
		}
		else
		{
			if ($server_type == "jetty") {
				$server_bin_start = "bin/jetty.sh";
				$server_bin_stop = "bin/jetty.sh";
			}
			else{
				$server_bin_start = "";
				$server_bin_stop = "";
			}
			$dubbo_port = $this->input->post('dubbo_port');	
			$server = $this->input->post('server');
			$port_id = $this->project_model->search_port_id($ServerName);
			if ($port_id == NULL) {
				$http_port = $this->input->post('http_port');
				$data1 = [
					'server_env' => $server_env2,
					'server_name' => $ServerName,
					'server_alias_name' => $cn_alias_name,
					'server_type' => $server_type,
					'server_project' => $server_project2,
					'server_deploy_path' => "/home/www/xkeshi/".$ServerName,
					'server_logs_path' => "/home/".$server_type."_logs/".$ServerName,
					'server_deploy_ip' => $server,
					'server_bin_start' => $server_bin_start,
					'server_bin_stop' => $server_bin_stop,
					'server_deploy_port' => $http_port,
					'server_status' => '2'
				];
				$result1 = $this->project_model->insert_app_server($data1);
				$data2 = [
					'ops_server_name' => $ServerName,
					'ops_docker_deploy' => $ops_docker_deploy,
					'ops_repo_type' => $ops_repo_type,
					'ops_repo_url' => $ops_repo_url,
					'ops_war_name' => $ops_war_name,
					'ops_port' => $http_port,
					'ops_dubbo_port' => $dubbo_port
				];
				$result2 = $this->project_model->insert_jenkins($data2);           
			} else {
				$http_port = $this->project_model->search_port($port_id);
				$data1 = [
					'server_env' => $server_env2,
					'server_name' => $ServerName,
					'server_alias_name' => $cn_alias_name,
					'server_type' => $server_type,
					'server_project' => $server_project2,
					'server_deploy_path' => "/home/www/xkeshi/".$ServerName,
					'server_logs_path' => "/home/".$server_type."_logs/".$ServerName,
					'server_deploy_ip' => $server,
					'server_bin_start' => $server_bin_start,
					'server_bin_stop' => $server_bin_stop,
					'server_deploy_port' => $http_port,
					'server_status' => '2'
				];
				$result2 = $this->project_model->insert_app_server($data1);
			}              			
			if ($result2) {
				$this->project_model->Email_to_ops($name,$ServerName,$cn_alias_name,$server_type,$server_env2,$server,$http_port);
				redirect('admin/project/show_result?server_env='.$server_env2.'&ServerName='.$ServerName.'&alias_name='.$cn_alias_name.'&server_type='.$server_type.'&server='.$server.'&port='.$http_port);
			}
		}
	}

	//添加jenkins成功展示页面
	 public function show_result()
	 {
		$data = array();
		$this->_data['title'] = '项目添加结果';
		$this->load->view('admin/project_jenkins_show',$this->_data);
		
	 }

	public function jenkins_copy()
	{
		$user_id = $this->session->userdata('admin_id');
		$name = $this->project_model->get_name_by_id($user_id);
		$this->form_validation->set_rules('server', 'server','required');
	    $server_name = $this->input->get('server_name');
	    $server_project = $this->project_model->get_project_by_server_name($server_name);
		$platform_id = $this->project_model->get_platform_by_project($server_project);
		$server_env = $this->project_model->get_env_by_server_name($server_name);
		$server = $this->input->post('server');
		$jenkins = $this->input->post('jenkins');

		if ($this->form_validation->run() == FALSE)
        {
		$data = array();
		$this->_data['title'] = '添加子项目';
		$this->_data['server_name'] = $server_name;
		$this->_data['platform_id'] = $platform_id;
		$this->_data['server_env'] = $server_env;
		$this->_data['server'] = $server;
		$this->_data['jenkins'] = $jenkins;
		$this->load->view('admin/project_jenkins_copy',$this->_data);
		}
		else
		{
			$copy = $this->project_model->get_jenkins_copy_by_server_name($jenkins);		
			$temp_arrayName = $copy[0];
			$arrayName = $this->project_model->object_to_array($temp_arrayName);
			$default = [
				'server_name' => $jenkins,
				'server_deploy_ip' => $server,
				'server_status' => '2'
			];
			$data = array_merge($arrayName, $default);
			$result = $this->project_model->insert_app_server($data);           			
			if ($result) {
				$this->project_model->Email_to_ops($name,$jenkins,$copy[0]->server_alias_name,$copy[0]->server_type,$copy[0]->server_env,$server,$copy[0]->server_deploy_port);
				redirect('admin/project/show_result?server_env='.$copy[0]->server_env.'&ServerName='.$jenkins.'&alias_name='.$copy[0]->server_alias_name.'&server_type='.$copy[0]->server_type.'&server='.$server.'&port='.$copy[0]->server_deploy_port);
			}
		}
	}
}
