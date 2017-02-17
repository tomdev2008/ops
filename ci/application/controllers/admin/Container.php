<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Container extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/container_model');
		
	}
	public function index()
	{
		$data = array();
		$this->_data['title'] = '容器列表';
		$container_env = $this->input->get('container_env', TRUE);
		$container_sql_where = $container_env ? " WHERE server_env = '".$container_env."'" : "";
		$query = $this->db->query("select * from ops_app_server".$container_sql_where." order by id desc");
		$containers = $query->result();
		$query = $this->db->query("select * from ops_project_env");
		$server_env = $query->result();

		$this->_data['server_env'] = $server_env;		
		$this->_data['containers'] = $containers;
		$this->load->view('admin/header');
		$this->load->view('admin/container',$this->_data);
		$this->load->view('admin/footer');
	}
	public function domain()
	{
		$this->form_validation->set_rules('app_domain', 'app_domain','required');
		$id = $this->input->get('id');
		$hidden_app_name = $this->container_model->get_app_name_by_id($id);
		$app_name = $this->input->post('app_name');		
		$app_domain_alias = $this->input->post('app_domain_alias');
		$hidden_app_domain = $this->container_model->get_app_domain_by_name($hidden_app_name);
		$hidden_server_project = $this->container_model->get_server_project_by_name($hidden_app_name);
		$hidden_server_env = $this->container_model->get_server_env_by_name($hidden_app_name);
		switch ($hidden_server_env) {
			case '1':
				$hidden_app_url = $this->container_model->get_dev_url($hidden_server_project);
				$temp_app_name = $this->container_model->get_temp_app_domain_by_dev($hidden_app_name);
				if (empty($temp_app_name)) {
					$temp_hidden_app_name = $hidden_app_name;
				} else {
					$temp_hidden_app_name = $temp_app_name;
				}
				break;
			case '2':
				$hidden_app_url = $this->container_model->get_test_url($hidden_server_project);
				$temp_app_name = $this->container_model->get_temp_app_domain_by_test($hidden_app_name);
				if (empty($temp_app_name)) {
					$temp_hidden_app_name = $hidden_app_name;
				} else {
					$temp_hidden_app_name = $temp_app_name;
				}
				break;
			case '3':
				$hidden_app_url = $this->container_model->get_pre_url($hidden_server_project);
				$temp_app_name = $this->container_model->get_temp_app_domain_by_pre($hidden_app_name);
				if (empty($temp_app_name)) {
					$temp_hidden_app_name = $hidden_app_name;
				} else {
					$temp_hidden_app_name = $temp_app_name;
				}
				break;
			case '4':
				$hidden_app_url = $this->container_model->get_product_url($hidden_server_project);
				$temp_app_name = $this->container_model->get_temp_app_domain_by_pro($hidden_app_name);
				if (empty($temp_app_name)) {
					$temp_hidden_app_name = $hidden_app_name;
				} else {
					$temp_hidden_app_name = $temp_app_name;
				}
				break;			
			default:
				$hidden_app_url = '没有这个值！';	
				break;
		}		
		$app_domain = $temp_hidden_app_name.'.'.$hidden_app_url;
		// echo $hidden_app_domain;
		// exit();
		$this->_data['hidden_app_name'] = $hidden_app_name;
		$this->_data['hidden_app_domain'] = $hidden_app_domain;
		$this->_data['app_domain'] = $app_domain;
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '绑定域名';
			$this->_data['app_name'] = $app_name;
			$this->_data['app_domain'] = $app_domain;
			$this->load->view('admin/container_domain',$this->_data);
        }
        else
        {
        		$app_domain = $this->input->post('app_domain');
		 		$data =[
				    'app_name' => $app_name,
				    'app_domain' => $app_domain,
				    'app_domain_alias' => $app_domain_alias
				];       	
				$result = $this->container_model->insert_domain($data); 
				if ($result) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
         			parent.layer.close(index);  	
					</script>";
				}				
	    }
	}

	public function jenkins()
	{
		$this->form_validation->set_rules('server_name', 'server_name','required');
		$id = $this->input->get('id');
		$hidden_server_name = $this->container_model->get_app_name_by_id($id);
		$hidden_repo_type = $this->container_model->get_repo_type_by_name($hidden_server_name);
		$hidden_repo_url = $this->container_model->get_repo_url_by_name($hidden_server_name);	
		$hidden_ops_war_name = $this->container_model->get_war_name_by_name($hidden_server_name);	
		$hidden_ops_dubbo_port = $this->container_model->get_dubbo_port_by_name($hidden_server_name);

		$hidden_server_alias_name = $this->container_model->get_server_alias_name_by_id($id);
		$hidden_server_type = $this->container_model->get_server_type_by_id($id);
		$hidden_server_deploy_path = $this->container_model->get_server_deploy_path_by_id($id);
		$hidden_server_bin_start = $this->container_model->get_server_bin_start_by_id($id);
		$hidden_server_bin_stop = $this->container_model->get_server_bin_stop_by_id($id);
		$hidden_app_logs_path = $this->container_model->get_app_logs_path_by_id($id);
		$hidden_server_logs_path = $this->container_model->get_server_logs_path_by_id($id);
		$this->_data['hidden_server_name'] = $hidden_server_name;
		$this->_data['hidden_repo_type'] = $hidden_repo_type;
		$this->_data['hidden_repo_url'] = $hidden_repo_url;
		$this->_data['hidden_ops_war_name'] = $hidden_ops_war_name;
		$this->_data['hidden_ops_dubbo_port'] = $hidden_ops_dubbo_port;

		$this->_data['hidden_server_alias_name'] = $hidden_server_alias_name;
		$this->_data['hidden_server_type'] = $hidden_server_type;
		$this->_data['hidden_server_deploy_path'] = $hidden_server_deploy_path;
		$this->_data['hidden_server_bin_start'] = $hidden_server_bin_start;
		$this->_data['hidden_server_bin_stop'] = $hidden_server_bin_stop;
		$this->_data['hidden_app_logs_path'] = $hidden_app_logs_path;
		$this->_data['hidden_server_logs_path'] = $hidden_server_logs_path;
		if ($this->form_validation->run() == FALSE){
			$data = array();
			$this->_data['title'] = 'APP详情';
			$this->_data['hidden_server_name'] = $hidden_server_name;
			$this->_data['hidden_repo_type'] = $hidden_repo_type;
			$this->_data['hidden_repo_url'] = $hidden_repo_url;
			$this->_data['hidden_ops_war_name'] = $hidden_ops_war_name;
			$this->_data['hidden_ops_dubbo_port'] = $hidden_ops_dubbo_port;
			$this->load->view('admin/container_jenkins',$this->_data);
	       }
	    else
	       {
	        	$server_name = $this->input->post('server_name');
	        	$repo_type = $this->input->post('repo_type');
	        	$repo_url = $this->input->post('repo_url');
	        	$ops_war_name = $this->input->post('ops_war_name');
	        	$ops_dubbo_port = $this->input->post('ops_dubbo_port');
	       		$app_logs_path = $this->input->post('app_logs_path');
	        	$add_log_path = $this->input->post('add_log_path');
	        	$server_id = $this->container_model->get_server_id_by_name($server_name);
	        	$server_logs_path = $this->container_model->get_server_logs_path_by_name($server_name);
	        	if ($add_log_path != NULL) {
	        		$data2 =[
						'server_logs_path' =>$server_logs_path.','.$add_log_path,
						'app_logs_path' =>$app_logs_path
					];  	 
					$result2 = $this->container_model->update_app_server($data2,$server_name);    
					if ($result2) {
									$data =[
											'ops_server_name' => $server_name,
											'ops_repo_type' => $repo_type,
											'ops_repo_url' => $repo_url,
											'ops_war_name' => $ops_war_name,
											'ops_dubbo_port' => $ops_dubbo_port
											];       	
										$result = $this->container_model->insert_jenkins($data,$server_id); 
										if ($result) {
												echo "<script>
												parent.window.location.reload();
							         			var index = parent.layer.getFrameIndex(jenkins.name); //获取窗口索引
							         			parent.layer.close(index);  	
												</script>";
											}
					   		} else {
					   			echo '修改失败';
					   		}
					   		   		
	        	} else {	 
	        	$data2 =[
						'app_logs_path' =>$app_logs_path
					];  	 
				$result2 = $this->container_model->update_app_server($data2,$server_name);        	       	
			 	$data =[
					'ops_server_name' => $server_name,
					'ops_repo_type' => $repo_type,
					'ops_repo_url' => $repo_url,
					'ops_war_name' => $ops_war_name,
					'ops_dubbo_port' => $ops_dubbo_port
					];       	
				$result = $this->container_model->insert_jenkins($data,$server_id); 
				if ($result2 AND $result) {
						echo "<script>
						parent.window.location.reload();
	         			var index = parent.layer.getFrameIndex(jenkins.name); //获取窗口索引
	         			parent.layer.close(index);  	
						</script>";
					}	
				}			
		    } 		
	}
	public function add()
	{

	}

	public function update()
	{

	}

}
