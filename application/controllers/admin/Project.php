<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','typography'));
		$this->load->helper(array('form', 'url', 'cookie'));
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
			$this->_data['title'] = '添加展示信息';
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
			$result = $this->db->query("UPDATE ops_project SET platform_id = '".$category."',dev_url = '".$dev_url."',test_url = '".$test_url."',pre_url = '".$pre_url."',product_url = '".$product_url."',user_id = '".$user_id."',name = '".$name."' WHERE id = '".$id."'");	
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
		$query = $this->db->query("select id,server_name,server_type,server_alias_name,server_status,server_deploy_ip,group_concat(CONCAT(server_deploy_ip,':',server_deploy_port))as ip_repeat from ops_app_server".$container_sql_where."  group by server_name order by id desc");
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
		foreach ($containers as $key => $value) {
			$upstream_name = $value->server_name;
			$ip_servers = explode(",",$value->ip_repeat);
			$nginx_conf_upstream .= $this->project_model->add_nginx_conf_upstream($upstream_name, $ip_servers);
			$nginx_conf_server .= $this->project_model->add_nginx_conf_server($value->server_name);			
		}
		$nginx_conf_upstream_tmp1 = $this->project_model->add_nginx_conf_tmp1();
		$nginx_conf_upstream_tmp2 = $this->project_model->add_nginx_conf_tmp2();
		//$nginx_conf_upstream = $this->typography->nl2br_except_pre($nginx_conf_upstream);
		$this->_data['nginx_conf_upstream'] = $nginx_conf_upstream;
		$this->_data['nginx_conf_server'] = $nginx_conf_server;
		$this->_data['nginx_conf_upstream_tmp1'] = $nginx_conf_upstream_tmp1;
		$this->_data['nginx_conf_upstream_tmp2'] = $nginx_conf_upstream_tmp2;
		$this->_data['server_env'] = $server_env;
		$this->_data['server_project'] = $server_project;		
		$this->_data['containers'] = $containers;
		$this->load->view('admin/project_container_nginx',$this->_data);
	}
}
