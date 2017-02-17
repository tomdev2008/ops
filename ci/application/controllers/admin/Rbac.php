<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rbac extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/rbac_model');
		
	}
	public function index()
	{
		$users_level = $this->rbac_model->get_user_level_list();
		$this->_data['users_level'] = $users_level;
		$level_id = $this->input->get('level_id', TRUE);
		$this->_data['users'] = $this->rbac_model->get_user_by_level_id($level_id);//在职人员名单(按组长和id降序)
		$this->_data['users_all'] = $this->rbac_model->get_users_desc();//全部人员名单(按id降序)
		$this->_data['users_dimission'] = $this->rbac_model->get_user_dimission();//离职人员名单
		$this->_data['title'] = '员工列表';
		$this->load->view('admin/header');
		$this->load->view('admin/rbac',$this->_data);
		$this->load->view('admin/footer');
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'name','required');
		$user_id = $this->input->get('user_id', TRUE);
		$name = $this->rbac_model->get_name_by_id($user_id);
		$level_id = $this->rbac_model->get_level_id_by_id($user_id);
		$email = $this->rbac_model->get_email_by_id($user_id);
		$disconfig = $this->rbac_model->get_disconfig_by_id($user_id);
		$db = $this->rbac_model->get_db_by_id($user_id);
		$role_id = $this->rbac_model->get_role_by_id($user_id);	
		$this->_data['user_id'] = $user_id;
		$this->_data['name'] = $name;
		$this->_data['level_id'] = $level_id;
		$this->_data['email'] = $email;
		$this->_data['disconfig'] = $disconfig;
		$this->_data['db'] = $db;		
		$this->_data['role_id'] = $role_id;
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['user_id'] = $user_id;
			$this->_data['name'] = $name;
			$this->_data['level_id'] = $level_id;
			$this->_data['email'] = $email;
			$this->_data['disconfig'] = $disconfig;	
			$this->_data['db'] = $db;		
			$this->_data['role_id'] = $role_id;
			$this->_data['user_level_list'] = $this->rbac_model->get_user_level_list();
			$this->_data['user_role_list'] = $this->rbac_model->get_user_role_list();
			$this->load->view('admin/rbac_update',$this->_data);
        }
        else
        {	
        	$user_id = $this->input->post('user_id', TRUE);	
        	$disconfig = $this->input->post('disconfig', TRUE);
        	$db = $this->input->post('db', TRUE);    	
        	$role_id = $this->input->post('role_id',TRUE);
        	if ($disconfig == NULL) {
        		$disconfig = 0;
        	}
        	if ($db == NULL) {
        		$db = 0;
        	}
			$data1 = [
				'user_id' => $user_id,
				'power_type' => '2',
				'power_id' => '26',
				'power_status' => $disconfig
			];
			$data2 = [
				'user_id' => $user_id,
				'power_type' => '2',
				'power_id' => '27',
				'power_status' => $db
			];
			$finder_disconfig = $this->rbac_model->jundge_disconfig_by_user_id($user_id);
			$finder_db = $this->rbac_model->jundge_db_by_user_id($user_id);
			if ($finder_disconfig != NULL AND $finder_db != NULL) {
				//$result = $this->db->update('ops_user_action', $data,array('user_id' => $user_id));
				$result1 = $this->db->query("UPDATE ops_user_action SET power_status = '".$disconfig."' WHERE user_id = '".$user_id."' AND power_id = '26'");
				$result2 = $this->db->query("UPDATE ops_user_action SET power_status = '".$db."' WHERE user_id = '".$user_id."' AND power_id = '27'");
				$result3 = $this->db->query("UPDATE ops_user SET role_id = '".$role_id."' WHERE id = '".$user_id."'");
			} else {
				$new_data1 = [
					'user_id' => $user_id,
					'power_type' => '2',
					'power_id' => '26',
					'power_status' => $disconfig
				];
				$new_data2 = [
					'user_id' => $user_id,
					'power_type' => '2',
					'power_id' => '27',
					'power_status' => $db
				];
				$result1 = $this->db->insert('ops_user_action',$new_data1);
				$result2 = $this->db->insert('ops_user_action',$new_data2);
				$result3 = $this->db->query("UPDATE ops_user SET role_id = '".$role_id."' WHERE id = '".$user_id."'");
			}
			if ($result1 AND $result2 AND $result3) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(rbac.name); //获取窗口索引
         			parent.layer.close(index);  	
					</script>";
        		}
        }	
	}
	public function role()
	{
		$users_level = $this->rbac_model->get_user_level_list();
		$this->_data['users_level'] = $users_level;
		$this->_data['front_power_all'] = $this->rbac_model->get_front_power_list();
		$this->_data['users_dimission'] = $this->rbac_model->get_user_dimission();//离职人员名单
		$this->_data['title'] = '员工列表';
		$this->load->view('admin/header');
		$this->load->view('admin/rbac_role',$this->_data);
		$this->load->view('admin/footer');
	}	
}
