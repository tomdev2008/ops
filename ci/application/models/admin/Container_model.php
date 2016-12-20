<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Login_model class.
 * 
 * @extends CI_Model
 */
class Container_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}
	public function get_alias_by_ip($ip) {
		$query = $this->db->query("select ip_alias from ops_ip WHERE ip ='".$ip."'");
		$row = $query->row_array();
		$data = '<span class="label label-info">'.$row['ip_alias'].'</span> '.$ip;
		return $data;
	}
	public function insert_domain($data) {
		$this->db->set('opr_time', 'NOW()', false);
		$this->db->insert('ops_app_domain', $data);
		$result = $this->db->insert_id();
		return $result;
	}
	public function insert_jenkins($data,$server_id) {
		if ($server_id == NULL) {
			$result = $this->db->insert('ops_app_jenkins',$data);
		} else {
			$this->db->where('id', $server_id);
			$result = $this->db->update('ops_app_jenkins', $data);
		}
		return $result;
	}
	public function update_jenkins($data,$id) {
		$this->db->where('id', $id);
		$result = $this->db->update('ops_app_jenkins', $data);
		return $result;
	}
	public function get_app_name_by_id($id) {
		$this->db->select('server_name');
		$this->db->from('ops_app_server');
		$this->db->where('id', $id);
		$data = $this->db->get()->row('server_name');
		return $data;
	}
	public function get_server_project_by_name($app_name) {
		$this->db->select('server_project');
		$this->db->from('ops_app_server');
		$this->db->where('server_name', $app_name);
		$data = $this->db->get()->row('server_project');
		return $data;
	}	
	public function get_server_env_by_name($app_name) {
		$this->db->select('server_env');
		$this->db->from('ops_app_server');
		$this->db->where('server_name', $app_name);
		$data = $this->db->get()->row('server_env');
		return $data;
	}	
	public function get_app_domain_by_name($app_name) {
		$this->db->select('app_domain');
		$this->db->from('ops_app_domain');
		$this->db->where('app_name', $app_name);
		$data = $this->db->get()->row('app_domain');
		return $data;
	}	
	public function get_temp_app_domain_by_dev($allString) {
		$searchString = "dev-";
		$newString = strstr($allString, $searchString);
		$length = strlen($searchString);
		$data = substr($newString, $length);
		return $data;
	}	
	public function get_temp_app_domain_by_test($allString) {
		$searchString = "test-";
		$newString = strstr($allString, $searchString);
		$length = strlen($searchString);
		$data = substr($newString, $length);
		return $data;
	}
	public function get_temp_app_domain_by_pre($allString) {
		$searchString = "pre-";
		$newString = strstr($allString, $searchString);
		$length = strlen($searchString);
		$data = substr($newString, $length);
		return $data;
	}
	public function get_temp_app_domain_by_pro($allString) {
		$searchString = "product-";
		$newString = strstr($allString, $searchString);
		$length = strlen($searchString);
		$data = substr($newString, $length);
		return $data;
	}		
	public function get_dev_url($hidden_server_project) {
		$this->db->select('dev_url');
		$this->db->from('ops_project');
		$this->db->where('id', $hidden_server_project);
		$data = $this->db->get()->row('dev_url');
		return $data;
	}	
	public function get_test_url($hidden_server_project) {
		$this->db->select('test_url');
		$this->db->from('ops_project');
		$this->db->where('id', $hidden_server_project);
		$data = $this->db->get()->row('test_url');
		return $data;
	}	
	public function get_pre_url($hidden_server_project) {
		$this->db->select('pre_url');
		$this->db->from('ops_project');
		$this->db->where('id', $hidden_server_project);
		$data = $this->db->get()->row('pre_url');
		return $data;
	}	
	public function get_product_url($hidden_server_project) {
		$this->db->select('product_url');
		$this->db->from('ops_project');
		$this->db->where('id', $hidden_server_project);
		$allString = $this->db->get()->row('product_url');
		$searchString = "http://";
		$newString = strstr($allString, $searchString);
		$length = strlen($searchString);
		$tmp = substr($newString, $length);
		if (empty($tmp)) {
			$data = $newString;
		} else {
			$data = $tmp;
		}
		return $data;
	}		
	public function get_repo_url_by_name($ops_server_name) {
		$this->db->select('ops_repo_url');
		$this->db->from('ops_app_jenkins');
		$this->db->where('ops_server_name', $ops_server_name);
		$data = $this->db->get()->row('ops_repo_url');
		return $data;
	}	
	public function get_repo_type_by_name($ops_server_name) {
		$this->db->select('ops_repo_type');
		$this->db->from('ops_app_jenkins');
		$this->db->where('ops_server_name', $ops_server_name);
		$data = $this->db->get()->row('ops_repo_type');
		return $data;
	}	
	public function get_server_id_by_name($ops_server_name) {
		$this->db->select('id');
		$this->db->from('ops_app_jenkins');
		$this->db->where('ops_server_name', $ops_server_name);
		$data = $this->db->get()->row('id');
		return $data;
	}	
	public function get_war_name_by_name($ops_server_name) {
		$this->db->select('ops_war_name');
		$this->db->from('ops_app_jenkins');
		$this->db->where('ops_server_name', $ops_server_name);
		$data = $this->db->get()->row('ops_war_name');
		return $data;
	}	
	public function get_dubbo_port_by_name($ops_server_name) {
		$this->db->select('ops_dubbo_port');
		$this->db->from('ops_app_jenkins');
		$this->db->where('ops_server_name', $ops_server_name);
		$data = $this->db->get()->row('ops_dubbo_port');
		return $data;
	}	
}