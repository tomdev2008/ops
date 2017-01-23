<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<title>集团邮箱管理</title>
</head>
<body>
	<!-- content -->
    <div class="col-md-10">
        <div class="row" >
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>集团邮箱管理</h1>
                </div>
				<div class="panel panel-default bootstrap-admin-no-table-panel">
	                <div class="panel-heading">
	                    <div class="text-muted bootstrap-admin-box-title">管理邮箱</div>
	                </div>
	                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                        <form class="form-horizontal">
                            <fieldset>
                                <p>
                                <?php
                                	$DepartmentId = $this->input->get('id');
                                	if ($DepartmentId = NULL) {
                                		$DepartmentId = 0;
                                	}
                                    foreach( $department as $key => $value) {
                                    	$active = $DepartmentId == $key ? "active" : "" ;
                                        echo anchor('admin/email?id='.$key.'', ''.$value.'', 'class="btn btn-default '.$active.'" title="'.$value.'" style="margin-right:10px"');
                                    }
                                ?>
                                </p>
                                <!-- <a href="/admin/email" class="btn btn-success">新建邮箱 <i class="glyphicon glyphicon-plus"></i></a> -->
                            </fieldset>
                        </form>
                    </div>
	                <div class="bootstrap-admin-panel-content">
	                	<table class="table table-striped table-bordered" id="example">
	                		<thead>
	                			<tr>
									<th width="10%">#</th>
									<th width="20%">邮箱账号</th>
									<th width="20%">用户名</th>
									<th width="50%">操作</th>
	                			</tr>
	                		</thead>
	                		<tbody>
								<?php $n = 0;
									foreach ($employees['List'] as $employee) {
										foreach ($employee as $value) {
											$EmployeeName = $this->email_model->get_account_info($value)['Name'];
											$EmployeeStatus = $this->email_model->get_account_info($value)['OpenType'];
								?>
								<tr>
									<td><?php echo $n = $n+1;?></td>
									<td><?php if ($EmployeeStatus == 2){
										echo "<strike>".$value."</strike>";
									}else if($EmployeeStatus == 1){
										echo $value;
									}?></td>
									<td><?php echo $EmployeeName;?></td>
									<td>
										<div style="float:left">
                                           <!--  <a href="email/add?key=<?php echo $key?>">
                                                <button type="button" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-pencil"></i>开通</button></a> 
                                            <a href="javascript:;" class="runcode" onclick="password_reset('<?php echo $value;?>')">
                                                <button type="button" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i>密码重置</button></a>
                                            <a href="javascript:;" class="runcode" onclick="email_update('/admin/email/email_update?email=<?php echo $value;?>')">
                                                <button type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i>修改信息</button></a>
                                            <a href="javascript:;" class="runcode" onclick="email_disable('<?php echo $value;?>')">
                                                <button type="button" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i>禁用</button></a> -->
										</div>
									</td>
								</tr>
								<?php }} ?>
	                		</tbody>
	                	</table>
	                </div>
	        	</div>
            </div>
        </div>
		<!-- JS -->
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/DT_bootstrap.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script type="text/javascript">
        	// 邮箱密码重置
	        function password_reset(email) {
	        	layer.confirm('确定要重置密码吗？',{
	        		btn: ['确定','取消'] //按钮
	        	},function() {
	        		$.ajax({
	        			type:"GET",
	        			url:"/admin/email/PasswordReset?email=" + email,
	        			success:function (data) {
	        				if (data == "success") {
	        					layer.msg('密码已重置！', {time: 3000,icon: 1});
	                        	parent.window.location.reload();
	        				}else{
	        					layer.msg('重置失败请检查！', {time: 3000,icon: 1}, function(){
	                                parent.window.location.reload();
	                            });
	        				}
	        			},
	        			error:function() {
	        				layer.msg('程序内部错误！', {time: 3000,icon: 1});
	                    	parent.window.location.reload();
	        			}
	        			})
	        		})
	        }
	        // 邮箱禁用
	        function email_disable(email) {
	        	layer.prompt({
                	title :'请输入删除密码',
                	formType: 1
            	},function(val){
		            $.ajax({
		                url:"/admin/email/email_disable?email=" + email + "&pwd=" + val,//邮箱禁用接口
		                success:function(data){
		                    if (data == "success") {
		                        layer.msg('邮箱已禁用！', {time: 3000,icon: 1});
		                        parent.window.location.reload();
		                    }
		                    else if(data == "error_pwd"){
                            	layer.msg('密码错误，请重试！', {time: 3000,icon: 1});
                         	}
		                    else{
		                        layer.msg('禁用失败请检查！', {time: 3000,icon: 1}, function(){
		                        	parent.window.location.reload();
		                        });
		                    }
		                },
		                error: function() {
		                    layer.msg('程序内部错误！', {time: 3000,icon: 1});
		                    parent.window.location.reload();
		                }
		            })
		        })
        	}
        	// layer弹出层（修改邮箱信息）
	        function email_update(url) {
	            layer.open({
	                  id: 'ex1',
	                  title:false,
	                  type: 2,
	                  // offset: '50px',
	                  skin: 'layui-layer-demo', //样式类名
	                  area: ['500px', '550px'],
	                  content: url
	                });
	        }
        </script>
</body>
</html>