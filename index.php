<?php
	/**********************************************************************
	*  ezSQL initialisation for mySQL
	*/

	// Include ezSQL core
	include_once "./ezsql/ez_sql_core.php";

	// Include ezSQL database specific component
	include_once "./ezsql/ez_sql_mysql.php";

	// Initialise database object and establish a connection
	// at the same time - db_user / db_password / db_name / db_host
	$db = new ezSQL_mysql('ops','ops818','ops','192.168.184.100');
?>
<!DOCTYPE html>
<html>
<head>
    <title>OPS Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/16X16.ico">
    <link href="//cdn.bootcss.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 70px; }
        h2 {
            padding-top: 100px;
            margin-top: -100px;
            display: inline-block; /* required for webkit browsers */
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body data-spy="scroll" data-target="#navbar-opcache">
<nav id="navbar-opcache" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">运维管理平台</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="#hits">爱客仕平台</a></li>
            <li><a href="#memory">常用平台</a></li>
            <li><a href="#keys">第三方平台</a></li>
            <li><a href="#status">自动化平台</a></li>
            <li><a href="#configuration">监控平台</a></li>
            <li><a href="#scripts">框架组平台</a></li>
            <li><a href="http://data.ops.xkeshi.so/" target="_blank"><strong>软件下载</strong></a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">
        <h2><img src="http://redmine.ops.xkeshi.so/themes/gitmike/images/logo.png"><a href="http://arch.ops.xkeshi.so?<?=time();?>" target="_blank">后端开发入职必读手册</a>  <a href="http://192.168.184.2:8090/pages/viewpage.action?pageId=4099995" target="_blank">后端组PC MAC列表</a></h2>
<br>
        <h2>by xkeshi <a href="mailto:ops@xkeshi.com">@ops</a></h2>
    </div>


    <h2 id="hits">爱客仕平台</h2>
    <div class="table-responsive">
    <!-- class=danger -->
        <table class="table table-striped table-hover">
<?php
		$jenkins_url = "http://jenkins.ops.xkeshi.so/search/?q=";
		$my_tables = $db->get_results("SELECT * FROM ops_project WHERE platform_id = '1'");
		foreach ( $my_tables as $table ) {
			 $user = $db->get_row("SELECT * FROM ops_user WHERE id = $table->user_id")
?>

        	<tr class=""><th align="left"><?php echo $table->name?>-<a href="mailto:<?php echo $user->email;?>"><?php echo $user->name;?></a>-<?php echo $user->room;?><a target=blank href=tencent://message/?uin=<?php echo $user->qq;?>&Site=<?php echo $user->name?>&Menu=yes><img border="0" SRC=http://wpa.qq.com/pa?p=1:<?php echo $user->qq;?>:1 alt="有事点这里"></a></th><td align="right"><a href="<?php echo $table->dev_url?>" target="_blnak">开发环境</a> 【<a href="<?php echo $jenkins_url?><?php echo $table->dev_jenkins?>" target="_blank"><img src="./assets/images/jenkins.ico" border="0" width="16" height="16"></a>】，<a href="<?php echo $table->test_url?>" target="_blnak">测试环境</a>【<a href="<?php echo $jenkins_url?><?php echo $table->test_jenkins?>" target="_blank"><img src="./assets/images/jenkins.ico" border="0" width="16" height="16"></a>】，<a href="<?php echo $table->pre_url?>" target="_blnak">预发布环境</a>【<a href="<?php echo $jenkins_url?><?php echo $table->pre_jenkins?>" target="_blank"><img src="./assets/images/jenkins.ico" border="0" width="16" height="16"></a>】【<a href="<?php echo $table->pre_log_url?>" target="_blank">日志</a>】，<a href="<?php echo $table->product_url?>" target="_blnak">正式环境</a>【<a href="<?php echo $jenkins_url?><?php echo $table->product_jenkins?>" target="_blank"><img src="./assets/images/jenkins.ico" border="0" width="16" height="16"></a>】</td><td></td></tr>	
<?php
}
?>	       	
        	<tr class=""><th align="left">【logs.xkeshi.net】日志查看平台</th><td align="right"><a href="http://120.55.99.43/" target="_blnak">http://120.55.99.43/</a></td><td></td></tr>	        				
        </table>
    </div>


    <h2 id="system">系统平台</h2>
    <div class="table-responsive">
    <!-- class=danger -->
        <table class="table table-striped table-hover">
<?php
        $jenkins_url = "http://jenkins.ops.xkeshi.so/search/?q=";
        $my_tables = $db->get_results("SELECT * FROM ops_project WHERE platform_id = '2'");
        foreach ( $my_tables as $table ) {
             $user = $db->get_row("SELECT * FROM ops_user WHERE id = $table->user_id")
?>

            <tr class=""><th align="left"><?php echo $table->name?>-<a href="mailto:<?php echo $user->email;?>"><?php echo $user->name;?></a>-<?php echo $user->room;?><a target=blank href=tencent://message/?uin=<?php echo $user->qq;?>&Site=<?php echo $user->name?>&Menu=yes><img border="0" SRC=http://wpa.qq.com/pa?p=1:<?php echo $user->qq;?>:1 alt="有事点这里"></a></th><td align="right"><a href="<?php echo $table->dev_url?>" target="_blnak">开发环境</a> 【<a href="<?php echo $jenkins_url?><?php echo $table->dev_jenkins?>" target="_blank"><img src="./assets/images/jenkins.ico" border="0" width="16" height="16"></a>】，<a href="<?php echo $table->test_url?>" target="_blnak">测试环境</a>【<a href="<?php echo $jenkins_url?><?php echo $table->test_jenkins?>" target="_blank"><img src="./assets/images/jenkins.ico" border="0" width="16" height="16"></a>】，<a href="<?php echo $table->pre_url?>" target="_blnak">预发布环境</a>【<a href="<?php echo $jenkins_url?><?php echo $table->pre_jenkins?>" target="_blank"><img src="./assets/images/jenkins.ico" border="0" width="16" height="16"></a>】【<a href="<?php echo $table->pre_log_url?>" target="_blank">日志</a>】，<a href="<?php echo $table->product_url?>" target="_blnak">正式环境</a>【<a href="<?php echo $jenkins_url?><?php echo $table->product_jenkins?>" target="_blank"><img src="./assets/images/jenkins.ico" border="0" width="16" height="16"></a>】</td><td></td></tr>   
<?php
}
?>                                   
        </table>
    </div>

    <h2 id="memory">常用平台</h2>
    <div class="table-responsive">
    <!-- class=danger -->
        <table class="table table-striped table-hover">
        	<tr class=""><th align="left">【Vmware vSphere Web Client】虚拟化管理平台</th><td align="right"><a href="https://192.168.184.88/" target="_blnak">https://192.168.184.88/</a></td><td></td></tr>
			<tr class=""><th align="left">【redmine】运维工作管理平台</th><td align="right"><a href="http://redmine.ops.xkeshi.so" target="_blnak">http://redmine.ops.xkeshi.so</a></td><td></td></tr>
			<tr class=""><th align="left">【SVN】代码管理平台</th><td align="right"><a href="http://192.168.184.6:8181/" target="_blnak">http://192.168.184.6:8181/</a></td><td></td></tr>		
			<tr class=""><th align="left">【GITLIB】代码管理平台</th><td align="right"><a href="http://gitlab.ops.xkeshi.so" target="_blnak">http://gitlab.ops.xkeshi.so</a></td><td></td></tr>
			<tr class=""><th align="left">【Axure】产品原型管理</th><td align="right"><a href="http://axure.ops.xkeshi.so" target="_blnak">http://axure.ops.xkeshi.so</a></td><td></td></tr>
			<tr class=""><th align="left">【jira】jira管理平台</th><td align="right"><a href="http://jira.ops.xkeshi.so" target="_blnak">http://jira.ops.xkeshi.so</a></td><td></td></tr>
			<tr class=""><th align="left">【confluence】confluence管理平台</th><td align="right"><a href="http://confluence.ops.xkeshi.so" target="_blnak">http://confluence.ops.xkeshi.so</a></td><td></td></tr>	
			<tr class=""><th align="left">【rap】RAP接口文档</th><td align="right"><a href="http://rap.ops.xkeshi.so" target="_blnak">http://rap.ops.xkeshi.so</a></td><td></td></tr>																		
        </table>
    </div>

    <h2 id="keys">第三方平台</h2>
    <div class="table-responsive">
    <!-- class=danger -->
        <table class="table table-striped table-hover">
        	<tr class=""><th align="left">【主机管理】阿里云</th><td align="right"><a href="https://home.console.aliyun.com/" target="_blnak">https://home.console.aliyun.com/</a></td><td></td></tr>
			<tr class=""><th align="left">【域名管理】DNSPod</th><td align="right"><a href="http://www.dnspod.cn" target="_blnak">http://www.dnspod.cn</a></td><td></td></tr>
			
        </table>
    </div>


	<h2 id="status">自动化平台</h2>
    <div class="table-responsive">
    <!-- class=danger -->
        <table class="table table-striped table-hover">
        	<tr class=""><th align="left">【MAVEN私服】Sonatype Nexus</th><td align="right"><a href="http://192.168.184.6:8081/nexus/index.html#view-repositories;releases~browseindex" target="_blnak">http://192.168.184.6:8081/nexus/</a></td><td></td></tr>
			<tr class=""><th align="left">【jenkins】jenkins持续集成平台</th><td align="right"><a href="http://jenkins.ops.xkeshi.so" target="_blnak">http://jenkins.ops.xkeshi.so</a></td><td></td></tr>
			<tr class=""><th align="left">分布式配置管理平台</th><td align="right"><a href="http://192.168.184.2:8088/main.html" target="_blnak">http://192.168.184.2:8088/main.html</a></td><td></td></tr>
        </table>
    </div>

 

    <h2 id="configuration">监控平台</h2>
    <div class="table-responsive">
    	<table class="table table-striped table-hover">
    		<tr class=""><th align="left">【监控宝】监控宝管理平台</th><td align="right"><a href="https://qiye.jiankongbao.com" target="_blnak">https://qiye.jiankongbao.com</a></td><td></td></tr>
    		<tr class=""><th align="left">【M/MONIT】MONIT监控管理平台</th><td align="right"><a href="http://monit.ops.xkeshi.so:8080/index.csp" target="_blnak">http://monit.ops.xkeshi.so:8080/index.csp</a></td><td></td></tr>
    		<tr class=""><th align="left">【REDIS监控】开发REDIS监控管理平台</th><td align="right"><a href="http://redis.ops.xkeshi.so:8080" target="_blnak">http://redis.ops.xkeshi.so:8080</a></td><td></td></tr>
            <tr class=""><th align="left">【REDIS管理】Redis WEB界面管理工具</th><td align="right"><a href="http://ops.xkeshi.so/redis/?overview" target="_blnak">http://ops.xkeshi.so/redis/?overview</a></td><td></td></tr>
    	</table>
    </div>

    <h2 id="scripts">框架组平台</h2>
    <div class="table-responsive">
    	<table class="table table-striped table-hover">
                    <tr class=""><th align="left">【后端开发入职必读手册】</th><td align="right"><a href="http://arch.ops.xkeshi.so" target="_blnak">http://arch.ops.xkeshi.so</a>  </td><td></td></tr>
    		<tr class=""><th align="left">【RocketMQ 监控】管理平台</th><td align="right"><a href="http://192.168.184.10:8085" target="_blnak">http://192.168.184.10:8085</a>   <a href="http://120.55.99.43:9004" target="_blnak">http://120.55.99.43:9004</a></td><td></td></tr>
    		<tr class=""><th align="left">【Dubbo 服务控制台】</th><td align="right"><a href="http://192.168.184.10:8980" target="_blnak">http://192.168.184.10:8980</a> <a href="http://120.55.99.43:9003" target="_blnak">http://120.55.99.43:9003</a></td><td></td></tr>
    		<tr class=""><th align="left">【服务监控】</th><td align="right"><a href="http://192.168.184.12:10105" target="_blnak">http://192.168.184.12:10105</a> <a href="http://121.40.90.11:9988" target="_blnak">http://121.40.90.11:9988</a></td><td></td></tr>
    		<tr class=""><th align="left">【日志管理平台】</th><td align="right"><a href="http://121.40.90.11:9988/es/xkeshilog" target="_blnak">http://121.40.90.11:9988/es/xkeshilog</a></td><td></td></tr>
    	</table>
    </div>

    
</div>

<script src="//cdn.bootcss.com/jquery/3.0.0-beta1/jquery.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css"></script>
</body>
</html>
