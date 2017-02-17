<?php 
// 后台配置文件模板
@$config['dubbo.properties'] =
<<<EOF
${env}.dubbo.registry.address=${registry_address}
${env}.dubbo.monitor.address=${monitor_address}
${env}.dubbo.protocol.port=#21101#
${env}.dubbo.application.owner=xkeshi
${env}.dubbo.cache.path=dubboCache/${env}
${env}.dubbo.consumer.group=pub
${env}.dubbo.consumer.version=#1.0.3#

${env}.dubbo.provider.group=pub
${env}.dubbo.provider.version=#1.0.3#
${env}.dubbo.protocol.host=dubbohost
EOF;

$config['dev_registry_address'] = "zookeeper://192.168.184.131:2181?backup=192.168.184.132:2181,192.168.184.133:2181";
$config['dev_monitor_address'] = "dubbo://192.168.184.131:7070";