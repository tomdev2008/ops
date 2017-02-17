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

		public function get_permission_by_id($id) {
			$this->db->select('power_status');
			$this->db->from('ops_user_action');
			$this->db->where('user_id', $id);
			$this->db->where('power_id', 27);
			$this->db->where('power_type', 2);
			$data = $this->db->get()->row('power_status');
			return $data;
		}
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
				// "2" => "<",
				// "3" => ">",
				// "4" => ">=",
				// "5" => "<="
			];
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
		// 数据表查询结果统计
		public function SelectResultCount($database,$table,$field,$symbol,$value)
		{
			$symbol_val = [
				"1" => "=",
			];
			$symbol = $symbol_val[$symbol];
			$this->db_div = $this->load->database($database,TRUE);
			$query = $this->db_div->query("select * from ".$table." where ".$field.$symbol." '".$value."'");
			$data = count($query->result());
			return $data;
		}
		// 数据表查询结果(重构)
		public function SelectResultBy($data)
		{
			$database = $data['database'];
			$table = $data['table'];
			$field = $data['field'];
			$symbol = $data['symbol'];
			$value = $data['value'];
			$num = $data['selectnum'];
			$symbol_val = [
				"1" => "=",
			];
			$sql_add = '';
			if ($num > 0) {
				for ($i=1; $i <= $num; $i++) {
					$switch = empty($data["switch".$i]) ?"or":"and";
					$sql_add .= $switch." ".$data["field".$i].$symbol_val[$data["symbol".$i]]."'".$data["value".$i]."'";
				}
			}
			// foreach ($data as $key => $value) {
			// 	$sql_add .= $value->switch." ".$value->field." = ".$value->value;
			// }
			$this->db_div = $this->load->database($database,TRUE);
			$sql = "select * from ".$table." where ".$field.$symbol_val[$symbol]." '".$value."' ".$sql_add." limit 0,100";
			$query = $this->db_div->query($sql);
			$querydata = $query->result();
			return $querydata;
		}
		// 数据表查询结果统计(重构)
		public function SelectResultCountBy($data)
		{
			$database = $data['database'];
			$table = $data['table'];
			$field = $data['field'];
			$symbol = $data['symbol'];
			$value = $data['value'];
			$num = $data['selectnum'];
			$symbol_val = [
				"1" => "=",
			];
			$sql_add = '';
			if ($num > 0) {
				for ($i=1; $i <= $num; $i++) { 
					$switch = empty($data["switch".$i]) ?"or":"and";
					$sql_add .= $switch." ".$data["field".$i].$symbol_val[$data["symbol".$i]]."'".$data["value".$i]."'";
				}
			}
			$this->db_div = $this->load->database($database,TRUE);
			$sql = "select * from ".$table." where ".$field.$symbol_val[$symbol]." '".$value."' ".$sql_add;
			$query = $this->db_div->query($sql);	
			$querydata = count($query->result());
			return $querydata;
		}
	}
 ?>