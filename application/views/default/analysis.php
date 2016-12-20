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
                                                <th>时期</th>
                                                <th>502错误</th>
                                                <th>安全分析报告</th>
                                                <th>常规分析报告</th>                                                 
                                                <th>可疑访问</th>
                                                <th>漏洞攻击</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                        $log_url = "http://ops.xkeshi.so/static/";
                                        foreach( $analysis as $key => $user ) {
                                            $name1 = '安全分析报告';
                                            $name2 = '常规分析报告';
                                            $name3 = '可疑访问';
                                            $name4 = '漏洞攻击';
                                            $name5 = 'api.xkeshi.net_502.txt';

                                            $year = substr($user->opr_time, 0,4);
                                            $month = substr($user->opr_time, 5,2);
                                            $day = substr($user->opr_time, 8,2);
                                            $access_url = $log_url.$year.'/'.$month.'/'.$day.'/';
                                            $logs_path = '/home/wwwroot/analysis.xkeshi.so/'.$year.'/'.$month.'/'.$day.'/'
                                ?>        
                                            <tr class="odd gradeX">
                                                <td><?php echo ++$key;?></td>
                                                <td><?php echo $user->opr_time?></td> 
                                                <?php
                                                $line_502 = count(@file($logs_path.$name5)); 
                                                ?>
                                                <td><span class="badge badge-important"><?php echo $line_502?></span>&nbsp;<a target="_blank" href="<?php echo $access_url.$name5?>"><?php echo $name5;?></a></td>                                               
                                                <td><a target="_blank" href="<?php echo $access_url.'xkeshi.net_access-'.$name1?>.html">xkeshi.net_access-<?php echo $name1?></a></td>
                                                <td class="center"><a target="_blank" href="<?php echo $access_url.'xkeshi.net_access-'.$name2?>.html">xkeshi.net_access-<?php echo $name2?></a></td>                                                 
                                                <td><a target="_blank" href="<?php echo $access_url.'xkeshi.net_access-'.$name3?>.txt">xkeshi.net_access-<?php echo $name3?></a></td>
                                                <td class="center"><a target="_blank" href="<?php echo $access_url.'xkeshi.net_access-'.$name4?>.txt">xkeshi.net_access-<?php echo $name4?></a></td>

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