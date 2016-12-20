
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12"></div>
                    </div>
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/dailylog/view_add', $attributes);
    $id_hidden = $this->uri->segment(4,0);
    $this->load->helper('typography');
?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title"><?php echo $title?></div>
                                </div>
                               <div class="bootstrap-admin-panel-content">
  								<?php echo "<strong>工作日志标题 : </strong>".$get_dailylog_by_id['daily_title']."【".date("Y-m-d",strtotime($get_dailylog_by_id['daily_time']))."】";?>
  							</div>
                  <div class="bootstrap-admin-panel-content">
                  <?php echo "<strong>负责人 : </strong>"?>
                  <span class="label label-info">
                  <?php  
                      $username = $this->dailylog_model->get_name_by_id($get_dailylog_by_id['user_id']);
                      echo $username;             
                  ?>
                  </span>
              </div>             
               <div class="bootstrap-admin-panel-content">
                  <?php echo "<strong>工作日志内容 : </strong>"?><br>
                  <?php echo $this->dailylog_model->makeLinks($get_dailylog_by_id['daily_content'])?>
              </div>    
               <div class="bootstrap-admin-panel-content">                           
                        <table class="table table-striped table-bordered" id="example">
                          <thead>
                           <tr>
                           	  <th width="5%">#</th>
                              <th width="15%">工作标题</th>
                              <th>工作内容</th>
                            </tr>
                          </thead>
                          <tbody>
                  <?php 
				  $num = 0;
                  foreach ($get_reply_by_daily_id as $value) {?>
                  	<tr>
                  <td><?php echo $num = $num+1?></td>
                  <td><?php 
                      if (empty($value->daily_content)) {
                      	echo ' ';
                      } else {
                      	 echo $this->dailylog_model->makeLinks($value->daily_content);
                      }
                 ?><br><span class="label label-success bootstrap-admin-label-thin"><?php 
                      echo $submitter = $this->dailylog_model->get_user_name_by_id($value->submitter_id)?></span><br><span><?php echo date("Y-m-d",strtotime($value->opr_time));?></span><a href="javascript:;" class="runcode" onclick="get_reply_change('/admin/dailylog/reply?id=<?php echo $value->id?>')">修改</a>
                      </td>
                  <td><?php 
                      if (empty($value->daily_text)) {
                      	echo ' ';
                      } else {
                      	 echo $this->dailylog_model->makeLinks($value->daily_text);
                      }
                  ?></td>
                  <?php } ?>
                  </tr>
                  	</tbody>
                  		</table>
              </div>

				<div class="bootstrap-admin-panel-content">                
                  <?php echo "<strong>工作留言 : </strong>"?>
                </div>
                <div class="form-group">
                   <label class="col-lg-2 control-label" for="focusedInput">工作标题</label>
                <div class="col-lg-8"><input class="form-control" type="text" name="daily_content" ></div>
                </div>

                <div class="form-group">
                   <label class="col-lg-2 control-label" for="textarea-wysihtml5">工作内容<span class="required">*</span></label>
                	<div class="col-lg-8">
                	<?php echo form_error('daily_text', '<div class="alert alert-danger">
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                 <strong>请输入！</strong>', '</div>'); ?>
                        <textarea name="daily_text" class="form-control textarea-wysihtml5" placeholder="Enter text..." style="width: 100%; height: 200px"></textarea>
                    </div>
                </div>
  				<div class="form-actions" style="text-align:center;">
  					<input type="hidden" name="id_hidden" value=<?php echo $id_hidden?>>
                	<input type="hidden" name="title_hidden" value=<?php echo $get_dailylog_by_id['daily_title']?>>
  					<input type="hidden" name="name_hidden" value=<?php echo $username?>>
  					<button type="submit" name="submit" class="btn btn-primary" id="btn">确定</button>
  					<button type="button" class="btn btn-default" onclick="history.go(-1)">取消</button>
  				</div>

                                </div>
                            </div>
                        </div>
                    </div>
                               
        <script src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>  
        <script src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/uniform/jquery.uniform.min.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/chosen.jquery.min.js"></script> 
        <script src="<?php echo base_url();?>admin-static/vendors/selectize/dist/js/standalone/selectize.min.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard-for.bootstrap3.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/boostrap3-typeahead/bootstrap3-typeahead.min.js"></script>   
        <script src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>    
        <script src="<?php echo base_url();?>layer/layer.js"></script>       

        <script type="text/javascript">
      function buttoncheck(){
        $('#btn').on('click',function(){
          $("#btn").attr("disabled", true);
          return true;
        });
      }
      function get_reply_change(url) {
            layer.open({
                  id: 'ex1',
                  title:false,
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  area: ['750px', '500px'],
                  content: url
                });
        }
        </script>