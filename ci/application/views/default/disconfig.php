                <div class="span9" id="content">
                     <?php  
                        // url中get到数据
                        $env = $this->input->get('env');
                        $projectid = $this->input->get('project_id');
                        $app = $this->input->get('app');
                        $app_version = $this->disconfig_model->get_version_by_appid_env($app,$env);
                        $default_version = $app_version ? $app_version[0]->version : '';
                        $version = $this->input->get('version') ? $this->input->get('version') : $default_version;
                        $version_exist = $this->input->get('version');
                        $app_info = $this->disconfig_model->get_info_by_app_env_version($app,$env,$version);
                        $disconfig_recently = $this->disconfig_model->get_disconf_recently();
                        $add_url = explode("?", $_SERVER['REQUEST_URI']);
                        @$version_url = $version_exist ? $add_url[1] : $add_url[1]."&version=".$version;
                    ?>
                    <div class="row-fluid">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <ul class="breadcrumb">
                                        <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <li>
                                            <a href="/">控制台</a> <span class="divider">/</span>    
                                        </li>
                                        <li>
                                            <a href="project/container?pid=<?php echo $projectid?>"><?php echo $this->disconfig_model->get_name_by_pid($projectid)?></a> <span class="divider">/</span>    
                                        </li>
                                        <li class="active">配置中心</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <div class="row-fluid">  
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><span class="badge badge-info"></span>
                                    <?php                                             
                                        echo '环境:'.$this->disconfig_model->env_switch($env).", APP: ".$app;
                                    ?>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                <div class="span12">
                                <!-- tabs -->
                                <div class="bootstrap-admin-panel-content">
                                <div><span style="color: red;"><b>配置中心说明文档（必看）：</span><a href="https://ops.xkeshi.so/faq/new_disconf.html#三注意事项" target="view_window">https://ops.xkeshi.so/faq/new_disconf.html#三注意事项</a></div><br>
                                    <ul class="nav nav-tabs">
                                    <li>
                                    <!-- 下拉按钮 -->
                                    <?php if($app != NULL && $env != NULL &&$env != 3 && $env != 4){?>
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
                                                <a href="javascript:;" onclick="disconfig_add('<?php echo site_url('disconfig/add_view?'.$add_url[1])?>')">新建配置文件</a>
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
                                    </li>
                                    </ul>
                                </div>
                                <table class="table table-striped table-bordered dataTable" id="example">
                                    <?php $n=0;
                                    if ($env != NULL || $projectid != NULL || $app != NULL) {
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>KEY</th>
                                            <th>线上配置</th>
                                            <th>修改时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($app_info as $value) {?>
                                        <tr>
                                            <td><?php echo $n=$n+1;?></td>
                                            <td><?php echo $value->name?></td>
                                            <td><?php if ($value->sensitive_status == 1) { ?><i class="icon-lock"></i>敏感配置<?php } else {?><a href="javascript:;" onclick="disconfig_value('<?php echo site_url('disconfig/value/'.$value->config_id)?>')">点击获取</a><?php } ?></td>
                                            <td><?php echo $value->update_time?></td>
                                            <td class="actions"><?php if ($value->sensitive_status == 1) { ?>
                                                <div style="float:right">
                                                    <a href="#">
                                                        <button class="btn btn-danger btn-mini"><i class="icon-lock icon-white"></i>
                                                        修改
                                                        </button></a>
                                                </div>
                                            </a>
                                            <?php } else {?>
                                                <div style="float:right">
                                                    <a href="#">
                                                        <button class="btn btn-info btn-mini" onclick="disconfig_update('<?php echo site_url('disconfig/update/'.$value->config_id)?>')"><i class="icon-pencil icon-white"></i>
                                                        修改
                                                        </button></a>
                                                </div>
                                            </a><?php } ?></td>
                                        </tr>
                                        <?php 
                                            } 
                                        }
                                    else {
                                        $num=0;
                                        ?>
                                        <tbody>
                                        <?php }?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                                </div>
                            </div>
                            </div>
 </div>
        <!--/.fluid-container-->
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
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
            //提交控制
            var version = getUrlParam('version');
            $('#btn-search').on('click',function(){
                var server_name = $chosenSelectSoSingle.val()
                var project_id = $(".chosen-select").val()
                var url="disconfig?env="+env+"&project_id=" + project_id+ "&app="+server_name 
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
                    area: ['700px', '700px'],
                    content: url
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
            $(function() {
                // Easy pie charts
                $('.easyPieChart').easyPieChart({animate: 1000});
            });
        </script>