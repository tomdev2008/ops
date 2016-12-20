
                <div class="span10" id="content">

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
        foreach ($cname as $key => $value) {
            if ($j % 2 == 0)  echo "<div class=\"row-fluid\">\n";
    ?>   
            
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><a href="#"><?php echo $value->domain?></a> </div>
                                    <div class="pull-right"><span class="badge badge-info"></span>

                                    </div>
                                </div>


                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>星座</th>                                                
                                                <th><span class='label label-inverse'>CNAME</span></th>
                                                <th></th>
                                                <th>对应解析IP(组)</th>
                                                <th>时间</th>                                   
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
                                $cname_data = "cname_".$key;
                                $i=1;
                                foreach (${$cname_data} as $cname_value) {
?>                                        
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><span class="label label-success"><?php echo $cname_value->constellation_cn?></span></td>
                                                <td><a href="http://<?php echo $cname_value->constellation?>.<?php echo $cname_value->domain?>" target='_blank'><?php echo $cname_value->constellation?>.<?php echo $cname_value->domain?></a></td>
                                                <td><i class="icon-arrow-right"></i> </td>
                                                <?php 
                                                    $pub_ip_alias = explode(',', $cname_value->ip_alias);
                                                    $pub_ip_data = explode(',', $cname_value->pub_ip);
                                                 ?>
                                                 <td>
                                                 <?php    
                                                    foreach ($pub_ip_alias as $key => $value) {
                                                        printf('<span class="label label-info">%-15s:</span>',$value);
                                                        printf("%20s<br>",$pub_ip_data[$key]);
                                                    }
                                                ?>
                                                </td>
                                                <td><?php echo $cname_value->opr_time?></td>                                                
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