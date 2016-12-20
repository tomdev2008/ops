				<?php 
                	$type = $this->input->get('type');
                	$username = $this->session->userdata('username');
                ?>				
				<div class="span9" id="content">
                    	<div class="row-fluid">
                            <div class="block" style="position:absolute;margin-top:30px">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">
                                    账号管理 / 修改密码
                                    </div>
                               	</div>
                                <div class="block-content collapse in">
                                    <!-- <div class="span12" style="margin-top:20px; height:50px"> -->
                                        <!-- <?php echo anchor('ldap?type=update', '修改密码', 'class="btn-large btn-info" title="修改密码"');?>
                                        <?php echo anchor('ldap?type=reset', '密码重置', 'class="btn-large btn-primary" style="margin-left:10px" title="密码重置"');?> -->
                             		<!-- </div> -->
                             	<div>
                          	</div>
                    	</div>
                <div>
                <!-- reset -->
                	<!-- <?php if($type == "update"){?>

                	<?php }?> -->
                <!-- /reset -->
                <!-- block -->
                <div style="width:800px;height:362px;margin-left:20px">
                	<!-- BEGIN FORM update-->
<?php
	$attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return checkpassword()'];
	echo form_open('ldap/update',$attributes);
?>
			<fieldest>
				<div class="control-group" style="margin-left:80px;margin-top:20px">
					<label class="control-label">请输入旧密码<span class="required">*</span></label>
					<div class="controls">
					<?php echo form_error('oldpassword', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>','</div>');?>
						<input type="password" style="width:180px;height:30px;margin-left" id="oldpassword" name="oldpassword" data-required="1" class="span2 m-wrap"/>
						<strong>【<a href="#" onclick="resetpassword('http://<?php echo $_SERVER['HTTP_HOST']?>/login/reset')"> 忘记密码请点 </a>】</strong>
					</div>
				</div>
				<div class="control-group" style="margin-left:80px;margin-top:50px">
					<label class="control-label">请输入新密码<span class="required">*</span></label>
					<div class="controls">
						<input type="password" style="width:180px;height:30px" id="newpassword1" name="newpassword1" data-required="1" class="span2 m-wrap"/>
						<?php echo form_error('newpassword1', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>','</div>');?>
						<strong>【密码不少于6位且由数字和字母组成】</strong>
					</div>
				</div>
				<div class="control-group" style="margin-left:80px;margin-top:50px">
					<label class="control-label">再输入新密码<span class="required">*</span></label>
					<div class="controls">
						<input type="password" style="width:180px;height:30px" id="newpassword2" name="newpassword2" data-required="1" class="span2 m-wrap"/>
						<?php echo form_error('newpassword2', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>','</div>');?>
						<strong>【两次新密码输入要求相同一致】</strong>
					</div>
				</div>
				<div class="form-actions" style="width:660px;padding-left:100px;margin-top:60px;margin-bottom:10px">
					<button type="submit" class="btn-large btn-primary" style="margin-right:50px;margin-left:50px">确认修改</button>
					<button type="button" class="btn-large" onclick="location.href=' http://<?php echo $_SERVER['HTTP_HOST']?>' ">取消修改</button>
				</div>
			</fieldest>
		</from>
                	<!-- END FORM update-->
                </div>
                <!-- /block -->
 <!--/.fluid-container-->
        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script src="<?php echo base_url();?>layer/layer.js"></script>
        <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
        <script type="text/javascript">
        function checkpassword(){
        	var oldpassword = $('#oldpassword')
        	var password1 = $('#newpassword1')
        	var password2 = $('#newpassword2')
        	// var re = /^[A-Za-z]+$/;
        	// var reg = /^[0-9]+$/;
        	var r =/^(?![^a-zA-Z]+$)(?!\D+$)/;
        	if (oldpassword.val() == password1.val()) 
        	{
        		alert("新旧密码不能重复，请重新输入！");
        		return false;
        	}
        	if (password1.val() != password2.val())
        	{
        		alert("2次密码输入不一致！");
        		return false;
        	}
        	else if(password1.val() == password2.val())
        	{
        		if (password1.val().length > 6 || password1.val().length == 6) {
		        			if (password1.val().match(r)) 
		        			{
		        				return true;
		        			}
		        			else
		        			{
		        				alert("密码必须由字母和数字组成，请重新输入！");
		        				return false;
		        			}
        		}
        		else if(password1.val().length < 6){
        			alert("密码输入小于6位，请重新输入！");
        			return false;
        		}
        	}
        }//密码匹配规则
        function resetpassword(url) {
          layer.open({
          title: false,
          type: 2,
          skin: 'layui-layer-demo', //样式类名
          area: ['550px', '401px'],
          content: [url]
        });
      }//重置密码
        </script>