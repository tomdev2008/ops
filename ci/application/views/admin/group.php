
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="/admin/user">人员管理</a>
                                    </li>                                    
                                    <li>人员组管理</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>人员组管理</h1>
                            </div>
                        </div>
                    </div>
                      <p><?php echo anchor('admin/group/add', '新增分组 <i class="glyphicon glyphicon-plus glyphicon-white"></i>', 'class="btn btn-primary" title="新增分组"');?></p>
                        <div class="col-lg-14">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">员工分组管理</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table table-striped" id="example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>组名</th>                                                                                               
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        $num = 0;
                                        foreach( $groups as $value ) {
                                ?>        
                                            <tr class="odd gradeX">
                                                <td><?php echo $num=$num+1?></td>
                                                <td><?php echo $value->level_name?></td>                                            
                                                <td class="actions">
                                                    <p >
                                                    <a href="javascript:;" class="runcode" onclick="get_group_update('/admin/group/update?id=<?php echo $value->id?>')">
                                                        <button type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-refresh glyphicon-white"></i>修改</button></a>
                                                    </p>
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
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/uniform/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/selectize/dist/js/standalone/selectize.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard-for.bootstrap3.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/boostrap3-typeahead/bootstrap3-typeahead.min.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script type="text/javascript">

            function get_group_update(url) {
            layer.open({
                  id: 'ex1',
                  title:false,
                  type: 2,
                  skin: 'layui-layer-demo', //样式类名
                  area: ['520px', '320px'],
                  content: url
                });
        }
            
            function get_group_delete(id) {
            layer.confirm('您确定要删除该人员组吗？', {
                    btn: ['确定','取消'] //按钮
                    }, function(){
            $.ajax({
                type: "GET",
                url:"/admin/group/delete?id="+id,//我要执行删除的url地址
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