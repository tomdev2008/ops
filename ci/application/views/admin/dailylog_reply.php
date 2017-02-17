<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; top:0px ;left:30px;right:50px; width:90%; height:90%">
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
    echo form_open('admin/dailylog/reply', $attributes);
    echo form_hidden('id', $id);
    echo form_hidden('daily_text', $daily_text);
    echo form_hidden('daily_content', $daily_content);
    echo '<br>';
?>
    <fieldset>
    <div class="control-group">
    <label class="control-label">工作标题</label>
    <div class="controls">
      <input type="text" name="daily_content" data-required="1" style="width:350px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $daily_content;?>" />
            </div>
                </div>
    <br> 
    <div class="control-group">
                  <label class="control-label">工作内容<span class="required">*</span></label>
                  <div class="controls">
                  <textarea name="daily_text" class="form-control textarea-wysihtml5" placeholder="Enter text..." style="width: 80%; height: 200px"><?php echo $daily_text;?></textarea>
            </div>
                </div>
    <br>  
    <div class="form-actions">
                  <button type="submit" class="btn btn-primary">确定</button>
                  <button type="button" class="btn" onclick="close_frame()">取消</button>
                </div>
                <br> <br> 
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