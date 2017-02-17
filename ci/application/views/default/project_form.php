    <title>项目申请</title>
    <!-- bootstrap CSS-->
	<link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-theme.min.css">
	<!-- chosen CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
    <style>
        #main{margin-left:auto;margin-right:auto;}
    </style>
        <div id="main">
            <div class="col-md-10" style="float:left;width:100%;margin-top:5%">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">项目申请</div>
                                </div>
                <?php 
                    $attributes = ['class' => 'form-horizontal', 'id' => 'proform','method'=>"post",'onsubmit' => 'return buttoncheck()'];
                    echo form_open('project/form', $attributes);
                    $platform = $this->project_model->get_platform();
                ?>
                  <!-- 项目类别 -->
                  <div class="form-group" style="margin-top: 10px">
                    <label for="inputPattern" class="col-sm-2 control-label">项目类别</label>
                    <div class="col-sm-10">
                        <select name="platform" id="platform">
                        	<!-- <option value="">请选择项目</option> -->
							<?php foreach ($platform as $key => $value) {?>
								<option><?php print_r($value->name) ;?></option>
							<?php } ?>
                        </select>
                    </div>
                  </div>
                  <!-- 项目中文名称 -->
                  <div class="form-group" style="margin-top: 10px;">
                    <label for="inputVersion" class="col-sm-2 control-label">项目中文名称</label>
                    <div class="col-sm-10">
                        <input type="text" id="ProjectNameCN" name="ProjectNameCN" style="width:250px;height:35px" />
                    </div>
                  </div>
                  <!-- 项目英文名称 -->
                  <div class="form-group" style="margin-top: 10px;">
                    <label for="inputVersion" class="col-sm-2 control-label">项目英文名称</label>
                    <div class="col-sm-10">
                        <input type="text" id="ProjectNameEN" name="ProjectNameEN" style="width:250px;height:35px"/>
                    </div>
                  </div>
                  <!-- 容器选择 -->
                  <div class="form-group" style="margin-top: 10px;">
                    <label for="inputVersion" class="col-sm-2 control-label">请选择容器</label>
                    <div class="col-sm-10">
                        <select name="container" id="container">
                        	<!-- <option value="">请选择容器</option> -->
							<option>前端(nodejs)</option>
							<option>后端(jetty) </option>
                        </select>
                    </div>
                  </div>
                  <!-- 存储地址 -->
                  <div class="form-group" style="margin-top: 10px;">
                    <label for="inputVersion" class="col-sm-2 control-label">请填写仓库地址</label>
                    <div class="col-sm-10">
                        <select name="StorageMethod" id="StorageMethod" style="width:100px;">
                        	<!-- <option value="">请选择仓库</option> -->
							<option>git</option>
							<option>svn</option>
							<option>ftp</option>
                        </select>
                        <input type="text" id="StoragePath" name="StoragePath" style="width:250px;height:35px"/>
                    </div>
                  </div>
                  <!-- war包名称 -->
                  <div class="form-group" style="margin-top: 10px;">
                    <label for="inputVersion" class="col-sm-2 control-label">请填写war包名称【选填】</label>
                    <div class="col-sm-10">
                        <input type="text" id="war" name="war" style="width:250px;height:35px"/>
                    </div>
                  </div>
                  <!-- 应用日志目录 -->
                  <div class="form-group" style="margin-top: 10px;">
                    <label for="inputVersion" class="col-sm-2 control-label">应用日志目录</label>
                    <div class="col-sm-10">
                        <input type="text" id="logbath" name="logbath" value="/home/www/logs/" style="width:250px;height:35px"/>
                    </div>
                  </div>
                  <div class="form-group" style="margin-top: 10px;">
                    <div class="col-sm-offset-2 col-sm-10">
                    	<button type="button" class="btn btn-primary" onclick="return form_check()">
                                        确认提交<i class="icon-search icon-white"></i></button>
                      <!-- <button type="submit" class="btn btn-primary" onclick="return from_check();">确认</button> -->
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>chosen_v1.6.2/chosen.jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>layer/layer.js"></script>
    <script type="text/javascript">
        $("#platform").chosen();
        $("#StorageMethod").chosen();
        $("#container").chosen();
        // 表单提交控制
        function form_check() {
        	var platform = $("#platform")
	        var ProjectNameCN = $("#ProjectNameCN")
	        var ProjectNameEN = $("#ProjectNameEN")
	        var container = $("#container")
	        var StorageMethod = $("#StorageMethod")
	        var StoragePath = $("#StoragePath")
	        var logbath = $("#logbath")
        	if (platform.val() == "") {
        		platform.focus();
	            layer.msg('请选择项目类别！', {time: 2000,icon: 1});
	        }
	        else if (ProjectNameCN.val() == "") {
	         	ProjectNameCN.focus();
	            layer.msg('请填写项目中文名称！', {time: 2000,icon: 1});
	        }
	      	else if (ProjectNameEN.val() == "") {
	      	 	ProjectNameEN.focus();
	            layer.msg('请填写项目英文名称！', {time: 2000,icon: 1});
	        }
	        else if (container.val() == "") {
	         	container.focus();
	            layer.msg('请选择容器！', {time: 2000,icon: 1});
	        }
	        else if (StorageMethod.val() == "") {
	         	StorageMethod.focus();
	            layer.msg('请选择存储方式！', {time: 2000,icon: 1});
	        }
	        else if (StoragePath.val() == "") {
	         	StoragePath.focus();
	            layer.msg('请填写存储地址！', {time: 2000,icon: 1});
	        }
	        else if (logbath.val() == "/home/www/logs/") {
	         	logbath.focus();
	            layer.msg('请填写应用日志目录！', {time: 2000,icon: 1});
	        }
	        else{
	        	layer.msg('提交成功，正在跳转，请稍等~', {time: 2000,icon: 1});
	        	$("#proform")[0].submit();
	        }
        }
        // 控制提交
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