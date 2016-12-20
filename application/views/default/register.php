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
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1' ,'onsubmit' => 'return buttoncheck()'];
    echo form_open('register',$attributes);
?>
    <fieldset>
      <div class="control-group">
          <label class="control-label"><strong>所属部门</strong><span class="required">*</span></label>
            <div class="controls">
               <?php echo form_error('level_id', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
                <select class="span6 m-wrap" name="level_id" style="width:250px">
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
                      <input type="text" style="width:250px;height:30px" name="name" data-required="1" class="span2 m-wrap"/>
                      <?php echo form_error('name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
              </div>
          </div>
          <div class="control-group">
          <label class="control-label">
          <strong>账号<span class="required">*</span><br>( 姓名全拼或首字母 )</strong>
          </label>
            <div class="controls">
                      <input type="text" style="width:150px;height:30px" name="email" data-required="1" class="span2 m-wrap"/>
                      <?php echo form_error('email', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
                      <input type="text" value="@xkeshi.com" style="width:100px;height:30px" name="email_end" data-required="1" class="span2 m-wrap" readonly/>
                      <?php echo form_error('email_end', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
              </div>
          </div>
          <div class="control-group">
          <label class="control-label">
          <strong>账号密码<span class="required">*</span><br></strong>
          </label>
            <div class="controls">
                      <input type="password" style="width:250px;height:30px" id="password1" name="password1" data-required="1" class="span2 m-wrap"/>
                      【 密码不少于6位且由数字和字母组成 】
                      <?php echo form_error('password1', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
              </div>
          </div>
          <div class="control-group">
          <label class="control-label">
          <strong>再输入一次密码<span class="required">*</span><br></strong>
          </label>
            <div class="controls">
                      <input type="password" style="width:250px;height:30px" id="password2" name="password2" data-required="1" class="span2 m-wrap"/>
                      【 两次密码输入要求相同一致 】
                      <?php echo form_error('password2', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
              </div>
          </div>
          <div class="control-group">
          <label class="control-label">
          <strong>手机号<span class="required">*</span><br></strong>
          </label>
            <div class="controls">
                      <input type="text" style="width:250px;height:30px" name="tel" id="tel" data-required="1" class="span2 m-wrap"/>
                      <?php echo form_error('tel', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
              </div>
          </div>
          <div class="control-group">
            <label class="control-label">
              <strong>验证码<span class="required">*</span><br>( 英文 )</strong>
            </label>
              <div class="controls">
                <input type="text" name="captcha" style="width:150px;height:30px"/>
                <?php echo form_error('captcha', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>');?>
                <img id="checkpic" src="/register/captcha" onclick="changing();" title="看不清，点击刷新"/>
              </div>
          </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary" id="btn" onclick="return check();">确认</button>
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
  <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/scripts.js"></script>
  <script src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
  <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
  <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
  <script type="text/javascript">
      // function checkpic(){
      //       var captcha = <?php echo $this->session->userdata('captcha')?>
      //       var checkpic = $('#checkpic').val
      //       if (captcha.val() == checkpic.val()) {
      //         return true;
      //       }
      //       else{
      //         alert("验证码错误，请重试！");
      //         return false;
      //       }
      // }
      function changing(){
         document.getElementById('checkpic').src="/register/captcha?"+Math.random();
      }
      function buttoncheck(){
        $('#btn').on('click',function(){
          $("#btn").attr("disabled", true);
            setTimeout(function(){
              $("#btn").attr("disabled", false);
            },3000);
            return true;
        });
      }
      function check(){
        var password1 = $('#password1')
        var password2 = $('#password2')
        var r = /^(?![^a-zA-Z]+$)(?!\D+$)/
        var tel = $('#tel')
        var t = /^1(3|4|5|7|8)\d{9}$/
        if (password1.val() != password2.val())
          {
            alert("2次密码输入不一致！");
            return false;
          }
          else if(password1.val() == password2.val())
          {
            if (password1.val().length > 6 || password1.val().length == 6) {
                  if (password1.val().match(r))
                  {
                      if (tel.val().match(t)) {
                        return true;
                      }
                      else{
                        alert("请输入正确的手机号码！");
                        return false;
                      }
                  }
                  else
                  {
                    alert("密码必须由字母和数字组成，请重新输入！");
                    return false;
                  }
            }
            else if(password1.val().length < 6){
              alert("密码输入小于6位，请重新输入！");
              return false;
            }
          }
      }//密码和手机号验证
  </script>