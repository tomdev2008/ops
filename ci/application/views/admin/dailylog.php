
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>工作日志管理</h1>
                            </div>
                        </div>
                    </div>
                                    <p><?php echo anchor('admin/dailylog/add', '新增工作日志 <i class="glyphicon glyphicon-plus glyphicon-white"></i>', 'class="btn btn-primary" title="新增工作日志"');?></p>
                          <div class="row">
                          <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">部门列表</div>
                                </div>
                               <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>
                                    <p>
                                    <?php 
                                    $id = $this->input->get('id', TRUE);
                                    form_hidden('id',$id);
                                    if ($id == NULL) {
                                        echo anchor('admin/dailylog', '全部人员', 'class="btn btn-primary" title="全部人员"');echo ' ';
                                    }else{
                                    echo anchor('admin/dailylog', '全部人员', 'class="btn btn-default" title="全部人员"');echo ' ';
                                    }
                                    foreach( $ops_list as $value ) {                                      
                                      if ($value->id != $id) {
                                          echo anchor('admin/dailylog?id='.$value->id.'', ''.$value->name.'', 'class="btn btn-default" title="'.$value->name.'"');echo ' ';
                                      }
                                      else if ($value->id == $id) {
                                          echo anchor('admin/dailylog?id='.$value->id.'', ''.$value->name.'', 'class="btn btn-primary" title="'.$value->name.'"');echo ' ';
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
                                                <th>标题</th>                                                 
                                                <th>负责人</th>
                                                <th>时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        $num = 0;
                                        foreach( $dailylogs as $value ) {
                                ?>        
                                            <tr>
                                                <td><?php echo $num = $num+1?></td>
                                                <td><?php echo '<a href=/admin/dailylog/view/'.$value->id.'>'.$value->daily_title.'</a>'?></td>
                                                <td><?php echo $user_name = $this->dailylog_model->get_user_name_by_id($value->user_id);?></td>
                                                <td><?php echo substr($value->daily_time, 0,10);?></td>
                                                <td class="actions">
                                                <a href="javascript:;" class="runcode" onclick="get_user_change('/admin/dailylog/update?id=<?php echo $value->id?>')">
                                                  <button type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-refresh glyphicon-white"></i>修改</button></a>
                                                  </td>
<!--                                                 <td><a href="javascript:;" class="runcode" onclick="get_url_delete('<?php echo $value->id?>')">
                                                        <button type="button" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i>删除</button></a></td> -->
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
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script type="text/javascript">
            function get_daily_content_log(url) {
            layer.open({
                  title:'工作日志内容',
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  area: ['660px', '400px'],
                  content: url
                });
        }
            function get_user_change(url) {
            layer.open({
                  id: 'ex1',
                  title:false,
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  area: ['650px', '400px'],
                  content: url
                });
        }
            
            function get_url_delete(id) {
            layer.confirm('您确定要删除该工作日志吗？', {
                    btn: ['确定','取消'] //按钮
                    }, function(){
            $.ajax({
                type: "GET",
                url:"/admin/dailylog/delete?id="+id,//我要执行删除的url地址
                success: function (data) {
                     layer.msg('删除成功', {time: 1000,icon: 1}, function(){
                        parent.window.location.reload();  
                     });
                },
                error: function () {
                     layer.msg('删除失败', {time: 1000,icon: 1});
                }
            })
                });
        }

        </script>