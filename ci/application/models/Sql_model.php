<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* Sql_model class
	*
	* @extends CI_Model
	*/
	class Sql_model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library(array('session'));
			$this->load->helper(['cookie','typography']);
			//$this->xpredb = $this->load->database('xpredb',true);
			
		}
		// 测试接口
		//public function test()
		//{
			//$this->xpredb->query("select * from account where id =1");
			// $this->xpredb->select('name');
			// $this->xpredb->from('account');
			// $this->xpredb->where('id',1);
			//$fields = $this->xpredb->list_fields('account');
			// $data = $this->xpredb->get();
			//$data = $this->xpredb->result();
			//return $fields;
		//}


		// 获得查询表的所有字段
		public function GetFieldsByTable($database,$table)
		{
			$this->db_div = $this->load->database($database,TRUE);
			$fields = $this->db_div->list_fields($table);
			return $fields;
		}
		// 数据表查询结果
		public function SelectResult($database,$table,$field,$symbol,$value)
		{
			$symbol_val = [
				"1" => "=",
				"2" => "<",
				"3" => ">",
				"4" => ">=",
				"5" => "<="
			];// 符号映射
			$symbol = $symbol_val[$symbol];
			$this->db_div = $this->load->database($database,TRUE);
			$query = $this->db_div->query("select * from ".$table." where ".$field.$symbol." '".$value."' limit 0,100");
			//$this->xpredb->select('*');
			//$this->xpredb->from($table);
			//$this->xpredb->where($field,$value);
			//$data = $this->xpredb->get();
			$data = $query->result();
			return $data;
		}
	}
 ?>