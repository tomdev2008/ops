    <title>添加配置</title>
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
                                    <div class="text-muted bootstrap-admin-box-title">添加书籍</div>
                                </div>
                                <!-- form -->
				                <?php 
				                    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
				                    echo form_open('book/add', $attributes);
				                ?>
									<!-- book_level seclect -->
					                <div class="form-group" style="margin-top: 20px;margin-left: 10%">
										<label for="inputLevel" class="col-sm-2 control-label">选择书籍类别</label>
					                    <div class="col-sm-10">
					                        <select data-placeholder="==请选择提交方式==" id="level" name="level" style="width:30%;" class="chosen-select-level">
					                        	<option value=""></option>
					                            <?php foreach ($book_level as $key => $value): ?>
					                            	<option value="<?php echo $value->id?>"><?php echo str_replace('组','类',$value->level_name) ?></option>
					                            <?php endforeach ?>
					                        </select>
					                    </div>
					                </div>
					                <!-- book_name input -->
									<div class="form-group" style="margin-left: 10%">
				                        <label for="inputBookName" class="col-sm-2 control-label">书名</label>
				                        <div class="col-sm-10">
				                            <input class="form-control" id="name" type="text" name="name" style="width:60%" required="required">
				                        </div>
				                  	</div>
				                  	<div class="form-group" style="margin-left: 10%">
				                  	<label for="inputBookName" class="col-sm-2 control-label">简介（可填）</label>
				                        <div class="col-sm-10">
				                            <textarea name="remark" style="width:60%;height: 15%"></textarea>
				                        </div>
				                  	</div>
				                  	<div class="form-group" style="margin-left: 20%">
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
    	$(".chosen-select-level").chosen();
    	//判断level是否为空
    	function check(){
    		var level = $('#level').val()
    		if(level == ""){
    			alert('请选择书籍版本！！');
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
