<html>
<head>
	<title>修改配置</title>
	<link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-theme.min.css">
	<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
	<script src="<?php echo base_url();?>layer/layer.js"></script>
	<script src="<?php echo base_url();?>admin-static/vendors/linedtextarea/jquery-linedtextarea.js"></script>
	<link href="<?php echo base_url();?>admin-static/vendors/linedtextarea/jquery-linedtextarea.css" type="text/css" rel="stylesheet" />
	<style>
		#main{width:1200px;height:auto;text-align:center;margin-left:auto;margin-right:auto;}
		#left{width:auto;height:auto;margin-left:50px;}
		#right{width:auto;height:auto;margin-left:50px;}
		#left,#right{float:left;}
		h3{
			font-size: xx-large;
			font-weight: bold;
			text-shadow: 5px 5px 10px #000000;
		}
	</style>
</head>
	<body>
		<?php 
            $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
            $id = $this->uri->segment(4,0);
            $env = $this->input->get('env');
            echo form_open('admin/disconfig/amend', $attributes);
            $data = [
            	'id_hidden' => $id,
            	'env' => $env 
            ];
            echo form_hidden($data);
        ?>
		<div id="main">
	    	<div id="left">
	    		<h3>原配置</h3>
				<p><?php echo $conf_data->name?>内容：</p>
					<textarea class="text_value" rows="30" cols="70" readonly><?php echo $conf_data->value?></textarea>
					<script>
					$(function() {
						$(".text_value").linedtextarea(
							{selectedLine: 1}
						);
					});
					</script>
	    	</div>
		    <div id="right">
		    	<h3>修改配置</h3>
				<p><?php echo $conf_data->name?>内容：</p>
					<textarea class="text_update" rows="30" cols="70" name="text_amend"><?php 
						if ($env == 3|| $env == 4) {
							echo $conf_data->redundance;
						}
						else{
							echo $conf_data->value;
						}
					?></textarea>
					<script>
					$(function() {
						$(".text_update").linedtextarea(
							{selectedLine: 1}
						);
					});
					</script>
					<div class="form-group" style="margin-top:20px">
                    <div class="col-sm-offset-2 col-sm-10">
                      	<button type="button" class="btn btn-default"  onclick="location.reload();">恢复配置</button>
                      	<button type="submit" class="btn btn-primary" style="margin-left:30px" onclick="return check();">确认提交</button>
                    </div>
                  </div>
		    </div>
		</div>
	  </form>
	</body>
</html>