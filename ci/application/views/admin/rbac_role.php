                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="/admin/user">人员管理</a>
                                    </li>                                  
                                    <li>角色管理</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                            <div class="col-lg-12">
                            <div class="page-header">
                                <h1>角色管理</h1>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-14">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">角色权限管理</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                            <?php
                                            ?>
                                                <th>权限\角色</th>
                                                <th>普通用户</th>                                                  
                                                <th>高级用户</th>
                                                <th>行政</th>
                                                <th>VIP</th> 
                                                <th>管理员</th>                                               
                                                <th>超级管理员</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                    $number = 0;                                                      
                                        foreach( $front_power_all as $value) {
                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $value ->power_name;?></td>
                                                <td><input type="checkbox" checked name="disconfig" value="1"></td>
                                                <td><input type="checkbox" checked name="disconfig" value="1"></td>
                                                <td><input type="checkbox" checked name="disconfig" value="1"></td>
                                                <td><input type="checkbox" checked name="disconfig" value="1"></td>
                                                <td><input type="checkbox" checked name="disconfig" value="1"></td>
                                                <td><input type="checkbox" checked name="disconfig" value="1"></td>
                                            </tr>
                            <?php }?>
                                    </tbody>
                                        <tbody>
                                      </tbody>
                                    </table>
                                    <p align="center">
                                    <?php 
                                        echo anchor('admin/rbac/role', '保存', 'class="btn btn-primary" title="保存" ');
                                    ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>
        <script type="text/javascript">
        </script>