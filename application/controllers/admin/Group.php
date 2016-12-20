<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/group_model');
		
	}
	public function index()
	{
		$data = array();
		$query = $this->db->query('select * from ops_user_level');
		$data = $query->result();
		$this->_data['groups'] = $data;

		$this->_data['title'] = '分组列表';
		$this->load->view('admin/header');
		$this->load->view('admin/group',$this->_data);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('level_name', 'level_name','required');
		$this->form_validation->set_rules('ldap_ou', 'ldap_ou','required');
		$level_name = $this->input->post('level_name');
		$ldap_ou = $this->input->post('ldap_ou');
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '添加人员分组';
			$this->_data['user_level_list'] = $this->group_model->get_user_level_list();
			$this->load->view('admin/header');
			$this->load->view('admin/group_add',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
		 		$data =[
				    'level_name' => $level_name,
				    'ldap_ou' => $ldap_ou
				];       	
				$result = $this->group_model->insert_user_level($data);  
				if ($result) {
					redirect('admin/group');
				}				
	    }
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'name','required');
		$id = $this->input->get('id', TRUE);
		$level = $this->group_model->get_level_by_id($id);
		// $level_name = $this->group_model->get_level_by_id($id)->name;
		// $level_ldap = $this->group_model->get_level_by_id($id)->ldap;
		$this->_data['id'] = $id;
		$this->_data['level'] = $level;
		$id = $this->input->post('id');
        $name = $this->input->post('name');
        $ldap = $this->input->post('ldap');
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '友情链接组修改';
			$this->_data['id'] = $id;
			$this->_data['level'] = $level;
			$this->load->view('admin/group_update',$this->_data);
        }
        else
        {	
        	$id = $this->input->post('id');
	        $name = $this->input->post('name');
	        // $ldap = $this->input->post('ldap');
	        echo $id.$name.$ldap;
			$result = $this->db->query("UPDATE ops_user_level SET level_name = '".$name."' WHERE id = '".$id."'");	
				if ($result) {
					echo "<script>
					parent.window.location.reload();
         			var index = parent.layer.getFrameIndex(update.name); //获取窗口索引
         			parent.layer.close(index);  	
					</script>";

        }
        }	
	}

	public function delete()
	{
		$id = $this->input->get('id', TRUE);
		$result = $this->db->delete('ops_user_level', array('id' => $id));
	}
}
