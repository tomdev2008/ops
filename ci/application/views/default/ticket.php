                <div class="span9" id="content">
                    <div class="row-fluid">
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">工单分组</div>
                                </div>
                                <div class="block-content collapse in">
                                    <div class="span12">
                                        <p>
                                        <?php echo anchor('ticket', '所有问题', 'class="btn btn-success" title="所有问题"');?>
                                <?php
                                        $level_id = $this->db->escape($this->input->get('level_id', TRUE));
                                        if($level_id == 'NULL'){
                                          $level_id = 0;
                                        }
                                        form_hidden('level_id',$level_id);
                                      foreach( $tickets_level as $ticket_level ) {
                                ?>
                                      <?php
                                      if ($ticket_level->id != $level_id) {
                                          echo anchor('ticket?level_id='.$ticket_level->id.'', ''.$ticket_level->level_name.'', 'class="'.$ticket_level->level_class.' " title="'.$ticket_level->level_name.'"');
                                      }
                                      else if ($ticket_level->id == $level_id) {
                                          echo anchor('ticket?level_id='.$ticket_level->id.'', ''.$ticket_level->level_name.'', 'class="'.$ticket_level->level_class.' active " title="'.$ticket_level->level_name.'"');
                                      }
                                    }
                                      ?>
                                <div>
                                  <?php
                                    echo $this->ticket_model->makeLinks($ticket_message);
                                 ?>
                                 </div>
                                        </p>
                                    </div>
                                </div>
                            </div>   
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $title?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <div class="table-toolbar">
                                      <div class="btn-group">
                                         <?php echo anchor('ticket/add', '添加工单 <i class="icon-plus icon-white"></i>', 'class="btn btn-success" title="添加工单"');?>
                                      </div>
                                </div>
                    <table class="table table-bordered">
                          <thead>
                           <tr>
                              <th>#</th>
                              <th>标题</th>
                              <th>类型</th>
                              <th>报障人</th>
                              <th>状态</th>
                              <th>时间</th>
                            </tr>
                          </thead>
                          <tbody>
                <?php
                      $page = $this->uri->segment(2,0);
                      if ($page != 0) {
                        $num = $page*$page_num;
                      }
                      else if ($page == 0 ) {
                        $num = 0;
                      }
                      foreach ($ticket_list as $key => $value) {
                ?>
                            <tr>
                              <td><?php echo $num=$num+1?></td>               
                              <td><?php echo '<a href=/ticket/view/'.$value->id.'>'.$value->title.'</a>'?></td>
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
                        <?php
                         echo  $create_links;
                        ?>
                                </div>
                            </div>
                        </div>
                     	<!-- /block -->
		                </div>
                     <!-- /validation -->
                </div>
            </div>
        <!--/.fluid-container-->
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
           
        });
        </script>