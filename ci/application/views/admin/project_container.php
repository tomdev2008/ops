                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="/admin/project">项目管理</a>
                                    </li>
                                    <li><?php echo $title_name = $this->project_model->get_alias_name_by_server_project($server_project)?></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                            <?php 
                                $container_env = $this->input->get('container_env', TRUE);
                                $server_project = $this->input->get('server_project', TRUE);
                                $platform_id = $this->project_model->get_platform_id_by_id($server_project);
                                form_hidden('container_env',$container_env);
                                form_hidden('server_project',$server_project);
                            ?>
                                <h1><?php echo $title_name = $this->project_model->get_alias_name_by_server_project($server_project)?></h1>
                            </div>
                        </div>
                    </div>
                    <?php if (!$container_env == NULL) {
                    ?>
                    <p>
                    <a href="javascript:;" class="runcode" onclick="add_jenkins('/admin/project/jenkins?server_project=<?php echo $server_project?>&env=<?php echo $container_env?>&platform_id=<?php echo $platform_id;?>')"><button type="button" class="btn btn-primary">添加jenkins <i class="glyphicon glyphicon-plus glyphicon-white"></i></button></a>
                    </p>
                    <?php 
                    }?>
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
                                    if ($container_env == NULL) {
                                        echo anchor('admin/project/container?server_project='.$server_project.'', '全部容器', 'class="btn btn-primary" title="全部容器"');echo ' ';
                                    }else{
                                    echo anchor('admin/project/container?server_project='.$server_project.'', '全部容器', 'class="btn btn-default" title="全部容器"');echo ' ';
                                    }
                                    foreach( $server_env as $value ) {                                      
                                      if ($value->id != $container_env) {
                                          echo anchor('admin/project/container?container_env='.$value->id.'&server_project='.$server_project.'', ''.$value->server_env.'', 'class="btn btn-default" title="'.$value->server_env.'"');echo ' ';
                                      }
                                      else if ($value->id == $container_env) {
                                          echo anchor('admin/project/container?container_env='.$value->id.'&server_project='.$server_project.'', ''.$value->server_env.'', 'class="'.$value->level_class.'" title="'.$value->server_env.'"');echo ' ';
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
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle;">#</th>
                                                <th style="text-align: center; vertical-align: middle;">APP名称</th>  
                                                <th style="text-align: center; vertical-align: middle;">容器名称</th>                                               
                                                <th style="text-align: center; vertical-align: middle;">部署服务器</th>
                                                <th style="text-align: center; vertical-align: middle;">应用别名</th>
                                                <th style="text-align: center; vertical-align: middle;">属性</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        $num = 0;
                                        foreach( $containers as $value ) {
                                        $sum = $this->project_model->get_num_all_by_server_name($value->server_name);
                                        // echo $sum;
                                ?>        
                                            <tr class="odd gradeX">
                                            <td style="text-align: left; vertical-align: middle;" rowspan="<?php echo $sum?>"><?php echo $num=$num+1?></td>
                                                <td style="text-align: left; vertical-align: middle;" rowspan="<?php echo $sum?>"><a href="javascript:;" class="runcode" onclick="get_jenkins_change('/admin/container/jenkins?id=<?php echo $value->id?>')"><?php echo $value->server_name?></a>&nbsp;<a href="http://jenkins.ops.xkeshi.so/job/<?php echo $value->server_name?>" target="_blank"><img src="<?php echo base_url();?>images/jenkins.ico" border="0" width="16" height="16"></a>&nbsp;<a href="javascript:;" class="runcode" onclick="get_domain_change('/admin/container/domain?id=<?php echo $value->id?>')"><button type="button" class="btn btn-xs btn-success">域名</button></a>&nbsp;<a href="javascript:;" class="runcode" onclick="window.open('http://ops.xkeshi.so/api/jenkins/server?server_name=<?php echo $value->server_name?>&pretty=true','_blank')"><button type="button" class="btn btn-xs btn-warning">API</button></a>&nbsp;<a href="javascript:;" class="runcode" onclick="add_jenkins('/admin/project/jenkins_copy?server_name=<?php echo $value->server_name?>')"><button type="button" class="btn btn-xs btn-default">复制</button></a></td>
                            <?php
                                    $ID = $this->project_model->get_project_id_by_server_name($value->server_name);
                                    foreach ($ID as $key => $value2)
                                    {
                                        $id = $value2->id;
                                        $project_env_num = 1;
                                        $haha = $this->project_model->get_alias_by_id($value2->id);
                                        $server_deploy_port = $this->project_model->get_server_deploy_port_by_id($value2->id);
                                        $server_type = $this->project_model->get_server_type_by_id($value2->id);
                            ?>
                                                <td><span class="label label-primary"><?php echo $server_type.$id?></span></td>
                                                <td>
                                                <?php
                                                    echo $haha; 
                                                    echo ':'.$server_deploy_port?><br>
                                                    </td>
                                                <td><?php echo $value->server_alias_name?></td>
                                                <td><?php if($value->server_status == 1) {?><span class="label label-success">已部署</span>
                                                    <?php }else if($value->server_status == 2) {?><span class="label label-warning">部署中</span>
                                                    <?php }else if($value->server_status == 0) {?><span class="label label-danger">已删除</span>
                                                    <?php }?>
                                                </td>  
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
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>layer/layer.js"></script>
        <script type="text/javascript">
            function get_jenkins_change(url) {
            layer.open({
                  id: 'ex1',
                  title:false,
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  area: ['650px', '600px'],
                  content: url
                });
        }
            function get_domain_change(url) {
            layer.open({
                  id: 'ex1',
                  title:false,
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  area: ['650px', '400px'],
                  content: url
                });
        }
            function add_jenkins(url) {
            layer.open({
                  id: 'ex2',
                  title:false,
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  area: ['875px', '600px'],
                  content: url
                });
        }            

        </script>