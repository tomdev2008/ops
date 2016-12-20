
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>常用链接内容管理</h1>
                            </div>
                        </div>
                    </div>
                                    <p><?php echo anchor('admin/gallery/add', '新增常用链接 <i class="glyphicon glyphicon-plus glyphicon-white"></i>', 'class="btn btn-primary" title="增加分组"');?></p>
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
                                        echo anchor('admin/gallery', '全部信息', 'class="btn btn-primary" title="全部信息"');echo ' ';
                                    }else{
                                    echo anchor('admin/gallery', '全部信息', 'class="btn btn-default" title="全部信息"');echo ' ';
                                    }
                                    foreach( $platform as $value ) {                                      
                                      if ($value->id != $platform_id) {
                                          echo anchor('admin/gallery?platform_id='.$value->id.'', ''.$value->gallery_name.'', 'class="btn btn-default" title="'.$value->gallery_name.'"');echo ' ';
                                      }
                                      else if ($value->id == $platform_id) {
                                          echo anchor('admin/gallery?platform_id='.$value->id.'', ''.$value->gallery_name.'', 'class="btn btn-primary" title="'.$value->gallery_name.'"');echo ' ';
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
                                                <th width="5%">#</th>
                                                <th>名称</th>                                                 
                                                <th>网址</th>
                                                <th>版本</th>
                                                <th width="10%">负责人</th>
                                                <th width="10%">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        $num = 0;
                                        foreach( $gallerys as $value ) {
                                ?>        
                                            <tr>
                                                <td><?php echo $num=$num+1?></td>
                                                <td><?php echo $value->gallery_name?></td>
                                                <td><a href="<?php echo $value->gallery_url?>" target="_blank"><?php echo substr($value->gallery_url, 0,90)?></a></td>
                                                <td><?php echo $value->gallery_version?></td>
                                                <td><?php echo $value->user_name?></td>
                                                <td><p>
                                          <a href="javascript:;" class="runcode" onclick="get_url_change('/admin/gallery/update?id=<?php echo $value->id?>')">
                                            <button type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-refresh glyphicon-white"></i>修改</button></a>
                                                    <a href="javascript:;" class="runcode" onclick="get_url_delete('<?php echo $value->id?>')">
                                                        <button type="button" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i>删除</button></a>
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
        <script src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>  
        <script src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/uniform/jquery.uniform.min.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/chosen.jquery.min.js"></script> 
        <script src="<?php echo base_url();?>admin-static/vendors/selectize/dist/js/standalone/selectize.min.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard-for.bootstrap3.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/boostrap3-typeahead/bootstrap3-typeahead.min.js"></script>   
        <script src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>    
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script type="text/javascript">

            function get_url_change(url) {
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
            layer.confirm('您确定要删除该友情链接吗？', {
                    btn: ['确定','取消'] //按钮
                    }, function(){
            $.ajax({
                type: "GET",
                url:"/admin/gallery/delete?id="+id,//我要执行删除的url地址
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