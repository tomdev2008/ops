                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>运维管理后台</h1>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="#">运维管理平台</a>
                                    </li>
                                    <li>
                                        <a href="#">总后台</a>
                                    </li>
                                    <li class="active">控制台</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">应用服务数量分布</div>
                                    <div class="pull-right"><span class="badge">共计<?php echo count($server_list);?>个</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $percent1 = round(100*(count($server_list_dev))/(count($server_list)));?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $percent1;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">开发环境</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $percent2 = round(100*(count($server_list_test))/(count($server_list)));?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $percent2;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">测试环境</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $percent3 = round(100*(count($server_list_pre))/(count($server_list)));?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $percent3;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">预发环境</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="<?php echo $percent4 = round(100*(count($server_list_pro))/(count($server_list)));?>" style="width: 110px; height: 110px; line-height: 110px;"><?php echo $percent4;?>%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">生产环境</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">工单未处理</div>
                                    <div class="pull-right"><span class="badge"><?php echo count($ticket_list_undo);?></span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped">
                          <thead>
                           <tr>
                              <th>#</th>
                              <th>标题</th>
                              <th width="20%">员工</th>
                              <th width="25%">时间</th>
                            </tr>
                          </thead>
                          <tbody>
                <?php
                      $num = 0;
                      foreach ($ticket_list_undo as $key => $value) {
                ?>
                            <tr>
                              <td><?php echo $num=$num+1?></td>               
                              <td><?php echo '<a href=/admin/ticket/view/'.$value->id.'>'.$value->title.'</a>'?></td>
                              <td><?php echo $value->submitter_name?></td>
                              <td><?php echo substr($value->opr_time, 0,10)?></td>
                            </tr>
                <?php
                    }
                  ?> 
                          </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">工单处理中</div>
                                    <div class="pull-right"><span class="badge"><?php echo count($ticket_list_done);?></span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                        <table class="table table-striped">
                          <thead>
                           <tr>
                              <th>#</th>
                              <th>标题</th>
                              <th width="20%">员工</th>
                              <th width="25%">时间</th>
                            </tr>
                          </thead>
                          <tbody>
                <?php
                      $num = 0;
                      foreach ($ticket_list_done as $key => $value) {
                ?>
                            <tr>
                              <td><?php echo $num=$num+1?></td>               
                              <td><?php echo '<a href=/admin/ticket/view/'.$value->id.'>'.$value->title.'</a>'?></td>
                              <td><?php echo $value->submitter_name?></td>
                              <td><?php echo substr($value->opr_time, 0,10)?></td>
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
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/easypiechart/jquery.easy-pie-chart.js"></script>

        <script type="text/javascript">
            $(function() {
                // Easy pie charts
                $('.easyPieChart').easyPieChart({animate: 1000});
            });
        </script>
