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



}