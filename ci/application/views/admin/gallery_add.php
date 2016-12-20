
                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                        </div>
                    </div>
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/gallery/add', $attributes);
?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="navbar navbar-default bootstrap-admin-navbar-thin">
                                <ol class="breadcrumb bootstrap-admin-breadcrumb">
                                    <li>
                                        <a href="/admin/gallery">常用链接管理</a>
                                    </li>
                                    <li>添加常用链接</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">添加常用链接信息</div>
                                </div>
                                <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                                    <form class="form-horizontal">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="selectError">常用链接分组选择<span class="required">*</span></label>
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
                                                </div>
                                            </div>                                            
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">名称<span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                <?php echo form_error('title', '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                                        <strong>请输入！</strong>', '</div>'); ?>
                                                <input class="form-control" type="text" name="title" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">网址<span class="required">*</span></label>
                                                <div class="col-lg-10">
                                                <?php echo form_error('url', '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                                        <strong>请输入！</strong>', '</div>'); ?>
                                                    <input class="form-control" name="url" type="text" >
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="focusedInput">负责人</label>
                                                <div class="col-lg-10">
                                                <input class="form-control" type="text" name="user_name" >
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
        <script src="<?php echo base_url();?>admin/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>admin/js/jquery-2.0.3.min.js"></script>
        <script src="<?php echo base_url();?>admin/js/twitter-bootstrap-hover-dropdown.min.js"></script>  
        <script src="<?php echo base_url();?>admin/js/bootstrap-admin-theme-change-size.js"></script>  
        <script src="<?php echo base_url();?>admin/vendors/uniform/jquery.uniform.min.js"></script>  
        <script src="<?php echo base_url();?>admin/vendors/chosen.jquery.min.js"></script> 
        <script src="<?php echo base_url();?>admin/vendors/selectize/dist/js/standalone/selectize.min.js"></script>  
        <script src="<?php echo base_url();?>admin/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>  
        <script src="<?php echo base_url();?>admin/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>  
        <script src="<?php echo base_url();?>admin/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>  
        <script src="<?php echo base_url();?>admin/vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard-for.bootstrap3.js"></script>  
        <script src="<?php echo base_url();?>admin/vendors/boostrap3-typeahead/bootstrap3-typeahead.min.js"></script>                  

        <script type="text/javascript">
   
        </script>