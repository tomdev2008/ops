                <div class="span9" id="content">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" style="width:80%;margin-top:100px;margin-left:100px">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo anchor('ticket', '工单发布管理');?> / <?php echo $title?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
					<!-- BEGIN FORM-->
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
    echo form_open('ticket/add', $attributes);
    $level_id = $this->input->get('level_id');
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
                  <label class="control-label">工单类型<span class="required">*</span></label>
                  <div class="controls">
                  <?php echo form_error('category', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <select class="span6 m-wrap" name="category" style="width:25%">
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
                  <label class="control-label">工单标题<span class="required">*</span></label>
                  <div class="controls">
                  <?php echo form_error('title', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <input type="text" name="title" data-required="1" class="span2 m-wrap" style="width: 60%" />
                  </div>
                </div>
              <div class="control-group">
                <label class="control-label" for="textarea2">工单内容</label>
                  <div class="controls">
                  <?php echo form_error('contents', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                  <?php echo form_error('contents', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                  <p><a class="emotion" style="cursor:pointer;"><img id="meme" style="cursor:pointer;" src="<?php echo base_url();?>qqface/arclist/icon.jpg" border="0" width="24" height="24">表情</a></p>
                   <textarea name="contents" id="contents" class="input-xlarge textarea" placeholder="请输入 ..." " style="width:60%;height:200px"></textarea>
                   <div>
                     <strong><font color = "red">重要敏感的数据及文件</font> 直接发邮件到<?php echo mailto('ops@xkeshi.com',"ops@xkeshi.com")?></strong>
                   </div>
                 </div>
              </div>    
  							
  							<div class="form-actions">
  								<button type="submit" class="btn btn-primary" id="btn">确定</button>
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
    <script type="text/javascript" src="<?php echo base_url();?>qqface/js/jquery.qqFace.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>qqface/js/jquery.browser.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>qqface/css/qqface.css">
    <script>
      function buttoncheck(){
        $('#btn').on('click',function(){
          $("#btn").attr("disabled", true);
          return true;
        });
      }
    $(function(){ 
    $('.emotion').qqFace({ 
        assign:'contents', //给输入框赋值 
        path:'<?php echo base_url();?>qqface/arclist/'    //表情图片存放的路径 
    }); 
});
    </script>
