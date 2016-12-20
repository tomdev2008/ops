 <div class="span9" id="content">                   
                     <div class="row-fluid">

 <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">部门列表</div>
                                </div>
                                <div class="block-content collapse in">
                                    <div class="span12">
                                        <p>
                                        <?php echo anchor('user', '全部员工', 'class="btn btn-success" title="全部员工"');?>
                                <?php
                                        foreach( $users_level as $user_level ) {
                                ?>                                         
                                           <?php echo anchor('user?level_id='.$user_level->id.'', ''.$user_level->level_name.'', 'class="'.$user_level->level_class.'" title="'.$user_level->level_name.'"');?>

                                  <?php
                                 }
                                 ?>                                              
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /block -->

                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $title?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                        <thead>
                                            <tr>
                                                <th>姓名</th>
                                                <th>IP</th>   
                                                <th>MAC地址</th>                                             
                                                <th>邮箱</th>
                                                <th>QQ</th>                                               
                                                <th>SSH-USER</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        foreach( $users as $user ) {
                                ?>        
                                            <tr class="odd gradeX">
                                                <td><?php echo $user->name?></td>
                                                <td class="center"><?php echo $user->user_ip?></td>
                                                <td class="center"><?php echo $user->mac?></td>                                                 
                                                <td><a href="mailto:<?php echo $user->email?>"><?php echo $user->email?></a></td>
                                                <td class="center"></td>
                                                <td class="center"><?php echo $user->ssh_user?></td>
                                            </tr>
                                 <?php
                                 }
                                 ?>           
                                                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
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