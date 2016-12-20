
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1>首页信息展示管理</h1>
                            </div>
                        </div>
                    </div>
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/gallery/delete', $attributes);
?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">删除首页展示信息</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="selectError">展示栏目选择<span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                <?php echo form_error('category', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                                    <select class="form-control" name="category">
                                                        <?php 
                                                          foreach ($gallery_platform_list as $key => $value) {                                                             
                                                            ?>    
                                                          <option selected value="<?php echo $value->id?>"><?php echo $value->gallery_name?></option>
                                                            <?php                                                               
                                                           } ?>
                                                    </select>
                                                    <span class="help-block">Woohoo!</span>
                                                </div>
                                            </div>                                            
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">名称<span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                <?php echo form_error('title', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                                <input class="form-control" type="text" name="title" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">网址<span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                <?php echo form_error('title', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                                                    <input class="form-control" name="url" type="text" >
                                                </div>
                                            </div>                                            
                                            <div class="form-actions">
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

        <script type="text/javascript">
            $(function() {
                $('.datepicker').datepicker();
                $('.uniform_on').uniform();
                $('.chzn-select').chosen();
                $('.selectize-select').selectize();
                $('.textarea-wysihtml5').wysihtml5({
                    stylesheets: [
                        'vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/wysiwyg-color.css'
                    ]
                });

                $('#rootwizard').bootstrapWizard({
                    'nextSelector': '.next',
                    'previousSelector': '.previous',
                    onNext: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard').find('.progress-bar').css('width', $percent + '%');
                        // If it's the last tab then hide the last button and show the finish instead
                        if ($current >= $total) {
                            $('#rootwizard').find('.pager .next').hide();
                            $('#rootwizard').find('.pager .finish').show();
                            $('#rootwizard').find('.pager .finish').removeClass('disabled');
                        } else {
                            $('#rootwizard').find('.pager .next').show();
                            $('#rootwizard').find('.pager .finish').hide();
                        }
                    },
                    onPrevious: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard').find('.progress-bar').css('width', $percent + '%');
                        // If it's the last tab then hide the last button and show the finish instead
                        if ($current >= $total) {
                            $('#rootwizard').find('.pager .next').hide();
                            $('#rootwizard').find('.pager .finish').show();
                            $('#rootwizard').find('.pager .finish').removeClass('disabled');
                        } else {
                            $('#rootwizard').find('.pager .next').show();
                            $('#rootwizard').find('.pager .finish').hide();
                        }
                    },
                    onTabShow: function(tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;
                        var $percent = ($current / $total) * 100;
                        $('#rootwizard').find('.bar').css({width: $percent + '%'});
                    }
                });
                $('#rootwizard .finish').click(function() {
                    alert('Finished!, Starting over!');
                    $('#rootwizard').find('a[href*=\'tab1\']').trigger('click');
                });
            });
        </script>