<div class="span9" id="content" style=" position:absolute; left:19%; top:5%;">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">邮箱开通页面</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
 <?php
    // $onsubmit = array('' => , );
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1' ,'onsubmit' => 'return buttoncheck()'];
    echo form_open('admin/user/add_email',$attributes);
    $id = $this->input->get('id');
    echo form_hidden('id',$id);
    $email = explode("@", $email)[0];
    $domain = $this->config->item('ops_email_domain');
?>
    <fieldset>
      	<div class="control-group">
          <label class="control-label"><strong>所属部门</strong><span class="required">*</span></label>
            <div class="controls">
            	<input type="text" style="width:220px;height:30px" class="form-control" id="partypath" name="partypath" value="<?php echo $partypath;?>" readonly />
            </div>
        </div>
        <div class="control-group">
          <label class="control-label"><strong>邮箱群组</strong><span class="required">*</span></label>
            <div class="controls">
            	<select style="width:220px;height:30px" id="group" name="group">
					<?php foreach ($group as $key => $value) {?>
						<option value="<?php echo $value->level_email;?>" <?php echo $level_id == $value->id ? "selected" : '' ?> >
							<?php echo $value->level_name." ".$value->level_email;?> 
						</option>
					<?php } ?>
            	</select>
            </div>
        </div>
	    <div class="control-group">
	        <label class="control-label"><strong>姓名(中文)</strong><span class="required">*</span></label>
	            <div class="controls">
	                <input type="text" style="width:220px;height:30px" id="name" name="name" value="<?php echo $name;?>" />
	            </div>
	    </div>
        <div class="control-group">
         	<label class="control-label">
          	<strong>邮箱账号<span class="required">*</span><br></strong>
          	</label>
            <div class="controls">
                <input type="text" style="width:80px;height:30px" id="email" name="email" value="<?php echo $email;?>" />@
                <select style="width:120px;height:30px" name="domain">
					<?php foreach ($domain as $key => $value) {?>
						<option value="<?php echo $key;?>"><?php echo $value;?></option>
					<?php } ?>
                </select>
            </div>
        </div>
        <div class="control-group">
          	<label class="control-label">
          	<strong>邮箱密码<span class="required">*</span><br></strong>
          	</label>
            <div class="controls">
                    <input type="text" style="width:220px;height:30px" id="password" name="password" value="<?php echo $password;?>" readonly />
            </div>
        </div>
        <div class="control-group">
          <label class="control-label"><strong>手机号码</strong><span class="required">*</span></label>
              <div class="controls">
                  <input type="text" style="width:220px;height:30px" id="tel" name="tel" value="<?php echo $tel;?>" />
              </div>
        </div>
         <!--  <div class="control-group">
            <label class="control-label">
              <strong>验证码<span class="required">*</span><br>( 英文 )</strong>
            </label>1
              <div class="controls">
                <input type="text" name="captcha" style="width:150px;height:30px"/>
                <img id="checkpic" src="/admin/user/captcha" onclick="changing();" title="看不清，点击刷新"/>
              </div>
          </div> -->
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary" id="btn" onclick="return check();">确认</button>
                  <!-- <button type="button" class="btn" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']?>' ">取消</button> -->
                </div>
          </fieldset>
        </form>
    </div>
          </div>
      </div>
      </div>
                      <!-- /block  -->
        </div>
                     <!-- /validation -->
                </div>
  <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
  <script type="text/javascript">
      // function checkpic(){
      //       var captcha = <?php echo $this->session->userdata('captcha')?>
      //       var checkpic = $('#checkpic').val
      //       if (captcha.val() == checkpic.val()) {
      //         return true;
      //       }
      //       else{
      //         alert("验证码错误，请重试！");
      //         return false;
      //       }
      // }
      //function changing(){
      //  document.getElementById('checkpic').src="/admin/user/captcha?"+Math.random();
      //}
      function buttoncheck(){
        $('#btn').on('click',function(){
          $("#btn").attr("disabled", true);
            setTimeout(function(){
              $("#btn").attr("disabled", false);
            },3000);
            return true;
        });
      }
      function check(){
    	var partypath = $("#partypath").val()
    	var name = $("#name").val()
    	var email = $("#email").val()
    	if (partypath == "") {
    		alert("请输入部门！");
    		return false;
    	}
    	else {
    		if (name == "") {
	    		alert("请输入姓名！");
	    		return false;
    		}
    		else{
    			if (email == "") {
		    		alert("请输入邮箱名！");
		    		return false;
	    		}else{
	    			return true;
	    		}
    		}
    	}
      }//输入验证
  </script>