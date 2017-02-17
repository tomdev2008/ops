                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="/admin/user">人员管理</a>
                                    </li>                                    
                                    <li>权限管理</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row" >
                            <div class="col-lg-12">
                            <div class="page-header">
                                <h1>权限管理</h1>
                            </div>
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">部门列表</div>
                                </div>
                               <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>
                                    <p>
                                    <?php 
                                        $level_id = $this->input->get('level_id', TRUE);
                                        form_hidden('level_id',$level_id);
                                        if ($level_id == NULL) {
                                            echo anchor('admin/rbac', '全部信息', 'class="btn btn-primary" title="全部信息"');echo ' ';
                                        }else{
                                            echo anchor('admin/rbac', '全部信息', 'class="btn btn-default" title="全部信息"');echo ' ';
                                        }
                                        foreach( $users_level as $value ) {                                      
                                            if ($value->id != $level_id) {
                                                echo anchor('admin/rbac?level_id='.$value->id.'', ''.$value->level_name.'', 'class="btn btn-default" title="'.$value->level_name.'"');echo ' ';
                                            }
                                            else if ($value->id == $level_id) {
                                                echo anchor('admin/rbac?level_id='.$value->id.'', ''.$value->level_name.'', 'class="btn btn-primary" title="'.$value->level_name.'"');echo ' ';
                                            }
                                        }
                                    ?>
                                    </p>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-14">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">员工信息管理</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped table-bordered" id="example">
                                <?php
                                    if ($level_id != "dismission") {
                                ?>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>姓名</th>                                                  
                                                <th>邮箱</th>
                                                <th>配置中心</th>
                                                <th>数据库查询</th> 
                                                <th width="10%">角色</th>                                               
                                                <th width="20%">员工操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                    if ($level_id != null && $level_id != "dismission") {
                                        $num = 0;
                                        foreach( $users as $user ) {
                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $num = $num+1;?></td>
                                                <td><?php 
                                                    if ($user->group_leader == 0) {
                                                        echo $user->name;
                                                    }
                                                    else{
                                                        echo "<strong>".$user->name."</strong>";
                                                    }
                                                ?></td>
                                                <td><a href="mailto:<?php echo $user->email?>"><?php echo $user->email?></a></td>
                                                <td><?php 
                                                $disconfig = $this->rbac_model->get_disconfig_by_id($user->id);
                                                if ($disconfig == 1) {
                                                    ?>
                                                    <input type="checkbox" checked disabled></td>
                                                    <?php
                                                } else {
                                                    ?><input type="checkbox" disabled></td>
                                                    <?php
                                                }
                                                 ?>
                                                <td><?php 
                                                $db = $this->rbac_model->get_db_by_id($user->id);
                                                if ($db == 1) {
                                                    ?>
                                                    <input type="checkbox" checked disabled></td>
                                                    <?php
                                                } else {
                                                    ?><input type="checkbox" disabled></td>
                                                    <?php
                                                }
                                                 ?>
                                                <td>
                                                    <?php 
                                                       $role_id = $this->rbac_model->get_role_by_id($user->id);
                                                       echo $role_name = $this->rbac_model->get_role_name_by_id($role_id); 
                                                    ?>
                                                </td>
                                                <td class="actions">
                                                <a href="javascript:;" class="runcode" onclick="get_user_change('/admin/rbac/update?user_id=<?php echo $user->id?>')">
                                                        <button type="button" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-pencil"></i>修改</button></a>
                                                </td>
                                            </tr>
                                <?php 
                                        } 
                                }
                                ?>
                                <?php
                                    $number = 0;
                                    if ($level_id == null) {
                                        
                                        foreach( $users_all as $user) {
                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $number = $number+1;?></td>
                                                <td><?php 
                                                    if ($user->group_leader == 0) {
                                                        echo $user->name;
                                                    }
                                                    else{
                                                        echo "<strong>".$user->name."</strong>";
                                                    }
                                                ?></td>
                                                <td><a href="mailto:<?php echo $user->email?>"><?php echo $user->email?></a></td>
                                                <td><?php 
                                                $disconfig = $this->rbac_model->get_disconfig_by_id($user->id);
                                                if ($disconfig == 1) {
                                                    ?>
                                                    <input type="checkbox" checked disabled></td>
                                                    <?php
                                                } else {
                                                    ?><input type="checkbox" disabled></td>
                                                    <?php
                                                }
                                                 ?>
                                                <td><?php 
                                                $db = $this->rbac_model->get_db_by_id($user->id);
                                                if ($db == 1) {
                                                    ?>
                                                    <input type="checkbox" checked disabled></td>
                                                    <?php
                                                } else {
                                                    ?><input type="checkbox" disabled></td>
                                                    <?php
                                                }
                                                 ?>
                                                <td>
                                                    <?php 
                                                        $role_id = $this->rbac_model->get_role_by_id($user->id);
                                                        echo $role_name = $this->rbac_model->get_role_name_by_id($role_id);                      
                                                    ?>
                                                </td>
                                                <td class="actions">
                                                <a href="javascript:;" class="runcode" onclick="get_user_change('/admin/rbac/update?user_id=<?php echo $user->id?>')">
                                                        <button type="button" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-pencil"></i>修改</button></a>
                                                </td>
                                            </tr>
                            <?php }?>
                            <?php 
                                 }
                            }
                            ?>
                                    </tbody>
                                        <tbody>
                                      </tbody>
                                    </table>
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
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script type="text/javascript">
        function check_user_permission(url) {
            layer.open({
                  id: 'ex1',
                  title:false,
                  type: 2,
                  // offset: '50px',
                  skin: 'layui-layer-demo', //样式类名
                  area: ['350px', '300px'],
                  content: url
                });
        }
        function get_user_change(url) {
            layer.open({
                  id: 'ex1',
                  title:false,
                  type: 2,
                  // offset: '50px',
                  skin: 'layui-layer-demo', //样式类名
                  area: ['500px', '550px'],
                  content: url
                });
        }
        </script>