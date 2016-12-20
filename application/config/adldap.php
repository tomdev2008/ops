<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$config['hosts'] = array('192.168.184.101');
	$config['ports'] = array(389);
	$config['basedn'] = 'ou=chengdao,dc=xkeshi,dc=so';
	$config['login_attribute'] = 'uid';
	$config['proxy_user'] = 'cn=admin,dc=xkeshi,dc=so';
	$config['proxy_pass'] = 'Xkeshi@123';