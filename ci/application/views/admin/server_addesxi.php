
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                        </div>
                    </div>
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/server/addesxi', $attributes);
?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="/admin/server">服务器管理</a>
                                    </li>
                                    <li>添加虚拟服务器</li>
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
                                                <label class="col-lg-2 control-label" for="selectError">所属主机<span class="required">*</span></label>
                                                <div class="col-lg-8">
                                                    <select class="form-control" name="esxi_id">
                                                        <?php 
                                                          foreach ($esxi_list as $key => $value) {                                                             
                                                            ?>    
                                                          <option value="<?php echo $value->id?>"><?php echo $value->ip?></option>
                                                            <?php                                                               
                                                           } ?>
                                                    </select>
                                                </div>
                                            </div> 
                                          <div class="form-group">
                                                <label class="col-lg-2 control-label" for="selectError">环境</label>
                                                <div class="col-lg-8">
                                                <?php echo form_error('env', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                                    <select class="form-control" name="env">
                                                    <option selected value="0">系统环境</option>
                                                    <option value="1">开发环境</option>
                                                    <option value="2">测试环境</option>
                                                    <option value="3">预发布环境</option>
                                                    <option value="4">生产环境</option>
                                                    </select>
                                                </div>
                                            </div>         
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="selectError">所属平台<span class="required">*</span></label>
                                                <div class="col-lg-8">
                                                    <select class="form-control" name="platform_id">
                                                        <?php 
                                                          foreach ($platform_list as $key => $value) {                                                             
                                                            ?>    
                                                          <option value="<?php echo $value->id?>"><?php echo $value->name?></option>
                                                            <?php                                                               
                                                           } ?>
                                                    </select>
                                                </div>
                                            </div>           
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="selectError">服务器位置<span class="required">*</span></label>
                                                <div class="col-lg-8">
                                                    <select class="form-control" name="location">
                                                        <?php 
                                                          foreach ($location_list as $key => $value) {                                                             
                                                            ?>    
                                                          <option value="<?php echo $value->id?>"><?php echo $value->id.$value->location?></option>
                                                            <?php                                                               
                                                           } ?>
                                                    </select>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">系统类型</label>
                                                <div class="col-lg-8">
                                                <select class="form-control" name="type">                                   
                                                    <option value="Windows">Windows</option>
                                                    <option selected value="Linux">Linux</option>
                                                    </select>
                                                </div>
                                            </div>                         
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">服务器IP地址<span class="required">*</span></label>
                                                <div class="col-lg-8">
                                                <?php echo form_error('title', '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                                        <strong>请输入！</strong>', '</div>'); ?>
                                                <input class="form-control" type="text" name="title" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">公网IP地址</label>
                                                <div class="col-lg-8">
                                                <input class="form-control" type="text" name="pub_ip" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">服务器别名</label>
                                                <div class="col-lg-8">
                                                <input class="form-control" type="text" name="ip_alias" >
                                                </div>
                                            </div>                                            
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">配置<span class="required">*</span></label>
                                                <div class="col-lg-8">
                                                <?php echo form_error('config', '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                                        <strong>请输入！</strong>', '</div>'); ?>
                                                    <input class="form-control" name="config" type="text" >
                                                </div>
                                            </div>                                              
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">服务代码</label>
                                                <div class="col-lg-8">
                                                <input class="form-control" type="text" name="service_no" >
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">备注</label>
                                                <div class="col-lg-8">
                                                <input class="form-control" type="text" name="ip_comments" >
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">添加时间</label>
                                                <div class="col-lg-8">
                                                <input value="<?php echo date("Y-m-d")?>" onclick="laydate({istime: false, istoday: true,format: 'YYYY-MM-DD'})" name="opr_time">
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
                                    </div>
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
        </script>