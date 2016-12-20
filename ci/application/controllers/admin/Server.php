<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/server_model');
		
	}
	public function index()
	{
		$data = array();
		$hidden_server_env = $this->input->get('env', TRUE);
		$hidden_platform_id = $this->input->get('platform_id', TRUE);
		$platform_list = $this->server_model->get_platform_list();
		$project_env_list = $this->server_model->get_project_env_list();
		$servers = $this->server_model->get_servers_data_list($hidden_server_env,$hidden_platform_id);				
 		$this->_data['project_env_list'] = $project_env_list;
 		$this->_data['platform_list'] = $platform_list;
 		$this->_data['servers'] = $servers;
		$this->_data['title'] = '服务器列表';
		$this->load->view('admin/header');
		$this->load->view('admin/server',$this->_data);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('title', 'title','required');
		$this->form_validation->set_rules('env', 'env','required');
		$this->form_validation->set_rules('config', 'config','required');
		$title = $this->input->post('title');
		$pub_ip = $this->input->post('pub_ip');
		$env = $this->input->post('env');
		$ip_alias = $this->input->post('ip_alias');
		$config = $this->input->post('config');
		$type = $this->input->post('type');
		$service_no = $this->input->post('service_no');
		$ip_comments = $this->input->post('ip_comments');
		$platform_id = $this->input->post('platform_id');
		$opr_time = $this->input->post('opr_time');
		$location = $this->input->post('location');
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '添加服务器信息';
			$this->_data['location_list'] = $this->server_model->get_location_list();
			$this->_data['platform_list'] = $this->server_model->get_platform_list();
			$this->load->view('admin/header');
			$this->load->view('admin/server_add',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
		 		$data =[
				    'ip' => $title,
				    'server_env' => $env,
				    'location' =>$location,
				    'ip_alias' => $ip_alias,
				    'server_config' => $config,
				    'type' => $type,
				    'service_no' => $service_no,
				    'platform_id' => $platform_id,
				    'ip_comments' => $ip_comments,
				    'pub_ip' => $pub_ip,
				    'opr_time' => $opr_time,
				    'is_esxi' => "0"
				];       	
				$result = $this->server_model->insert_server($data);  
				if ($result) {
					redirect('admin/server');
				}				
	    }
	}
public function addesxi()
	{
		$this->form_validation->set_rules('title', 'title','required');
		$this->form_validation->set_rules('esxi_id', 'esxi_id','required');
		$this->form_validation->set_rules('env', 'env','required');
		$this->form_validation->set_rules('config', 'config','required');
		$title = $this->input->post('title');
		$esxi_id = $this->input->post('esxi_id');
		$pub_ip = $this->input->post('pub_ip');
		$env = $this->input->post('env');
		$ip_alias = $this->input->post('ip_alias');
		$config = $this->input->post('config');
		$type = $this->input->post('type');
		$service_no = $this->input->post('service_no');
		$ip_comments = $this->input->post('ip_comments');
		$platform_id = $this->input->post('platform_id');
		$opr_time = $this->input->post('opr_time');
		$location = $this->input->post('location');
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '添加虚拟服务器';
			$this->_data['esxi_list'] = $this->server_model->get_esxi_list();
			$this->_data['location_list'] = $this->server_model->get_location_list();
			$this->_data['platform_list'] = $this->server_model->get_platform_list();
			$this->load->view('admin/header');
			$this->load->view('admin/server_addesxi',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
        	if ($type == "ESXi") {
        		$esxi_version = "6.0";
        	}else {
        		$esxi_version = NULL;
        	}
		 		$data =[
				    'ip' => $title,
				    'server_env' => $env,
				    'location' =>$location,
				    'ip_alias' => $ip_alias,
				    'server_config' => $config,
				    'type' => $type,
				    'service_no' => $service_no,
				    'platform_id' => $platform_id,
				    'ip_comments' => $ip_comments,
				    'pub_ip' => $pub_ip,
				    'opr_time' => $opr_time,
				    'esxi_version' => $esxi_version,
				    'is_esxi' => $esxi_id
				];       	
				$result = $this->server_model->insert_server($data);  
				if ($result) {
					redirect('admin/server');
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
}
