<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Disconfig_model class.
 * 
 * @extends CI_Model
 */
class Disconfig_model extends CI_Model {
	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}
	
}