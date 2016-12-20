<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; left:50px; right:50px;top:0px; width:90%; height:90%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><?php echo $title ?></div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
                                      <fieldset>
                        <table class="table table-bordered">
                          <thead>
                           <tr>
                              <th style="text-align: center;background-color: #EFEFEF; vertical-align: middle;">姓名</th>
                              <?php
                                  foreach( $ot_date as $key => $id ) {
                              ?>  
                              <th style="text-align: center; background-color: #EFEFEF;vertical-align: middle;">
                              <?php 
                              if (isset($ot_date)) {
                                echo $id->release_date.$id->release_name;
                              } else {
                                echo '';
                              }
                              ?>
                              </th>
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
                                            <td class="center"><?php echo $id->name ?></td>
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
                                                        }
                                                        else {
                                                        $tem_hour2 = 24 + $tem_hour2;
                                                           $result_hour = $tem_hour2 - $tem_hour1;
                                                         echo $tem_hour1.':'.$tem_min1.'-'.$tem_hour2.':'.$tem_min2; 
                                                         }
                                                    }  else {
                                                      ?>
                                                      <a herf="javascript:;" onclick="get_ot_add('/ot/add_view?ot_date=<?php echo $ot_date[$i]->release_date?>&name_id=<?php echo $id->id?>')" style="cursor:pointer"><?php echo '添加加班信息';?></a>
                                                      <?php 
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
 </fieldset>
          </div>
      </div>
      </div>
                      <!-- /block -->
        </div>
                     <!-- /validation -->
                </div>
         <!--/.fluid-container-->

        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets/form-validation.js"></script>
        <script src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
        <script>
            function get_ot_add(url) {
            layer.open({
                  id: 'ex1',
                  title:'添加人员加班信息',
                  type: 2,
                  offset: '50px',
                  skin: 'layui-layer-demo', //样式类名
                  area: ['650px', '500px'],
                  content: url
                });
        }
        </script>