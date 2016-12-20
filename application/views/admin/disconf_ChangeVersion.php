<html>
	<head>
		<title>修改配置版本</title>
		<link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
	    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-theme.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
		<style>
			#main{margin-width:auto;margin-height:auto;}
		</style>
	</head>
	<body>
		<div class="col-md-10" style="float:left;width:100%;">
	                <div class="row">
	                        <div class="col-lg-12">
	                            <div class="panel panel-default bootstrap-admin-no-table-panel">
	                            	<div class="panel-heading" style="height:50px">
                                    	<div class="text-muted bootstrap-admin-box-title"></div>
                                	</div>
									<?php 
								        $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
								        echo form_open('admin/disconfig/change_version', $attributes);
								        $version = $this->input->get('version',TRUE);
								        $app = $this->input->get('app',TRUE);
										$env = $this->input->get('env',TRUE);
										$data = array(
											'version' => $version,
											'app' => $app,
											'env' => $env
											);
										echo form_hidden($data);
								    ?>
										<div class="form-group " style="margin-left: 10%;margin-top:20px">
											<label class="col-sm-2 control-label">版本号</label>
											<input type="text" id="version" name="version_new" value="<?php echo $version;?>" style="width:200px;height:40px;"/>
										</div>
										<div class="form-group" style="margin-left: 25%;margin-top:20px">
						                    <div class="col-sm-offset-2 col-sm-10">
						                      	<button type="submit" class="btn btn-primary" id="btn" onclick="return check();">确认提交</button>
						                      	<button type="button" class="btn btn-default" style="margin-left:30px" onclick="location.reload();">恢复版本号</button>
						                    </div>
						                </div>
								</div>
							</div>
					</div>
		</div>
	</body>
	<script>
		function check(){
			var version = $('#version').val()
			if (version == "") {
				alert("请输入版本号！！");
				return false;
			}
			else{
				return true;
			}
		}
		function buttoncheck(){
            $('#btn').on('click',function(){
              $("#btn").attr("disabled", true);
                setTimeout(function(){
                  $("#btn").attr("disabled", false);
                },3000);
                return true;
            });
        }
	</script>
</html>