<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Platform extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/platform_model');
		
	}
	public function index()
	{
		$data = array();
		$query = $this->db->query('select * from ops_gallery_platform');
		$data = $query->result();
		$this->_data['platforms'] = $data;

		$this->_data['title'] = '分组列表';
		$this->load->view('admin/header');
		$this->load->view('admin/platform',$this->_data);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('title', 'title','required');

		$title = $this->input->post('title');

        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '添加展示信息';
			$this->_data['gallery_platform_list'] = $this->platform_model->get_gallery_platform_list();
			$this->load->view('admin/header');
			$this->load->view('admin/platform_add',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
		 		$data =[
				    'gallery_name' => $title
				];       	
				$result = $this->platform_model->insert_platform($data);  
				if ($result) {
					redirect('admin/platform');
				}				
	    }
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'name','required');
		$id = $this->input->get('id', TRUE);
		$name = $this->platform_model->get_name_by_id($id);
	
		$this->_data['id'] = $id;
		$this->_data['name'] = $name;

        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '友情链接组修改';
			$this->_data['id'] = $id;
			$this->_data['name'] = $name;

			$this->load->view('admin/platform_update',$this->_data);
        }
        else
        {	
        	$id = $this->input->post('id', TRUE);	
        	$name = $this->input->post('name', TRUE);

			$result = $this->db->query("UPDATE ops_gallery_platform SET gallery_name = '".$name."' WHERE id = '".$id."'");	
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
		$result = $this->db->delete('ops_gallery_platform', array('id' => $id));
	}
}
