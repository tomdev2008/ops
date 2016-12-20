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
    echo form_open('boardroom/apply', $attributes);
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
							<div class="control-group" style="margin-top:50px "><strong>请选择要修改的会议 ： </strong>
							<select class="span6 m-wrap" name="id" style=" width:300px">
              <?php echo form_error('id', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <?php
                      foreach ($get_apply_by_submitter as $value) {
                        $result = $this->boardroom_model->judge_time($value->starttime);
                        if ($result <= 2 && $result >= 0) {
                        ?>
		                    <option value="<?php echo $value->id?>">
                        <?php 
                          echo "【".$value->name."】 ".$value->reason;
                        ?>
                        </option>
                      <?php 
                      }
                    }
                    ?>
		                    </select>
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
   <!--  <script type="text/javascript">
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
    </script> -->