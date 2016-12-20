<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends Public_Controller {


	public function index()
	{
		$data = array();
		$server_location = [
					[
						"id" => "6",
						"name" => "阿里云ECS(经典网络)",
						"count" => ""
					],
					[
						"id" => "9",
						"name" => "阿里云ECS(VPC网络)",
						"count" => ""
					],		
					[
						"id" => "10",
						"name" => "庙街阿里云ECS(经典网络)",
						"count" => ""
					],								
					 [
						"id" => "5",					
						"name" => "爱客仕",
						"count" => ""
					],
					[
						"id" => "7",
						"name" => "阿里云数据库",
						"count" => ""
					],
					[
						"id" => "3",
						"name" => "世导仓前机房 ==> 机房手机号：<a href=tel:13357467934>13357467934</a> 百羽互联：<a href=tel:0571-85528663>0571-85528663</a>",
						"count" => ""
					],
					[
						"id" => "8",
						"name" => "阿里云高防IP",
						"count" => ""
					]					


		];
		$sss = sha1(md5(md5('Linux') . sha1(time()))) . md5(sha1(sha1('root')));
		//echo substr($sss,2,18);
		foreach ($server_location as $key => $value) {
			$value_id = $value['id'];
			$query = $this->db->query("select * from ops_ip where location='$value_id' and is_esxi='0' order by server_env asc");
			$server_location[''.$key.'']['count'] = $query->num_rows();
			$data_ip = $query->result();
			foreach ($data_ip as $key => $value) {
				$data_ip[''.$key.'']->expire_flag = substr($value->opr_time,5,2) - date('m');
			}
			$this->_data['server'.$value_id.''] = $data_ip;
		}
		$this->_data['server_location'] = $server_location;
		$this->load->view('default/header',$this->_data_header);
		$this->load->view('default/server',$this->_data);
		$this->load->view('default/footer');
	}
}
