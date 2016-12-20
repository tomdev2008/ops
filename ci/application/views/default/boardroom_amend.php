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
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    $id = $this->input->get('id',TRUE);
    $apply = $this->boardroom_model->get_by_id($id);
    echo form_open('boardroom/amend?id='.$id, $attributes);
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
              <?php foreach ($apply as $value) {?>
  							<div class="control-group">
  								<label class="control-label">会议名称（申请理由）<span class="required">*</span></label>
  								<div class="controls">
                 		<?php echo form_error('reason', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input type="text" name="reason" value="<?php echo $value->reason?>" data-required="1" class="span2 m-wrap" style="width:100px"/>
  								</div>
  							</div>
                <div class="control-group">
                  <label class="control-label">会议主讲人<span class="required">*</span></label>
                  <div class="controls">
                  <?php echo form_error('reason', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input type="text" name="name" value="<?php echo $value->name?>" data-required="1" class="span2 m-wrap" style="width:100px"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">所需会议室<span class="required">*</span></label>
                  <div class="controls">
                    <?php echo form_error('room_id', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input type="text" name="room_id" value="<?php echo $value->room_id?>" data-required="1" class="span2 m-wrap" style="width:100px"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">开始时间<span class="required">*</span></label>
                  <div class="controls">
                    <?php echo form_error('starttime', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input value="<?php echo $value->starttime?>" onclick="laydate({istime:true,format:'YYYY-MM-DD hh:mm',start:'<?php echo $value->starttime?>'})" name="starttime"></input>
                  </div>
                </div>
              <div class="control-group">
                <label class="control-label">结束时间<span class="required">*</span></label>
                  <div class="controls">
                    <?php echo form_error('overtime', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input value="<?php echo $value->overtime?>" onclick="laydate({istime:true,format:'YYYY-MM-DD hh:mm',start:'<?php echo $value->overtime?>'})" name="overtime"></input>
                  </div>
                </div>
              <div class="control-group">
                <label class="control-label" for="textarea2">会议内容</label>
                  <div class="controls">
                     <textarea name="contents"  class="input-xlarge textarea" placeholder="Enter text ..." style="width: 300px; height: 150px"><?php echo $value->contents?></textarea>
                     <?php echo form_error('contents', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                 </div>
              </div> 
              <?php }?>
              	   <div class="control-group" style=" margin-left:30px">
                     <strong><font color = "red">更改会议申请前请先确认！！</font></strong>
                   </div> 
  							<div class="form-actions">
  								<button type="submit" class="btn btn-primary">确认更改</button>
  								<button type="button" class="btn" onclick="history.go(-1)">返回</button>
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
    <script type="text/javascript">
      var 
      $(".span6 m-wrap").on('change',function){
        $.ajax({
          url:"/boardroom/ajax_boardroom?id="+$(this).val()+"/",
          dataType:"json",
          beforeSend: function(){$('ul.span2 m-wrap').empty();},
          success:function(servers){
            var room_id = servers.room_id
            var name = servers.name
            var reason = servers.reason
            var starttime = servers.starttime
            var overtime = servers.overtime
            var contents = servers.contents
            $span2 m-wrap.append
          }
        })
      }
    </script>