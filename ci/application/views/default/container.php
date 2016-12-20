
                <div class="span9" id="content">

                    <div class="row-fluid">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <ul class="breadcrumb">
                                        <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                                        <li>
                                            <a href="#">Dashboard</a> <span class="divider">/</span>    
                                        </li>
                                        <li class="active"><a href="<?php echo site_url('container')?>"><?php echo $title?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    
    <?php
        foreach ($container as $value) {
    ?>   
            <div class="row-fluid">
                        <div class="span12">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">【<?php echo $value->id?>】<a href="#"><?php echo $value->name?></a></div>
                                    <div class="pull-right"><span class="badge badge-info"></span>

                                    </div>
                                </div>
<?php
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
                if ($ip_data) {

?>

                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>反向代理</th>
                                                <th></th>
                                                <th><?php echo $ip_server['name']?></th>
                                                <th>应用名称</th>
                                                <th>属性</th>                                  
                                            </tr>
                                        </thead>
                                        <tbody>
                         <?php
                                //$ip_data = explode(',', $value->$ip_server['server_ip']);
                                
                                $ip_data_count = count($ip_data);
                                $i = 1;
                                foreach ($ip_data as $key => $value_ip) {
                        ?>                                         
                                            <tr>
                                            <?php
                                                if ($i == 1) {
                                            ?>
                                            <td width="10%" style="vertical-align:middle;text-align:center;" rowspan="<?php echo $ip_data_count?>">
                                            <?php echo anchor('#nginx_'.$value->id.'', 'NGINX', 'data-toggle="modal" class="btn btn-success btn-mini" title="NGINX"');?>
                                            <i class="icon-arrow-right"></i>
                                            <div id="nginx_<?php echo $value->id ?>" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">&times;</button>
                                                <h3>NGINX info</h3>
                                            </div>
                                            <div class="modal-body">
                                                <pre style="text-align:left;">
upstream imiaoj {
    server 10.117.20.99:9591;
}


server{
        listen 80;
        server_name wx.imiaoj.com;
        if ($query_string ~* (.*)(insert|select|delete|update|\*|master|truncate|declare|\'|\(|\)|exec)(.*)$ ) { return 404; }
        access_log /home/www/logs/nginx_logs/wx.imiaoj.com/wx.imiaoj.com.log main;

        location /x_ngx_status {
                stub_status on;
                access_log off;
                allow 61.130.0.179;
                allow 60.195.252.106;
                deny all;
        }




        rewrite ^(.*)\;(JSESSIONID|jsessionid)=(.*)$  $1  break;

        location /app/microweb/ {
                alias /home/www/static-xkeshi/product/git-product-xkeshi-microweb-mj/dist/;
                if ($request_uri ~* ^/app/microweb/(.*)\.(gif|jpg|jpeg|png|bmp|ico|css|js|svg|woff|woff2|eot|ttf)$) {
                        expires 90d;
                }
                if ($request_uri ~* ^/app/microweb/(.*)\.html$) {
                        expires -1;
                }
        }


        location / {
                proxy_pass http://imiaoj;
                include proxy.conf;
        }
}

                                                </pre>
                                            </div>
                                        </div>

                                            </td>
                                            <?php
                                                }
                                            ?>
                                                <td width="10%"><span class="label label-inverse"><?php echo $value_ip->server_type.$value_ip->id?></td>
                                               <td width="20%"><?php echo $value_ip->server_deploy_ip.':'.$value_ip->server_deploy_port?><br>
                                                    <?php echo $value_ip->server_name?><?php if ($flag == 1) {?><a href="<?php echo 'http://jenkins.ops.xkeshi.so/job/'.$value_ip->server_name?>" target="_blank"><img src="<?php echo base_url();?>images/jenkins.ico" border="0" width="16" height="16"></a><?php }?>
                                                </td>
                                                <td width="20%"><?php echo $value_ip->server_alias_name; //echo anchor('container#', ' 查看日志', 'title="查看日志"');?></td> 
                                                <td width="15%"><?php if($value_ip->server_status == 1) {?><span class="label label-success">已部署</span>
                                                    <?php }else if($value_ip->server_status == 2) {?><span class="label label-success">部署中</span>
                                                    <?php }else if($value_ip->server_status == 0) {?><span class="label label-inverse">已删除</span>
                                                    <?php }?>
                                                </td>                                               
                                            </tr>
                        <?php
                            $i++;
                            }
                        ?>
                                        </tbody>
                                    </table>
                                </div>

<?php
}}
?>
                            </div>
                            <!-- /block -->
                            </div>
                        <?php
                         }?>
                   
              
                </div>
            </div>
            </div>
        <!--/.fluid-container-->
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>