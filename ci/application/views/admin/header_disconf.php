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
                        $project_id_get = $this->input->get('project_id');
                        $app_get = $this->input->get('app');
                        $version = $this->input->get('version');
                        // 截取url
                        $url = explode("?env=", $_SERVER['REQUEST_URI']);
                        @$u = substr($url[1], 1);
                        @$app_name = explode("&app=", $u);
                        @$app_env = explode("-", $app_name[1]);
                        @$app = explode($app_env[0], $app_name[1]);
                        // @$url_change = explode($app_env[0], $u);
                        // @$url_noversion = explode("&version=", $url_change[1]);
                        // echo $app;
                        // 导航栏
                        $env_val = [
                            "1" => [
                                "id" => "1",
                                "name" => "开发环境",
                                "select" => "",
                            ],
                            "2" => [
                                "id" => "2",
                                "name" => "测试环境",
                                "select" => "",
                            ],
                            "3" => [
                                "id" => "3",
                                "name" => "预发布环境",
                                "select" => "",
                            ],
                            "4" => [
                                "id" => "4",
                                "name" => "生产环境",
                                "select" => "",
                            ],
                            // "5" => [
                            //     "id" => "5",
                            //     "name" => "本地环境",
                            //     "select" => "",
                            // ]
                        ];
                        //导航栏active状态
                        if ($env == 0) {
                            $disconf = "active";
                        }else{
                            $env_val[$env]["select"] = "active";
                        }
                        // url调整
                        $url_dev =  $app_get != "" ? $app_name[0]."&app=dev".$app[1] : $app_name[0];
                        $url_test =  $app_get != "" ? $app_name[0]."&app=test".$app[1] : $app_name[0];
                        $url_pre =  $app_get != "" ? $app_name[0]."&app=pre".$app[1] : $app_name[0];
                        $url_product =  $app_get != "" ? $app_name[0]."&app=product".$app[1] : $app_name[0];
                    ?>
                        <li class="<?php echo $disconf?>">
                            <a href="<?php echo base_url();?>admin/disconfig"><i class="glyphicon glyphicon-chevron-right"></i>最新修改</a>
                        </li>
                            <?php foreach ($env_val as $key => $value) {?>
                                <li class="<?php echo $value["select"];?>">
                                    <a href="<?php echo $env != "" ? $url[0]."?env=".$value["id"].$url_dev : $url[0]."?env=".$value["id"]?>">
                                        <i class="glyphicon glyphicon-chevron-right"></i><?php echo $value["name"];?>
                                    </a>
                                </li>
                            <?php }?>
                    </ul>
                </div>
    