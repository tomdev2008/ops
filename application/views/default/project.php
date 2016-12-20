<div class="span9" id="content">
<?php
    foreach ($platform as $value) {
?>
<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $value->name?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>项目名称</th>
                                          <th>开发环境</th>
                                          <th>测试环境</th>
                                          <th>预发布环境</th>
                                          <th>生产环境</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                         <?php
                                $projectform = "platform_".$value->id;
                                $jenkins_url = "http://jenkins.ops.xkeshi.so/search/?q=";
                                $i=1;
                              foreach (${$projectform} as $value) {
                        ?>             
                                        <tr>
                                          <td><?php printf("%2d",$i) ;?></td>
                                          <td>
                                          <?php echo anchor('container?pid='.$value->id, $value->name, 'title="查看容器"');?>
                                          <span class="label label-success"><?php echo $value->alias_name?></span>
                                           <span class="label label-success"><?php echo $value->username?></span> 
                                           <?php if ($value->alias_name != NULL){?>
                                           <button class="btn btn-info btn-mini" onclick="add_project('http://<?php echo $_SERVER['HTTP_HOST']?>/project/add?server_project=<?php echo $value->id?>&&project_name=<?php echo $value->name?>&&platform_id=<?php echo $value->platform_id?>')">添加Jenkins项目</button>
                                         <?php }?>
                                           </td>
                                          <td>
                                          <?php
                                          echo $value->dev_url ? '<a href="'.$value->dev_url.'" target="_blnak">域名</a>' : '<span class="label label-inverse">域名</span>';
                                          ?>
                                           <a href="<?php echo $jenkins_url?><?php echo $value->dev_jenkins?>" target="_blank"><img src="<?php echo base_url();?>images/jenkins.ico" border="0" width="16" height="16"></a></td>
                                          <td>
                                          <?php
                                          echo $value->test_url ? '<a href="'.$value->test_url.'"" target="_blnak">域名</a>' : '<span class="label label-inverse">域名</span>';
                                          ?>
                                           <a href="<?php echo $jenkins_url?><?php echo $value->test_jenkins?>" target="_blank"><img src="<?php echo base_url();?>images/jenkins.ico" border="0" width="16" height="16"></a></td>
                                          <td>
                                          <?php
                                          echo $value->pre_url ? '<a href="'.$value->pre_url.'"" target="_blnak">域名</a>' : '<span class="label label-inverse">域名</span>';
                                          ?>
                                           <a href="<?php echo $jenkins_url?><?php echo $value->pre_jenkins?>" target="_blank"><img src="<?php echo base_url();?>images/jenkins.ico" border="0" width="16" height="16"></a></td>
                                          <td>
                                          <?php
                                          echo $value->product_url ? '<a href="'.$value->product_url.'"" target="_blnak">域名</a>' : '<span class="label label-inverse">域名</span>';
                                          ?>
                                           <a href="<?php echo $jenkins_url?><?php echo $value->product_jenkins?>" target="_blank"><img src="<?php echo base_url();?>images/jenkins.ico" border="0" width="16" height="16"></a></td>
                                        </tr>

                                <?php 
                                $i++;
                                }?>
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                <?php
                     }
?>        

 </div>
 </div>

         <!--/.fluid-container-->
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script>
        function add_project(url) {
          layer.open({
          title: false,
          type: 2,
          skin: 'layui-layer-demo', //样式类名
          area: ['875px', '415px'],
          content: url
        });
      }
        $(function() {
            
        });
        </script>