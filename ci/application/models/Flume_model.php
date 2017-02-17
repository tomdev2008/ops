<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Flume_model class.
 * 
 * @extends CI_Model
 */
class Flume_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('parser'));
		$this->load->helper(['cookie']);		
		$this->load->database();
		
	}
	public function get_server_data($ip){
		$query = $this->db->query("select * from ops_app_server where server_deploy_ip='".$ip."'");
		$data = $query->result();
		return $data;
	}
	public function GetAgentConf($ip)
	{
		$flume_conf = "{agent_sources}{agent_content}{agent_footer}";
		$data = array(
    		'agent_sources' => $this->get_agent_sources($ip),
 		   	'agent_content' => $this->get_agent_content($ip),
		    'agent_footer' => $this->get_agent_footer($ip)
		);
		return $this->parser->parse_string($flume_conf, $data,true);
	}
	public function get_agent_sources($ip)
	{
		$server = $this->get_server_data($ip);
		$source = '';
		foreach ($server as $key => $value) {
			$log_bath = $value->app_logs_path;
			if ($log_bath != NULL) {
				$log_bath = str_replace(",","",$log_bath);
				$log_bath = str_replace("/home/www/logs/"," ",$log_bath);
				$source .= $log_bath;
			}
		}
		$agent_sources = 
<<<EOF
agent.sources = ${source}
agent.channels = channel1
agent.sinks = sink1

EOF;
return $agent_sources;
	}
	public function get_agent_content($ip)
	{
		$server = $this->get_server_data($ip);
		$agent_content = '';
		foreach ($server as $key => $value) {
			$log_baths = $value->app_logs_path;
			$server_name = $value->server_name;
			$Ta = '$TagNameBuilder';
			$Bu = '$Builder';
			if ($log_baths != NULL) {
				$logs = explode(",",$log_baths);
				foreach ($logs as $key => $value) {
					$log_bath = str_replace(",","",$value);
					$log_bath = str_replace("/home/www/logs/","",$log_bath);
					$agent_content .= 
<<<EOF

agent.sources.${log_bath}.type = org.apache.flume.source.TaildirSource
agent.sources.${log_bath}.channels = channel1
agent.sources.${log_bath}.positionFile  = /home/flume/apache-flume-1.6.0-bin/position/taildir_${log_bath}_position.json
agent.sources.${log_bath}.filegroups = f1
agent.sources.${log_bath}.filegroups.f1 = ${value}/.*.log
agent.sources.${log_bath}.batchSize = 100
agent.sources.${log_bath}.backoffSleepIncrement = 1000
agent.sources.${log_bath}.maxBackoffSleep = 5000
agent.sources.${log_bath}.interceptors = i1 i2 i3 i4
agent.sources.${log_bath}.interceptors.i1.type = host
agent.sources.${log_bath}.interceptors.i1.hostHeader = hostname
agent.sources.${log_bath}.interceptors.i1.useIP=true
agent.sources.${log_bath}.interceptors.i2.type = timestamp
agent.sources.${log_bath}.interceptors.i3.type = com.xkeshi.flume.plugins.interceptor.XHandleTagNameInterceptor${Ta}
agent.sources.${log_bath}.interceptors.i4.type = com.xkeshi.flume.plugins.interceptor.XHandleInterceptor${Bu}

EOF;
					}
			}
		}
		return $agent_content;
	}
	public function get_agent_footer($ip)
	{
		$server = $this->get_server_data($ip);
		$agent_footer = '';
		$sink1_namesrvAddr = '';
		$sink1_producerGroup = '';
		$sink1_topic = '';
		@$header = explode("-", $server[0]->server_name)[0];
		if ($header == "pre" || $header == "product") {
			$sink1_namesrvAddr = '10.117.34.42:9876;10.117.16.164:9876';
			$sink1_producerGroup = 'log-online-group';
			$sink1_topic = 'log-online';
		}
		else if($header == "test"){
			$sink1_namesrvAddr = '192.168.184.10:9876';
			$sink1_producerGroup = 'flume-test-group';
			$sink1_topic = 'flume-test';
		}
		$agent_footer = 
<<<EOF

agent.channels.channel1.type = dual
agent.channels.channel1.memory.capacity = 10000
agent.channels.channel1.memory.byteCapacity = 512000000
agent.channels.channel1.file.checkpointDir = /home/flume/flume-channel/fchannel1/spool/checkpoint
agent.channels.channel1.file.dataDirs = /home/flume/flume-channel/fchannel1/spool/data
agent.channels.channel1.file.capacity = 200000000
agent.channels.channel1.file.keep-alive = 30
agent.channels.channel1.file.write-timeout = 30
agent.channels.channel1.file.checkpoint-timeout=600

agent.sinks.sink1.channel = channel1
agent.sinks.sink1.type = com.xkeshi.flume.plugins.sinks.RocketMQSink
agent.sinks.sink1.namesrvAddr = ${sink1_namesrvAddr}
agent.sinks.sink1.producerGroup = ${sink1_producerGroup}
agent.sinks.sink1.topic = ${sink1_topic}
EOF;
		return $agent_footer;
	}
}
