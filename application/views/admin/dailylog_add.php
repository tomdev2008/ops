
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12"></div>
                    </div>
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/dailylog/add', $attributes);
?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="/admin/dailylog">工作日志管理</a>
                                    </li>
                                    <li>添加工作日志</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title"><?php echo $title?></div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>                                          
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">工作名称<span class="required">*</span></label>
                                                <div class="col-lg-8">
                                                <?php echo form_error('daily_title', '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                                        <strong>请输入！</strong>', '</div>'); ?>
                                                <input class="form-control" type="text" name="daily_title" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="textarea-wysihtml5">工作内容</label>
                                                <div class="col-lg-10">
                                                    <textarea name="daily_content" class="form-control textarea-wysihtml5" placeholder="Enter text..." style="width: 100%; height: 200px"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-lg-2 control-label" for="focusedInput">负责人<span class="required">*</span></label>
                                              <div class="col-lg-8">
                                               <?php echo form_error('user_id', '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                                        <strong>请输入！</strong>', '</div>'); ?>
                                                  <select data-placeholder="==请选择负责人==" name="user_id" style="width:600px;" class="chosen-select" tabindex="7">
                                                    <option></option>
                                                    <?php foreach($get_user_name as $user_name){
                                                      $user_id = $this->dailylog_model->get_id_by_name($user_name->name);
                                                      ?>
                                                      <option value="<?php echo $user_id?>"><?php echo $user_name->name?></option>
                                                    <?php }?>
                                                    </select>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                               <label class="col-lg-2 control-label" for="focusedInput">提醒时间<span class="required">*</span></label>
                                              <div class="col-lg-8">
                                              <?php echo form_error('daily_time', '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                                        <strong>请输入！</strong>', '</div>'); ?>
                                                <input value="<?php echo date("Y-m-d H:i")?>" onclick="laydate({istime: true, istoday: true,format: 'YYYY-MM-DD hh:mm'})" name="daily_time">
                                              </div>
                                            </div>                     
                                            <div class="form-actions" style="text-align:center;">
                                              <button type="submit" class="btn btn-primary">确定</button>
                                              <button type="reset" class="btn btn-default" onclick="history.go(-1)">取消</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                               
        <script src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url();?>admin-static/js/twitter-bootstrap-hover-dropdown.min.js"></script>  
        <script src="<?php echo base_url();?>admin-static/js/bootstrap-admin-theme-change-size.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/uniform/jquery.uniform.min.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/chosen.jquery.min.js"></script> 
        <script src="<?php echo base_url();?>admin-static/vendors/selectize/dist/js/standalone/selectize.min.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard-for.bootstrap3.js"></script>  
        <script src="<?php echo base_url();?>admin-static/vendors/boostrap3-typeahead/bootstrap3-typeahead.min.js"></script>    
        <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
        <script src="<?php echo base_url();?>laydate/laydate.js"></script>
        <script src="<?php echo base_url();?>chosen_v1.6.2/chosen.jquery.js"></script>              

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
        </script>