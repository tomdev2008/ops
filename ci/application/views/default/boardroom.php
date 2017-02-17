				<div class="span9" id="content">
                    <div class="row-fluid">
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">会议申请情况</div>
                                </div>
                                <div class="block-content collapse in">
                                    <div class="span12">
                                        <p>
                                    <?php //printf($this->boardroom_model->judge_time("2016-09-14 16:40:10"))?>
                                    <?php 
                                         $day = $this->input->get('day', TRUE);
                                        if($day == NULL){
                                          $day = 0;
                                        }
                                    ?>
                               			<?php if ($day == 0) {
                                      echo anchor('boardroom?day=0', '今天情况', 'class="btn btn-success" title="今天问题"');
                                    }
                                    else if ($day != 0) {
                                      echo anchor('boardroom?day=0', '今天情况', 'class="btn " title="今天问题"');
                                    }
                                    ?>
                                    <?php if ($day == 1) {
                               			 echo anchor('boardroom?day=1', '明天情况', 'class="btn btn-success" title="明天问题"');
                                    }
                                    else if ($day != 1) {
                                     echo anchor('boardroom?day=1', '明天情况', 'class="btn " title="明天问题"');
                                    }
                                    ?>
                               			<?php if ($day == 2) {
                                      echo anchor('boardroom?day=2', '后天情况', 'class="btn btn-success" title="后天问题"');
                                    }
                                    else if ($day != 2) {
                                    echo anchor('boardroom?day=2', '后天情况', 'class="btn " title="后天问题"');
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
                                if ($day == 0) {
                                  $title = date('Y年m月d日')."会议室";
                                }
                                else if ($day == 1) {
                                  $title = date('Y年m月d日',strtotime("+1 day"))."会议室";
                                }
                                else if ($day == 2) {
                                   $title = date('Y年m月d日',strtotime("+2 day"))."会议室";
                                }
                                echo $title;
                                ?>
                                </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <div class="table-toolbar">
                                      <div class="btn-group">
                                         <?php echo anchor('boardroom/add', '申请会议室 <i class="icon-plus icon-white"></i>', 'class="btn btn-success" title="申请会议室"');?>
                                         <?php echo anchor('boardroom/apply', '会议变更 <i class="icon-plus icon-white"></i>', 'class="btn btn-warning" title="会议变更"');?>
                                         <?php echo anchor('boardroom/del', '会议取消 <i class="icon-plus icon-white"></i>', 'class="btn btn-danger" title="会议取消"');?>
                                      </div>
                                </div>
                    <table class="table table-bordered">
                          <thead>
                          <tr>
                            <td><center><strong>会议室<font size = 6>☞</font></strong></center></td>
                            <td colspan="7"><center><font size="5"><strong>会议室</strong></font></center></td>
                          <tr>
                           <tr>
                              <th style = "width : 80px"><center>详情<font size = 6>☟</font></center></th>
                              <th style = "width : 200px"><center><font size = 6>A</font></center></th>
                              <th style = "width : 150px"><center><font size = 6>B</font></center></th>
                              <th style = "width : 150px"><center><font size = 6>C</font></center></th>
                              <th style = "width : 150px"><center><font size = 6>D</font></center></th>
                              <th style = "width : 150px"><center><font size = 6>E</font></center></th>
                              <th style = "width : 150px"><center><font size = 6>F</font></center></th>
                              <th style = "width : 150px"><center><font size = 6>G</font></center></th>
                            </tr>
                          </thead>
                          <tbody>
 								             <?php 
                             $num_day = $this->boardroom_model->get_apply_num($day);
                             foreach ($num_day as $key => $value) {
                               if ($key == 0) {
                                 $num_morning = $value;
                               }
                               else if ($key == 1) {
                                 $num_afternoon = $value;
                               }
                             }
                             echo "上午有".$num_morning."个会议  "." 下午有".$num_afternoon."个会议";
                             $i = 1;
                             $j = 1; 
                             foreach ($boardroom_applys as $boardroom_apply) { 
                                        $meettime = $boardroom_apply->starttime;
                                        //echo $this->boardroom_model->judge_time($meettime)."string".$day;
                                        if ($this->boardroom_model->judge_time($meettime) == $day) {
                              ?>
                                   <tr>
                                   <?php 
                                      if (($num_afternoon != 0 && $j == 1 && $i == $num_morning + 1 )||( $num_afternoon != 0 && $j == 1 && $num_morning == 0)) {
                                  ?>
                                    <td style="text-align: center; vertical-align: middle;" rowspan="<?php echo $num_afternoon?>" ><span class="label label-warning">下午</span></td> <!-- 上下午 -->
                                   <?php $j++;}?>
                                   <?php if ($num_morning != 0 && $i == 1) {?>
                                      <td style="text-align: center; vertical-align: middle;" rowspan="<?php echo $num_morning?>"><span class="label label-info">上午</span></td> <!-- 上下午 -->
                                   <?php }?>
                                   <?php  
                                      $starttime = date("H:i",strtotime($boardroom_apply->starttime));
                                      $overtime = date("H:i",strtotime($boardroom_apply->overtime));
                                      if ($boardroom_apply->room_id == 'A') {
                                        $color = '#5F9EA0'
                                   ?>
                                   <td bgcolor="<?php echo $color?>"><center>
                                   <font color="white">
                                   <?php
                                          echo "【".$boardroom_apply->name."】<br>";
                                    ?>
                                    <a style="color:white;text-decoration:underline" href="javascript:;" onclick="get_contents('/boardroom/get_contents_by_id?id=<?php echo $boardroom_apply->id?>')">
                                          <?php echo $boardroom_apply->reason."<br>";?></a>
                                    <?php
                                          echo $starttime."到".$overtime;
                                    ?>
                                      </font></center></td> 
                                   <?php } else{?><td></td><?php }?><!-- A -->
                                   <?php
                                   if ($boardroom_apply->room_id == 'B') {
                                        $color = '#5F9EA0'
                                   ?>
                                   <td bgcolor="<?php echo $color?>"><center>
                                   <font color="white">
                                   <?php
                                          echo "【".$boardroom_apply->name."】<br>";
                                    ?>
                                    <a style="color:white;text-decoration:underline" href="javascript:;" onclick="get_contents(site_url('/boardroom/get_contents_by_id?id=<?php echo $boardroom_apply->id?>')">
                                          <?php echo $boardroom_apply->reason."<br>";?></a>
                                    <?php
                                          echo $starttime."到".$overtime;
                                    ?>
                                     </font></center></td> 
                                   <?php } else{?><td></td><?php }?><!-- B -->
                                   <?php
                                   if ($boardroom_apply->room_id == 'C') {
                                        $color = '#5F9EA0'
                                   ?>
                                   <font color="white">
                                   <td bgcolor="<?php echo $color?>"><center>
                                   <?php
                                          echo "【".$boardroom_apply->name."】<br>";
                                    ?>
                                    <a style="color:white;text-decoration:underline" href="javascript:;" onclick="get_contents('/boardroom/get_contents_by_id?id=<?php echo $boardroom_apply->id?>')">
                                          <?php echo $boardroom_apply->reason."<br>";?></a>
                                    <?php
                                          echo $starttime."到".$overtime;
                                    ?>
                                      </font></center></td> 
                                   <?php } else{?><td></td><?php }?><!-- C -->
                                   <?php
                                   if ($boardroom_apply->room_id == 'D') {
                                        $color = '#5F9EA0'
                                   ?>
                                   <td bgcolor="<?php echo $color?>"><center>
                                   <font color="white">
                                   <?php
                                          echo "【".$boardroom_apply->name."】<br>";
                                    ?>
                                    <a style="color:white;text-decoration:underline" href="javascript:;" onclick="get_contents('/boardroom/get_contents_by_id?id=<?php echo $boardroom_apply->id?>')">
                                          <?php echo $boardroom_apply->reason."<br>";?></a>
                                    <?php
                                          echo $starttime."到".$overtime;
                                    ?>
                                      </font></center></td> 
                                   <?php } else{?><td></td><?php }?><!-- D -->
                                   <?php
                                   if ($boardroom_apply->room_id == 'E') {
                                        $color = '#5F9EA0'
                                   ?>
                                   <td bgcolor="<?php echo $color?>"><center>
                                   <font color="white">
                                   <?php
                                          echo "【".$boardroom_apply->name."】<br>";
                                    ?>
                                    <a style="color:white;text-decoration:underline" href="javascript:;" onclick="get_contents('/boardroom/get_contents_by_id?id=<?php echo $boardroom_apply->id?>')">
                                          <?php echo $boardroom_apply->reason."<br>";?></a>
                                    <?php
                                          echo $starttime."到".$overtime;
                                    ?>
                                      </font></center></td> 
                                   <?php } else{?><td></td><?php }?><!-- E -->
                                   <?php
                                   if ($boardroom_apply->room_id == 'F') {
                                        $color = '#5F9EA0'
                                   ?>
                                   <td bgcolor="<?php echo $color?>"><center>
                                   <font color="white">
                                   <?php
                                          echo "【".$boardroom_apply->name."】<br>";
                                    ?>
                                    <a style="color:white;text-decoration:underline" href="javascript:;" onclick="get_contents('/boardroom/get_contents_by_id?id=<?php echo $boardroom_apply->id?>')">
                                          <?php echo $boardroom_apply->reason."<br>";?></a>
                                    <?php
                                          echo $starttime."到".$overtime;
                                    ?>
                                      </font></center></td> 
                                   <?php } else{?><td></td><?php }?><!-- F -->
                                   <?php
                                   if ($boardroom_apply->room_id == 'G') {
                                        $color = '#5F9EA0'
                                   ?>
                                   <td bgcolor="<?php echo $color?>"><center>
                                   <font color="white">
                                   <?php
                                          echo "【".$boardroom_apply->name."】<br>";
                                    ?>
                                    <a style="color:white;text-decoration:underline" href="javascript:;" onclick="get_contents('/boardroom/get_contents_by_id?id=<?php echo $boardroom_apply->id?>')">
                                          <?php echo $boardroom_apply->reason."<br>";?></a>
                                    <?php
                                          echo $starttime."到".$overtime;
                                    ?>
                                      </font></center></td> 
                                   <?php } else{?><td></td><?php }?><!-- G -->
                             <?php 
                             $i++;
                                }
                           } 
                           ?>
                           </tr>
                          </tbody>
                        </table>
                        <?php
                         //echo  $create_links;
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
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script>
        function get_contents(url) {
          layer.open({
          title:'会议详情',
          type: 2,
          skin: 'layui-layer-demo', //样式类名
          area: ['360px', '200px'],
          content: url
        });
      }
        $(function() {
           

        });
        </script>