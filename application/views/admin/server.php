
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>服务器管理</h1>
                            </div>
                        </div>
                    </div>
                    <p><?php echo anchor('admin/server/add', '新增服务器 <i class="glyphicon glyphicon-pencil glyphicon-white"></i>', 'class="btn btn-success" title="增加服务器"');?>
                <?php echo anchor('admin/server/addesxi', '新增虚拟服务器 <i class="glyphicon glyphicon-pencil glyphicon-white"></i>', 'class="btn btn-success" title="增加虚拟服务器"');?>
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
                                    // form_hidden('env',$server_env);
                                    echo anchor('admin/server', '全部服务器', 'class="btn btn-primary" title="全部服务器"');echo ' ';
                                    echo anchor('admin/server?env=0', '系统环境', 'class="btn btn-default" title="系统环境"');echo ' ';
                                    echo anchor('admin/server?env=1', '开发环境', 'class="btn btn-default" title="开发环境"');echo ' ';
                                    echo anchor('admin/server?env=2', '测试环境', 'class="btn btn-default" title="测试环境"');echo ' ';
                                    echo anchor('admin/server?env=3', '预发布环境', 'class="btn btn-default" title="预发布环境"');echo ' ';
                                    echo anchor('admin/server?env=4', '生产环境', 'class="btn btn-default" title="生产环境"');echo ' ';
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
                                $i=1;
                                foreach ($servers as $value) {
                                    $value->opr_time = substr($value->opr_time, 5,9);
                                    // substr($value->opr_time,5,2) - date('m');
                                ?>                                         
                                            <tr>
                                                <td><?php echo $i;?></td>
                                                <td>
                                                <?php echo anchor('container/server_list?sid='.$value->id, $value->ip, 'title="查看容器"');?>
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
                                                <td><?php echo $value->service_no;?></td>
                                                <td><span class="label label-success"><?php echo $value->ip_alias;?></span></td>
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