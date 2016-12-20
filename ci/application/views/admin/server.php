
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>服务器管理</h1>
                            </div>
                        </div>
                    </div>
                    <p><?php echo anchor('admin/server/add', '新增服务器 <i class="glyphicon glyphicon-plus glyphicon-white"></i>', 'class="btn btn-primary" title="增加服务器"');?>
                <?php echo anchor('admin/server/addesxi', '新增虚拟服务器 <i class="glyphicon glyphicon-plus glyphicon-white"></i>', 'class="btn btn-primary" title="增加虚拟服务器"');?>
                    </p>
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
                                    $server_env = $this->input->get('env', TRUE);
                                    $platform_id = $this->input->get('platform_id', TRUE);
                                    // form_hidden('env',$server_env);
                                    if ($server_env == NULL) {
                                        echo anchor('admin/server?platform_id='.$platform_id, '全部服务器', 'class="btn btn-sm btn-primary" title="全部服务器"');echo ' ';
                                    } else {
                                        echo anchor('admin/server?platform_id='.$platform_id, '全部服务器', 'class="btn btn-sm btn-default" title="全部服务器"');echo ' ';
                                    }
                                    if ($server_env == '0') {
                                        echo anchor('admin/server?env=0&platform_id='.$platform_id, '系统环境', 'class="btn btn-sm btn-primary" title="系统环境"');echo ' ';
                                    } else {
                                        echo anchor('admin/server?env=0&platform_id='.$platform_id, '系统环境', 'class="btn btn-sm btn-default" title="系统环境"');echo ' ';
                                    }                                                                        
                                        foreach( $project_env_list as $va ) {                                      
                                            if ($va->id != $server_env) {
                                                echo anchor('admin/server?env='.$va->id.'&platform_id='.$platform_id.'', ''.$va->server_env.'', 'class="btn btn-sm btn-default" title="'.$va->server_env.'"');echo ' ';
                                            }
                                            else if ($va->id == $server_env) {
                                                echo anchor('admin/server?env='.$va->id.'&platform_id='.$platform_id.'', ''.$va->server_env.'', 'class="btn btn-sm btn-primary" title="'.$va->server_env.'"');echo ' ';
                                            }
                                        }                                    
                                 ?>
                                    </p>
                            <div class="controls" style="height:52px">
                                <p>
                                <?php 
                                        if ($platform_id == NULL) {
                                            echo anchor('admin/server?env='.$server_env, '全部平台', 'class="btn btn-sm btn-primary" title="全部平台"');echo ' ';
                                        }else{
                                            echo anchor('admin/server?env='.$server_env, '全部平台', 'class="btn btn-sm btn-default" title="全部平台"');echo ' ';
                                        }
                                        foreach( $platform_list as $value ) {                                      
                                            if ($value->id != $platform_id) {
                                                echo anchor('admin/server?env='.$server_env.'&platform_id='.$value->id.'', ''.$value->name.'', 'class="btn btn-sm btn-default" title="'.$value->name.'"');echo ' ';
                                            }
                                            else if ($value->id == $platform_id) {
                                                echo anchor('admin/server?env='.$server_env.'&platform_id='.$value->id.'', ''.$value->name.'', 'class="btn btn-sm btn-primary" title="'.$value->name.'"');echo ' ';
                                            }
                                        }
                                ?>
                                </p>
                            </div>
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
                                                <th>别名</th>
                                                <th>服务器IP</th>                                                 
                                                <th>环境</th>
                                                <th>配置</th>
                                                <th>系统类型</th>
                                                <th>使用者</th>
                                                <th>到时时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                $i=1;
                                foreach ($servers as $value) {
                                    $value->opr_time = substr($value->opr_time, 5,9);
                                    // substr($value->opr_time,5,2) - date('m');
                                ?>                                         
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td><span class="label label-primary"><?php echo $value->ip_alias;?></span></td>
                                                <td>
                                                <?php echo anchor('container/server_list?sid='.$value->id, substr($value->ip,0,20), 'title="查看容器"');?>
                                                <?php echo $value->pub_ip ? "<br><strong>".$value->pub_ip."</strong>":"";?>
                                                <?php echo $value->ip_alias ? "<a href=http://monit.ops.xkeshi.so:8080/reports/events/?reset=true&host=".$value->ip_alias." target=_blank>监控</a>": ''?>
                                                </td>
                                                <td><?php if($value->server_env == '0') {?>
                                                    <span class="label label-danger">系统环境</span>
                                                <?php } else if($value->server_env == '1'){?>
                                                    <span class="label label-default">开发环境</span>
                                                <?php } else if($value->server_env == '2'){?>
                                                    <span class="label label-info">测试环境</span>
                                                <?php } else if($value->server_env == '3'){?>
                                                    <span class="label label-warning">预发布环境</span>
                                                <?php } else if($value->server_env == '4'){?>
                                                    <span class="label label-success">生产环境</span>
                                                <?php }?></td>
                                                <td><?php echo $value->server_config;?></td>
                                                <td><?php echo $value->type == 'ESXi' ? "<span class='label label-default'>$value->type $value->esxi_version</span>" : $value->type;?></td>
                                                <td><?php echo $value->ip_comments;?></td>
                                                <td><?php $expire_flag = $this->server_model->judge_expire_flag($value->opr_time);
                                                echo $expire_flag <= 1 && $expire_flag >= 0 ? "<span class='label label-danger'>$value->opr_time  续费...</span>" : "<span class='label label-default'>$value->opr_time</span>";?></td>
                                            </tr>
                        <?php
                            $i++;
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