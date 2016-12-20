<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->config->item('ops_admin_name')?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-theme.min.css">
        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-admin-theme-change-size.css">
        <!-- Vendors -->
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/vendors/easypiechart/jquery.easy-pie-chart.css">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/vendors/easypiechart/jquery.easy-pie-chart_custom.css">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/DT_bootstrap.css">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="collapse navbar-collapse" >
                        <ul class="nav navbar-nav navbar-right" style="position:absolute;left:10%">
                            <li style="margin-left:-100px">
                                <a href="/" target="_blank">回到前台 <i class="glyphicon glyphicon-share-alt"></i></a>
                            </li>
                        </ul>
                           <!--  <ul class="nav navbar-nav navbar-left bootstrap-admin-theme-change-size"> -->
                                <!-- <li class="text">Change size:</li>
                                <li><a class="size-changer small">Small</a></li>
                                <li><a class="size-changer large active">Large</a></li> -->
                            <!-- </ul> -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- <li><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                                <li>
                                    <a href="#">Reminders <i class="glyphicon glyphicon-bell"></i></a>
                                </li>
                                <li>
                                    <a href="#">Settings <i class="glyphicon glyphicon-cog"></i></a>
                                </li> -->
                                <li class="dropdown">
                                    <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i><?php echo $this->session->userdata('adminname')?> <i class="caret"></i></a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation" class="divider"></li>
                                        <li><a href="<?php echo site_url('admin/login/logout')?>">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- main / large navbar -->
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">运维管理后台</a>
                        </div>
                        <div class="collapse navbar-collapse main-navbar-collapse">
                            <ul class="nav navbar-nav">
                            <?php $classname = $this->uri->segment(2);?>
                                <li><a href="/admin/welcome">总后台</a></li>
                                <li class="active"><a href="/admin/disconfig">配置中心</a></li>
                            </ul>
                    </div>
                </div>
            </div><!-- /.container -->
        </nav>

        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->
                <div class="col-md-2 bootstrap-admin-col-left">
                    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                    <?php 
                        $this->load->database();
                        $query = $this->db->query("select * from ops_col_permissions where class_id = 2 ");
                        $permissions = $query->result();
                        $env = $this->input->get('env');
                        $disconf = $dev = $test = $prepub = $online = $local = $autoprepub = "";
                        // 截取url
                        $url = explode("?env=", $_SERVER['REQUEST_URI']);
                        @$u = substr($url[1], 1);
                        @$app_name = explode("&app=", $u);
                        @$app_env = explode("-", $app_name[1]);
                        @$app = explode($app_env[0], $app_name[1]);
                        @$url_change = explode($app_env[0], $u);
                        @$url_noversion = explode("&version=", $url_change[1]);
                        //导航栏active状态
                        switch ($env) {
                            case 1:
                                $dev = "active";
                                break;
                            case 2:
                                $test = "active";
                                break;
                            case 3:
                                $prepub = "active";
                                break;
                            case 4:
                                $online = "active";
                                break;
                            // case 5:
                            //     $local = "active";
                            //     break;
                            // case 6:
                            //     $autoprepub = "active";
                            //     break;
                            default:
                                $disconf = "active";
                                break;
                        }
                    ?>
                        <li class="<?php echo $disconf?>">
                            <a href="<?php echo base_url();?>admin/disconfig"><i class="glyphicon glyphicon-chevron-right"></i> 控制台</a>
                        </li>
                            <li class="<?php echo $dev?>">
                                <a href="<?php echo $u != "" ? $url[0]."?env=1".$url_change[0]."dev".$url_noversion[0] : $url[0]."?env=1"?>">
                                    <i class="glyphicon glyphicon-chevron-right"></i>开发环境
                                </a>
                            </li>
                            <li class="<?php echo $test?>">
                                <a href="<?php echo $u != "" ? $url[0]."?env=2".$url_change[0]."test".$url_noversion[0] : $url[0]."?env=2"?>">
                                    <i class="glyphicon glyphicon-chevron-right"></i>测试环境
                                </a>
                            </li>
                            <li class="<?php echo $prepub?>">
                                <a href="<?php echo $u != "" ? $url[0]."?env=3".$url_change[0]."pre".$url_noversion[0] : $url[0]."?env=3"?>">
                                    <i class="glyphicon glyphicon-chevron-right"></i>预发布环境
                                </a>
                            </li>
                            <li class="<?php echo $online?>">
                                <a href="<?php echo $u != "" ? $url[0]."?env=4".$url_change[0]."product".$url_noversion[0] : $url[0]."?env=4"?>">
                                    <i class="glyphicon glyphicon-chevron-right"></i>生产环境
                                </a>
                            </li>
                            <!-- <li class="<?php echo $local?>">
                                <a href="<?php echo $url[0]."?env=5".$url_add?>">
                                    <i class="glyphicon glyphicon-chevron-right"></i>local环境
                                </a>
                            </li>
                            <li class="<?php echo $autoprepub?>">
                                <a href="<?php echo $url[0]."?env=6".$url_add?>">
                                    <i class="glyphicon glyphicon-chevron-right"></i>autoprepub环境
                                </a>
                            </li> -->
                    </ul>
                </div>
    