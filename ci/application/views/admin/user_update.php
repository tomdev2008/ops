<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; top:0px; width:470px; height:550px;">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">修改账号信息</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/user/update', $attributes);
    echo form_hidden('user_id', $user_id);
    echo '<br>';
?>
    <fieldset>
    <div class="control-group">
                  <label class="control-label">email<span class="required">*</span></label>
                  <div class="controls">
                  <input type="text" name="email" readonly data-required="1" style="width:200px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $email;?>" />
            </div>
                </div>  
    <div class="control-group">
                  <label class="control-label">姓名<span class="required">*</span></label>
                  <div class="controls">
                  <input type="text" name="name" readonly data-required="1" style="width:200px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $name;?>" />
            </div>
                </div>
                <div class="control-group">
                  <label class="control-label">员工所属组<span class="required">*</span></label>
                  <div class="controls">
                    <select class="span6 m-wrap" name="level_id" style="width:150px">
                      <!--<option value="">Select...</option>-->
                      <?php 
                      foreach ($user_level_list as $key => $value) { 
                            if ($value->id == $level_id) {
                        ?>    
                      <option selected value="<?php echo $value->id?>"><?php echo $value->level_name?></option>
                        <?php 
                          }
                          else if ($value->id != $level_id) { 
                        ?>
                        <option value="<?php echo $value->id?>"><?php echo $value->level_name?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>    
                <div class="control-group">
                  <label class="control-label">组长<span class="required">*</span></label>
                  <div class="controls">
                    <select class="span6 m-wrap" name="group_leader" style="width:150px">
                      <!--<option value="">Select...</option>-->
                      <?php 
                            if ($group_leader == 1) {
                        ?>    
                      <option selected value="1"><?php echo '是'?></option>
                      <option value="0"><?php echo '否'?></option>
                        <?php 
                          }
                          else if ($group_leader != 1) { 
                        ?>
                      <option value="1"><?php echo '是'?></option>
                      <option selected value="0"><?php echo '否'?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>   
    <div class="control-group">
                  <label class="control-label">手机<span class="required">*</span></label>
                  <div class="controls">
                  <?php echo form_error('tel', '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>请输入！</strong>', '</div>'); ?>
                  <input type="text" name="tel" data-required="1" style="width:200px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $tel;?>" />
            </div>
                </div>  
    <div class="control-group">
                  <label class="control-label">QQ</label>
                  <div class="controls">
                  <input type="text" name="qq" data-required="1" style="width:200px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $qq;?>" />
            </div>
                </div>          
    <div class="form-actions">
                  <button type="submit" class="btn btn-primary">确定</button>
                  <button type="button" class="btn" onclick="close_frame()">取消</button>
                </div>
          </fieldset>
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