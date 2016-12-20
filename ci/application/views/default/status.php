

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
                                        <li class="active"><?php echo $title?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

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
                                          <td  colspan="2"></th>
                                          <td colspan="4" align="center">运行状态</th>
                                        </tr>
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
                                          <?php echo anchor('status#', $value->name, 'title=""');?>
                                           <span class="label label-success"><?php echo $value->username?></span> <span class="label label-success"><?php echo $value->username_room?></span></td>
                                          <td align="center"><span class="label label-success">运行中</span></td>
                                          <td align="center"><span class="label label-important">重启中</span></td>
                                          <td align="center"><span class="label label-success">运行中</span></td>
                                          <td align="center"><span class="label label-success">运行中</span></td>
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


        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
            
        });
        </script>