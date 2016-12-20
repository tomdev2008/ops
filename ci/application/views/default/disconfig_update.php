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
		#main{width:500px;height:auto;text-align:center;margin-left:auto;margin-right:auto;}
		#left{width:auto;height:auto;}
		#left,#right{float:left;}
	</style>
</head>
	<body>
		<?php 
            $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
            $id = $this->uri->segment(3,0);
            echo form_open('disconfig/amend', $attributes);
            echo form_hidden('id_hidden',$id);
        ?>
		<div id="main">
		    <div id="right">
		    	<h3>修改 <?php echo $conf_data->name?> 配置</h3>
				<p style="color: red; font-weight: bold;">除开发、测试环境外，其余环境修改完成提交后请联系运维部进行审核！</p>
				<?php if ($sensitive_id == 0) { ?>
					<textarea class="text_update" rows="30" cols="70" name="text_amend"><?php if ($conf_data->redundance == NULL){echo $conf_data->value;}else {echo $conf_data->redundance;}?></textarea>
					<script>
					$(function() {
						$(".text_update").linedtextarea(
							{selectedLine: 1}
						);
					});
					</script>
					<div class="form-group" style="margin-top:20px">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-default" style="margin-left:30px" onclick="location.reload();">恢复配置</button>
                      <button type="submit" class="btn btn-primary" onclick="return check();">确认提交</button>
                    </div>
                  </div>
  				<?php 
				} else {
					echo '对不起，该配置文件属于敏感信息，如须修改，请联系运维组进行修改！';
				}?>
		    </div>
		</div>
	  </form>
	</body>
</html>