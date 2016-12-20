 <!DOCTYPE html>
 <script>
    function getSltValue() 
    {
      var selected_val = document.getElementById("project_name").value;
    }
 </script>
                <div class="span9" id="content">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo anchor('statistics', '项目统计');?> / <?php echo $title?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
					<!-- BEGIN FORM-->
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
    echo form_open('statistics/add', $attributes);
    $level_id = $this->input->get('level_id');
?>
						<fieldset>
							<div class="alert alert-error hide">
								<button class="close" data-dismiss="alert"></button>
								You have some form errors. Please check below.
							</div>
							<div class="alert alert-success hide">
								<button class="close" data-dismiss="alert"></button>
								Your form validation is successful!
							</div>
  							<div class="control-group">
  								<label class="control-label">项目发布计划<span class="required">*</span></label>
  								<div class="controls">
                  <?php echo form_error('project_time', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
  									 <input onclick="laydate({istime: true, format: 'YYYYMMDD'})" name="project_time"></input>
  								</div>
  							</div>

                <div class="control-group">
                  <label class="control-label">项目环境:<span class="required">*</span></label>
                  <div class="controls">
                  <font size=5><strong>生产环境</strong></font><br>
                  没有子项目请前往<a href="http://<?php echo $_SERVER['HTTP_HOST']?>/project">项目管理</a>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">选择具体项目<span class="required">*</span></label>
                  <div class="controls">
                   <?php echo form_error('project_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <select data-placeholder="==请选择项目==" name="project_name" style="width:350px;" class="chosen-select" tabindex="7">
                        <option></option>
                        <?php foreach($get_project_name as $project_name){
                          $project_id = $this->statistics_model->get_id_by_name($project_name->name);
                          ?>
                          <option value="<?php echo $project_id?>"><?php echo $project_name->name?></option>
                        <?php }?>
                        </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">选择子项目<span class="required">*</span></label>
                  <div class="controls">
                  <?php echo form_error('env_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <select data-placeholder="==请选择子项目==" style="width:350px;" name="env_name" class="chosen-select-no-single" tabindex="9">
                        </select>
                  </div>
                </div>

              <div class="control-group">
                <label class="control-label" for="textarea2">【Change Log】</label>
                  <div class="controls">
                   <textarea name="change_log" class="input-xlarge textarea" placeholder="Enter text ..." style="width: 600px; height: 200px"></textarea>
                   <div>
                     <input type="checkbox" name="select" value="1" ><font color="red">紧急发布</font>（无缝发布，编译和部署分离）
                   </div>
                 </div>
              </div>    
  							<div class="form-actions">
  								<button type="submit" class="btn btn-primary" id="btn" onclick="return buttoncheck();">确定</button>
  								<button type="button" class="btn" onclick="history.go(-1)">取消</button>
  							</div>
						</fieldset>
					</form>
					<!-- END FORM-->
				</div>
			    </div>
			</div>
                     	<!-- /block -->
		    </div>
                     <!-- /validation -->
                </div>
            </div>

        <!--/.fluid-container-->
    <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
    <script src="<?php echo base_url();?>chosen_v1.6.2/chosen.jquery.js"></script>
    <script src="<?php echo base_url();?>laydate/laydate.js"></script>
    <script type="text/javascript">
        var $chosenSelectSoSingle = $('.chosen-select-no-single')
        $(".chosen-select").chosen();
        $chosenSelectSoSingle.chosen({
            disable_search_threshold:10
        });
        $(".chosen-select").on('change', function (){
            $.ajax({
              url: "/statistics/ajax_project?project_id="+$(this).val()+"/",
              dataType: "json",
              beforeSend: function(){$('ul.chosen-select-no-single').empty();},
              success: function( servers ) {
                $chosenSelectSoSingle.empty()
                servers.forEach(function(server){
                  var name = server.server_name
                  var alias_name = server.server_alias_name
                  $chosenSelectSoSingle.append('<option value="' + name + '">' + name +' 【'+ alias_name + '】</option>');
                })
                $chosenSelectSoSingle.trigger("chosen:updated");
              }
            });
        })
        laydate({
            elem: '#time',
            format: 'YYYYMMDD', // 分隔符可以任意定义，该例子表示只显示年月
            festival: true, //显示节日
        });
        function buttoncheck(){
        $('#btn').on('click',function(){
          $("#btn").attr("disabled", true);
          return true;
        });
      }
        // $('.chosen-select input').autocomplete({
        //   source: function( request, response ) {
        //     $.ajax({
        //       url: "/statistics/ajax_project?project_id="+request.project_name+"/",
        //       dataType: "json",
        //       beforeSend: function(){$('ul.chosen-select-no-single').empty();},
        //       success: function( data ) {
        //         response( $.map( data, function( item ) {
        //           $('ul.chosen-select-no-single').append('<li class="active-result">' + item.name + '</li>'
        //             );
        //         }));
        //       }
        //     });
        //   }
        // });
    </script>
