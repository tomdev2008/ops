<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'cookie'));
		$this->load->model('admin/gallery_model');
		
	}
	public function index()
	{
		$data = array();
		$query = $this->db->query('select * from ops_gallery_platform');
		$data = $query->result();
		$this->_data['platform'] = $data;

		$platform_id = $this->input->get('platform_id', TRUE);

		$gallery_sql_where = $platform_id ? " WHERE gallery_platform_id = '".$platform_id."'" : "";

		$query = $this->db->query('select * from ops_gallery'.$gallery_sql_where);
		$data = $query->result();
		$this->_data['gallerys'] = $data;

		$this->_data['title'] = '常用链接列表';
		$this->load->view('admin/header');
		$this->load->view('admin/gallery',$this->_data);
		$this->load->view('admin/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('title', 'title','required');
		$this->form_validation->set_rules('category', 'category','required');
		$this->form_validation->set_rules('url', 'url','required');
		$title = $this->input->post('title');
		$category = $this->input->post('category');
		$url = $this->input->post('url');
		$user_name = $this->input->post('user_name');
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '添加展示信息';
			$this->_data['gallery_platform_list'] = $this->gallery_model->get_gallery_platform_list();
			$this->load->view('admin/header');
			$this->load->view('admin/gallery_add',$this->_data);
			$this->load->view('admin/footer');
        }
        else
        {
		 		$data =[
				    'gallery_name' => $title,
				    'gallery_platform_id' => $category,
				    'gallery_url' => $url,
				    'user_name' => $user_name
				];       	
				$result = $this->gallery_model->insert_gallery($data);  
				if ($result) {
					redirect('admin/gallery');
				}				
	    }
	}

	public function update()
	{
		$this->form_validation->set_rules('name', 'name','required');
		$this->form_validation->set_rules('url', 'url','required');
		$id = $this->input->get('id', TRUE);
		$name = $this->gallery_model->get_gallery_name_by_id($id);
		$url = $this->gallery_model->get_url_by_id($id);
		$platform_id = $this->gallery_model->get_platform_id_by_id($id);
		$user_name = $this->gallery_model->get_user_name_by_id($id);
		$get_platform_name = $this->gallery_model->get_gallery_platform_list();
		$gallery = $this->gallery_model->get_gallery_list_by_id($id);
		$this->_data['get_platform_name'] = $get_platform_name;
		$this->_data['id'] = $id;
		$this->_data['name'] = $name;
		$this->_data['url'] = $url;
		$this->_data['user_name'] = $user_name;
		$this->_data['platform_id'] = $platform_id;
		$this->_data['gallery'] = $gallery;
        if ($this->form_validation->run() == FALSE)
        {
			$data = array();
			$this->_data['title'] = '常用链接修改';
			$this->_data['id'] = $id;
			$this->_data['name'] = $name;
			$this->_data['url'] = $url;
			$this->_data['user_name'] = $user_name;
			$this->_data['platform_id'] = $platform_id;
			$this->load->view('admin/gallery_update',$this->_data);
        }
        else
        {	
        	$id = $this->input->post('id', TRUE);	
        	$name = $this->input->post('name', TRUE);
        	$url = $this->input->post('url', TRUE);
			$user_name = $this->input->post('user_name', TRUE);
			$platform_id = $this->input->post('platform_id', TRUE);
			$result = $this->db->query("UPDATE ops_gallery SET gallery_platform_id = '".$platform_id."',gallery_url = '".$url."',user_name = '".$user_name."',gallery_name = '".$name."' WHERE id = '".$id."'");	
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
		$result = $this->db->delete('ops_gallery', array('id' => $id));
		
	}
}
