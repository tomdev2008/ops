
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>容器管理</h1>
                            </div>
                        </div>
                    </div>
<!--                         <p><?php echo anchor('admin/container/add', '新增容器 <i class="glyphicon glyphicon-pencil glyphicon-white"></i>', 'class="btn btn-success" title="新增容器"');?></p> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">分组</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>
                                    <p>
                                    <?php 
                                    $container_env = $this->input->get('container_env', TRUE);
                                    form_hidden('container_env',$container_env);
                                    if ($container_env == NULL) {
                                        echo anchor('admin/container', '全部容器', 'class="btn btn-primary" title="全部容器"');echo ' ';
                                    }else{
                                    echo anchor('admin/container', '全部容器', 'class="btn btn-default" title="全部容器"');echo ' ';
                                    }
                                    foreach( $server_env as $value ) {                                      
                                      if ($value->id != $container_env) {
                                          echo anchor('admin/container?container_env='.$value->id.'', ''.$value->server_env.'', 'class="btn btn-default" title="'.$value->server_env.'"');echo ' ';
                                      }
                                      else if ($value->id == $container_env) {
                                          echo anchor('admin/container?container_env='.$value->id.'', ''.$value->server_env.'', 'class="'.$value->level_class.'" title="'.$value->server_env.'"');echo ' ';
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
                                <div class="text-muted bootstrap-admin-box-title"><?php echo $title?></div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped table-bordered" id="example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>容器名称</th>                                                 
                                                <th>部署服务器</th>
                                                <th>应用别名</th>
                                                <th>部署目录</th>
                                                <th>属性</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        $num = 0;
                                        foreach( $containers as $value ) {
                                ?>        
                                            <tr class="odd gradeX">
                                                <td><?php echo $num=$num+1?></td>
                                                <td><span class="label label-primary"><?php echo $value->server_type.$value->id?></span></td>
                                                <td><?php
                                                    echo $haha = $this->container_model->get_alias_by_ip($value->server_deploy_ip); 
                                                    echo ':'.$value->server_deploy_port?><br>
                                                    <?php echo $value->server_name?></td>
                                                <td><?php echo $value->server_alias_name?></td>
                                                <td><?php echo $value->server_deploy_path?></td>
                                                <td><?php if($value->server_status == 1) {?><span class="label label-success">已部署</span>
                                                    <?php }else if($value->server_status == 2) {?><span class="label label-warning">部署中</span>
                                                    <?php }else if($value->server_status == 0) {?><span class="label label-danger">已删除</span>
                                                    <?php }?>
                                                </td>  
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
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>layer/layer.js"></script>
        <script type="text/javascript">
            function get_project_change(url) {
            layer.open({
                  id: 'ex1',
                  title:false,
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  area: ['650px', '400px'],
                  content: url
                });
        }
            

        </script>