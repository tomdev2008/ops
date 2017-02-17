                <div class="span9" id="content">
                    <div class="row-fluid">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <ul class="breadcrumb">
                                        <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <li>
                                            <a href="/">控制台</a> <span class="divider">/</span>    
                                        </li>
                                        <li class="active">常用链接管理</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <div class="row-fluid">
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">常用链接分组</div>
                                </div>
                                <div class="block-content collapse in">
                                    <div class="span12">
                                    <?php 
                                    $platform_id = $this->input->get('platform_id', TRUE);
                                    form_hidden('platform_id',$platform_id);
                                    if ($platform_id == NULL) {
                                        echo anchor('gallery', '全部信息', 'class="btn btn-success" title="全部信息"');echo ' ';
                                    }else{
                                    echo anchor('gallery', '全部信息', 'class="btn btn-default" title="全部信息"');echo ' ';
                                    }
                                    foreach( $platform as $value ) {                                      
                                      if ($value->id != $platform_id) {
                                          echo anchor('gallery?platform_id='.$value->id.'', ''.$value->gallery_name.'', 'class="btn btn-default" title="'.$value->gallery_name.'"');echo ' ';
                                      }
                                      else if ($value->id == $platform_id) {
                                          echo anchor('gallery?platform_id='.$value->id.'', ''.$value->gallery_name.'', 'class="btn btn-primary" title="'.$value->gallery_name.'"');echo ' ';
                                      }                                           
                                 }
                                 ?>
                                         
                                    </div>
                                </div>
                            </div>   
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">常用链接列表</div>
                                    <div class="pull-right"><span class="badge badge-info"></span>

                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                <div class="span12">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>名称</th>                                                 
                                                <th>网址</th>
                                                <th>版本</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                         <?php
                            $galleryform = "platform_".$value->id;
                              $i=1;
                              foreach ($gallerys as $value) {
                        ?>             
                                        <tr>
                                          <td><?php printf("%2d",$i) ;?></td>
                                           <td><?php echo $value->gallery_name;?>
                                           <span class="label label-success"><?php echo $value->user_name?></span></td>
                                          <!-- <td><?php echo $value->gallery_name;?>
                                           <span class="label label-success"><?php echo $user_name = $this->gallery_model->get_user_name_by_id($value->user_id)?></span></td> -->
                                          <td><a target=blank href="<?php echo $value->gallery_url?>"><?php echo $value->gallery_url; ?></a></td>
                                          <th><?php echo $value->gallery_version?></th>
                                        </tr>
                                <?php 
                                $i++;
                                }?>
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
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>