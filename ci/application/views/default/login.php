<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $this->config->item('ops_name')?></title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?php echo base_url();?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
   <div class="alert alert-warning" style ="margin-top:-130px;height:130px">
        <button class="close" type="button" data-dismiss="alert"></button>
        <div style="position:absolute;left:40%;height:130px">
        <h4>重要通知</h4>
        运维平台帐号已启动密码验证机制（账号没有改动）<br>
        目前平台登录方法请参考：<br>
        1.新同事或未注册过运维平台的同事请先注册<br>
        2.未开通过VPN账号的同事，初始密码为<strong>Abc123</strong>
        （安全起见请在登陆后，点右上角修改密码）<br>
        3.之前开通过VPN账号的同事请直接使用VPN密码登录
        </div>
      </div>
    <div class="container">
<?php
    $attributes = ['class' => 'form-signin', 'id' => 'myform'];
    echo form_open('login', $attributes);
    $redirect_hidden_value = $this->input->get('redirect', TRUE) ? $this->input->get('redirect', TRUE) : $this->input->post('redirect');
    echo form_hidden('redirect', $redirect_hidden_value);
?>

        <h2 class="form-signin-heading"><?php echo $title?></h2>
        <?php echo form_error('sql', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
        <?php //echo validation_errors('<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
<div class="input-append">
               <input type="text" name="username" class="span2" value="<?php echo get_cookie('cookie_username'); ?>" placeholder="Email address">
              <span class="add-on" style="padding: 7px 9px;">@xkeshi.com</span>
            </div>
        <?php echo form_error('username', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
        <input type="password" name="password" class="input-block-level" style="width:180px" placeholder="Password">
        <a href="#" onclick="resetpassword('http://<?php echo $_SERVER['HTTP_HOST']?>/login/reset')" style="margin-left:15px"><font size=4>忘记密码</font></a>
        <?php echo form_error('password', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
        <label class="checkbox">
          <input type="checkbox" name="remember-me" checked="checked" value="1"> Remember me
        </label>
        <div style="height:60px">
        <button class="btn btn-large btn-primary" type="submit" style="margin-right:10px;">登录</button>
        <!-- <button class="btn btn-large btn-info" type="button" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']?>/register'" style="margin-right:10px;">注册</button> -->
         <a class="btn btn-success btn-large" title="运维文档" target='_blank' href="http://ops.xkeshi.so/faq/" >常用文档</a>
        </div>
      </form>
    </div> <!-- /container -->
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script>
        function resetpassword(url) {
          layer.open({
          title: false,
          type: 2,
          skin: 'layui-layer-demo', //样式类名
          area: ['550px', '401px'],
          content: [url]
        });
      }//重置密码
        $(function() {
            
        });
        </script>
  </body>
</html>