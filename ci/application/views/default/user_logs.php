 <div class="span9" id="content">                   
                     <div class="row-fluid">



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
                                                <th>#</th>
                                                <th>登录邮箱</th>
                                                <th>登录姓名</th>                                                 
                                                <th>登录IP</th>
                                                <th>登录时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        foreach( $logs as $key => $user ) {
                                ?>        
                                            <tr class="odd gradeX">
                                                <td><?php echo ++$key;?></td>
                                                <td><a href="mailto:<?php echo $user->email?>"><?php echo $user->email?></a></td>
                                                <td class="center"><?php echo $user->name?></td>                                                 
                                                <td><span class="label label-important"><?php echo $user->login_ip?></span></td>
                                                <td class="center"><?php echo $user->logintime?></td>
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