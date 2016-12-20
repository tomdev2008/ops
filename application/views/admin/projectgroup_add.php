
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                        </div>
                    </div>
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/projectgroup/add', $attributes);
?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">添加项目分组</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>                                           
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput" style="text-align:middle">项目分组组名<span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                <?php echo form_error('title', '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                                        <strong>请输入！</strong>', '</div>'); ?>
                                                <input class="form-control" type="text" name="title" >
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
        <script src="<?php echo base_url();?>admadmin-staticin/js/twitter-bootstrap-hover-dropdown.min.js"></script>  
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

        </script>