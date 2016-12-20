<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Language Class extension.
 * 
 * Adds language fallback handling.
 * 
 * When loading a language file, CodeIgniter will load first the english version, 
 * if appropriate, and then the one appropriate to the language you specify. 
 * This lets you define only the language settings that you wish to over-ride 
 * in your idiom-specific files.
 * 
 * This has the added benefit of the language facility not breaking if a new 
 * language setting is added to the built-in ones (english), but not yet 
 * provided for in one of the translations.
 * 
 * To use this capability, transparently, copy this file (MY_Lang.php)
 * into your application/core folder.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Language
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/language.html
 */
class MY_Controller extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
    }

}	

class Public_Controller extends MY_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('form', 'url', 'cookie','date'));
        $this->is_logged_in();
        $this->_data_header['col_name'] = $this->get_header_col_name();
        $this->_data_header['user_info'] = $this->get_user_sshrsa_by_id($this->session->userdata('u_id'));
        $this->_data_header['hidden_loguser_id'] = $this->get_loguser_by_id($this->session->userdata('u_id'));
    }

    public function get_user_sshrsa_by_id($u_id) {
    	$this->db->select('ssh-rsa as ssh_rsa, mac,tel');
		$this->db->from('ops_user');
		$this->db->where('id', $u_id);
		$data = $this->db->get()->row();
		return $data;
    }
    public function get_loguser_by_id($u_id) {
		$sql = "SELECT ssh_user FROM ops_user_ssh_server WHERE user_id = ? ";
		$query = $this->db->query($sql, array($u_id));			
		$data = $query->result();
		foreach ($data as $key => $value) {
			$r[] = $value->ssh_user;
		}
		return $r;
    }

	public function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true){
			$redirect_url = $this->uri->uri_string() ? 'login?redirect='.$this->uri->uri_string() : 'login';				
			redirect($redirect_url);		
		}		
	}
	public function get_header_col_name($classid='1') {
		$user_level_id = $this->session->userdata('u_level_id');
		if (!$user_level_id) {
			$user_level_id = 0;
		}
		$query = $this->db->query("select * from ops_col_permissions where FIND_IN_SET(".$user_level_id." ,ops_permissions) and class_id='".$classid."' order by id");
		return $data_col = $query->result();
	}	
}

class Admin_Controller extends MY_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('form', 'url', 'cookie'));
        $this->is_admin_logged_in();
    }
    public function get_user_sshrsa_by_id($u_id) {
    	$this->db->select('ssh-rsa as ssh_rsa, mac,tel');
		$this->db->from('ops_user');
		$this->db->where('id', $u_id);
		$data = $this->db->get()->row();
		return $data;
    }
    public function is_admin_logged_in(){
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		if(!isset($is_admin_logged_in) || $is_admin_logged_in != true){
			$redirect_url = $this->uri->uri_string() ? 'admin/login?redirect='.$this->uri->uri_string() : 'admin/login';
			redirect($redirect_url);		
		}		
	}
}