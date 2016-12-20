<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disconfig extends ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation','zip'));
		$this->load->helper(array('form', 'url', 'cookie','download','date'));
		$this->load->model('admin/disconfig_model');
		$this->load->model('statistics_model');
	}
	public function index()
	{
		$data = array();
		$query = $this->db->query('select distinct app_id from ops_disconfig ');
		$data = $query->result();
		$this->_data['app'] = $data;
		$this->_data['title'] = '配置中心';
		$this->_data['get_project_name'] = $this->disconfig_model->get_project_name();
		$this->load->view('admin/header_disconf');
		$this->load->view('admin/disconfig',$this->_data);
		$this->load->view('admin/footer');
	}
	// public function view_add(){
	// 	$this->form_validation->set_rules('app', 'app','required');
	// 	$this->form_validation->set_rules('env', 'env','required');
	// 	$app = $this->input->post('app');
	// 	$env = $this->input->post('env');
	// 	if ($this->form_validation->run() == FALSE)
    //  {
	// 	    $this->_data['title'] = '配置中心';
	// 	    $this->_data['get_project_name'] = $this->statistics_model->get_project_name();
	// 	    $this->load->view('admin/header_disconf');
	// 	    $this->load->view('admin/disconfig',$this->_data);
	// 	    $this->load->view('admin/footer');
	// 	}
	// 	else{
	// 		$this->_data['version'] = $this->disconfig_model->get_version_by_appid_env($app,$env);
	// 		redirect('/disconfig?env='.$env.'&app='.$app);
	// 	}
	// }
	// public function ajax_disconfig(){
	// 	$env = $this->input->get('env', TRUE);
	// 	$app = $this->input->get('app', TRUE);
	// 	$version = $this->disconfig_model->get_version_by_appid_env($app,$env);
	// 	echo json_encode($version);
	// }
	public function ajax_project() {
		$project_id = $this->input->get('project_id', TRUE);
		$env_id = $this->input->get('env_id', TRUE);
		$server_name = $this->disconfig_model->get_name_by_project($project_id,$env_id);
		echo json_encode($server_name);
	}
	public function ajax_version(){
		$app = $this->input->get('app_id',TRUE);
		$env = $this->input->get('env',TRUE);
		$version = $this->disconfig_model->get_version_by_appid_env($app,$env);
		echo json_encode($version);
	}
	public function downloadfile($id=NULL){
		if ($id == NULL) {
			show_error("error_request",502);
		}
		else{
			$disconf = $this->disconfig_model->get_conf_data_by_id($id);
			$name = $disconf->name;
			$data = $disconf->value;
			force_download($name, $data);
		}
	}
	public function downloadzip(){
		$app = $this->input->get('app');
		$env = $this->input->get('env');
		$version = $this->input->get('version');
		$disconf = $this->disconfig_model->get_info_by_app_env_version($app,$env,$version);
		$zip_data = array(
				$value->name => $value->value
			);
		$zip_data = array();
		foreach ($disconf as $value ) {
			$zip_data[$value->name] = $value->value;
		}
		@$this->zip->add_data($zip_data);
		$this->zip->archive('/tmp/'.$app.'_disconfig.zip');
		switch ($env) {
			case 1:
				$env = "dev";
				break;
			case 2:
				$env = "test";
				break;
			case 3:
				$env = "pre";
				break;
			case 4:
				$env = "online";
				break;
			case 5:
				$env = "local";
				break;
			case 6:
				$env = "autoprepub";
				break;
			default:
				$env = "";
				break;
		}
		$this->zip->download('APP'.$app.'_ENV'.$env.'_VERSION'.$version.'.zip');
		$this->zip->clear_data();
		// $name = $disconf->name;
		// $data = $disconf->value;
		// force_download($name, $data);
	}
	public function value($id=NULL){
		if ($id == NULL) {
			show_error("error_request",502);
		}
		else{
		$this->_data['conf_data'] = $this->disconfig_model->get_conf_data_by_id($id);
		$this->load->view('admin/disconf_value',$this->_data);
		}
	}
	public function update($id=NULL){
		if ($id == NULL) {
			show_error("error_request",502);
		}
		else{
			$this->_data['conf_data'] = $this->disconfig_model->get_conf_data_by_id($id);
			$this->load->view('admin/disconf_update',$this->_data);
		}
	}
	public function amend(){
		$this->form_validation->set_rules('text_amend', 'text_amend','required');
		$this->form_validation->set_rules('id_hidden', 'id_hidden','required');
		$this->form_validation->set_rules('env', 'env','required');
		$text_amend = $this->input->post('text_amend');
		$id_hidden = $this->input->post('id_hidden');
		$env = $this->input->post('env');
		$admin_id = $this->session->userdata('admin_id');
		$update_time = date("Y-m-d H:i:s",time());
		if ($env == '1' && $env == '2') {
			$data = [
					'value' => $text_amend,
					'update_time' => $update_time
				];
		}
		else{
			$data = [
					'value' => $text_amend,
					'redundance' => $text_amend,
					'update_time' => $update_time
				];
		}
		$amend = $this->disconfig_model->update_value($id_hidden,$data);
		if($amend){
			$this->disconfig_model->insert_admin_opearte_log_update($admin_id);
			echo "<script>
					alert('配置修改成功！');
					parent.window.location.reload();
			         var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
			         parent.layer.close(index);
				</script>";
			}
	}
	public function add_view(){
		$data = array();
      	$this->_data['get_project_name'] = $this->disconfig_model->get_project_name();
      	$this->_data['get_env'] = $this->disconfig_model->get_env();
      	$this->_data['title'] = '新增APP';
		$this->load->view('admin/disconf_add',$this->_data);
	}
	public function add(){
		$this->form_validation->set_rules('pattern', 'pattern','required');
		$this->form_validation->set_rules('project', 'project','required');
		$this->form_validation->set_rules('env', 'env','required');
		$this->form_validation->set_rules('version', 'version','required');
		$this->form_validation->set_rules('version_custom', 'version_custom','required');
		$this->form_validation->set_rules('filename', 'filename','required');
		$this->form_validation->set_rules('text', 'text','required');
		$pattern = trim($this->input->post('pattern'));
		$project = trim($this->input->post('project'));
		$env = trim($this->input->post('env'));
		$version = trim($this->input->post('version'));
		$version_custom = trim($this->input->post('version_custom'));
		$filename = trim($this->input->post('filename'));
		$text = trim($this->input->post('text'));
		$n = 0;
		if ($pattern == "uploadfile") {
			if ($_FILES["inputfile"]["error"] > 0){
			  	echo "Error: " . $_FILES["inputfile"]["error"]."<br />";//由文件上传导致的错误代码
			}
			else{
				// echo "Upload: " . $_FILES["inputfile"]["name"] . "<br />";//上传文件名字
				// echo "Type: " . $_FILES["inputfile"]["type"] . "<br />";//上传文件类型
				// echo "Size: " . ($_FILES["inputfile"]["size"] / 1024) . " Kb<br />";//上传文件大小
				// echo "Stored in: " . $_FILES["inputfile"]["tmp_name"];//存储在服务器的文件的临时副本的名称
				$file = fopen($_FILES["inputfile"]["tmp_name"],"r") or exit("Unable to open file!");//Output a line of the file until the end is reached
				while(!feof($file)){
				    $line= fgets($file);
				    @$file_value = $file_value.$line;
				}
				if ($version == "version_custom") {
					$disconfig_name = $this->disconfig_model->get_info_by_app_env_version($project,$env,$version_custom);
					$data = [
						'app_id' => $project,
						'env_id' => $env,
						'version' => $version_custom,
						'name' => $_FILES["inputfile"]["name"],
						'value' => $file_value
					];
				}
				else{
					$disconfig_name = $this->disconfig_model->get_info_by_app_env_version($project,$env,$version);
					$data = [
					    'app_id' => $project,
					    'env_id' => $env,
					    'version' => $version,
					    'name' => $_FILES["inputfile"]["name"],
						'value' => $file_value
					];
				}
				foreach ($disconfig_name as $value) {
					if ($value->name == $_FILES["inputfile"]["name"]) {
						$n = 1;
					}
				}
				if ($n == 0) {
					$inputresult = $this->disconfig_model->insert_disconfig($data);
					if ($inputresult) {
						echo "<script>
							alert('配置上传成功！');
							parent.window.location.reload();
			         		var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
			         		parent.layer.close(index);
						  </script>";
					}
				}
				else if($n == 1){
					echo "<script>
							alert('配置添加失败，文件名重复！');
							history.go(-1);
						  </script>";
				}
				fclose($file);
			}
		}
		else if ($pattern == "inputtextarea") {
			if ($version == "version_custom") {
				$disconfig_name = $this->disconfig_model->get_info_by_app_env_version($project,$env,$version_custom);
				$data = [
				    'app_id' => $project,
				    'env_id' => $env,
				    'version' => $version_custom,
				    'name' => $filename,
				    'value' => $text
				];
			}
			else{
				$disconfig_name = $this->disconfig_model->get_info_by_app_env_version($project,$env,$version);
				$data = [
				    'app_id' => $project,
				    'env_id' => $env,
				    'version' => $version,
				    'name' => $filename,
				    'value' => $text
				];
			}
			foreach ($disconfig_name as $value) {
				if ($value->name == $filename) {
					$n = 1;
				}
			}
			if ($n == 0) {
				$result = $this->disconfig_model->insert_disconfig($data);
				if($result){
					echo "<script>
							alert('配置添加成功！');
							parent.window.location.reload();
			         		var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
			         		parent.layer.close(index);
						  </script>";
				}
			}
			else if($n == 1){
				echo "<script>
							alert('配置添加失败，文件名重复！');
							history.go(-1);
							location.reload();
					  </script>";
			}
		}
	}
	public function delete(){
		$username = $this->session->userdata('adminname');
		$admin_id = $this->session->userdata('admin_id');
		$pwd = $this->input->get('pwd', TRUE);
		$id = $this->input->get('id', TRUE);
		$conf_data = $this->disconfig_model->get_conf_data_by_id($id);
		$res = $this->disconfig_model->search_user_by_ldap($username,$pwd);
		if ($res) {
			$del = $this->disconfig_model->delete_disconf($id);
			if ($del) {
				$this->disconfig_model->insert_admin_opearte_log_del($admin_id);
				echo $conf_data->name;
			}
			else{
				echo "error_del";
			}
		}
		else{
			echo "error_pwd";
		}
		
	}
	public function copy(){
		$app = $this->input->get('app',TRUE);
		$env = $this->input->get('env',TRUE);
		$version = $this->input->get('version',TRUE);
		$disconfig_info = $this->disconfig_model->get_info_by_app_env_version($app,$env,$version);
		$res = 1;
		foreach ($disconfig_info as $value) {
			$data = [
				'name' => $value->name,
				'value' => $value->value,
				'app_id' => $value->app_id,
				'version' => $value->version."_copy",
				'env_id' => $value->env_id,
				'sensitive_status' => $value->sensitive_status
			];
			$result = $this->disconfig_model->insert_disconfig($data);
			if (!$result) {
				$res = 0;
			}
		}
		// $result = $this->disconfig_model->insert_disconfig_batch($data);
		if ($res == 1) {
			echo $version;
			// echo "<script>
			// 		location.href='".$_SERVER["HTTP_REFERER"]."';
			// 	</script>";
		}
	}
	public function copy_to_other_env(){
		$this->load->helper('form');
    	$this->load->library('form_validation');
		$this->form_validation->set_rules('env', 'env','required');
		if ($this->form_validation->run() == FALSE){
			$data = array();
      		$this->_data['title'] = '修改配置版本';
			$this->load->view('admin/disconf_copy',$this->_data);
		}
		else{
			$this->form_validation->set_rules('env_old', 'env_old','required');
			$this->form_validation->set_rules('version', 'version','required');
			$this->form_validation->set_rules('app', 'app','required');
			$app_post = $this->input->post('app');
			$env_post = $this->input->post('env');
			$version_post = $this->input->post('version');
			$env_old = $this->input->post('env_old');
			$disconfig_info = $this->disconfig_model->get_info_by_app_env_version($app_post,$env_old,$version_post);
			$env_vaule = [
				1 => "dev",
				2 => "test",
				3 => "pre",
				4 => "product"
			];
			$app_change = explode($env_vaule[$env_old], $app_post);
			$judge = $this->disconfig_model->get_by_server_name($env_vaule[$env_post].$app_change[1]);
			if ($judge == "") {
				echo "<script>
						alert('版本复制失败，请先添加相应的子项目！！');
						parent.window.location.reload();
			         	var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
			         	parent.layer.close(index);
						location.href='".$_SERVER["HTTP_REFERER"]."';
					</script>";
				exit();
			}
			$res = 1;
			foreach ($disconfig_info as $value) {
				$data = [
					'name' => $value->name,
					'value' => $value->value,
					'app_id' => $env_vaule[$env_post].$app_change[1],
					'version' => $value->version,
					'env_id' => $env_post,
					'sensitive_status' => $value->sensitive_status
				];
				$result = $this->disconfig_model->insert_disconfig($data);
				if (!$result) {
					$res = 0;
				}
			}
			if ($res == 1) {
				echo "<script>
						alert('版本复制成功！！');
						parent.window.location.reload();
			         	var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
			         	parent.layer.close(index);
						location.href='".$_SERVER["HTTP_REFERER"]."';
					</script>";
			}
		}
	}
	public function change_version(){
		$this->form_validation->set_rules('app', 'app','required');
		$this->form_validation->set_rules('env', 'env','required');
		$this->form_validation->set_rules('version', 'version','required');
		$this->form_validation->set_rules('version_new', 'version_new','required');
      	$app = $this->input->post('app');
		$env = $this->input->post('env');
		$version = $this->input->post('version');
		$version_new = $this->input->post('version_new');
		$disconfig_info = $this->disconfig_model->get_info_by_app_env_version($app,$env,$version);
		@$url = explode("&version=", $_SERVER["HTTP_REFERER"]);
	    $url_new = str_replace('/change_version', '', $url[0]);
		if ($this->form_validation->run() == FALSE)
      	{
      		$data = array();
      		$this->_data['title'] = '修改配置版本';
			$this->load->view('admin/disconf_ChangeVersion',$this->_data);
      	}
      	else{
      		$res = $this->disconfig_model->get_version_by_appid_env($app,$env);
      		$n = 1;
      		foreach ($res as $value) {
      			if ($value->version == $version_new && $version_new != $version) {
      				$n = 0;
      			}
      		}
      		if ($n == 1) {
      			foreach ($disconfig_info as $value) {
	      			$data = [
	      				'version' => $version_new
	      			];
	      			$id = $value->config_id;
	      			$result = $this->disconfig_model->change_version($id,$data);
      			}
	      		if ($result) {
					echo "<script>
						alert('版本修改成功！！');
						parent.window.location.reload();
			         	var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
			         	parent.layer.close(index);
			         	window.location.href='www.';
					</script>";
					// redirect($url_new."&version=".$version_new);
				}
				else{
					echo "<script>
						alert('版本修改失败，请重试！！');
						parent.window.location.reload();
			         	var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
			         	parent.layer.close(index);
						location.href='".$_SERVER["HTTP_REFERER"]."';
					</script>";
				}
      		}
      		else if ($n == 0) {
      			echo "<script>
						alert('版本重复，请重试！！');
						parent.window.location.reload();
			         	var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
			         	parent.layer.close(index);
						location.href='".$_SERVER["HTTP_REFERER"]."';
					</script>";
      		}
      	}
	}
	public function ajax_switch(){
		$id = $this->input->get('id', TRUE);
		$conf_data = $this->disconfig_model->get_conf_data_by_id($id);
		echo $conf_data->sensitive_status;
	}
	public function status_switch(){
		$id = $this->input->get('id', TRUE);
		$status = $this->disconfig_model->get_conf_data_by_id($id)->sensitive_status;
		if ($status == 0) {
			$data = [
				'sensitive_status' => 1
			];
		}
		else if($status == 1) {
			$data = [
				'sensitive_status' => 0
			];
		}
		$result = $this->disconfig_model->update_value($id,$data);
		$status_now = $this->disconfig_model->get_conf_data_by_id($id)->sensitive_status;
		if ($result) {
			echo $status_now;
			exit();
		}
		else{
			echo "updete_error";
		}
	}
	// public function test(){
	// 	$email = $this->disconfig_model->mac();
	// 	foreach ($email as $value) {
	// 		// $ops = $this->disconfig_model->Email_to_user($value->email,$value->name);
	// 		// if ($ops) {
	// 		// 	echo $value->email."发送成功</br>";
	// 		// }
	// 		echo $value->name." : ".$value->email."</br>";
	// 	}
	// }
}