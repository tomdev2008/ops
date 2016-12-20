<div class="span9" id="content" style="position:absolute;top:0%;left:0%;width:550px">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">密码重置</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
                                  <!-- Form Start -->
<?php
	$attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return check()'];
    echo form_open('login/reset',$attributes);
?>
	<fieldest>
		<div class="control-group" style="margin-top:20px;margin-bottom:20px">
			<label class="control-label"><strong>请输入邮箱名</strong><span class="required">*</span></label>
            <div class="controls">
                <input type="text" style="width:250px;height:30px" id="username" name="username" data-required="1" class="span2 m-wrap"/>
            </div>
		</div>
			<!-- 验证码 -->
		 <div class="control-group">
            <label class="control-label">
              <strong>验证码<span class="required">*</span><br>( 英文 )</strong>
            </label>
              <div class="controls">
                <input type="text" name="captcha" id="checkcode" style="width:100px;height:30px;margin-top:-20px"/>
                <img id="checkpic" src="/login/captcha" onclick="changing();" title="看不清，点击刷新"/>
              </div>
          </div>
		<div class="form-actions">
                <button type="submit" class="btn btn-primary" name="btn" id="btn" onclick="return checkinput()">密码重置</button>
        </div>
    </fieldest>
</form>
                <!-- Form End -->
                </div>
            </div>
        </div>
    </div>
</div>
               <!--/.fluid-container-->
		  <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
		  <script src="<?php echo base_url();?>assets/scripts.js"></script>
		  <script src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
		  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
		  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
		  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
		  	<script type="text/javascript">
			  	function checkinput(){
			  		var username = $('#username').val()
			  		var tel = $('#tel').val()
			  		var checkcode = $('#checkcode').val()
			  		if (username == "") {
			  			alert("请输入账号");
	        			return false;
			  		}
			  		if (tel == "") {
			  			alert("请输入手机号");
	        			return false;
			  		}
			  		if (checkcode == "") {
			  			alert("请输入验证码");
	        			return false;
			  		}
			  	}
			  	function check(){
			  		// $('#btn').on('click',function(){
			  			var tel = $('#tel')
        				var t = /^1(3|4|5|7|8)\d{9}$/
        					if (tel.val().match(t)) {
	        					if(confirm('确定要重置密码吗？')){
								    $("#btn").attr("disabled", true);
							  		setTimeout(function(){
							  			$("#btn").attr("disabled", false);
							  		},3000);
			  						return true;
							}else{
								return false;
							}
        				}
        				else{
        					alert("手机号码格式错误，请检查！");
        					return false;
        				}
						// $.ajax({
						// 	beforeSend:function(){$("#btn").attr("disabled", true);},
						// 	success:function(server){
						// 		$("#btn").attr("disabled", false);
						// 	}
						// });
			  		// });//监听按钮，弹出询问窗口
			  	}
			  	function changing(){
			         document.getElementById('checkpic').src="/login/captcha?"+Math.random();
			    }
		  	</script>
