<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; top:0px; width:470px; height:550px;">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">修改用户权限</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/rbac/update', $attributes);
    echo form_hidden('user_id', $user_id);
    echo '<br>';
?>
    <fieldset>
    <div class="control-group">
                  <label class="control-label">email</label>
                  <div class="controls">
                  <input type="text" name="email" readonly data-required="1" style="width:200px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $email;?>" />
            </div>
                </div>  
    <div class="control-group">
                  <label class="control-label">姓名</label>
                  <div class="controls">
                  <input type="text" name="name" readonly data-required="1" style="width:200px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $name;?>" />
            </div>
                </div>
                <div class="control-group">
                  <label class="control-label">员工所属组</label>
                  <div class="controls">
                    <select class="span6 m-wrap" name="level_id" style="width:150px" disabled>
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
                  <label class="control-label">角色</label>
                  <div class="controls">
                    <select class="span6 m-wrap" name="role_id" style="width:150px">
                      <!--<option value="">Select...</option>-->
                      <?php 
                      foreach ($user_role_list as $key => $value) { 
                            if ($value->id == $role_id) {
                        ?>    
                      <option selected value="<?php echo $value->id?>"><?php echo $value->role_name?></option>
                        <?php 
                          }
                          else if ($value->id != $role_id) { 
                        ?>
                        <option value="<?php echo $value->id?>"><?php echo $value->role_name?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>   
    <div class="control-group">
                  <label class="control-label">配置中心</label>
                  <div class="controls">
                  <?php                      
                    if ($disconfig == 1) {
                    ?>
                    <input type="checkbox" checked name="disconfig" value="1">
                    <?php
                     } else {
                     ?><input type="checkbox" name="disconfig" value="1">
                      <?php
                      }
                    ?>
            </div>
                </div>  
    <div class="control-group">
                  <label class="control-label">数据库查询</label>
                  <div class="controls">
                  <?php                      
                    if ($db == 1) {
                    ?>
                    <input type="checkbox" checked name="db" value="1"> 
                    <?php
                     } else {
                     ?><input type="checkbox" name="db" value="1">
                      <?php
                      }
                    ?>
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
  <script type="text/javascript" src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/scripts.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
 <script>

      function close_frame() {  
      var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
      parent.layer.close(index);
      }

 </script>