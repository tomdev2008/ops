<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; top:0px ;left:30px; right:50px; width:90%; height:90%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">绑定域名</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/container/domain', $attributes);
    echo form_hidden('hidden_app_name', $hidden_app_name);
    echo form_hidden('app_domain', $app_domain);
    echo form_hidden('hidden_app_domain', $hidden_app_domain);
    echo '<br>';
?>
                                        <fieldset>                                          
                                                <div class="control-group">
                                                <label class="control-label">app名称</label>
                                                <div class="controls">
                                                <input style="width:250px; margin-right:10px;" class="span2 m-wrap" type="text" name="app_name" readonly="readonly" value="<?php echo $hidden_app_name?>">
                                                </div>
                                            </div>
                                            <?php 
                                            if (empty($hidden_app_domain)) {
                                                ?>
                                                <div class="control-group">
                                                <label class="control-label">app域名<span class="required">*</span></label>
                                                <div class="controls">
                                                <?php echo form_error('app_domain', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                                    <input style="width:300px; margin-right:10px;" class="span2 m-wrap" name="app_domain" type="text" value="<?php echo $app_domain?>">
                                                </div>
                                            </div>
                                            <?php  
                                            } else {
                                            ?>
                                                <div class="control-group">
                                                <label class="control-label">app域名<span class="required">已绑定</span></label>
                                                <div class="controls">
                                                <?php echo form_error('app_domain', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                                    <input style="width:300px; margin-right:10px;" class="span2 m-wrap" name="app_domain" type="text" readonly value="<?php echo $app_domain?>">
                                                </div>
                                            </div>  
                                            <?php
                                            }
                                            ?>

                                                <div class="control-group">
                                                <label class="control-label">app域名别名</label>
                                                <div class="controls">
                                                    <input style="width:250px; margin-right:10px;" class="span2 m-wrap" name="app_domain_alias" type="text" >
                                                </div>
                                            </div>   
                                            <?php 
                                            if (empty($hidden_app_domain)) {
                                                ?>
                                            <div class="form-actions">
                                              <button type="submit" class="btn btn-primary">确定</button>
                                              <button type="button" class="btn" onclick="close_frame()">取消</button>
                                            </div>
                                            <?php  
                                            } else {
                                            ?>
                                            <div class="form-actions">
                                              <button type="button" class="btn btn-primary" onclick="close_frame()">确定</button>
                                              <button type="button" class="btn" onclick="close_frame()">取消</button>
                                            </div>
                                            <?php
                                            }
                                            ?>                                     
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
  <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
        <script type="text/javascript">
      function close_frame() {  
      var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
      parent.layer.close(index);
      }
        </script>