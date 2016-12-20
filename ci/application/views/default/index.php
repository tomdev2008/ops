
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
	                                    <li>
	                                        <a href="#">Settings</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li class="active">Tools</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">M/MONIT监控状态</div>
                                <div class="pull-right"><a href="http://monit.ops.xkeshi.so:8080/status/hosts/" target="_blank"><span class="badge badge-warning">查看更多</span></a>

                                </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span3">
                                    <div class="chart" data-percent="100">100%</div>
                                    <div class="chart-bottom-heading"><span class="label label-info">Visitors</span>

                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="chart" data-percent="100">100%</div>
                                    <div class="chart-bottom-heading"><span class="label label-info">Page Views</span>

                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="chart" data-percent="100">100%</div>
                                    <div class="chart-bottom-heading"><span class="label label-info">Users</span>

                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="chart" data-percent="100">100%</div>
                                    <div class="chart-bottom-heading"><span class="label label-info">Orders</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    <div class="container-fluid">
                    <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">运维成员</div>
                                    <div class="pull-right"><span class="badge badge-info"><?php
                                    //print_r($ops_on_duty);
                                     echo $ops_on_duty['0']->count?></span>

                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>姓名</th>
                                                <th>联系方式</th>
                                                <th>QQ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                        <?php
                            foreach ($ops_on_duty as $key => $value) {
                        ?>
                                   
                                            <tr>
                                                <td><?php echo $key+1?></td>
                                                <td><?php echo $value->name?></td>
                                                <td><?php echo $value->tel?></td>
                                                <td><a target=blank href=tencent://message/?uin=<?php echo $value->qq;?>&Site=<?php echo $value->name?>&Menu=yes><img border="0" SRC=http://wpa.qq.com/pa?p=1:<?php echo $value->qq;?>:1 alt="有事点这里"></a></td>
                                            </tr>
                        <?php
                            }
                        ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                             <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">内部工具</div>
                                    <div class="pull-right"><span class="badge badge-info">3</span>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>名称</th>
                                                <th>网址</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>jenkins</td>
                                                <td><a href="http://jenkins.ops.xkeshi.so/" target="_blank">http://jenkins.ops.xkeshi.so</a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>配置中心<span class="label label-success">朱黎明</span></td>
                                                <td><a href="http://disconf.ops.xkeshi.so/" target="_blank">http://disconf.ops.xkeshi.so</a></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>RAP</td>
                                                <td><a  href="http://rap.ops.xkeshi.so/" target="_blank">http://rap.ops.xkeshi.so</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                            <!-- /block -->
                  </div>
                    </div>
   <?php
        $j = 0;
        foreach ($platform as $value) {
            if ($j % 2 == 0)  echo "<div class=\"row-fluid\">\n";
    ?>   
            
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><?php echo $value->gallery_name?></div>
                                    <div class="pull-right"><span class="badge badge-info"></span>

                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>名称</th>
                                          <th>网址</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                         <?php
                            $galleryform = "platform_".$value->id;
                              $i=1;
                              foreach (${$galleryform} as $value) {
                        ?>             
                                        <tr>
                                          <td><?php printf("%2d",$i) ;?></td>
                                          <td><?php echo $value->gallery_name;?>
                                           <span class="label label-success"><?php echo $value->username?></span></td>
                                          <td><a target=blank href="<?php echo $value->gallery_url?>"><?php echo $value->gallery_url; ?></a></td>
                                        </tr>

                                <?php 
                                $i++;
                                }?>
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