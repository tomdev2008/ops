
                <div class="span9" id="content">


                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo anchor('ticket', '工单管理');?> / <?php echo "工单号：".$get_ticket_by_id['id']?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
					<!-- BEGIN FORM-->
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
    echo form_open('ticket/view_add', $attributes);
    $id_hidden = $this->db->escape($this->uri->segment(3,0));
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
                  <div class="control-group"">
                  <?php echo "<strong>报障人 : </strong>"?>
                  <span class="label label-success">
                  <?php  
                      $levelid = $this->ticket_model->get_level_id_by_id($get_ticket_by_id['submitter']);
                      $levelname = $this->ticket_model->get_user_level_name_by_id($levelid);
                      echo $levelname;
                  ?>
                  </span>
                  <span class="label label-info">
                  <?php
                      $username = $this->ticket_model->get_name_by_id($get_ticket_by_id['submitter']);
                      echo $username;
                  ?>
                  </span>
              </div>
              <div>
              <?php echo "<strong>报障人邮箱 : </strong>"?>
              <span class="btn" >
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
              </div>
                <div class="control-group"">
                  <?php echo "<strong>工单内容 : </strong>"?>
                  <?php echo $this->ticket_model->makeLinks($get_ticket_by_id['contents'])?>
              </div>    
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
                  <td><?php echo $this->ticket_model->makeLinks($value->contents)?></td>
                  <td><?php echo "【".date("Y-m-d H:i",strtotime($value->opr_time))."】<br />"?></td>
                  <?php } ?>
                  </tr>
                  	</tbody>
                  		</table>
              </div>
              <div class="control-group warning" >
                <?php 
                if ($get_ticket_by_id['status'] != 1 && $get_ticket_by_id['status'] != 4) { 
                  if($user_id == $get_ticket_by_id['submitter']){
                  ?>            
                <label class="control-label" for="inputError" ><strong>留言板</strong></label>
                  <div class="controls" >
                  <?php echo form_error('contents', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                   <textarea name="contents" class="input-xlarge textarea" placeholder="Enter text ..." style="width: 400px; height: 200px"></textarea>
                   <span class="help-inline">请输入您的留言</span>
                 </div>
                 <!-- <?php 
                  if ($level_id == 2) { ?>
                    <input type="checkbox" name="select" value="1" >确认完成
                 <?php } ?> -->
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
</div>
                </div>
            </div>
              
        <!--/.fluid-container-->
    <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <script>
      
      function buttoncheck(){
        $('#btn').on('click',function(){
          $("#btn").attr("disabled", true);
          return true;
        });
      }
    </script>