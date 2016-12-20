
                <div class="span9" id="content">

                    <div class="row-fluid">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <ul class="breadcrumb">
                                        <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <li>
                                            <a href="#">Dashboard</a> <span class="divider">/</span>    
                                        </li>
                                        <li class="active"><?php echo $title?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    
    <?php
        $j = 0;
        foreach ($esxi as $value) {
            if ($j % 2 == 0)  echo "<div class=\"row-fluid\">\n";
    ?>   
            
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><a href="#"><?php echo $value->ip?></a> </div>
                                    <div class="pull-right"><span class="badge badge-info"></span>

                                    </div>
                                </div>


                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>名称</th>                                                
                                                <th><span class='label label-inverse'><?php echo $value->type?> <?php echo $value->esxi_version?></span></th>
                                                <th>配置</th>
                                                <th>使用者</th>
                                                <th>系统类型</th>
                                                <th>时间</th>                                   
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
                                $esxi_data = "esxi".$value->id;
                                $i=1;
                                foreach (${$esxi_data} as $esxi_value) {
?>                                        
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><span class="label label-success"><?php echo $esxi_value->ip_alias?></span></td>                                           <td><?php echo $esxi_value->ip?></td>
                                                <td><?php echo $esxi_value->server_config?></td>
                                                <td><span class="label label-success"><?php  echo $esxi_value->ip_comments?></span></td>
                                                <td><?php echo $esxi_value->type?></td>
                                                <td><?php echo $esxi_value->opr_time?></td>                                                
                                            </tr>
                        <?php
                            $i++;
                            }
                        ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                            <!-- /block -->
                            </div>
                        <?php
                        if ($j % 2 == 1)  echo "</div>\n";
                        $j++;
                         }?>
                   
              
                </div>
            </div>
        <!--/.fluid-container-->
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>