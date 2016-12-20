<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; top:0px ;left:30px; right:50px; width:90%; height:90%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><?php echo $title?></div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/container/jenkins', $attributes);
    echo form_hidden('hidden_server_name', $hidden_server_name);
    echo '<br>';
?>
                                        <fieldset>                                          
                                                <div class="control-group">
                                                <label class="control-label">项目名称</label>
                                                <div class="controls">
                                                <input style="width:300px; margin-right:10px;" class="span2 m-wrap" type="text" name="server_name" readonly="readonly" value="<?php echo $hidden_server_name?>">
                                                </div>
                                            </div>
                                              <div class="control-group">
                                                <label class="control-label">仓库类型</label>
                                                <div class="controls">
                                                  <select class="span6 m-wrap" name="repo_type" style="width:300px; margin-right:10px;">
                                                  <?php 
                                                          if ($hidden_repo_type == "svn") {
                                                      ?>   
                                                    <option value="git">git</option> 
                                                    <option selected value="svn">svn</option>
                                                    <option value="ftp">ftp</option> 
                                                      <?php 
                                                        }
                                                        else { 
                                                      ?>
                                                      <option selected value="git">git</option>
                                                      <option value="svn">svn</option>
                                                      <option value="ftp">ftp</option>
                                                      <?php } ?>
                                                  </select>
                                                </div>
                                            </div>
                                            <?php 
                                            if (empty($hidden_repo_url)) {
                                                ?>
                                                <div class="control-group">
                                                <label class="control-label">仓库地址<span class="required"></span></label>
                                                <div class="controls">
                                                    <input style="width:300px; margin-right:10px;" class="span2 m-wrap" name="repo_url" type="text">
                                                </div>
                                            </div>
                                            <?php  
                                            } else {
                                            ?>
                                                <div class="control-group">
                                                <label class="control-label">仓库地址<span class="required">已添加</span></label>
                                                <div class="controls">
                                                <?php echo form_error('repo_url', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                                    <input style="width:300px; margin-right:10px;" class="span2 m-wrap" name="repo_url" type="text" value="<?php echo $hidden_repo_url?>">
                                                </div>
                                            </div>  
                                            <?php
                                            }
                                            ?>   
                                            <?php 
                                            if (empty($hidden_ops_war_name)) {
                                                ?>
                                                <div class="control-group">
                                                <label class="control-label">war包名称<span class="required"><br>如有多个请用英文逗号隔开</span></label>
                                                <div class="controls">
                                                    <input style="width:300px; margin-right:10px;" class="span2 m-wrap" name="ops_war_name" type="text">
                                                </div>
                                            </div>
                                            <?php  
                                            } else {
                                            ?>
                                                <div class="control-group">
                                                <label class="control-label">war包名称<span class="required">已添加<br>如有多个请用英文逗号隔开</span></label>
                                                <div class="controls">
                                                <?php echo form_error('ops_war_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                                    <input style="width:300px; margin-right:10px;" class="span2 m-wrap" name="ops_war_name" type="text" value="<?php echo $hidden_ops_war_name?>">
                                                </div>
                                            </div>  
                                            <?php
                                            }
                                            ?>   
                                            <?php 
                                            if (empty($hidden_ops_dubbo_port)) {
                                                ?>
                                                <div class="control-group">
                                                <label class="control-label">dubbo端口<span class="required">*</span></label>
                                                <div class="controls">
                                                    <input style="width:300px; margin-right:10px;" class="span2 m-wrap" name="ops_dubbo_port" type="text">
                                                </div>
                                            </div>
                                            <?php  
                                            } else {
                                            ?>
                                                <div class="control-group">
                                                <label class="control-label">dubbo端口<span class="required">已添加</span></label>
                                                <div class="controls">
                                                <?php echo form_error('ops_dubbo_port', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                                    <input style="width:300px; margin-right:10px;" class="span2 m-wrap" name="ops_dubbo_port" type="text" value="<?php echo $hidden_ops_dubbo_port?>">
                                                </div>
                                            </div>  
                                            <?php
                                            }
                                            ?>  
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
  <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
        <script type="text/javascript">
      function close_frame() {  
      var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
      parent.layer.close(index);
      }
        </script>