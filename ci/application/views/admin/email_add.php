<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<title>开通集团邮箱账号</title>
	<!-- Bootstrap -->
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-theme.min.css">
    <!-- Bootstrap Admin Theme -->
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-admin-theme.css">
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-admin-theme-change-size.css">
</head>
<body>
	<?php 
		$DepartmentId = $this->input->get('key');
	 ?>
	<!-- content -->
    <div class="col-md-10">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>集团邮箱账号开通</h1>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="panel panel-default bootstrap-admin-no-table-panel">
	        		<div class="panel-heading">
	                    <div class="text-muted bootstrap-admin-box-title">开通集团邮箱</div>
	                    <div class="pull-right"><span class="badge">东融集团</span></div>
	                </div>
	                <div class="bootstrap-admin-panel-content bootstrap-admin-no-table-panel-content collapse in">
	                	<!-- Form -->
	                	<?php 
	                		$attributes = ['class' => 'form-horizontal','id' => 'email_add','onsubmit' => 'return buttoncheck()'];
	                		echo form_open('admin/email',$attributes);
	                	 ?>
	                		<fieldset>
	                			<legend>
	                				开通邮箱
	                				<!-- <a href="/admin/email/info" class="btn btn-primary" style="float: right;">
	                					邮箱详情 <i class="glyphicon glyphicon-envelope"></i>
	                				</a> -->
	                			</legend>
			                	<div class="form group has-success">
			                    	<label class="col-lg-2 control-label" for="selectError"><strong>姓名（中文）</strong><span class="required">*</span></label>
							        <div class="col-lg-10">
							            <input class="form-control" type="text" id="name" name="name" style="width:250px">
							        </div>
			                    </div>
			                    <div class="form group has-success" style="margin-top: 50px">
			                    	<label class="col-lg-2 control-label" for="selectError"><strong>邮箱号（英文）</strong><span class="required">*</span></label>
							        <div class="col-lg-10">
							            <input class="form-control" type="text" name="account" id="account" style="width:150px">
							        </div>
			                    </div>
			                    <div class="form group has-success">
			                    	<label class="col-lg-2 control-label" for="selectError" style="margin-top: 30px"><strong>邮箱域名</strong><span class="required">*</span></label>
							        <div class="col-lg-10">
							            <select class="input-group-addon" name="eamil" id="email" style="width:150px;margin-top: 30px">
							                <!-- <option value="" selected>——请选择域名——</option> -->
							                <?php foreach ($email as  $key => $value ) {?>
							                    <option value="<?php echo $value?>" <?php echo $key == $DepartmentId ? "selected" : "" ?>>
							                    	<?php echo $value?>
							                    </option>
							                <?php }?>
							            </select>
							            <span class="label label-danger" id="warning" style="display:none"><i class="glyphicon glyphicon-remove"></i></span>
                  						<span class="label label-success" id="success" style="display:none"><i class="glyphicon glyphicon-ok"></i></span>
							        </div>
			                    </div>
			                	<div class="form group has-success">
			                    	<label class="col-lg-2 control-label" style="margin-top: 30px"><strong>所属部门</strong><span class="required">*</span></label>
							        <div class="col-lg-10">
							            <select class="form-control" name="department" id="department" style="width:250px;margin-top: 30px">
							                <!-- <option value="">——请选择部门——</option> -->
							                <?php foreach ($department as  $key => $value) {?>
							                    <option value="<?php echo $value?>" <?php echo $key == $DepartmentId ? "selected" : "" ?>>
							                    	<?php echo $value?>
							                    </option>
							                <?php }?>
							            </select>
							        </div>
			                    </div>
			                    <!-- <div class="form group has-success" style="margin-top: 50px;">
			                    	<label class="col-lg-2 control-label" style="margin-top: 30px"><strong>所属群组</strong><span class="required">*</span></label>
							        <div class="col-lg-10">
							            <select class="form-control" name="group" id="group" style="width:250px;margin-top: 30px">
							                <option value="">——请选择群组——</option>
							                <?php foreach ($group as $key => $value) {?>
							                    <option value="<?php echo $value?>">
							                    	<?php echo $key?>
							                    </option>
							                <?php }?>
							            </select>
							        </div>
			                    </div> -->
			                    <div style="margin-left: 20%">
				                    <button type="submit" class="btn btn-primary" id="btn" style="margin-top: 20px" onclick="return check()">确认提交</button>
	                                <button type="reset" class="btn btn-default" style="margin-top: 20px;margin-left: 20px">重置</button>
	                            </div>
		                    </fieldset>
		                </form>
	                </div>
				</div>
            </div>
        </div>
		
    </div>

    </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?php echo base_url();?>layer/layer.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin-static/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
<script type="text/javascript">
	// 邮箱验证
      var res = 0
      $("#account").on('change',function(val){
        //console.log($(this).val()+'@xkeshi.com');
        $.ajax({
          url:"/admin/email/check_email?email=" + $(this).val() + $("#email").val(),
          type:"GET",
          success:function(data) {
            if (data == 0) {
                res = 1;
                layer.msg('账号可用！', {time: 2000,icon: 1});
                document.getElementById("success").style.display="";//显示
                document.getElementById("warning").style.display="none";//隐藏
            }else{
                res = 0;
                $("#account").focus();
                layer.msg('账号已存在，请重新输入！', {time: 2000,icon: 1});
                document.getElementById("success").style.display="none";//隐藏
                document.getElementById("warning").style.display="";//显示
            }
          }
        })
      })
      $("#email").on('change',function(val){
        $.ajax({
          url:"/admin/email/check_email?email=" + $("#account").val() + $(this).val() ,
          type:"GET",
          success:function(data) {
            if (data == 0) {
                res = 1;
                layer.msg('账号可用！', {time: 2000,icon: 1});
                document.getElementById("success").style.display="";//显示
                document.getElementById("warning").style.display="none";//隐藏
            }else{
                res = 0;
                $("#account").focus();
                layer.msg('账号已存在，请重新输入！', {time: 2000,icon: 1});
                document.getElementById("success").style.display="none";//隐藏
                document.getElementById("warning").style.display="";//显示
            }
          }
        })
      })
    // 表单验证
    function check() {
    	var name = $("#name")
    	var email = $("#email")
    	var account = $("#account")
    	var department = $("#department")
    	var group = $("#group")
    	if (name.val() == "") {
    		layer.msg('请输入姓名！', {time: 2000,icon: 1});
    		name.focus();
    		return false;
    	}
    	if (email.val() == "") {
    		layer.msg('请输入邮箱域名！', {time: 2000,icon: 1});
    		email.focus();
    		return false;
    	}
    	if (account.val() == "") {
    		layer.msg('请输入邮箱账号！', {time: 2000,icon: 1});
    		account.focus();
    		return false;
    	}
    	if (department.val() == "") {
    		layer.msg('请输入部门！', {time: 2000,icon: 1});
    		department.focus();
    		return false;
    	}
    	if (group.val() == "") {
    		layer.msg('请输入群组！', {time: 2000,icon: 1});
    		group.focus();
    		return false;
    	}
    	if (res == 1) {
    		return true;
    	}
    	else{
    		layer.msg('账号不可用，请重新输入！', {time: 2000,icon: 1});
    		return false;
    	}
    }
	// 控制提交
    function buttoncheck(){
        $("#btn").on('click',function(){
          	$("#btn").attr("disabled", true);
            setTimeout(function(){
                $("#btn").attr("disabled", false);
            },3000);
            return true;
        });
    }
</script>
</body>
</html>