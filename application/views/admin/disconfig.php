                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>配置中心</h1>
                            </div>
                        </div>
                    </div>
                    <!-- select app -->
                     <?php  
                        // url中get到数据
                        $env = $this->input->get('env');
                        $projectid = $this->input->get('project_id');
                        $app = $this->input->get('app');
                        $app_version = $this->disconfig_model->get_version_by_appid_env($app,$env);
                        $default_version = $app_version ? $app_version[0]->version : '';
                        $version = $this->input->get('version') ? $this->input->get('version') : $default_version;
                        $app_info = $this->disconfig_model->get_info_by_app_env_version($app,$env,$version);
                        $disconfig_recently = $this->disconfig_model->get_disconf_recently();
                        @$add_url = explode("?", $_SERVER['REQUEST_URI']);
                        if($env != null || $projectid != null || $app != null){
                    ?>
                    <div class="col-md-6" style="width:100%">
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">APP选择</div>
                                </div>
                            <!-- 具体项目 -->
                            <div class="control-group">
                                <div class="controls" style="height:52px">
                                    <div style="margin-left:50px">
                                        <label class="control-label">选择具体项目<span class="required">*</span></label>
                                        <?php echo form_error('project_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                        <select data-placeholder="==请选择相应的项目==" name="app_name" style="width:250px;" class="chosen-select">
                                            <option value="<?php echo $projectid?>" selected="selected">
                                                    <?php echo $this->disconfig_model->get_name_by_id($projectid);?>
                                                    </option>
                                             <?php 
                                             foreach($get_project_name as $project_name){
                                                $project_id = $this->disconfig_model->get_id_by_name($project_name->name);
                                                if($project_id == $projectid){
                                             ?>
                                                <option value="<?php echo $projectid?>" selected="selected">
                                                    <?php echo $this->disconfig_model->get_name_by_id($projectid);?>
                                                </option>
                                            <?php }else{?>
                                              <option value="<?php echo $project_id?>"><?php echo $project_name->name?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <!-- 子项目 -->
                                        <label class="control-label" style="margin-left:20px">选择子项目<span class="required">*</span></label>
                                        <?php echo form_error('env_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                         <select data-placeholder="==请选择子项目==" style="width:250px;margin-right:50px" name="env_name" class="chosen-select-no-single">
                                             <option value="<?php echo $app?>" selected="selected">
                                                <?php 
                                                    @$env_name = explode("-",$app);
                                                    @$app_name = explode($env_name[0], $app);
                                                    $server_alias_name = $this->disconfig_model->get_server_alias_name_by_server_name("product".$app_name[1]);
                                                    echo $app.'【'.$server_alias_name.'】';
                                                ?>
                                            </option>
                                        </select>
                                        <div class="btn">
                                            <button class="btn btn-sm btn-primary" id="btn-search" type="submit" style="margin-left:20px;margin-top:5px;">确认</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <!-- block -->
                        <div class="col-lg-12" >
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">
                                        <?php 
                                            if ($env != null || $projectid != null || $app != null) {
                                                echo '环境:'.$this->disconfig_model->env_switch($env).", APP: ".$app;
                                            }
                                            else{
                                                echo "最新配置修改";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <!-- tabs -->
                                <div class="bootstrap-admin-panel-content">
                                    <ul class="nav nav-tabs">
                                    <li>
                                    <!-- 下拉按钮 -->
                                    <?php if($app != null && $env != null){?>
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" style="margin-right:20px">新增项目
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <!-- <li>
                                                <a href="<?php echo site_url('project')?>">新建APP</a>
                                            </li> -->
                                            <!-- <li>
                                                <a href="#">新建配置项</a>
                                            </li> -->
                                            <li>
                                                <a href="javascript:;" onclick="disconfig_add('<?php echo site_url('admin/disconfig/add_view?'.$add_url[1])?>')">新建配置文件</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php 
                                        }
                                        @$url = explode("&version=", $_SERVER['REQUEST_URI']);
                                        foreach ($app_version as $value) {
                                    ?>
                                        <li <?php if($version == $value->version) echo "class='active'";?>>
                                            <a href="<?php echo $url[0]."&version=".$value->version;?>"><?php echo $value->version;?></a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <!-- 配置表格 -->
                                <div class="bootstrap-admin-panel-content">
                                    <?php if($app != null && $env != null && $version != null){?>
                                        <!-- 复制配置按钮 -->
                                        <div class="text-right" style="margin-top:-20px">
                                            <a href="javascript:;" onclick="copy_version('<?php echo $add_url[1]?>')">
                                                <button type="button" class="btn btn-info btn-xs">
                                                <span class="glyphicon glyphicon-list"></span>
                                                复制版本
                                                </button></a>
                                            <button type="button" class="btn btn-info btn-xs" onclick="change_version('<?php echo site_url("admin/disconfig/change_version?$add_url[1]");?>')">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                                修改版本号
                                            </button>
                                            <a href="<?php echo site_url("admin/disconfig/downloadzip?$add_url[1]");?>">
                                                <button type="button" class="btn btn-info btn-xs">
                                                    <span class="glyphicon glyphicon-pencil"></span>
                                                    批量下载
                                                </button>
                                            </a>
                                        </div>
                                    <?php } ?>
                                <table class="table table-striped table-bordered dataTable" id="example">
                                    <?php $n=0;
                                    if ($env != null || $projectid != null || $app != null) {
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <!-- <th>AppName</th> -->
                                            <th>KEY</th>
                                            <th>配置内容</th>
                                            <th>敏感配置</th>
                                            <th>修改时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($app_info as $value) {?>
                                        <tr>
                                            <td><?php echo $n=$n+1;?></td>
                                            <!-- <td><?php echo $value->app_id?></td> -->
                                            <td><?php echo $value->name?></td>
                                            <td><a href="javascript:;" onclick="disconfig_value('<?php echo site_url('admin/disconfig/value/'.$value->config_id)?>')">点击获取 </a></td>
                                            <td>
                                                <div class="switch switch-small" data-on-label="yes" data-off-label="nn">
                                                    <input type="checkbox" name="switch" id="switch_<?php echo $value->config_id?>" value="<?php echo $value->config_id?>" <?php echo $value->sensitive_status == 1 ? 'checked' : ''; ?> />
                                                </div>
                                            </td>
                                            <td><?php echo $value->update_time?></td>
                                            <td class="actions">
                                                    <a href="#">
                                                        <button class="btn btn-sm btn-primary" onclick="disconfig_update('<?php echo site_url('admin/disconfig/update/'.$value->config_id)?>')"><i class="glyphicon glyphicon-psencil"></i>
                                                        修改
                                                        </button></a>
                                                    <a href="<?php echo site_url('admin/disconfig/downloadfile/'.$value->config_id)?>">
                                                        <button class="btn btn-sm btn-success">
                                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                                            下载
                                                        </button>
                                                    </a>
                                                    <!-- <a href="#">
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="glyphicon glyphicon-bell"></i>
                                                            Notify
                                                        </button>
                                                    </a> -->
                                                    <!-- <a href="javaScript:;" onclick="del_disconf('<?php echo $value->config_id?>')">
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                            删除
                                                        </button>
                                                    </a>  -->
                                                </td>
                                            </tr>
                                        <?php 
                                            } 
                                        }
                                    else {
                                        $num=0;
                                        ?>
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ProductName</th>
                                            <th>KEY</th>
                                            <th>配置内容</th>
                                            <!-- <th>敏感配置</th> -->
                                            <th>修改时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($disconfig_recently as $value) {?>
                                        <tr>
                                            <td><?php echo $num=$num+1;?></td>
                                            <td><?php echo $value->app_id?></td>
                                            <td><?php echo $value->name?></td>
                                            <td><a href="javascript:;" onclick="disconfig_value('<?php echo site_url('admin/disconfig/value/'.$value->config_id)?>')">点击获取 </a></td>
                                            <!-- <td>
                                                <div class="switch switch-small" data-on-label="yes" data-off-label="nn">
                                                    <input type="checkbox" name="switch" id="switch_<?php echo $value->config_id?>" value="<?php echo $value->config_id?>" <?php echo $value->sensitive_status == 1 ? 'checked' : ''; ?> />
                                                </div>
                                            </td> -->
                                            <td><?php echo $value->update_time?></td>
                                            <td class="actions">
                                                    <a href="#">
                                                        <button class="btn btn-sm btn-primary" onclick="disconfig_update('<?php echo site_url('admin/disconfig/update/'.$value->config_id)?>')">
                                                            <i class="glyphicon glyphicon-pencil"></i>
                                                            修改
                                                        </button>
                                                    </a>
                                                    <!-- <a href="<?php echo site_url('admin/disconfig/downloadfile/'.$value->config_id)?>">
                                                        <button class="btn btn-sm btn-success">
                                                            <i class="glyphicon glyphicon-ok-sign"></i>
                                                            下载
                                                        </button>
                                                    </a> -->
                                                    <!-- <a href="#">
                                                        <button class="btn btn-sm btn-warning">
                                                            <i class="glyphicon glyphicon-bell"></i>
                                                            Notify
                                                        </button>
                                                    </a> -->
                                                    <!-- <a href="javaScript:;" onclick="del_disconf('<?php echo $value->config_id?>')">
                                                        <button class="btn btn-sm btn-danger">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                            删除
                                                        </button>
                                                    </a>  -->
                                                </td>
                                            </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
        <link rel="stylesheet" href="<?php echo base_url();?>admin-static/vendors/bootstrap-switch/build/css/bootstrap3/bootstrap-switch.css">
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/bootstrap-switch/build/js/bootstrap-switch.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>
        <script src="<?php echo base_url();?>chosen_v1.6.2/chosen.jquery.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script src="<?php echo base_url();?>laydate/laydate.js"></script>
        <script type="text/javascript">
            var $chosenSelectSoSingle = $('.chosen-select-no-single')
            var $nav = $('.nav nav-tabs')
            var chosen = $(".chosen-select").val()
            $(".chosen-select").chosen();
            $chosenSelectSoSingle.chosen({
                disable_search_threshold:10
            });
            //获取url中的参数
            function getUrlParam(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
                var r = window.location.search.substr(1).match(reg);  //匹配目标参数
                if (r != null) return unescape(r[2]); return null; //返回参数值
            }
            var env = getUrlParam('env');
            if(env == null){
                var env = 1
            }
            var ENV_MAP = {
                1: 'dev-',
                2: 'test-',
                3: 'pre-',
                4: 'product-'
            }
            // 二级联动(项目->子项目)
            $(".chosen-select").on('change', function (){
                $.ajax({
                  url: "disconfig/ajax_project?project_id="+$(this).val()+"/",
                  dataType: "json",
                  beforeSend: function(){$('ul.chosen-select-no-single').empty();},
                  success: function( servers ) {
                    $chosenSelectSoSingle.empty()
                    servers.forEach(function(server){
                      var server_name = server.server_name
                      var server_name = server_name.substr(8)
                      var alias_name = server.server_alias_name
                      var env_name = ENV_MAP[env]
                      $chosenSelectSoSingle.append('<option value="' + env_name +server_name + '">' + env_name + server_name +' 【'+ alias_name + '】</option>');
                      $(".btn").append('')
                    })
                        $chosenSelectSoSingle.trigger("chosen:updated");
                     }
                });
            })
            //提交控制
            $('#btn-search').on('click',function(){
                var server_name = $chosenSelectSoSingle.val()
                var project_id = $(".chosen-select").val()
                var url="/admin/disconfig?env="+env+"&project_id="+project_id+"&app="+server_name
                $(location).attr('href',url);
            });
            // 查看配置
            function disconfig_value(url) {
                layer.open({
                    title: false,
                    type: 2,
                    skin: 'layui-layer-demo', //样式类名
                    area: ['40%', '80%'],
                    content: url
                });
            }
            // 修改配置
            function disconfig_update(url) {
                layer.open({
                    title: false,
                    type: 2,
                    area: ['90%', '90%'],
                    content: url
                });
            }
            // 添加配置
            function disconfig_add(url) {
                layer.open({
                    title: false,
                    type: 2,
                    skin: 'layui-layer-demo', //样式类名
                    area: ['60%', '70%'],
                    // scrollbar: false,
                    content: url
                });
            }
            // 删除操作
            function del_disconf(id){
                layer.prompt({
                    title :'请输入删除密码',
                    formType: 1
                },function(val){
                    $.ajax({
                        type:"GET",
                        url:"/admin/disconfig/delete?id=" + id + "&pwd=" + val,
                        success:function(data){
                            if(data == "error_pwd"){
                                layer.msg('密码错误，请重试！',{time:3000,icon:1});
                            }
                            else if (data == "error_del") {
                                layer.msg('删除失败，请重试！',{time:3000,icon:1});
                            }
                            else {
                                layer.msg( data + '的配置信息删除成功！', {time: 3000,icon: 1}, function(){
                                    parent.window.location.reload();
                                });
                            }
                        },
                        error: function () {
                            layer.msg('程序内部错误', {time: 3000,icon: 1});
                        }
                    })
                });
            }
            // 修改配置版本
            function change_version(url){
                layer.open({
                    title: "修改配置版本",
                    type: 2,
                    skin: 'layui-layer-demo', //样式类名
                    area: ['450px', '260px'],
                    content: url
                });
            }
            // 复制版本配置（确定操作）
            function copy_version(info){
                layer.confirm('您确定要复制该版本吗？', {
                    btn:['确定','取消']
                },function(){
                    $.ajax({
                        type:"GET",
                        url:"/admin/disconfig/copy?"+info,
                        success:function(data){
                            layer.msg('版本'+data+'复制成功', {time: 1000,icon: 1},function(){
                                parent.window.location.reload();
                            });
                        },
                        error: function () {
                            layer.msg('删除失败', {time: 1000,icon: 1});
                        }
                    })
                });
            }
            // bootstrap switch
            $("[name='switch']").bootstrapSwitch();//初始化，默认为是
            // switch-change 事件
            $(':checkbox').on('switch-change', function () {//或[name='switch']，都可以定位
                $.ajax({
                    type:"GET",
                    url:"/admin/disconfig/status_switch?id=" + $(this).val(),
                    success:function(data){
                        if (data == 1) {
                            $('#switch_'+$(this).val()).bootstrapSwitch('toggleState');
                            $('#switch_'+$(this).val()).bootstrapSwitch('setState', true);
                            }
                        else if(data == 0){
                            $('#switch_'+$(this).val()).bootstrapSwitch('toggleState');
                            $('#switch_'+$(this).val()).bootstrapSwitch('setState', false);
                        }
                    }
                });
            });
            $(function() {
                // Easy pie charts
                $('.easyPieChart').easyPieChart({animate: 1000});
            });
        </script>