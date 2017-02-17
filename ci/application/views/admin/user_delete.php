<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; top:100px ;left:50px; right:50px;top:0px; width:90%; height:90%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">修改人员加班信息</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('ot/make_view', $attributes);
    echo form_hidden('name_id', $name_id);
    echo form_hidden('ot_date', $ot_date);
    echo form_hidden('start_time1', $start_time1);
    echo form_hidden('end_time1', $end_time1);
    echo '<br>';
?>
    <fieldset>
    <div class="control-group">
                  <label class="control-label">姓名<span class="required">*</span></label>
                  <div class="controls">
                  <input type="text" name="name" data-required="1" style="width:200px; margin-right:10px;" readonly class="span2 m-wrap" value="<?php echo $name;?>" />
            </div>
                </div>
                <?php echo '<br>';?>
    <div class="control-group">
                  <label class="control-label">发布日期<span class="required">*</span></label>
                  <div class="controls">
                  <input type="text" name="release_date" data-required="1" style="width:200px; margin-right:10px;" readonly class="span2 m-wrap" value="<?php echo $ot_date;?>" />
            </div>
                </div>  
                <?php echo '<br>';?>              
          <div class="control-group">
                  <label class="control-label">开始时间<span class="required">*</span></label>
                  <div class="controls">
                 <input class="laydate-icon" name="start_time" id="start" value="<?php echo $start_time1;?>" style="width:200px; margin-right:10px;" />
            </div>
                </div>
                <?php echo '<br>';?>
        <div class="control-group">
                  <label class="control-label">结束时间<span class="required">*</span></label>
                  <div class="controls">
                 <input class="laydate-icon" name="end_time" id="end" value="<?php echo $end_time1;?>" style="width:200px;" />
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
  <script type="text/javascript" src="<?php echo base_url();?>laydate/laydate.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
 <script>

        var start = {
          elem: '#start',
          format: 'YYYY/MM/DD hh:mm:ss',
          min: laydate.now(-31), //设定最小日期为当前日期
          max: laydate.now(), //最大日期
          start: '<?php echo $time_now =date("Y-m-d H:i:s");?>',  //开始日期
          istime: true,
          isclear: false, //是否显示清空
          istoday: false,
          choose: function(datas){
             end.min = datas; //开始日选好后，重置结束日的最小日期
             end.start = datas //将结束日的初始值设定为开始日
          }
        };
        var end = {
          elem: '#end',
          format: 'YYYY/MM/DD hh:mm:ss',
          min: laydate.now(),
          max: laydate.now(+1),
          start: '<?php echo $time_now =date("Y-m-d H:i:s");?>',
          istime: true,
          isclear: false, //是否显示清空
          istoday: false,
          choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
          }
        };

      laydate(start);
      laydate(end);
      function close_frame() {  
      var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
      parent.layer.close(index);
      }

 </script>