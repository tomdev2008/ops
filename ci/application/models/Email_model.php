<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type:application/json; charset=utf-8');
/**
 * Email_model class.
 * 
 * @extends CI_Model
 */
class Email_model extends CI_Model {
 
 	public function __construct() {	
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(['cookie','typography']);	
		$this->load->database();
	}

	public $api_address = 'http://openapi.exmail.qq.com:12211/openapi/';
 	// 获取access_token
 	public function get_access_token($cTMailID,$cTMailSecret)
 	{
 		// 获取Token的地址
		$cTMailGetAccessTokenURL = 'https://exmail.qq.com/cgi-bin/token';
		//$cTMailContentData = 'grant_type=client_credentials&client_id=' . $cTMailID . '&client_secret=' . $cTMailSecret;
		$cTMailContentData = [
			'grant_type' => 'client_credentials',
			'client_id' => $cTMailID,
			'client_secret' => $cTMailSecret
		];
 		// 创建会话
 		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($cTMailGetAccessTokenURL,$headers,$cTMailContentData);
		//$ch = curl_init();
		//curl_setopt($ch,CURLOPT_URL,$cTMailGetAccessTokenURL);
		//curl_setopt($ch,CURLOPT_POSTFIELDS,$cTMailContentData);
		//curl_setopt($ch,CURLOPT_ENCODING,'UTF-8');
		//curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1 );
		//$res = curl_exec($ch);
		//curl_close($ch);
		$json_obj = json_decode($response->body,true);
		$cTMailAccessToken = $json_obj['access_token'];
		// 返回获取的AccessToken
		return $cTMailAccessToken;
 	}
	// 获取auth_key
 	public function get_auth_key($cTMailAccessToken,$cTMailAlias)
 	{
		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'alias' => $cTMailAlias
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'mail/authkey',$headers,$cTMailContentData);
		$json_obj = json_decode($response,true);
		$cTMailAuthKey = $json_obj['auth_key'];
		return $cTMailAuthKey;
 	}

	// 一键登录
	//$cURL = 'https://exmail.qq.com/cgi-bin/login?fun=bizopenssologin&method=bizauth&agent=' . $cTMailID . '&user=' . $cTMailAlias . '&ticket=' . $cTMailAuthKey;
	//echo '<a href="' . $cURL . '" target="_blank">一键登录</a>';

	// 获取用户信息
 	public function get_account_info($cTMailAccessToken,$cTMailAlias)
 	{
		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'alias' => $cTMailAlias
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/get',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 检查邮箱账号是否可用
	public function check_email($cTMailAccessToken,$cTMailAlias)
	{
		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'email' => $cTMailAlias
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/check',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
	}
 	// 添加新成员邮箱(已测试)
 	public function add_email($cTMailAccessToken,$cTMailAlias,$name,$password,$partypath)
 	{
 		// post地址
 		//$cTMailPostURL = $this->api_address.'user/sync';
 		//$cTMailContentData = 'access_token='.$cTMailAccessToken.'&action=2&alias='.$cTMailAlias.'&name='.$name.'&gender='.$gender.'&position='.$position.'&mobile='.$mobile.'&password='.$password.'&partypath='.$partypath;
 		// 注册信息
 		//$cTMailContentData = 'access_token='.$cTMailAccessToken.'&action=2&alias='.$cTMailAlias.'&name='.$name.'&password='.$password.'&partypath='.$partypath;
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 2,//添加为2
			'alias' => $cTMailAlias,
			'name' => $name,
			'password' => $password,
			'partypath' => $partypath
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 删除成员邮箱(已测试)
 	public function del_email($cTMailAccessToken,$cTMailAlias)
 	{
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 1,//删除为1
			'alias' => $cTMailAlias
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 修改成员邮箱信息（已测试）
 	public function mod_email($cTMailAccessToken,$cTMailAlias,$name,$gender,$position,$mobile,$password,$partypath,$opentype)
 	{ 		
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 3,//修改为3
			'alias' => $cTMailAlias,
			'name' => $name,
			'gender' => $gender,
			'position' => $position,
			'mobile' => $mobile,
			'password' => $password,
			'partypath' => $partypath,
			'opentype' => $opentype
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 修改成员邮箱信息(改为禁用状态)
 	public function email_disable($cTMailAccessToken,$cTMailAlias,$opentype)
 	{ 		
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 3,//修改为3
			'alias' => $cTMailAlias,
			'opentype' => $opentype
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'user/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 添加部门(已测试)
 	public function add_party($cTMailAccessToken,$dstpath)
 	{
 		//$cTMailPostURL = $this->api_address.'party/sync';
 		//$cTMailContentData = 'access_token='.$cTMailAccessToken.'&action=2&dstpath='.$party;
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 2,//添加为2
			'dstpath' => $dstpath
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'party/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 删除部门(已测试)
 	public function del_party($cTMailAccessToken,$dstpath)
 	{
 		//$cTMailPostURL = $this->api_address.'/party/sync';
 		//$cTMailContentData = 'access_token='.$cTMailAccessToken.'&action=1&dstpath='.$dstpath;
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 1,//删除为1
			'dstpath' => $dstpath
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'party/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
 	// 修改部门(已测试)
 	public function mod_party($cTMailAccessToken,$dstpath,$srcpath)
 	{
 		//$cTMailPostURL = $this->api_address.'party/sync';
 		//$cTMailContentData = 'access_token='.$cTMailAccessToken.'&action=3&dstpath='.$dstpath.'&srcpath='.$srcpath;
 		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'action' => 3,//修改为3
			'dstpath' => $dstpath,
			'srcpath' => $srcpath
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'party/sync',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
 	}
	// 获取用户未读邮件数量
 	// public function get_account_email($cTMailAccessToken,$cTMailAlias)
 	// {
 	// 	$cTMailPostURL = $this->api_address.'mail/newcount';
		// $cTMailContentData = 'access_token=' . $cTMailAccessToken . '&alias=' . $cTMailAlias;
		// $ch = curl_init();
		// curl_setopt($ch,CURLOPT_URL,$cTMailPostURL);
		// curl_setopt($ch,CURLOPT_POSTFIELDS,$cTMailContentData);
		// curl_setopt($ch,CURLOPT_ENCODING,'UTF-8');
		// curl_setopt($ch,CURLOPT_HEADER,0);
		// curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1 );
		// curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 75);
		// $res = curl_exec($ch);
		// curl_close($ch);
		// $json_obj = json_decode($res,true);
		// // 打印获取的信息
		// print_r($json_obj);
 	// }
	// 客户端维持长连接
 	// public function keep_client_connection($cTMailAccessToken,$cTMailAlias)
 	// {
 	// 	$cTMailPostURL = $this->api_address.'listen';
		// $cTMailContentData = 'access_token=' . $cTMailAccessToken . '&alias=' . $cTMailAlias;
		// $ch = curl_init();
		// curl_setopt($ch,CURLOPT_URL,$cTMailPostURL);
		// curl_setopt($ch,CURLOPT_POSTFIELDS,$cTMailContentData);
		// curl_setopt($ch,CURLOPT_ENCODING,'UTF-8');
		// curl_setopt($ch,CURLOPT_HEADER,0);
		// curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1 );
		// curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 75);
		// $res = curl_exec($ch);
		// curl_close($ch);
		// $json_obj = json_decode($res,true);
		// print_r($json_obj);
 	// }
	// 获取子部门列表
	// public function get_branch($cTMailAccessToken)
	// {
	// 	$cTMailPostURL = $this->api_address.'party/list';
	// 	$cTMailContentData = 'access_token=' . $cTMailAccessToken . '&partypath=';
	// 	$ch = curl_init();
	// 	curl_setopt($ch,CURLOPT_URL,$cTMailPostURL);
	// 	curl_setopt($ch,CURLOPT_POSTFIELDS,$cTMailContentData);
	// 	curl_setopt($ch,CURLOPT_ENCODING,'UTF-8');
	// 	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1 );
	// 	$res = curl_exec($ch);
	// 	curl_close($ch);
	// 	$json_obj = json_decode($res,true);
	// 	echo '<br>获取的子部门列表:';
	// 	print_r($json_obj);
	// }
	// 获取部门下成员列表
	// public function get_branch_($cTMailAccessToken)
	// {
	// 	$cTMailPostURL = $this->api_address.'partyuser/list';
	// 	$cTMailContentData = 'access_token=' . $cTMailAccessToken . '&partypath=XX公司/财务部';
	// 	$ch = curl_init();
	// 	curl_setopt($ch,CURLOPT_URL,$cTMailPostURL);
	// 	curl_setopt($ch,CURLOPT_POSTFIELDS,$cTMailContentData);
	// 	curl_setopt($ch,CURLOPT_ENCODING,'UTF-8');
	// 	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1 );
	// 	$res = curl_exec($ch);
	// 	curl_close($ch);
	// 	$json_obj = json_decode($res,true);
	// 	echo '<br>获取的子部门成员列表:';
	// 	print_r($json_obj);
	// }
	// 添加群组成员（已测试）
	public function add_email_in_group($cTMailAccessToken,$group_alias,$members)
	{
		//$cTMailPostURL = $api_address.'gruop/addmember';
		//$cTMailContentData = 'access_token=' . $cTMailAccessToken . '&group_alias='.$group_alias.'&members='.$members;
		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'group_alias' => $group_alias,
			'members' => $members
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'group/addmember',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		return $json_obj;
	}
	// 添加群组(群组名称中文乱码)
	public function add_group($cTMailAccessToken,$group_name,$group_admin,$status)
	{
		//$cTMailPostURL = $api_address.'gruop/addmember';
		//$cTMailContentData = 'access_token=' . $cTMailAccessToken . '&group_alias='.$group_alias.'&members='.$members;
		$cTMailContentData = [
			'access_token' => $cTMailAccessToken,
			'group_name' => $group_name,
			'group_admin' => $group_admin,
			'status' => $status,
		];
		$headers = array('Content-Type' => 'application/json');
		$response = Requests::post($this->api_address.'group/add',$headers,$cTMailContentData);
		$json_obj = json_decode($response->body,true);
		var_dump($response->headers);
		return $json_obj;
	}
}