<div class="span9" id="content">
    <div class="row-fluid">
        <!-- block -->
        <div class="block" style="position:absolute;margin-top:30px">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">
                    企业邮箱密码重置
                </div>
            </div>
            <div >
            	<!-- FORM BEGIN -->
            	<div id="form" style="display:none">
					<?php
						$attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
						echo form_open('ldap/add_EmailInfo',$attributes);
						$username = $this->session->userdata('username');
						echo form_hidden('email',$username);
					?>
						<fieldset>
							<div class="control-group" style="margin-left:80px;margin-top:20px">
								<label class="control-label">邮箱账号<span class="required">*</span></label>
								<div class="controls">
									<input type="text" style="width:180px;height:30px;" id="email" name="email" value="<?php echo $username;?>" readonly/>
									<!-- 邮箱验证特效 -->
									<span class="label label-important" id="warning" style="display:none"><i class="icon-remove icon-white"></i></span>
			                  		<span class="label label-success" id="success" style="display:none"><i class="icon-ok icon-white"></i></span>
								</div>
							</div>
							<div class="control-group" style="margin-left:80px;margin-top:50px">
								<label class="control-label">请先绑定手机号<span class="required">*</span></label>
								<div class="controls" id ="tel">
									<input type="text" id="telephone" name="telephone" style="width:180px;height:30px"/>
									<span class="label label-success" id="tel_success" style="display: none;">手机号可用</span>
									<span class="label label-important" id="tel_warning" style="display: none;">请输入正确的手机号码</span>
								</div>
							</div>
							<div class="form-actions" style="width:660px;padding-left:100px;margin-top:60px;margin-bottom:10px">
								<button type="submit" class="btn-large btn-primary" style="margin-right:50px;margin-left:50px" onclick="return formcheck();">确认绑定</button>
								<button type="button" class="btn-large" onclick="location.href=' http://<?php echo $_SERVER['HTTP_HOST']?>' ">取消绑定</button>
							</div>
						</fieldset>
					</form>
				</div>
				<!-- FORM END-->
				<div class="alert alert-success" id="tip" style="height:250px;display:none;font-size: 25px">
                    <div style="height:40px;margin-top:80px">
                      	您的企业邮箱<?php echo $username;?>已经绑定相应的手机号，可以自行修改密码~
                    </div>
                    <div style="height:40px;">
                      	邮箱密码修改链接：
                    </div>
                    <div style="text-align:center;margin-top: 20px">
                    <a href="/ldap/TXResetView" target="_blank">
                        <button class="btn btn-large btn-primary" type="button">
                            <font color="white">点击修改密码</font></button></a>
                        
                    </div>
				</div>
            </div>
        </div>
    </div>
</div>
<!--/.fluid-container-->
<script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts.js"></script>
<script src="<?php echo base_url();?>layer/layer.js"></script>
<script type="text/javascript">
	var res = 0
	var tm = 0
	// 邮箱信息验证
	$(function() {
		$.ajax({
			url:"/ldap/ajax_EmailInfo?email=" + $("#email").val(),
			type:"GET",
			success:function(data) {
				if (data == '') {
					$("#form").show();
					$("#tip").hide();
				}
				else{
					$("#tip").show();
					$("#form").hide();
				}
			}
		});// 验证邮箱是否已绑定手机号
		$.ajax({
			url:"/ldap/ajax_email?email=" + $("#email").val(),
			type:"GET",
			success:function (data) {
				if (data == 1) {
					// 邮箱账号存在
					res = 1;
					$("#success").show();
					$("#warning").hide();
				}
				else{
					// 邮箱账号不存在
					res = 0;
					$("#success").hide();
					$("#warning").show();
				}
			}
		});// 验证邮箱是否存在
	})
	// 手机号匹配规则
	function telephone_match(tel) {
		var t = /^1(3|4|5|7|8)\d{9}$/
		if (tel.match(t)) {
			return true;
		}
		else{
			return false;
		}
	}
	// 验证手机号
	$("#telephone").on('keyup change',function() {
		if (telephone_match($(this).val())) {
			tm = 1;
			$("#tel_warning").hide();
			$("#tel_success").show();
		}
		else{
			tm = 0;
			$("#tel_success").hide();
			$("#tel_warning").show();
		}
	})
	// 表单提交验证
	function formcheck() {
		var email = $("#email")
		var telephone = $("#telephone")
		var t = /^1(3|4|5|7|8)\d{9}$/
		if (email.val() == "") {
			layer.msg('邮箱账号为空！', {time: 2000,icon: 1});
			return false;
		}
		if (telephone.val() == "") {
			telephone.focus();
			layer.msg('手机号码为空！', {time: 2000,icon: 1});
			return false;
		}
		if (tm == 0) {
          telephone.focus();
          layer.msg('请输入正确的手机号码！', {time: 2000,icon: 1});
          return false;
        }
		if(res == 0){
			layer.msg('邮箱账号不存在，请联系运维同事！', {time: 2000,icon: 1});
			return false;
		}
		if(res == 1 && email.val() != "" && tm == 1){
			return true;
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