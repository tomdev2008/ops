 <div class="span9" id="content">                   
                     <div class="row-fluid">
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">部门列表</div>
                                </div>
                                <div class="block-content collapse in">
                                    <div class="span12">
                                        <p>
                                        <?php 
                                         $month = $this->input->get('month',TRUE);
                                        if($month == NULL){
                                          $month =  date('m');
                                        }
                                        $level_id = $this->input->get('level_id', TRUE);
                                        if($level_id == NULL){
                                         $ot_user_id = $this->session->userdata('u_id');
                                         $level_id = $this->ot_model->get_level_id_by_id($ot_user_id);
                                        }
                                        form_hidden('level_id',$level_id);
                                      foreach( $users_level as $user_level ) {
                                ?>                        
                                      <?php
                                      if ($user_level->id != $level_id) {
                                          echo anchor('ot?month='.$month.'&level_id='.$user_level->id.'', ''.$user_level->level_name.'', 'class="'.$user_level->level_class.' " title="'.$user_level->level_name.'"');echo ' ';
                                      }
                                      else if ($user_level->id == $level_id) {
                                          echo anchor('ot?month='.$month.'&level_id='.$user_level->id.'', ''.$user_level->level_name.'', 'class="'.$user_level->level_class.' btn-success " title="'.$user_level->level_name.'"');echo ' ';
                                      }
                                    }
                                      ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">发布列表</div>
                                </div>
                                <div class="block-content collapse in">
                                    <div class="span12">
                               
                                    <div class="table-toolbar">

                                </div>
                                        <p> 
                                        <?php 
                                        $hidden_level_id = $this->input->get('level_id',TRUE);
                                        $month_tmp = $this->input->get('month',TRUE);
                                        if($month_tmp == NULL){
                                          $month_tmp =  date('m');
                                        }
                                    $td_month =  date('m');
                                    for ($i=1; $i < (int)$td_month+1; $i++) { 
                                      $month = sprintf('%02s', $i);
                                      if ($month == $month_tmp) {
                                          echo anchor('ot?month='.$month.'&level_id='.$hidden_level_id.'', ''.$i.'月', 'class="btn btn-success" title="'.$i.'月"');echo ' ';
                                        } else {
                                          echo anchor('ot?month='.$month.'&level_id='.$hidden_level_id.'', ''.$i.'月', 'class="btn" title="'.$i.'月"');echo ' ';
                                        }                                                      
                                    }
                                      
                                    ?>

                                                                             
                                        </p>
                                    </div>
                                </div>
                            </div>

                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">
                                <?php
                                  $title = $month_tmp."月加班人员总览";
                                  echo $title;
                                ?>
                                </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <div class="table-toolbar">  
                                      <div class="btn-group">
                                         <?php 
                                         $ot_user_id = $this->session->userdata('u_id');
                                         $ot_user_level = $this->ot_model->get_group_leader_by_id($ot_user_id);
                                         $level_id = $this->ot_model->get_level_id_by_id($ot_user_id);
                                         if ($ot_user_level == '1' ) {
                                            ?>
                                            <input type="button" class="btn btn-success" onclick="get_ot_add('/ot/add?month=<?php echo $month_tmp?>&level_id=<?php echo $level_id?>')" value="添加加班人员信息">
                                            <?php
                                         }
                                         ?>
                                         <br>
                                      </div>  
                                         <div class="btn-group">
                                         <?php 
                                         $ot_user_level = $this->session->userdata('u_level_id');
                                         $ot_user_level = $this->ot_model->get_group_leader_by_id($ot_user_id);
                                         $level_id = $this->ot_model->get_level_id_by_id($ot_user_id);
                                         if ($ot_user_level == '1' ) {
                                            ?>
                                            <input type="button" class="btn btn-warning" onclick="get_release_add('/ot/add_release')" value="新增日期">
                                            <?php
                                         }
                                         ?>
                                         <br>
                                      </div>  
                                        <div class="btn-group">
                                         <?php 
                                         $ot_user_id = $this->session->userdata('u_id');
                                         $ot_user_level = $this->ot_model->get_group_leader_by_id($ot_user_id);
                                         $level_id = $this->ot_model->get_level_id_by_id($ot_user_id);
                                         if ($ot_user_level == '1' ) {
                                            ?>
                                            <input type="button" class="btn btn-danger" onclick="get_ot_make('/ot/make?month=<?php echo $month_tmp?>&level_id=<?php echo $level_id?>')" value="修改加班人员信息">
                                            <?php
                                         }
                                         ?>
                                         <br>
                                      </div> 
                                   
                                      </div>
                        <table class="table table-bordered">
                          <thead>
                           <tr>
                              <th style="text-align: center; background-color: #EFEFEF; vertical-align: middle;width: 50px; ">姓名</th>
                              <?php
                                  foreach( $ot_date as $key => $id ) {
                              ?>  
                              <th style="text-align: center;background-color: #EFEFEF; vertical-align: middle;"><?php echo $id->release_date.$id->release_name;?> </th>
                              <?php
                                 }
                              ?> 
                            </tr>
                          </thead>
                                        <tbody>
                                <?php
                                        foreach( $users as $key => $id ) {
                                ?>        
                                            <tr class="odd gradeX">
                                            <td style="text-align: center;vertical-align: middle;"><?php echo $id->name ?></td>
                                            <?php
                                                  for ($i=0; $i <count($ot_date) ; $i++) { 
                                                    ?>
                                                  
                                                <td style="text-align: center; vertical-align: middle;">
                                                <?php
                                                 //echo $id->id.$id->name;                              
                                                 //echo $ot_date[$i]->release_date;
                                                  //print_r($data_project);
                                                  //echo isset($data_project[$ot_date[$i]->release_date][$id->id]) ? $data_project[$ot_date[$i]->release_date][$id->id] : '';
                                                  if (isset($data_project[$ot_date[$i]->release_date][$id->id])) {
                                                      $work_time = $data_project[$ot_date[$i]->release_date][$id->id] ;
                                                        $tem_day1 = (substr($work_time,8,2));//11日 
                                                         $tem_day2 = (substr($work_time,28,2));//13日 
                                                         $tem_min1 = (substr($work_time,14,2));//50分 
                                                         $tem_min2 = (substr($work_time,34,2));//51分  
                                                         $tem_hour1 = (substr($work_time,11,2));//16点 
                                                         $tem_hour2 = (substr($work_time,31,2));  //18点  
                                                        $min_day = $tem_day2 - $tem_day1;
                                                        $result_hour = $tem_hour2 - $tem_hour1;
                                                         $result_minute = $tem_min2 - $tem_min1;

                                                        if ($result_minute < 0) {
                                                            $result_minute = $result_minute+60;
                                                            $result_hour = $result_hour-1;
                                                                  } 
                                                        if ($result_hour < 0) {
                                                            $result_hour = $result_hour+24;
                                                                  } 
                                                        if ($min_day == 0) {
                                                         echo $tem_hour1.':'.$tem_min1.'-'.$tem_hour2.':'.$tem_min2;
                                                         
                                                          ?>
                                                         <span class="badge badge-success">
                                                         <?php echo $result_hour.'.'.$result_minute.'h'; ?></b></span>
                                                         <?php
                                                         }
                                                        else {
                                                        $tem_hour2 = 24 + $tem_hour2;
                                                           $result_hour = $tem_hour2 - $tem_hour1;
                                                         echo $tem_hour1.':'.$tem_min1.'-'.$tem_hour2.':'.$tem_min2; 
                                                         
                                                         ?>
                                                         <b>
                                                         <span class="badge badge-success">
                                                         <?php echo $result_hour.'.'.$result_minute.'h'; ?></b></span>
                                                         <?php
                                                         }
                                                    }  else {
                                                      echo '';
                                                    }
                                                ?>
                                                </td>
                                                   <?php 
                                                  }
                                            ?>                                          
                                            </tr>
                                 <?php
                                 }
                                 ?>                                                                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- /block -->
                    </div>
 </div>
         <!--/.fluid-container-->

        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script>

            function get_ot_add(url) {
            layer.open({
                  area: ['90%', '90%'],
                  title:'添加人员加班信息',
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  content: url
                });
        }

            function get_release_add(url) {
            layer.open({
                  area: ['600px', '550px'],
                  title:'新增日期',
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  content: url
                });
        }

            function get_ot_make(url) {
            layer.open({
                  area: ['90%', '90%'],
                  title:'修改人员加班信息',
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  content: url
                });
        }
        </script>