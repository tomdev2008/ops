<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; left:30%; top:20%;">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"注册结果</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $level_id = $this->input->get('level_id');
    $name = $this->input->get('name');
    $email = $this->input->get('email');
?>
  <div class="alert alert-success">
  <h2>注册结果：</h2>
    <font size=5>
      <div style="height:40px">
        工作部门：<strong><?php echo $this->register_model->get_name_by_level_id($level_id);?></strong><br>
      </div>
      <div style="height:40px">
        姓名：<strong><?php echo $name?></strong><br>
     </div>
       <div style="height:40px">
          账号：<strong><?php echo $email?></strong><br>
       </div>
   </div>
      <div style="text-align:center">
       <button class="btn btn-large btn-primary" type="button" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']?>/login' " style="text-align:center">点击返回登录页面</button>
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