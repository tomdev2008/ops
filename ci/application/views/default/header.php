<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $this->config->item('ops_name')?></title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- <script src="<?php echo base_url();?>bootstrap-modal/js/bootstrap-modal.js"></script> -->
        <style type="text/css">
            .modal-backdrop, .modal-backdrop.fade.in {
                background: #000
            }
        </style>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>       
                    <a class="brand" href="/"><?php echo $this->config->item('ops_name')?></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo $this->session->userdata('username')?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?php echo anchor('#profile', '设置', 'data-toggle="modal"');?>
                                    </li>
                                    <li>
                                        <?php echo anchor('ldap?type=update', '修改密码', ' title="修改密码"');?>
                                    </li>
                                    <!-- <li>
                                        <?php echo anchor('#profile', '密码重置', ' data-toggle="modal"');?>
                                    </li> -->
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url('login/logout')?>">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="nav">
                            <li class="active">
                                <a href="#">Dashboard</a>
                            </li>
                            
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">监控平台 <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="https://qiye.jiankongbao.com" target="_blank">监控宝</a>
                                    </li>
                                    <li>
                                        <a href="http://monit.ops.xkeshi.so:8080" target="_blank">M/MOMIT</a>
                                    </li>
               <!--                      <li class="divider"></li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li> -->
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">内部工具 <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                            <li>
                                                <a href="https://signin.aliyun.com/1271727880393658/login.htm" target="_blank">阿里云RAM</a>
                                            </li>                                
                                             <li>
                                                <a href="http://rap.ops.xkeshi.so" target="_blank">RAP</a>
                                            </li>
                                            <li>
                                                <a href="http://jenkins.ops.xkeshi.so/" target="_blank">Jenkins</a>
                                            </li>
                                            <li>
                                                <a href="http://disconf.ops.xkeshi.so/" target="_blank">配置中心</a>
                                            </li>
                                </ul>
                            </li>                            
                            
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">常用链接 <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="http://192.168.184.2:8090/pages/viewpage.action?1461850255&pageId=4099958" target="_blank">后端开发入职必读手册</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="ftp://ftp.ops.xkeshi.so/" target="_blank">公司FTP</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="http://data.ops.xkeshi.so/" target="_blank">常用软件下载</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">员工 <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url('user')?>">员工列表</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">

                <div class="span3" id="sidebar">

                    <ul class="nav nav-list bs-docs-sidenav nav-collapse">
                        <li>
                            <a class="btn btn-success btn-large" href="http://status.xkeshi.so:2813" target="_blank">平台首页健康状态</a>
                        </li>
                     </ul>   

                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li class="active">
                            <a href="/"><i class="icon-chevron-right"></i> 控制台</a>
                        </li>
                 <?php
                 // $this->load->database();
                 // $query = $this->db->query("select * from ops_col_permissions where class_id = 1 ");
                 // $col_name = $query->result();
                 if ($col_name != '') {
                    foreach ($col_name as $key => $value) {
                 ?>       
                        <li>
                            <a href="<?php echo site_url($value->col_route_name)?>"><i class="icon-chevron-right"></i> <?php echo $value->col_name?></a>
                        </li>   
                 <?php
                 }}
                 ?>                            
         
                    </ul>
                    
                </div>

   

<!-- Modal Definitions (tabbed over for <pre>) -->
<div id="profile" class="modal fade" tabindex="-1" data-width="760" style="display: none; top: 200px">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">用户设置</h4>
  </div>
  <div class="modal-body">
    
 <?php
    echo form_open('user/modify');
?>
<table class="table table-bordered">
    <tr>
    <td><strong>手机号</strong></td>
     <td><?php
    echo form_input(array(
        'name'          => 'tel',
        'id'            => 'tel',
        'value'         => set_value('tel', ''.$user_info->tel.'')
    ));
    ?>
    </td>
    </tr>
    <tr>
    <td><strong>ssh访问权限</strong></td>
    <td>
<?php
    if ($hidden_loguser_id == NULL) {
    ?>
    <input type="checkbox" name="loguser" value="1" >Loguser权限
    <?php
    } else {
         foreach ($hidden_loguser_id as $key => $value) {
            $r[] = $value->ssh_user;
        }
        foreach ($r as $ke => $va) {
        echo $va."<br>";}
    if (!in_array('loguser',$r)) {    
?>
<input type="checkbox" name="loguser" value="1" >Loguser权限
<?php
    }}
?>            
    </td>
    </tr>
    <tr>
    <td><strong>公钥</strong></td>
    <td><?php
    echo form_textarea(array(
        'name'          => 'ssh-rsa',
        'id'            => 'ssh-rsa',
        'value'         => set_value('ssh-rsa', ''.$user_info->ssh_rsa.''), // 
        'rows'          => 10,
        'cols'          => 250,
    ),'','style="width: 409px; height: 206px;"');
    ?>
         <a href="http://ops.xkeshi.so/faq/log_view.html" target="_blank">公钥操作方法</a>
    </td>
    </tr>
    <tr>
    <td><strong>网卡MAC地址：</strong></td>
    <td><?php
    echo form_input(array(
        'name'          => 'mac',
        'id'            => 'mac',
        'value'         => set_value('mac', ''.$user_info->mac.'')
    ));
    ?> <a href="http://ops.xkeshi.so/faq/mac-find-post.html" style="margin-left:30px" target="_blank">MAC地址获取说明</a></td>
    </tr>
</table>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
    <?php
    echo form_submit('mysubmit', '提交','class="btn btn-primary"');
?>
  </div>
  <?php

    echo form_close();
?>  
</div>                 
                       
                <!--/span-->