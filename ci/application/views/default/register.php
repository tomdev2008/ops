<div class="span9" id="content" style=" position:absolute; left:30%; top:20%;">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">注册账号</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
 <?php
    // $onsubmit = array('' => , );
    $attributes = ['class' => 'form-horizontal', 'id' => 'resform' ,'onsubmit' => 'return buttoncheck()'];
    echo form_open('register',$attributes);
?>
    <fieldset>
      <div style="margin-left: 15%">
      <div class="control-group">
          <label class="control-label"><strong>所属部门</strong><span class="required">*</span></label>
            <div class="controls">
                <select class="span6 m-wrap" name="level_id" id="level" style="width:250px">
                  <option value="" selected>--请选择部门--</option>
                  <?php foreach ($get_level_id as $value) {?>
                    <option value="<?php echo $value->id?>">
                    <?php echo $value->level_name?>
                    </option>
                    <?php }?>
                </select>
              </div>
          </div>
        <div class="control-group">
          <label class="control-label"><strong>姓名(中文)</strong><span class="required">*</span></label>
            <div class="controls">
                      <input type="text" style="width:250px;height:30px" name="name" id="name" data-required="1" class="span2 m-wrap"/>
              </div>
          </div>
          <div class="control-group">
          <label class="control-label">
          <strong>账号( 英文 )<span class="required">*</span><br>( 姓名全拼或首字母 )</strong>
          </label>
              <div class="controls">
                  <input type="text" style="width:150px;height:30px" name="email" id="email" data-required="1" class="span2 m-wrap"/>
                  <input type="text" value="@xkeshi.com" style="width:100px;height:30px" name="email_end" id="email_end" readonly/>
                  <span class="label label-important" id="warning" style="display:none"><i class="icon-remove icon-white"></i></span>
                  <span class="label label-success" id="success" style="display:none"><i class="icon-ok icon-white"></i></span>
              </div>
          </div>
          <div class="control-group">

          <label class="control-label">
          <strong>账号密码<span class="required">*</span><br></strong>
          </label>
              <div class="controls">
                  <input type="password" style="width:250px;height:30px" id="password1" name="password1" data-required="1" class="span2 m-wrap"/>
                      <!-- 【 密码不少于6位且由数字和字母组成 】 -->
              </div>
          </div>
          <div class="control-group">
          <label class="control-label">
          <strong>再输入一次密码<span class="required">*</span><br></strong>
          </label>
            <div class="controls">
                  <input type="password" style="width:250px;height:30px" id="password2" name="password2" data-required="1" class="span2 m-wrap"/>
                      <!-- 【 两次密码输入要求相同一致 】 -->
              </div>
          </div>
          <div class="control-group">
          <label class="control-label">
          <strong>手机号<span class="required">*</span><br></strong>
          </label>
            <div class="controls">
                      <input class="span2 m-wrap" name="tel" id="tel" type="text" data-required="1" style="width:250px;height:30px"   />
              </div>
          </div>
          <div class="control-group">
            <label class="control-label">
              <strong>验证码( 英文 )<span class="required">*</span><br>【点击图片刷新】</strong>
            </label>
              <div class="controls">
                <input type="text" name="captcha" id="captcha" style="width:150px;height:30px"/>
                <img id="checkpic" src="/register/captcha" onclick="changing();" title="看不清，点击刷新"/>
              </div>
          </div>
          </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary" id="btn" style="margin-left: 20%" onclick="return from_check()">确认</button>
                  <button type="button" class="btn" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']?>' ">取消</button>
                </div>
          </fieldset>
        </form>
    </div>
          </div>
      </div>
      </div>
                      <!-- /block  -->
        </div>
                     <!-- /validation -->
                </div>
  <!-- External CSS -->
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
  <!-- Javascript -->
  <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/scripts.js"></script>
  <script src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
  <script src="<?php echo base_url();?>layer/layer.js"></script>
  
  <script type="text/javascript">
      // 验证码打印
      function changing(){
         document.getElementById('checkpic').src="/register/captcha?"+Math.random();
      }
      // 邮箱验证
      var res = 0
      $("#email").on('change',function(val){
        //console.log($(this).val()+'@xkeshi.com');
        $.ajax({
          //url:"/register/check_email?email=" + $(this).val() + $("#email_end").val(),
          url:"/register/check_email?email=" + $(this).val() + '@xkeshi.so',
          type:"GET",
          success:function(data) {
            if (data == 0) {
                res = 1;
                layer.msg('账号可用！', {time: 2000,icon: 1});
                document.getElementById("success").style.display="";//显示
                document.getElementById("warning").style.display="none";//隐藏
                
            }else{
                res = 0;
                $("#email").focus();
                layer.msg('账号已存在，请重新输入！', {time: 2000,icon: 1});
                document.getElementById("success").style.display="none";//隐藏
                document.getElementById("warning").style.display="";//显示
            }
          }
        })
      })
      // 密码验证规则
      $("#password1").on('keyup',function(val){
        $.ajax({
          url:"register/password_check?password=" + $(this).val(),
          success:function(data){
            if (data == "1" && $('#password1').val().length >= 6) {
              // 清除元素
              $("#password_warning").empty();
              $("#password_success").empty();
              // 添加正确提醒元素
              $("#password1").after('<span class="label label-success" id="password_success"><i class="icon-ok icon-white"></i></span>');
            }
            else{
              // 焦点回归
              $("#password1").focus();
              // 清除元素
              $("#password_warning").empty();
              $("#password_success").empty();
              // 添加错误提醒元素
              $("#password1").after('<span class="label label-important" id="password_warning"><i class="icon-remove icon-white"></i></span>');
            }
          }
        });
      })
      // 密码规则提醒
      $("#password1").on('change',function(val){
        $.ajax({
          url:"register/password_check?password=" + $(this).val(),
          success:function(data){
            if (data == "1" && $('#password1').val().length >= 6) {
              // layer提示框
              layer.msg('密码可用！', {time: 2000,icon: 1});
            }
            else{
              // layer提示框
              layer.msg('密码必须由字母和数字组成，且大于等于六位！', {time: 2000,icon: 1});
            }
          }
        });
      })
      // 确认密码核对
      $("#password2").on('change',function(val){
        if ($('#password1').val() != $(this).val()) {
          // 焦点回归
          $("#password2").focus();
          // layer提示框
          layer.msg('2次密码输入不一致！', {time: 2000,icon: 1});
          // 清除元素
          $("#password2_warning").empty();
          $("#password2_success").empty();
          // 添加错误提醒元素
          $("#password2").after('<span class="label label-important" id="password2_warning"><i class="icon-remove icon-white"></i></span>');
        }
        else{
          // 清除元素
          $("#password2_warning").empty();
          $("#password2_success").empty();
          // 添加正确提醒元素
          $("#password2").after('<span class="label label-success" id="password2_success"><i class="icon-ok icon-white"></i></span>');
        }
      })
      // 验证码验证
      $("#captcha").on('keyup',function(val) {
        $.ajax({
            url:"/register/captcha_check?captcha=" + $(this).val(),
            type:"GET",
            success:function(data) {
              if (data == "1") {
                // 清除元素
                $("#captcha_warning").empty();
                $("#captcha_success").empty();
                // 添加正确提醒元素
                $("#captcha").after('<span class="label label-success" id="captcha_success"><i class="icon-ok icon-white"></i></span>');
              }
              if (data == "0"){
                // 焦点回归
                $("#captcha").focus();
                // 清除元素
                $("#captcha_warning").empty();
                $("#captcha_success").empty();
                // 添加错误提醒元素
                $("#captcha").after('<span class="label label-important" id="captcha_warning"><i class="icon-remove icon-white"></i></span>');
              }
            }
          });
      })
      // 按钮提交控制
      function buttoncheck(){
        $('#btn').on('click',function(){
          $("#btn").attr("disabled", true);
            setTimeout(function(){
              $("#btn").attr("disabled", false);
            },3000);
            return true;
        });
      }
      // 表单验证
      function from_check() {
        var level = $('#level')
        var name = $('#name')
        var email = $('#email')
        var password1 = $('#password1')
        var password2 = $('#password2')
        var captcha = $('#captcha')
        var r = /^(?![^a-zA-Z]+$)(?!\D+$)/
        var tel = $('#tel')
        var t = /^1(3|4|5|7|8)\d{9}$/
        if (level.val() == "") {
            layer.msg('请选择部门！', {time: 2000,icon: 1});
            return false;
        }
        if (name.val() == "") {
          layer.msg('请输入姓名！', {time: 2000,icon: 1});
          name.focus();
          return false;
        }
        if (email.val() == "") {
          email.focus();
          layer.msg('请输入账号！', {time: 2000,icon: 1});
          return false;
        }
        if (res == 0){
          layer.msg('账号已存在，请重新输入！', {time: 2000,icon: 1});
          return false;
        }
        if(password1.val().length < 6){
          password1.focus();
          layer.msg('密码输入小于6位，请重新输入！', {time: 2000,icon: 1});
          return false;
        }
        if (!password1.val().match(r)){
          password1.focus();
          layer.msg('密码必须由字母和数字组成，请重新输入！', {time: 2000,icon: 1});
          return false;
        }
        if (password1.val() != password2.val()){
          password2.focus();
          layer.msg('2次密码输入不一致！', {time: 2000,icon: 1});
          return false;
        }
        if (!tel.val().match(t)) {
          tel.focus();
          layer.msg('请输入正确的手机号码！', {time: 2000,icon: 1});
          return false;
        }
        if (captcha.val() == "") {
          captcha.focus();
          layer.msg('请输入验证码！', {time: 2000,icon: 1});
          return false;
        }
        if (res == 1) {
          var r
          $.ajax({
            url:"/register/captcha_check?captcha="+captcha.val(),
            type:"GET",
            success:function(data) {
              if (data == "1") {
                 $('#resform')[0].submit();//表单提交
              }
              else if (data == "0"){
                layer.msg('验证码错误，请重试！', {time: 2000,icon: 1});
              }
            }
          });
          return false;
        }
      }
  </script>