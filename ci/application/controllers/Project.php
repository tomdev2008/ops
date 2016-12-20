<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends Public_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','email','session'));
		$this->load->helper(array('form','url'));
		$this->load->model('project_model');
		$this->load->model('container_model');
	}

	public function index()
	{
		$data = array();
		$this->_data['title'] = '项目列表';
		$query = $this->db->query('select * from ops_platform');
		$data_platform = $query->result();
		$this->_data['platform'] = $data_platform;
		
		foreach ($data_platform as $value) {
			$query = $this->db->query("select * from ops_project where platform_id='$value->id'");
			$data_project = $query->result();

			foreach ($data_project as $key => $value_user) {
				$query_user = $this->db->query("select * from ops_user where id='$value_user->user_id'");
				$data_user =  $query_user->row_array();
				$data_project[$key]->username = $data_user['name'];
				$data_project[$key]->username_room = $data_user['room'];
			}
			$this->_data['platform_'.$value->id.''] = $data_project;
		}

		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/project',$this->_data);
		$this->load->view('default/footer');
	}
	public function add()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->database();
		$this->form_validation->set_rules('server_env', 'server_env','required');
		$this->form_validation->set_rules('server_env_name', 'server_env_name','required');
		$this->form_validation->set_rules('server_type_name', 'server_type_name','required');
		$this->form_validation->set_rules('server_name', 'server_name','required');
		$this->form_validation->set_rules('alias_name', 'alias_name','required');
		$this->form_validation->set_rules('server_type', 'server_type','required');
		// $server = $this->input->post('server');
		// $port = $this->input->post('port');
		$server_env = $this->input->post('server_env');
		$server_env_name = $this->input->post('server_env_name');
		$server_type_name = $this->input->post('server_type_name');
		$server_name = $this->input->post('server_name');
		$server_contents = $this->input->post('server_contents');
		if ($server_contents != NULL) {
			$ServerName = $server_env_name."-".$server_type_name."-".$server_name."-".$server_contents;
		}
		else if ($server_contents == NULL) {
			$ServerName = $server_env_name."-".$server_type_name."-".$server_name;
		}
		$alias_name = $this->input->post('alias_name');
		$server_type = $this->input->post('server_type');
		$server_project = $this->input->post('server_project');
		$project_name = $this->input->post('project_name');
		$platform_id = $this->input->post('platform_id');
		if ($this->form_validation->run() == FALSE)
        {
		$data = array();
		$this->_data['title'] = '添加子项目';
		// $this->load->view('default/header',$this->_data_header);
		$this->load->view('default/project_add',$this->_data);
		// $this->load->view('default/footer');
		}
		else
		{
			redirect('/project/add_project?server_env='.$server_env.'&ServerName='.$ServerName.'&alias_name='.$alias_name.'&server_type='.$server_type.'&server_project='.$server_project.'&project_name='.$project_name.'&platform_id='.$platform_id);
		}
	}
	public function add_project(){
		$user_id = $this->session->userdata('u_id');
		$name = $this->project_model->get_name_by_id($user_id);
		$this->form_validation->set_rules('server', 'server','required');
		$this->form_validation->set_rules('port', 'port','required');
		$server = $this->input->post('server');
		$port = $this->input->post('port');
		$server_env = $this->input->post('server_env');
		$ServerName = $this->input->post('ServerName');
		$alias_name = $this->input->post('alias_name');
		$server_type = $this->input->post('server_type');
		$server_project = $this->input->post('server_project');
		$project_name = $this->input->post('project_name');
		// $this->_data['ip'] = $this->project_model->get_ServerName_by_ServerEnv($server_env);
		if ($this->form_validation->run() == FALSE)
        {
		$data = array();
		$this->_data['title'] = '添加子项目';
		$this->load->view('default/project_add_server',$this->_data);
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
			$data = [
				'server_env' => $server_env,
				'server_name' => $ServerName,
				'server_alias_name' => $alias_name,
				'server_type' => $server_type,
				'server_project' => $server_project,
				'server_deploy_path' => "/home/www/xkeshi/".$ServerName,
				'server_logs_path' => "/home/".$server_type."_logs/".$ServerName,
				'server_deploy_ip' => $server,
				'server_bin_start' => $server_bin_start,
				'server_bin_stop' => $server_bin_stop,
				'server_deploy_port' => $port,
				'server_status' => '2'
			];
			$result = $this->project_model->insert_project($data);
			if ($result) {
				$this->project_model->Email_to_ops($name,$ServerName,$alias_name,$server_type,$server_env,$server,$port);
				redirect('/project/show_result?server_env='.$server_env.'&ServerName='.$ServerName.'&alias_name='.$alias_name.'&server_type='.$server_type.'&server='.$server.'&port='.$port);
				// echo "<script>
				// 	alert('项目添加成功');
				// 	parent.window.location.reload();
    //      			var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    //      			parent.layer.close(index);
				// 	</script>";
			}
		}
	}
	 public function show_result()
	 {
	 	$server = $this->input->get('server');
		$port = $this->input->get('port');
		$server_env = $this->input->get('server_env');
		$ServerName = $this->input->get('ServerName');
		$alias_name = $this->input->get('alias_name');
		$server_type = $this->input->get('server_type');
		// $server_project = $this->input->post('server_project');
		// $project_name = $this->input->post('project_name');
		$data = array();
		$this->_data['title'] = '项目添加结果';
		$this->load->view('default/project_show',$this->_data);
	 }

	public function container() 
	{
		// $query = $this->db->query('select * from ops_project_env');
		// $data_env = $query->result();
		// $this->_data['env'] = $data_env;
		// $this->_data['title'] = '容器列表';
		// foreach ($data_env as $value) {
		// 	$query = $this->db->query("select * from ops_project where platform_id='$value->id'");
		// 	$data_container = $query->result();
		// 	$this->_data['env_'.$value->id.''] = $data_container;
		// }
		$pid_id = $this->input->get('pid', TRUE);
		if ($pid_id == NULL) {
			$query = $this->db->query('select * from ops_project');
			$data_container = $query->result();
			$flag = 0;
		} else {
			$sql = "SELECT * FROM ops_project WHERE id = ? ";
			$query = $this->db->query($sql, array($pid_id));	
			$data_container = $query->result();
			$flag = 1;
		}
		foreach ($data_container as $key => $value) {
			$ip_environment = [
                    [	
                    	"server_env" => "1"
                    ],

                    [
                    	"server_env" => "2"
                    ],

                    [
                    	"server_env" => "3"
                    ],

                    [
                    	"server_env" => "4"
                    ]
        	];
        	foreach ($ip_environment as $key => $ip_server) {
        		$app_server = 'app_server_'.$value->id.'_'.$ip_server['server_env'];
        		$this->_data[''.$app_server.''] = $this->container_model->get_app_server_by_env_pro($value->id, $ip_server['server_env']);
        		/*if ($value->$ip_server['jetty_ip']) {
        				$value->$ip_server['jetty_ip'] = $this->container_model->get_alias_by_ipv2($value->$ip_server['jetty_ip']);
        		}*/
			}
		}
		$this->_data['container'] = $data_container;
		$this->_data['flag'] = $flag;
		$this->_data['pid_id'] = $pid_id;
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/project_container',$this->_data);
		$this->load->view('default/footer');
	}
}