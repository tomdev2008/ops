
                <!-- content -->
                <div class="col-md-10">
                    <div class="row" >
                            <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="/admin/ticket">工单管理</a>
                                    </li>
                                    <li><?php echo "工单号：".$get_ticket_by_id['id']?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                            
					<!-- BEGIN FORM-->
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
    echo form_open('admin/ticket/view_add', $attributes);
    $id_hidden = $this->uri->segment(4,0);
    $this->load->helper('typography');
    $level_id = $this->session->userdata('u_level_id');
    $user_id = $this->session->userdata('u_id');
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
  							<div class="control-group"">
  								<?php echo "<strong>工单标题 : </strong>".$get_ticket_by_id['title']."【".date("Y-m-d H:i",strtotime($get_ticket_by_id['opr_time']))."】";?>
  								</div>
                <br>
                  <div class="control-group"">
                  <?php echo "<strong>工单状态 : </strong>"?>
                  <?php echo $this->ticket_model->get_ticket_status_by_id($get_ticket_by_id['status']);
                    if ($get_ticket_by_id['status'] == 1 || $get_ticket_by_id['status'] == 4) {
                        $overtime = $this->ticket_model->get_ticket_overtime_by_ticket_id($id_hidden);
                        foreach ($overtime as $key => $value) {
                          $time = $value->opr_time;
                        }
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;完成耗时:";
                        $this->ticket_model->Time($get_ticket_by_id['opr_time'],$time);
                    }
                  ?>
              </div>
              <br>
                  <div class="control-group"">
                  <?php echo "<strong>报障人 : </strong>"?>
                  <span class="label label-success">
                  <?php  
                      $levelid = $this->ticket_model->get_level_id_by_id($get_ticket_by_id['submitter']);
                      $levelname = $this->ticket_model->get_user_level_name_by_id($levelid);
                      echo $levelname;
                  ?>
                  </span>&nbsp;
                  <span class="label label-info">
                  <?php  
                      $username = $this->ticket_model->get_name_by_id($get_ticket_by_id['submitter']);
                      echo $username;
                  ?>
                  </span>
              </div>
              <br>
              <div>
              <?php echo "<strong>报障人邮箱 : </strong>"?>
              <span class="btn btn-sm btn-default" >
                  <?php 
                  $email = $this->ticket_model->get_email_by_id($get_ticket_by_id['submitter']);
                  echo mailto($email,$email);
                  //$data = array(
                    //'id_hidden' => $id_hidden,
                    //'email_hidden' => $email,
                   //);
                  //form_hidden($data);
                  ?>
                  </span>
                </div>           
                <div class="control-group"">
                  <?php echo "<strong>工单内容 : </strong>"?><br>
                  <?php echo $this->ticket_model->makeLinks($get_ticket_by_id['contents'])?>
              </div>  
                <br>   
              <div class="control-group">
                  <?php echo "<strong>工单处理情况 : </strong><br />"?>
                   <table class="table table-bordered">
                          <thead>
                           <tr>
                              <th>姓名</th>
                              <th>留言内容</th>
                              <th>时间</th>
                            </tr>
                          </thead>
                          <tbody>
                  <?php foreach ($get_reply_by_ticket_id as $value) {?>
                  	<tr>
                  <td><?php  echo $this->ticket_model->get_name_by_id($value->submitter)?></td>
                  <td><?php echo print_r($value->contents,1)?></td>
                  <td><?php echo "【".date("Y-m-d H:i",strtotime($value->opr_time))."】<br />"?></td>
                  <?php } ?>
                  </tr>
                  	</tbody>
                  		</table>
              </div>
              <div class="control-group warning" >
                <?php 
                if ($get_ticket_by_id['status'] != 1 && $get_ticket_by_id['status'] != 4) { 
                  if($level_id == 2 || $user_id == $get_ticket_by_id['submitter']){
                  ?>            
                <label class="control-label" for="inputError" ><strong>留言板</strong></label>
                  <div class="controls" >
                  <?php echo form_error('contents', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                    <textarea name="contents" class="form-control textarea-wysihtml5" placeholder="请输入您的留言..." style="width: 100%; height: 200px"></textarea>
                    <!-- <textarea name="contents" class="layui-textarea" id="LAY_demo2" style="display: all;"></textarea> -->
                 </div>
                 <?php 
                  if ($level_id == 2) { ?>
                    <input type="checkbox" name="select" value="1" >确认完成
                 <?php } ?>
              </div>
  							<div class="form-actions">
  							<input type="hidden" name="id_hidden" value=<?php echo $id_hidden?>>
                <input type="hidden" name="email_hidden" value=<?php echo $email?>>
                <input type="hidden" name="title_hidden" value=<?php echo $get_ticket_by_id['title']?>>
  							<input type="hidden" name="name_hidden" value=<?php echo $username?>>
  								<button type="submit" name="submit" class="btn btn-primary" id="btn">确定</button>
  								<button type="button" class="btn" onclick="history.go(-1)">取消</button>
  							</div>
						</fieldset>
					</form>
          <?php
            }
          }
          ?>
					<!-- END FORM-->
				</div>
			    </div>
			</div>  
                     	<!-- /block -->
		    </div>
                     <!-- /validation -->

              
        <!--/.fluid-container-->
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>
<!--         <script src="<?php echo base_url();?>layui/layui.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>layui/css/layui.css"> -->
    <script>
      function buttoncheck(){
        $('#btn').on('click',function(){
          $("#btn").attr("disabled", true);
          return true;
        });
      }
      layui.use('layedit', function(){
        var layedit = layui.layedit
        ,$ = layui.jquery;
        
        //构建一个默认的编辑器
        var index = layedit.build('LAY_demo1');
        $('.site-demo-layedit').on('click', function(){
          var type = $(this).data('type');
          active[type] ? active[type].call(this) : '';
        });
        
        //自定义工具栏
        layedit.build('LAY_demo2', {
          tool: ['face','strong' ,'italic' ,'underline' ,'del','|','left' ,'center' ,'right' ,'|','link','unlink']
          ,height: 300
        })
      });
    </script>