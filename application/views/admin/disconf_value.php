<html>
<head>
	<title>查看配置</title>
	<link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-theme.min.css">
	<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
	<script src="<?php echo base_url();?>admin-static/vendors/linedtextarea/jquery-linedtextarea.js"></script>
	<link href="<?php echo base_url();?>admin-static/vendors/linedtextarea/jquery-linedtextarea.css" type="text/css" rel="stylesheet" />
	<style>
		body{width:auto;height:auto;text-align:center;}
	</style>
</head>
	<body>
	<div style="margin:0 auto;width:100%">
		<div style="margin-left:20px">
			<h3>查看 <?php echo $conf_data->app_id?> 配置</h3>
			<p><?php echo $conf_data->name?>内容：</p>
		</div>
			<div style="margin-left:5%;">
				<textarea class="lined" rows="25" cols="80" style="width:95%;height:80%;" readonly><?php echo $conf_data->value?></textarea>
			</div>
				<script>
				$(function() {
					$(".lined").linedtextarea(
						{selectedLine: 1}
					);
				});
				</script>
		</div>
	</body>
</html>