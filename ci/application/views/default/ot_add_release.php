<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; left:50px; right:50px;top:0px; width:80%; height:80%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
                    <?php
                        $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
                        echo form_open('ot/add_release', $attributes);

                    ?>
                </div>   
                
                <div class="control-group">
                  <label class="control-label">发布说明<span class="required">*</span></label>
                  <div class="controls">
                  <?php echo form_error('release_shuoming', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input type="text" name="release_shuoming" id="release_shuoming" style="width:300px; margin-right:20px; data-required="1" class="span2 m-wrap"/>
                  </div>
                </div>          
                <div class="control-group">
                  <label class="control-label">发布日期<span class="required">*</span></label>
                  <div class="controls">
                 <input class="laydate-icon" name="release" id="release" style="width:300px; margin-right:20px;" />
            </div>
            </div>
    <div class="form-actions">
                  <button type="submit" class="btn btn-primary">确定</button>
                  <button type="button" class="btn" onclick="close_frame()">取消</button>
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
  <script type="text/javascript" src="<?php echo base_url();?>laydate/laydate.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
 <script>
      var release = {
        elem: '#release',
        format: 'YYYY-MM-DD',
        min: laydate.now(-31),
        max: laydate.now(+31),
        istime: false,
        isclear: false, //是否显示清空
        istoday: false,

        };
      laydate(release);
      function close_frame() {  
      var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
      parent.layer.close(index);
      }
 </script>