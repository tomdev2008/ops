
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>项目管理</h1>
                            </div>
                        </div>
                    </div>
                                    <p><?php echo anchor('admin/project/add', '新增项目 <i class="glyphicon glyphicon-pencil glyphicon-white"></i>', 'class="btn btn-success" title="增加分组"');?></p>
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
                                    $platform_id = $this->input->get('platform_id', TRUE);
                                    form_hidden('platform_id',$platform_id);
                                    if ($platform_id == NULL) {
                                        echo anchor('admin/project', '全部项目', 'class="btn btn-primary" title="全部项目"');echo ' ';
                                    }else{
                                    echo anchor('admin/project', '全部项目', 'class="btn btn-default" title="全部项目"');echo ' ';
                                    }
                                    foreach( $platform as $value ) {                                      
                                      if ($value->id != $platform_id) {
                                          echo anchor('admin/project?platform_id='.$value->id.'', ''.$value->name.'', 'class="btn btn-default" title="'.$value->name.'"');echo ' ';
                                      }
                                      else if ($value->id == $platform_id) {
                                          echo anchor('admin/project?platform_id='.$value->id.'', ''.$value->name.'', 'class="btn btn-primary" title="'.$value->name.'"');echo ' ';
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
                                                <th>项目名称</th>                                                 
                                                <th>开发环境</th>
                                                <th>测试环境</th>
                                                <th>预发布环境</th>
                                                <th>生产环境</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        $num = 0;
                                        foreach( $projects as $value ) {
                                ?>        
                                            <tr class="odd gradeX">
                                                <td><?php echo $num=$num+1?></td>
                                                <td><a href="/container?pid=<?php echo $value->id?>" target="_blank"><?php echo $value->name;echo '  '?></a><span class="label label-info"><?php echo $value->alias_name?></span>&nbsp;<span class="label label-success"><?php echo $this->project_model->get_name_by_id($value->user_id)?></span> </td>
                                                <td><a href="project/container?container_env=1&server_project=<?php echo $value->id?>" target="_blank">列表</a> <a href="javascript:;" class="runcode" onclick="get_project_change('/admin/project/nginx?server_env=1&server_project=<?php echo $value->id?>')"><button type="button" class="btn btn-xs btn-success">nginx模板</button></a></td>
                                                 <td><a href="project/container?container_env=2&server_project=<?php echo $value->id?>" target="_blank">列表</a><a href="javascript:;" class="runcode" onclick="get_project_change('/admin/project/nginx?server_env=2&server_project=<?php echo $value->id?>')"><button type="button" class="btn btn-xs btn-success">nginx模板</button></a></td>
                                                 <td><a href="project/container?container_env=3&server_project=<?php echo $value->id?>" target="_blank">列表</a><a href="javascript:;" class="runcode" onclick="get_project_change('/admin/project/nginx?server_env=3&server_project=<?php echo $value->id?>')"><button type="button" class="btn btn-xs btn-success">nginx模板</button></a></td>
                                                 <td><a href="project/container?container_env=4&server_project=<?php echo $value->id?>" target="_blank">列表</a><a href="javascript:;" class="runcode" onclick="get_project_change('/admin/project/nginx?server_env=4&server_project=<?php echo $value->id?>')"><button type="button" class="btn btn-xs btn-success">nginx模板</button></a></td>
                                              <td class="actions">
                                                <a href="javascript:;" class="runcode" onclick="get_project_change('/admin/project/update?id=<?php echo $value->id?>')">
                                                  <button type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-refresh glyphicon-white"></i>修改</button></a>
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
                  area: ['650px', '700px'],
                  content: url
                });
        }
            

        </script>