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
                                    <div class="text-muted bootstrap-admin-box-title">Statistics</div>
                                    <div class="pull-right"><span class="badge">View More</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="73" style="width: 110px; height: 110px; line-height: 110px;">73%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Visitors</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="53" style="width: 110px; height: 110px; line-height: 110px;">53%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Page Views</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="83" style="width: 110px; height: 110px; line-height: 110px;">83%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Users</span></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="easyPieChart" data-percent="13" style="width: 110px; height: 110px; line-height: 110px;">13%<canvas width="110" height="110"></canvas></div>
                                        <div class="chart-bottom-heading"><span class="label label-info">Orders</span></div>
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
                                    <div class="pull-right"><span class="badge">5</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped">
                          <thead>
                           <tr>
                              <th>#</th>
                              <th>标题</th>
                              <th>员工</th>
                              <th>时间</th>
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
                              <td><?php echo $value->opr_time?></td>
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
                                    <div class="pull-right"><span class="badge">5</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                        <table class="table table-striped">
                          <thead>
                           <tr>
                              <th>#</th>
                              <th>标题</th>
                              <th>员工</th>
                              <th>时间</th>
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
                              <td><?php echo $value->opr_time?></td>
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

<!--                     <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Clients</div>
                                    <div class="pull-right"><span class="badge">17</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Vincent</td>
                                                <td>Gabriel</td>
                                                <td>@gabrielva</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Invoices</div>
                                    <div class="pull-right"><span class="badge">812</span></div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>02/02/2013</td>
                                                <td>$25.12</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>01/02/2013</td>
                                                <td>$335.00</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>01/02/2013</td>
                                                <td>$29.99</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
