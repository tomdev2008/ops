<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<title>开通邮箱信息</title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-theme.min.css">
    <!-- Bootstrap Admin Theme -->
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-admin-theme.css">
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-admin-theme-change-size.css">
</head>
<body>
	<div class="col-md-10">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>集团邮箱账号开通情况</h1>
                </div>
            </div>
        </div>
        <?php 
        	$name = $this->input->get('name');
			$EamilAccount = $this->input->get('email');
			$department = $this->input->get('department');
         ?>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default bootstrap-admin-no-table-panel">
	        		<div class="panel-heading">
	                    <div class="text-muted bootstrap-admin-box-title">集团邮箱信息</div>
	                    <div class="pull-right"><span class="badge">东融集团</span></div>
	                </div>
	                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
	                	<div class="alert alert-success">
		                	<h2>注册结果：</h2>
		                	<font size=5>
						      	<div style="height:40px">
						          	集团邮箱账号已注册成功~
						       	</div>
						       	<div style="height:40px;margin-top: 20px">
						          	姓名：<strong><?php echo $name;?></strong>
						       	</div>
								<div style="height:40px">
									邮箱号:<strong><?php echo $EamilAccount;?></strong>
								</div>
								<div style="height:40px">
									工作部门:<strong><?php echo $department;?></strong>
								</div>
							</font>
							<div style="text-align:center">
      							<a class="btn btn-large btn-primary" href="/admin/email" style="text-align:center">点击返回注册页面</a>
       						</div>
						</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
</body>
</html>