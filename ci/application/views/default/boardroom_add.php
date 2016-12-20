			 <div class="span9" id="content">


                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo anchor('boardroom', '会议室管理');?> / <?php echo $title?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
					<!-- BEGIN FORM-->
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
    echo form_open('boardroom/add', $attributes);
    $submitter = $this->session->userdata('u_id');
    $name = $this->boardroom_model->get_name_by_id($submitter);
    //$level_id = $this->input->get('level_id');
?>
						<fieldset>
							<div class="alert alert-error hide">
								<button class="close" data-dismiss="alert"></button>
								You have some form errors. Please check below.
							</div>
							<div class="alert alert-success hide">
								<button class="close" data-dismiss="alert"></button>
								Your form validation is successful!
							</div>
  							<div class="control-group">
  								<label class="control-label">会议名称（申请理由）<span class="required">*</span></label>
  								<div class="controls">
                  <?php echo form_error('reason', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
  									<input type="text" name="reason" data-required="1" class="span2 m-wrap" style="width:100px"/>
  								</div>
  							</div>
                <div class="control-group">
                  <label class="control-label">会议主讲人<span class="required">*</span></label>
                  <div class="controls">
                  <?php echo form_error('reason', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input type="text" name="name" value="<?php echo $name?>" data-required="1" class="span2 m-wrap" style="width:100px"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">所需会议室<span class="required">*</span></label>
                  <div class="controls">
                  <?php echo form_error('room_id', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <select class="span6 m-wrap" name="room_id" style="width:80px">
                    <option select value="A">A</option>
                    <option select value="B">B</option>
                    <option select value="C">C</option>
                    <option select value="D">D</option>
                    <option select value="E">E</option>
                    <option select value="F">F</option>
                    <option select value="G">G</option>
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">开始时间<span class="required">*</span></label>
                  <div class="controls">
                    <?php echo form_error('starttime', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input id="start" name="starttime"></input>
                    <!-- <li class="laydate-icon" id="start" style="width:200px; margin-right:10px;"></li> -->
                  </div>
                </div>
              <div class="control-group">
                <label class="control-label">结束时间<span class="required">*</span></label>
                  <div class="controls">
                  <?php echo form_error('overtime', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input id="end" name="overtime"></input>
                    <!-- <li class="laydate-icon" id="end" style="width:200px;"></li> -->
                  </div>
                </div>
              <div class="control-group">
                <label class="control-label" for="textarea2">会议内容<span class="required">*</span></label>
                  <div class="controls">
                   <textarea name="contents" class="input-xlarge textarea" placeholder="Enter text ..." style="width: 300px; height: 150px"></textarea>
                   <?php echo form_error('contents', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                   <div>
                     <strong><font color = "red">申请会议室前请先确认不会冲突！！</font></strong>
                   </div>
                 </div>
              </div>    
  							<div class="form-actions">
  								<button type="submit" class="btn btn-primary" id="btn" onclick="return check();">确定</button>
  								<button type="button" class="btn" onclick="history.go(-1)">取消</button>
  							</div>
						</fieldset>
					</form>
					<!-- END FORM-->
				</div>
			    </div>
			</div>
                     	<!-- /block -->
		    </div>
                     <!-- /validation -->
                </div>
            </div>

        <!--/.fluid-container-->
    <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>laydate/laydate.js"></script>
    <script>
      var start = {
        elem: '#start',
        format: 'YYYY/MM/DD hh:mm',
        min: laydate.now(), //设定最小日期为当前日期
        max: '2099-06-16 23:59', //最大日期
        istime: true,
        istoday: true,
        choose: function(datas){
           // end.min = datas; //开始日选好后，重置结束日的最小日期
           end.start = datas //将结束日的初始值设定为开始日
        }
      };
      var end = {
        elem: '#end',
        format: 'YYYY/MM/DD hh:mm',
        // min: starttime,
        max: '2099-06-16 23:59',
        istime: true,
        istoday: true,
        choose: function(datas){
          start.max = datas; //结束日选好后，重置开始日的最大日期
        }
      };
      laydate(start);
      laydate(end);
      function buttoncheck(){
        $('#btn').on('click',function(){
          $("#btn").attr("disabled", true);
          return true;
        });
      }
    </script>