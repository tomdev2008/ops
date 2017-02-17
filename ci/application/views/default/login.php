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
  </head>
  <body id="login">
   <!-- <div class="alert alert-warning" style ="margin-top:-130px;height:130px">
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
      </div> -->
    <div class="container">
<?php
    $attributes = ['class' => 'form-signin', 'id' => 'loginform'];
    echo form_open('login', $attributes);
    $redirect_hidden_value = $this->input->get('redirect', TRUE) ? $this->input->get('redirect', TRUE) : $this->input->post('redirect');
    echo form_hidden('redirect', $redirect_hidden_value);
?>
        <h2 class="form-signin-heading"><?php echo $title?></h2>
        <div class="input-append">
            <input class="span2" type="text" name="username" id="username" value="<?php echo get_cookie('cookie_username'); ?>" placeholder="Email address">
              <span class="add-on" style="padding: 7px 9px;">@xkeshi.com</span>
        </div>
            <input class="input-block-level" type="password" name="password" id="password" style="width:180px" placeholder="Password">
            <a href="javascript:;" onclick="resetpassword('/login/reset')" style="margin-left:15px"><font size=4>忘记密码</font></a>
            <div class="alert alert-error" id="alert" style="display: none">
              <button type="button" class="close" data-dismiss="alert">×</button>密码错误
            </div>
            <label class="checkbox">
              <input type="checkbox" name="remember-me" checked="checked" value="1"> Remember me
            </label>
        <div style="height:60px">
        <button type="submit" class="btn btn-large btn-primary" id="btn" style="margin-right:10px;" onclick="return from_check()">
        登录</button>
        <!-- <button class="btn btn-large btn-info" type="button" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']?>/register'" style="margin-right:10px;">注册</button> -->
         <a class="btn btn-success btn-large" title="运维文档" target='_blank' href="http://ops.xkeshi.so/faq/" >常用文档</a>
        </div>
      </form>
    </div> 
        <!-- /container -->
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script type="text/javascript">
        // 重置密码弹出层
        function resetpassword(url) {
            layer.open({
            title: false,
            type: 2,
            skin: 'layui-layer-demo', //样式类名
            area: ['550px', '401px'],
            content: url
          });
        }
        // 账号验证
        $("#username").on('change',function () {
          $.ajax({
            url:"login/passwordvalidate?account=" + $("#username").val() + "@xkeshi.com&password=" + $("#password").val(),
            type:"GET",
            success:function(data){
                if(data == 0){
                  layer.msg('账号不存在或人员已离职，请重新输入！', {time: 2000,icon: 1});
                  $("#username").focus(); 
                }
              }
            });
          })
        // 表单验证
        function from_check() {
          var username = $('#username')
          var password = $('#password')
          var alert = $('#alert')
          var close = $("#close")
          if (username.val() == "") {
              layer.msg('请输入账号！', {time: 2000,icon: 1});
              username.focus();
              return false;
          }
          if (password.val() == "") {
            layer.msg('请输入密码！', {time: 2000,icon: 1});
            password.focus();
            return false;
          }
          if (username.val() != "" && password.val() != "") {
            $.ajax({
              url:"/login/passwordvalidate?account=" + $("#username").val() + "@xkeshi.com&password=" + $("#password").val(),
              type:"GET",
              success:function(data){
                if (data == "success") {
                   $("#loginform")[0].submit();//表单提交
                }
                else{
                  if(data == "0"){
                    layer.msg('账号不存在或人员已离职，请重新输入！', {time: 2000,icon: 1});
                    $("#username").focus(); 
                  }
                  if (data == "1") {
                    alert.show();
                    //layer.msg('密码错误，请重新输入！', {time: 2000,icon: 1});
                    $("#password").focus();
                  }
                }
              }
            });
            return false;
          }
        }
        // 关闭密码错误提示
        // $("#close").click(function () {
        //     alert.hide();
        // })
        </script>
  </body>
</html>