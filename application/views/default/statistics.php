                 <div class="span9" id="content">
                    <div class="row-fluid">
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">近期项目总览</div>
                                </div>
                                <div class="block-content collapse in">
                                    <div class="span12">
                                        <p>
                                        <?php //echo anchor('statistics', '所有项目', 'class="btn btn-success" title="所有项目"');?>
                                <div>
                                  <?php 
                                  $time =  $this->input->get('time', TRUE);
                                  if($time == NULL)
                                  {
                                       $time = 0;
                                  }
                                  foreach ($get_product_project_name as $product_project_name) 
                                  {
                                  $time_name = $product_project_name->time;
                                  if ($time == $time_name) {
                                  	echo anchor('statistics?time='.$time_name, ''.$time_name.'', 'class="btn active" title="'.$time_name.'"')."  ";
                                  	}
                                  else if($time != $time_name){
                                  echo anchor('statistics?time='.$time_name, ''.$time_name.'', 'class="btn" title="'.$time_name.'"')."  ";
                              		}
                              	  }
                              	  ?>
                                 </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $this->input->get("date").$title?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                <div class="table-toolbar">
                                      <div class="btn-group">
                                         <?php echo anchor('statistics/add', '发布项目 <i class="icon-plus icon-white"></i>', 'class="btn btn-success" title="发布项目"');?>
                                      </div>
                                </div>
                    <table class="table table-bordered">
                          <thead>
                           <tr>
                              <th style="text-align: center; vertical-align: middle;">发布时间</th>
                              <th style="text-align: center; vertical-align: middle;">项目名称</th>
                              <th style="text-align: center; vertical-align: middle;">项目环境</th>
                              <th style="text-align: center; vertical-align: middle;">提交人</th>
                              <th style="text-align: center; vertical-align: middle;">容器名称</th>
                              <th style="text-align: center; vertical-align: middle;">Jenkins发布</th>
                              <th style="text-align: center; vertical-align: middle;">修改记录</th>
                              <th style="text-align: center; vertical-align: middle;">发布状态</th>
                              <th style="text-align: center; vertical-align: middle;">提交时间</th>
                            </tr>
                          </thead>
                          <tbody>
                           <tr>
                           <?php
                           		foreach ($get_product_project_name as $product_project_name) {
                           			$sum = $this->statistics_model->get_num_all_by_time($product_project_name->time);
                           			if ($time == $product_project_name->time ||$time == 0) {
                           ?>
                           			<td style="text-align: center; vertical-align: middle;" rowspan="<?php echo $sum?>"><span class="label label-info"><?php echo $product_project_name->time?></span></td>
                           	<?php
                           			$project_ID = $this->statistics_model->get_project_id_by_time($product_project_name->time);
                           			foreach ($project_ID as $key => $value)
                           			{
                           				$project_id = $value->project_id;
                           				$project_env_num = count($this->statistics_model->get_project_env_num_by_time_id($product_project_name->time,$project_id));
 										$project_name = $this->statistics_model->get_project_name_by_id($project_id);
 										$leader_user_id = $this->statistics_model->get_leader_user_id_by_id($project_id);
                              			$leader_name = $this->statistics_model->get_leader_name_by_id($leader_user_id);
                              			
							?>
                              		<td style="text-align: center; vertical-align: middle;" rowspan="<?php echo $project_env_num?>"><?php echo $project_name?></td>
                              		<td style="text-align: center; vertical-align: middle;" rowspan="<?php echo $project_env_num?>"><strong>生产环境</strong></td>
                              		
                              <?php 
                              	$server_name = $this->statistics_model->get_project_env_name_by_time_id($product_project_name->time,$project_id);
                              		foreach ($server_name as $key => $value) {
                              			$submitter = $this->statistics_model->get_name_by_time_name($product_project_name->time,$value->project_env_name);
                              			$alias_name = $this->statistics_model->get_alias_name($value->project_env_name);
                              			$change_log = $this->statistics_model->get_change_by_time_env($product_project_name->time,$value->project_env_name);
                              ?>
                              			<td style="text-align: center; vertical-align: middle;"><?php echo $submitter?></td>
                              			<td style="text-align: center; vertical-align: middle;">
                              			<a id="env" href="javascript:;" onclick="get_nginx_upstream('http://front2.ngx.xkeshi.net/status?upstream_name=<?php echo $value->project_env_name?>')"><?php echo $value->project_env_name;?></a>
                              			<div>
                              			<?php echo $alias_name;?>
                              			</div>
                              			</td>
                 						<td style="text-align: center; vertical-align: middle;"><a href="http://jenkins.ops.xkeshi.so/search/?q=<?php echo $value->project_env_name?>" target="_blank"><?php echo "Jenkins发布"?></a></td>
                              			<td style="text-align: center; vertical-align: middle;">
                              				<a id="log" href="javascript:;" onclick = "get_change_log('http://<?php echo $_SERVER['HTTP_HOST']?>/statistics/change_log?time=<?php echo $product_project_name->time?>&&env=<?php echo $value->project_env_name?>')">Change Log</a>
                              			</td>
                              			<?php if ($value->select == 1) { ?>
                              				<td style="text-align: center; vertical-align: middle;"><span class="label label-important">紧急发布</span></td>
                              			<?php }else{?>
                              				<td style="text-align: center; vertical-align: middle;"><span class="label label-success">正常发布</span></td>
                              			<?php }?>
                              			<td><?php echo $this->statistics_model->get_oprtime_by_time_name($product_project_name->time,$value->project_env_name)?></td>
                              			</tr>
                              <?php
                              			}
                              		}
                            	}
                           }
                            ?>
                          </tbody>
                        </table>
                                </div>
                            </div>
                        </div>
                     	<!-- /block -->
		                </div>
                     <!-- /validation -->
                </div>
            </div>
 <!--/.fluid-container-->
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script>
        function get_nginx_upstream(url) {
	        layer.open({
				  type: 2,
				  title:'NGINX Upstream',
				  area: ['360px', '200px'],
				  skin: 'layui-layer-rim', //加上边框
				  content: [url, 'no']
				});
   		}
   		function get_change_log(url) {
	        layer.open({
				  title:'Change Log',
				  type: 2,
				  skin: 'layui-layer-demo', //样式类名
				  area: ['360px', '200px'],
				  content: url
				});
   		}
        </script>