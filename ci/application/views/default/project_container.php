
                <div class="span9" id="content">  
                    <div class="row-fluid">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <ul class="breadcrumb">
                                        <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <li>
                                            <a href="/">Dashboard</a> <span class="divider">/</span>    
                                        </li>
                                        <li>
                                            <a href="/project/">项目管理</a> <span class="divider">/</span>    
                                        </li>
                                        <li class="active">容器信息</li>
                                        <a class="btn btn-primary" href="javascript:;" style="margin-top:-5px;float: right" onclick="form('/project/form')">项目申请<i class="icon-plus icon-white"></i></a>
                                    </ul>
                                </div>
                            </div>
                        </div>  

    <?php
        foreach ($container as $value) {
        $ip_environment = [
                    [                   
                        "name" => "开发环境",
                        "server_env" => "1"
                    ],

                    [                   
                        "name" => "测试环境",
                        "server_env" => "2"
                    ],

                    [                   
                        "name" => "预发布环境",
                        "server_env" => "3"
                    ],

                    [
                        "name" => "正式环境",
                        "server_env" => "4"
                    ]
        ];

        foreach ($ip_environment as $key => $ip_server) {
            $ip_data = 'app_server_'.$value->id.'_'.$ip_server['server_env'];
            $ip_data = $$ip_data;
        $container_sql_where = " WHERE server_env = '".$ip_server['server_env']."' and server_project = '".$value->id."'" ;
        $query = $this->db->query("select id,server_name,server_type,server_project,server_env,server_alias_name,server_status,server_deploy_ip,group_concat(CONCAT(server_deploy_ip,':',server_deploy_port))as ip_repeat from ops_app_server".$container_sql_where."  group by server_name order by id desc");
        $containers = $query->result();
                if ($ip_data) {
    ?>
            <div class="row-fluid">
                        <div class="span12">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">【<?php echo $value->id?>】<a href="#"><?php echo $value->name?><?php echo $ip_server['name']?></a>
                                    
                                    </div>
                                    <div class="pull-right"><span class="badge badge-info"></span>

                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="30%">APP名称</th>  
                                                <th width="10%">容器名称</th>                                               
                                                <th width="20%">部署服务器</th>
                                                <th width="20%">应用别名</th>
                                                <th width="10%">属性</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        $num = 0;
                                        foreach( $containers as $va ) {
                                        $sum = $this->project_model->get_num_all_by_server_name($va->server_name);
                                        // echo $sum;
                                ?>        
                                            <tr class="odd gradeX">
                                            <td style="text-align: left; vertical-align: middle;" rowspan="<?php echo $sum?>"><?php echo $num=$num+1?></td>
                                                <td style="text-align: left; vertical-align: middle;" rowspan="<?php echo $sum?>"><?php echo $va->server_name?></a>&nbsp;<a href="http://jenkins.ops.xkeshi.so/job/<?php echo $va->server_name?>" target="_blank"><img src="<?php echo base_url();?>images/jenkins.ico" border="0" width="16" height="16"></a></td>
                            <?php
                                    $ID = $this->project_model->get_project_id_by_server_name($va->server_name);
                                    foreach ($ID as $key => $value2)
                                    {
                                        $id = $value2->id;
                                        $project_env_num = 1;
                                        $haha = $this->project_model->get_alias_by_id($value2->id);
                                        $server_deploy_port = $this->project_model->get_server_deploy_port_by_id($value2->id);
                                        $server_type = $this->project_model->get_server_type_by_id($value2->id);
                            ?>
                                                <td><span class="label label-inverse"><?php echo $server_type.$id?></span></td>
                                                <td>
                                                <?php
                                                    echo $haha; 
                                                    echo ':'.$server_deploy_port?><br>
                                                    </td>
                                                <td><?php echo $va->server_alias_name?></td>
                                                <td><?php if($va->server_status == 1) {?><span class="label label-success">已部署</span>
                                                    <?php }else if($va->server_status == 2) {?><span class="label label-warning">部署中</span>
                                                    <?php }else if($va->server_status == 0) {?><span class="label label-danger">已删除</span>
                                                    <?php }?><?php if ($flag == 1) {?><span class="label label-info"><a style="color: white" href="/disconfig?env=<?php echo $flag_env = $this->container_model->get_server_env_by_server_name($va->server_name);?>&project_id=<?php echo $pid_id?>&app=<?php echo $va->server_name?>">配置中心</a></span><?php }?>
                                                </td>  
                                            </tr>
                                 <?php
                                 }
                             }
                                 ?>           
                                                                                                      
                                        </tbody>
                                    </table>
                                </div> </div>
<?php
}}
?>
                           
                            <!-- /block -->
                            </div>
               
                        <?php
                         }?>
                </div>      
              </div></div>
        <!--/.fluid-container-->
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script type="text/javascript">
        function form(url) {
            layer.open({
                  type: 2,
                  title: false,
                  area: ['1000px', '600px'],
                  skin: 'layui-layer-rim', //加上边框
                  content: [url, 'no']
                });
        }
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>