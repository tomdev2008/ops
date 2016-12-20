
                <!-- content -->
                <div class="col-md-10">
                    <div class="row" >
                            <div class="col-lg-12">
                            <div class="page-header">
                                <h1>工单管理</h1>
                            </div> 
 <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                     <div class="text-muted bootstrap-admin-box-title">工单分组</div>
                                </div>
                               <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>
                                    <p>
                                        <?php echo anchor('admin/ticket', '所有问题', 'class="btn btn-primary" title="所有问题"');?>
                                <?php
                                        $level_id = $this->input->get('level_id', TRUE);
                                        if($level_id == NULL){
                                          $level_id = 0;
                                        }
                                        form_hidden('level_id',$level_id);
                                      foreach( $tickets_level as $ticket_level ) {
                                ?>
                                      <?php
                                      if ($ticket_level->id != $level_id) {
                                          echo anchor('admin/ticket?level_id='.$ticket_level->id.'', ''.$ticket_level->level_name.'', 'class="btn btn-default" title="'.$ticket_level->level_name.'"');
                                      }
                                      else if ($ticket_level->id == $level_id) {
                                          echo anchor('admin/ticket?level_id='.$ticket_level->id.'', ''.$ticket_level->level_name.'', 'class="'.$ticket_level->level_class.' active " title="'.$ticket_level->level_name.'"');
                                      }
                                    }
                                      ?>
                                      <br>
                                  <?php
                                    echo $this->ticket_model->makeLinks($ticket_message);
                                 ?>
                                    </p>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                        <!-- block -->
                        <div class="col-lg-14">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title"><?php echo $title?></div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <div class="span12">
<!--                                 <div class="table-toolbar">
                                      <div class="btn-group">
                                         <?php echo anchor('admin/ticket/add?level_id='.$level_id, '添加工单 <i class="icon-plus icon-white"></i>', 'class="btn btn-primary" title="添加工单"');?>
                                      </div>
                                </div> -->
                    <table class="table table-striped table-bordered" id="example">
                          <thead>
                           <tr>
                              <th>#</th>
                              <th>标题</th>
                              <th>类型</th>
                              <th width="10%">报障人</th>
                              <th>状态</th>
                              <th>时间</th>
                            </tr>
                          </thead>
                          <tbody>
                <?php
                      $num = 0;
                      foreach ($ticket_list as $key => $value) {
                ?>
                            <tr>
                              <td><?php echo $num=$num+1?></td>               
                              <td><?php echo '<a href=/admin/ticket/view/'.$value->id.'>'.$value->title.'</a>'?></td>
                              <td><span class="label label-info"><?php echo $value->ticket_user_level_name?></span></td>
                              <td><?php echo $value->submitter_name?></td>
                              <td><?php echo $value->status_name?></td>
                              <td><?php echo $value->opr_time?></td>
                            </tr>
                <?php
                    }
                  ?> 
                          </tbody>
                        </table>
                                </div>
                            </div>
                        </div>
                     	<!-- /block -->
		                </div>
                    </div>
                     <!-- /validation -->
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script type="text/javascript">
        $(function() {
           
        });
        </script>