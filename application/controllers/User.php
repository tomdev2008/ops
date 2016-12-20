<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Public_Controller {


	public function index()
	{
		$data = array();
		$query = $this->db->query('select * from ops_user_level');
		$data = $query->result();
		$this->_data['users_level'] = $data;

		$level_id = $this->input->get('level_id', TRUE);

		$user_sql_where = $level_id ? " WHERE level_id = '".$level_id."'" : "";

		$query = $this->db->query('select * from ops_user'.$user_sql_where);
		$data = $query->result();
		$this->_data['users'] = $data;
		$this->_data['title'] = '员工列表';
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/user',$this->_data);
		$this->load->view('default/footer');
	}
	public function logs()
	{
		$query = $this->db->query('SELECT * FROM ops_user_logs ORDER BY id DESC LIMIT 100');
		$data = $query->result();
		$this->_data['logs'] = $data;
		$this->_data['title'] = '登录日志列表';
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/user_logs',$this->_data);
		$this->load->view('default/footer');
	}

	public function modify() {
		$ssh_rsa = $this->input->post('ssh-rsa');
		$mac = $this->input->post('mac');
		$tel = $this->input->post('tel');
		$u_id = $this->session->userdata('u_id');
		$this->db->select('ssh_user');
		$this->db->from('ops_user_ssh_server');
		$this->db->where('user_id', $u_id);
		$data = $this->db->get()->row('ssh_user');
		if ($data == 'loguser') {
			$hidden_loguser_id = 1;
		} else {
			$hidden_loguser_id = 0;
		}
		$loguser = $this->input->post('loguser');
		$data = [
		    'ssh-rsa'  => $ssh_rsa,
		    'mac'	   => $mac,
		    'tel' => $tel
		];
		$this->db->where('id', $u_id);
		$this->db->update('ops_user', $data);
		if ($loguser == 1 && $hidden_loguser_id == 0) {
			$data_loguser = array(
			    'user_id' => $u_id,
			    'ssh_user' => 'loguser',
			    'ssh_servers' => 'all',
			    'opr_time' => date('Y-m-d H:i:s',time())
			);
			$this->db->insert('ops_user_ssh_server', $data_loguser);
		}

		redirect('/');
	}
}
