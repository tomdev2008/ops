                <div class="col-md-10">
                        <!-- block -->
                        <div class="col-lg-14">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">登录日志管理</div>
                                </div>
                            <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped table-bordered" id="example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>登录邮箱</th>
                                                <th>登录姓名</th>                                                 
                                                <th>登录IP</th>
                                                <th>登录时间</th>
                                                <th>相关操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        foreach( $logs as $key => $user ) {
                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo ++$key;?></td>
                                                <td><a href="mailto:<?php echo $user->email?>"><?php echo $user->email?></a></td>
                                                <td><?php echo $user->name?></td>
                                                <td><span class="label label-danger"><?php echo $user->login_ip?></span></td>
                                                <td><?php echo $user->logintime?></td>
                                                <td>
                                                <?php
                                                    $operation = [
                                                        '0' => '登录后台',
                                                        '1' => '登录前台',
                                                        '2' => '办理离职手续',
                                                        '3' => '删除配置',
                                                        '4' => '修改配置',
                                                        '5' => '邮箱审核',
                                                        '6' => '邮箱禁用'
                                                    ];
                                                    echo $operation[$user->operation];
                                                ?></td>
                                            </tr>
                                 <?php
                                 }
                                 ?>
                                                                               
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

         <!--/.fluid-container-->

        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>
        <script>
        $(function() {
        });
        </script>