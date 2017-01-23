<?php

$config['ops_name'] = '运维管理平台';

$config['ops_admin_name'] = '运维平台后端管理';

// 企业邮箱域名
$config['ops_email_domain'] = [
	'xkeshi.com' => "xkeshi.com",
	'xkeshi.so' => "xkeshi.so",

];

// 企业邮箱的管理员ID
$config['ops_email_id'] = 'ops.xkeshi.com';

// 接口Key
$config['ops_email_key'] = '7dc8b15e0622f4daacb115925a01890c';

// 白名单地址
$config['ops_disconf_whitelist_ip'] = ['192.168.184.74','192.168.184.75','192.168.184.76'];

// 运维通知邮箱
$config['ops_email'] = 'ops@xkeshi.com';

// 集团企业邮箱部门
$config['email_department'] = [
	0 => '销售部',
	1 => '售后部',
	2 => '运营部',
	3 => '大展传媒',
	4 => '生产',
	5 => '财务部',
	6 => '东融集团',
	7 => '爱客仕经销商',
	8 => '微商城',
	9 => '庙街网络',
	10 => '战略合作中心',
	11 => '流程组',
];

// 集团企业邮箱域名
$config['email_domain'] = [
	0 => '@xkeshi.com',
	1 => '@imiaoj.com',
	2 => '@xkeshi.so',
];

// 查询数据库及表信息
$config['pre_database'] = [
	'xkeshi_com' => array(
		'account',
		'operator',
		'cau_exc_order',
		'cau_exc_order_detail',
		'check_order_detail',
		'check_order',
		'category',
		'combo',
		'combo_item',
		'e_coupon',
		'e_coupon_apply_shop',
		'e_coupon_info',
		'e_coupon_info_channel',
		'e_coupon_info_channel_info',
		'e_coupon_order',
		'e_coupon_transaction',
		'e_coupon_refund_transaction',
		'erp_order',
		'erp_order_detail',
		'item',
		'item_inventory',
		'item_inventory_change_detail',
		'item_inventory_change_detail_log',
		'item_inventory_change_log',
		'item_inventory_change_order',
		'itemcategory',
		'meta_configure',
		'merchant',
		'operator_shift',
		'order_discount',
		'order_member_discount',
		'order_refund_deduction',
		'order_transaction',
		'orderitem',
		'orders',
		'order_deduction',
		'posoperationlog',
		'refund_order',
		'refund_order_item_entry',
		'related_item',
		'shop',
		'shopinfo',
		'sms_verification',
		'specification',
		'storage_order',
		'storage_order_detail',
		'supplier',
		'terminal',
		'order_transaction',
		'alipay_transaction',
		'wxcard_transaction',
		'anonymous_card_transaction',
		'anonymous_card_trade',
		'anonymous_card_refund_transaction',
		'prepaid_card_charge_rules',
		'prepaid_card_charge_orders',
		'other_transactio',
		'other_refund_transaction',
		'postransaction',
		'pos_refund_transaction',
		'cash_transaction',
		'operator_shift',
		'operator_shift_consumed_physical_coupon',
		'promotion_activity',
		'item_member_discount',
		'order_discount',
		'order_item_member_discount',
		'promotion_activity',
		'orderitem_proact',
		'order_proact',
		'dping_refund_transaction',
		),
	'xkeshi_member' => array(
		'prepaid_card_charge_order',
		'card',
		'physical_card',
		'physical_card_record',
		'card_score',
		),
	'dataware_dw' => array(),
	'dataware_ods' => array(),
	'wemall' => array(),
	'xkeshi_business' => array('ticket_configure'),
	'xkeshi_common' => array(
		'sms_captcha',
		'dictionary',
		'dictionary_relationship',
		'secret',
		),
	'xkeshi_shop_new' => array(
		'account',
		'alipay_store',
		'balancetransaction',
		'business_configure',
		'category',
		'combo',
		'combo_item',
		'item_apply_shop',
		'koubei_shop_config',
		'merchant',
		'merchant_item',
		'payment',
		'pos_gateway_account',
		'pos_operation_log',
		'related_item',
		'shop',
		'shop_config',
		'shop_item',
		'specification',
		'sub_item',
		'terminal',
		),
];