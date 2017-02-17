                <!-- content -->
                <div class="col-md-10">
                    <div class="row" >
                            <div class="col-lg-12">
                            <div class="page-header">
                                <h1>人员管理</h1>
                            </div>
                      <p>
                      <?php echo anchor('admin/group', '分组管理 <i class="glyphicon glyphicon-list glyphicon-white"></i>', 'class="btn btn-primary" title="分组管理"');?>
                      <?php echo anchor('admin/rbac', '权限管理 <i class="glyphicon glyphicon-cog glyphicon-white"></i>', 'class="btn btn-primary" title="权限管理"');?>
                      <?php echo anchor('admin/rbac/role', '角色管理<i class="glyphicon glyphicon-tags glyphicon-white"></i>', 'class="btn btn-primary" title="角色管理" ');?>
                      </p>
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
                                            echo anchor('admin/user', '全部信息', 'class="btn btn-primary" title="全部信息"');echo ' ';
                                        }else{
                                            echo anchor('admin/user', '全部信息', 'class="btn btn-default" title="全部信息"');echo ' ';
                                        }
                                        foreach( $users_level as $value ) {                                      
                                            if ($value->id != $level_id) {
                                                echo anchor('admin/user?level_id='.$value->id.'', ''.$value->level_name.'', 'class="btn btn-default" title="'.$value->level_name.'"');echo ' ';
                                            }
                                            else if ($value->id == $level_id) {
                                                echo anchor('admin/user?level_id='.$value->id.'', ''.$value->level_name.'', 'class="btn btn-primary" title="'.$value->level_name.'"');echo ' ';
                                            }
                                        }
                                            echo anchor('admin/user?level_id=dismission', '离职员工', 'class="btn btn-warning" title="离职员工" ');
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
                                                <th width="10%">姓名</th>
                                                <th>组别</th>
                                                <th width="10%">邮箱</th>
                                                <th>手机</th>
                                                <th>IP</th>
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
                                                <td>
                                                    <span class="label label-success">
                                                        <?php echo $this->user_model->get_LevelName_by_LevelId($user->level_id);?>
                                                    </span>
                                                </td>
                                                <?php if ($user->email_exist == 1) {?>
                                                    <td><a href="mailto:<?php echo $user->email?>"><?php echo $user->email?></a></td>
                                                <?php }else if($user->email_exist == 0) {?>
                                                    <td>
                                                        <?php echo $user->email?><a href="javascript:;" onclick="add_email('/admin/user/add_email?id=<?php echo $user->id?>')"><button type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i>开通邮箱</button></a>
                                                    </td>
                                                <?php } ?>
                                                <td><?php echo $user->tel?></td>
                                                <td><?php echo $user->user_ip?></td>
                                                <td>
                                                    <?php 
                                                        if ($user->group_leader == 0) {
                                                            echo "成员";
                                                        }
                                                        else{
                                                            echo "<strong>组长</strong>";
                                                        }
                                                       
                                                    ?>
                                                </td>
                                                <td class="actions">
                                                <div style="float:right">
                                                    <p>
                                                     <a href="javascript:;" class="runcode" onclick="check_user_permission('/admin/user/user_permission?id=<?php echo $user->id?>')">
                                                        <button type="button" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-pencil"></i>权限</button></a>
                                                    <a href="javascript:;" class="runcode" onclick="get_user_change('/admin/user/update?user_id=<?php echo $user->id?>')">
                                                        <button type="button" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i>修改</button></a>
                                                    <a href="javascript:;" class="runcode" onclick="get_user_delete('<?php echo $user->id?>')">
                                                        <button type="button" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i>离职</button></a>
                                                    </p>
                                                </div>
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
                                                <td><span class="label label-success"><?php echo $this->user_model->get_LevelName_by_LevelId($user->level_id);?></span></td>
                                                <?php if ($user->email_exist == 1) {?>
                                                    <td><a href="mailto:<?php echo $user->email?>"><?php echo $user->email?></a></td>
                                                <?php }else if($user->email_exist == 0) {?>
                                                    <td><?php echo $user->email?><a href="javascript:;" onclick="add_email('/admin/user/add_email?id=<?php echo $user->id?>')"><button type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i>开通邮箱</button></a></td>
                                                <?php } ?>
                                                <td><?php echo $user->tel?></td>
                                                <td><?php echo $user->user_ip?></td>
                                                <td>
                                                    <?php 
                                                        if ($user->group_leader == 0) {
                                                            echo "成员";
                                                        }
                                                        else{
                                                            echo "<strong>组长</strong>";
                                                        }
                                                       
                                                    ?>
                                                </td>
                                                <td class="actions">
                                                <div style="float:right">
                                                    <p>
                                                     <a href="javascript:;" class="runcode" onclick="check_user_permission('/admin/user/user_permission?id=<?php echo $user->id?>')">
                                                        <button type="button" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-pencil"></i>权限</button></a>
                                                    <a href="javascript:;" class="runcode" onclick="get_user_change('/admin/user/update?user_id=<?php echo $user->id?>')">
                                                        <button type="button" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i>修改</button></a>
                                                    <a href="javascript:;" class="runcode" onclick="get_user_delete('<?php echo $user->id?>')">
                                                        <button type="button" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i>离职</button></a>
                                                        
                                                    </p>
                                                </div>
                                                </td>
                                            </tr>
                            <?php }?>
                            <?php 
                                 }
                            }
                            ?>
                                    </tbody>
                                    <?php
                                        $n = 0;
                                        if ($level_id == "dismission"){
                                    ?>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>姓名</th>                                                 
                                                <th>邮箱</th>
                                                <th>手机</th>
                                                <th>离职部门</th>                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                            foreach( $users_dimission as $user) {
                                    ?>
                                        
                                            <tr class="odd gradeX">
                                                <td><?php echo $n = $n+1;?></td>
                                                <td><?php echo $user->name?></td>
                                                <td>
                                                <?php if ($user->email_exist == 0){?>
                                                    <strike><?php echo $user->email?></strike>
                                                <?php }else{ ?>
                                                    <?php echo $user->email?><a href="javascript:;" onclick="email_disable('<?php echo $user->email?>')"><button type="button" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-pencil"></i>邮箱禁用</button></a>
                                                <?php } ?>
                                                </td>
                                                <td><?php echo $user->tel?></td>
                                                <td><?php echo $this->user_model->get_LevelName_by_LevelId($user->level_id)?></td>
                                            </tr>
                                    <?php
                                            }
                                        }
                                     ?>
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- JS -->
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
        // layer弹出层（修改个人信息）
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
        // layer弹出层（添加邮箱）
        function add_email(url) {
            layer.open({
                  title:false,
                  type: 2,
                  // offset: '50px',
                  skin: 'layui-layer-demo', //样式类名
                  area: ['50%', '60%'],
                  content: url
                });
        }
        // 删除人员账号信息
         function get_user_delete(user_id) {
            layer.prompt({
                title :'请输入删除密码',
                formType: 1
            },function(val){
                $.ajax({
                    type: "GET",
                    url:"/admin/user/delete?user_id="+user_id+"&pwd="+val,//要执行删除的url地址
                    success: function (data) {
                         if (data == "error_pwd") {
                            layer.msg('密码错误，请重试！', {time: 3000,icon: 1});
                         }else if (data == "error_ldap_search") {
                            layer.msg('查询ldap失败！', {time: 3000,icon: 1});
                         }else if (data == "error_ldap_del") {
                            layer.msg('ldap删除信息失败！', {time: 3000,icon: 1});
                         }else{
                            layer.msg(data+'的信息删除成功！', {time: 3000,icon: 1}, function(){
                                parent.window.location.reload();
                            });
                        }
                    },
                    error: function () {
                         layer.msg('程序内部错误！', {time: 3000,icon: 1});
                    }
                })
            });
        }
        // 用户邮箱禁用
        function email_disable(email) {
            $.ajax({
                url:"/admin/user/email_disable?email=" + email,//邮箱禁用接口
                success:function(data){
                    if (data == "success") {
                        layer.msg('邮箱已禁用！', {time: 3000,icon: 1});
                        parent.window.location.reload();
                    }else{
                        layer.msg('禁用失败请检查！', {time: 3000,icon: 1}, function(){
                                parent.window.location.reload();
                            });
                    }
                },
                error: function() {
                    layer.msg('程序内部错误！', {time: 3000,icon: 1});
                    parent.window.location.reload();
                }
            })
        }
        //  function get_user_delete(user_id) {
        //     layer.confirm('您确定要删除该员工信息吗？', {
        //             btn: ['确定','取消'] //按钮
        //             }, function(){
        //     $.ajax({
        //         type: "GET",
        //         url:"/admin/user/delete?user_id="+user_id,//我要执行删除的url地址
        //         success: function (data) {
        //              layer.msg(data+'的信息删除成功', {time: 1000,icon: 1}, function(){
        //                 parent.window.location.reload();  
        //              });
        //         },
        //         error: function () {
        //              layer.msg('删除失败', {time: 1000,icon: 1});
        //         }
        //     })
        //         });
        // }
        </script>