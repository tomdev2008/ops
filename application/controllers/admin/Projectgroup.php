<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projectgroup extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/projectgroup_model');
		
	}
	public function index()
	{
		$data = array();
		$query = $this->db->query('select * from ops_platform');
		$data = $query->result();
		$this->_data['platforms'] = $data;

		$this->_data['title'] = '分组列表';
		$this->load->view('admin/header');
		$this->load->view('admin/projectgroup',$this->_data);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('title', 'title','required');
		$title = $this->input->post('title');

        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '添加项目分组';
			$this->_data['projectgroup_list'] = $this->projectgroup_model->get_projectgroup_list();
			$this->load->view('admin/header');
			$this->load->view('admin/projectgroup_add',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
		 		$data =[
				    'name' => $title
				];       	
				$result = $this->projectgroup_model->insert_projectgroup($data);  
				if ($result) {
					redirect('admin/projectgroup');
				}				
	    }
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'name','required');
		$id = $this->input->get('id', TRUE);
		$name = $this->projectgroup_model->get_name_by_id($id);
	
		$this->_data['id'] = $id;
		$this->_data['name'] = $name;

        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '项目分组修改';
			$this->_data['id'] = $id;
			$this->_data['name'] = $name;

			$this->load->view('admin/projectgroup_update',$this->_data);
        }
        else
        {	
        	$id = $this->input->post('id', TRUE);	
        	$name = $this->input->post('name', TRUE);

			$result = $this->db->query("UPDATE ops_platform SET name = '".$name."' WHERE id = '".$id."'");	
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
