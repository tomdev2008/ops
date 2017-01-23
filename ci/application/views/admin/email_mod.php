 <div class="span9" id="content" style=" position:absolute; top:10px; width:470px; height:550px;">
    <!-- validation -->
    <div class="row-fluid">
       <!-- block -->
       <div class="block" >
          <div class="navbar navbar-inner block-header">
              <div class="muted pull-left">修改邮箱信息</div>
          </div>
          <div class="block-content collapse in">
            <div class="span12">
            <?php
                $attributes = ['class' => 'form-horizontal', 'id' => 'email_update'];
                echo form_open('admin/email/email_update', $attributes);
                $email = $this->input->get("email");
                $info = $this->email_model->get_account_info($email);
                $name = $info['Name'];
                $sex = $info['Gender'];
                $position = $info['Position'];
                $mobile = $info['Mobile'];
                $tel = $info['Tel'];
                $partylist = $info['PartyList']['List'][0]['Value'];
                $gender = [
                  0 => "未设置",
                  1 => "男",
                  2 => "女",
                ];
            ?>
              <fieldset>
                <div class="control-group">
                  <label class="control-label">email<span class="required">*</span></label>
                  <div class="controls">
                    <input class="span2 m-wrap" type="text" name="email" style="width:200px; margin-right:10px;" value="<?php echo $email;?>" readonly/>
                </div>
                </div>
                <div class="control-group">
                  <label class="control-label">姓名<span class="required">*</span></label>
                  <div class="controls">
                    <input class="span2 m-wrap" type="text" name="name" style="width:200px; margin-right:10px;" value="<?php echo $name;?>"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">性别</label>
                  <div class="controls">
                    <input class="span2 m-wrap" type="text" name="sex" style="width:200px; margin-right:10px;" value="<?php echo $gender[$sex];?>"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">职位</label>
                  <div class="controls">
                    <input class="span2 m-wrap" type="text" name="position" style="width:200px; margin-right:10px;" value="<?php echo $position;?>"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">电话</label>
                  <div class="controls">
                    <input class="span2 m-wrap" type="text" name="tel" style="width:200px; margin-right:10px;" value="<?php echo $tel;?>"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">手机</label>
                  <div class="controls">
                    <input class="span2 m-wrap" type="text" name="mobile" style="width:200px; margin-right:10px;" value="<?php echo $mobile;?>"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">员工所属部门<span class="required">*</span></label>
                  <div class="controls">
                    <input class="span2 m-wrap" type="text" name="partypath" style="width:200px; margin-right:10px;" value="<?php echo $partylist;?>"/>
                  </div>
                </div>    
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">确定</button>
                  <button type="button" class="btn" onclick="">取消</button>
                </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!-- /block -->
</div>
<!-- /validation -->
</div>

<!--/.fluid-container-->
  <script src="http://ops.xkeshi.so/vendors/jquery-1.9.1.min.js"></script>
  <script src="http://ops.xkeshi.so/assets/scripts.js"></script>
  <script src="http://ops.xkeshi.so/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="http://ops.xkeshi.so/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/assets/styles.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
 <script>
      function close_frame() {  
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        parent.layer.close(index);
      }
 </script>