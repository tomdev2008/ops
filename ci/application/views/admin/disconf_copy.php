 <title>拷贝版本到其他环境</title>
    <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
    <!-- bootstrap -->
    <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
	<link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-theme.min.css">
	<!-- chosen -->
    <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
    <script src="<?php echo base_url();?>chosen_v1.6.2/chosen.jquery.js"></script>
    <style>
        #main{margin-left:auto;margin-right:auto;}
    </style>
    	<div id="main">
            <div class="col-md-10" style="float:left;width:100%;margin-top:5%">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">跨环境复制配置版本</div>
                                </div>
            <?php 
                $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
                echo form_open('admin/disconfig/copy_to_other_env', $attributes);
                $app = $this->input->get('app');
				$env = $this->input->get('env');
				$version = $this->input->get('version');
				$data = [
					'app' => $app,
					'env_old' => $env,
					'version' => $version
				];
				echo form_hidden($data);
            ?>
             	<div class="form-group" style="margin-left:5%;margin-top:5%">
             		<label for="inputPattern" class="col-sm-2 control-label">选择环境</label>
                    <div class="col-sm-10">
                        <select data-placeholder="==请选择环境==" id="env" name="env" style="width:40%;" class="chosen-select-env">
                            <option value=""></option>
                            <!-- <option value="1" <?php echo $env == 1 ? "disabled" : '' ;?> >开发环境</option> -->
                            <option value="2" <?php echo $env == 1 ? "" : 'disabled' ;?> >测试环境</option>
                            <option value="3" <?php echo $env == 2 ? "" : 'disabled' ;?> >预发环境</option>
                            <option value="4" <?php echo $env == 3 ? "" : 'disabled' ;?> >生产环境</option>
                        </select>
                    </div>
                  </div>
                <div class="form-group" style="margin-left:5%;margin-top:5%">
                    <div class="col-sm-offset-2 col-sm-10">
                      	<button type="submit" id="btn" class="btn btn-primary" onclick="return check();">确认</button>
                    </div>
                </div>
            </form>
            				</div>
            			</div>
            	</div>
            </div>
        </div>
    <script type="text/javascript">
    	$(".chosen-select-env").chosen();
    	// 表单提交控制
    	function check(){
    		if ($('#env').val() == "") {
    			alert('请选择要拷贝的环境！！');
    			return false;
    		}
    		else{
    			return true;
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