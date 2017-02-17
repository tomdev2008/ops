<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; top:100px ;left:50px; right:50px;top:0px; width:90%; height:90%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">修改常用链接信息</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/gallery/update', $attributes);
    echo form_hidden('id', $id);
    echo form_hidden('platform_id', $platform_id);
    echo '<br>';
?>
    <fieldset>
   <?php 
   foreach ($gallery as $key => $value) {                                                             
     ?>   
    <div class="control-group">
                  <label class="control-label">分组<span class="required">*</span></label>
                  <div class="controls">
                    <select class="span6 m-wrap" name="platform_id" style="width:200px; margin-right:10px;">
                    <?php 
                      foreach ($get_platform_name as $key => $va) { 
                            if ($va->id == $value->gallery_platform_id) {
                        ?>    
                      <option selected value="<?php echo $va->id?>"><?php echo $va->gallery_name?></option>
                        <?php 
                          }
                          else if ($va->id != $value->gallery_platform_id) { 
                        ?>
                        <option value="<?php echo $va->id?>"><?php echo $va->gallery_name?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
            </div> 
    <div class="control-group">
                  <label class="control-label">名称<span class="required">*</span></label>
                  <div class="controls">
                  <input type="text" name="name" data-required="1" style="width:200px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $name;?>" />
            </div>
                </div>
    <div class="control-group">
                  <label class="control-label">网址<span class="required">*</span></label>
                  <div class="controls">
                  <input type="text" name="url" data-required="1" style="width:200px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $url;?>" />
            </div>
                </div>   
    <div class="control-group">
                  <label class="control-label">负责人</label>
                  <div class="controls">
                  <input type="text" name="user_name" data-required="1" style="width:200px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $user_name;?>" />
            </div>
                </div>       
    <div class="form-actions">
                  <button type="submit" class="btn btn-primary">确定</button>
                  <button type="button" class="btn" onclick="close_frame()">取消</button>
                </div>
    <?php                                                               
    } ?>
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
  <script src="<?php echo base_url();?>chosen_v1.6.2/chosen.jquery.js"></script>
 <script>

      function close_frame() {  
       var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
      parent.layer.close(index);
      }

 </script>