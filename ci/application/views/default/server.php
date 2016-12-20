
                <div class="span10" id="content">
                    <div class="row-fluid">
    <?php
        foreach ($server_location as $value) {

    ?>   

                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><?php echo $value['name']?></div>
                                    <div class="pull-right"><span class="badge badge-info"><?php echo $value['count']?></span>

                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>服务器IP</th>
                                                <th>环境</th>  
                                                <th>配置</th>                                           
                                                <th>系统类型</th>
                                                <th>服务代码</th>
                                                <th>备注</th>
                                                <th>到时时间</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                         <?php
                                $server_data = "server".$value['id'];
                                $i=1;
                                foreach (${$server_data} as $value) {
                                    $value->opr_time = substr($value->opr_time, 5,11);
                        ?>                                         
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td>
                                                <?php echo anchor('container/server_list?sid='.$value->id, $value->ip, 'title="查看容器"');?>
                                                <?php echo $value->pub_ip ? "<br><strong>".$value->pub_ip."</strong>":"";?>
                                                <?php echo $value->ip_alias ? "<a href=http://monit.ops.xkeshi.so:8080/reports/events/?reset=true&host=".$value->ip_alias." target=_blank>监控</a>": ''?>
                                                </td>
                                                <td><?php if($value->server_env == '0') {?>
                                                    <span class="label label-important">系统环境</span>
                                                <?php } else if($value->server_env == '1'){?>
                                                    <span class="label label-inverse">开发环境</span>
                                                <?php } else if($value->server_env == '2'){?>
                                                    <span class="label label-info">测试环境</span>
                                                <?php } else if($value->server_env == '3'){?>
                                                    <span class="label label-warning">预发布环境</span>
                                                <?php } else if($value->server_env == '4'){?>
                                                    <span class="label label-success">生产环境</span>
                                                <?php }?></td>
                                                <td><?php echo $value->server_config;?></td>
                                                <td><?php echo $value->type == 'ESXi' ? "<span class='label label-inverse'>$value->type $value->esxi_version</span>" : $value->type;?></td>
                                                <td><?php echo $value->service_no;?></td>
                                                <td><span class="label label-success"><?php echo $value->ip_alias;?></span></td>
                                                <td><?php echo $value->expire_flag <= 1 && $value->expire_flag >= 0 ? "<span class='label label-important'>$value->opr_time  续费...</span>" : "<span class='label'>$value->opr_time";?></span></td>
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
                        <?php }?>
                   
                    </div>
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