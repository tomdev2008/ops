
<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; left:0; top:0px; width:875px; height:415px">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"项目添加结果</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $server = $this->input->get('server');
    $port = $this->input->get('port');
    $server_env = $this->input->get('server_env');
    $ServerName = $this->input->get('ServerName');
    $alias_name = $this->input->get('alias_name');
    $server_type = $this->input->get('server_type');
    switch ($server_env) {
      case '1':
      $env = "开发环境";
        break;
      case '2':
      $env = "测试环境";
        break;
      case '3':
      $env = "预发布环境";
        break;
      case '4':
      $env = "生产环境";
        break;      
      default:
      $env = " ";
        break;
    }
?>
  <div class="alert alert-success">
    <font size=5>
      <div style="height:40px">
        项目Jenkins名称：<strong><?php echo $ServerName?></strong><br>
      </div>
      <div style="height:40px">
        项目中文名称：<strong><?php echo $alias_name?></strong><br>
     </div>
     <div style="height:40px">
        项目部署环境：<strong><?php echo $env?></strong><br>
     </div>
     <div style="height:40px">
        项目容器：<strong><?php echo $server_type?></strong><br>
     </div>
     <div style="height:40px">
        服务器IP：<strong><?php echo $server?></strong>&nbsp;&nbsp;
        端口号:<strong><?php echo $port?></strong>
     </div>
  </div>
  <div class="alert alert-info">
    <font size=5>
      <strong>运维组正在构建中，请稍等。</strong>
    </font>
  </div>

    </div>
          </div>
      </div>
      </div>
                      <!-- /block -->
        </div>
                     <!-- /validation -->
                </div>

<!--/.fluid-container-->
  <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/scripts.js"></script>
  <script src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
 <script>

 </script>