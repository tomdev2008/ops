                <div class="span9" id="content">


                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $title?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
					<!-- BEGIN FORM-->
					<form action="#" id="form_sample_1" class="form-horizontal">
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
  								<label class="control-label">版本名称<span class="required">*</span></label>
  								<div class="controls">
  									<input type="text" name="version_name" data-required="1" class="span2 m-wrap"/>
  								</div>
  							</div>
                <div class="control-group">
                  <label class="control-label">版本号<span class="required">*</span></label>
                  <div class="controls">
                    <input type="text" name="version_number" data-required="1" class="span2 m-wrap"/>
                  </div>
                </div>                
  							<div class="control-group">
  								<label class="control-label">Email<span class="required">*</span></label>
  								<div class="controls">
  									<input name="email" type="text" class="span6 m-wrap"/>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">URL<span class="required">*</span></label>
  								<div class="controls">
  									<input name="url" type="text" class="span6 m-wrap"/>
  									<span class="help-block">e.g: http://www.demo.com or http://demo.com</span>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Number<span class="required">*</span></label>
  								<div class="controls">
  									<input name="number" type="text" class="span6 m-wrap"/>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Digits<span class="required">*</span></label>
  								<div class="controls">
  									<input name="digits" type="text" class="span6 m-wrap"/>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Credit Card<span class="required">*</span></label>
  								<div class="controls">
  									<input name="creditcard" type="text" class="span6 m-wrap"/>
  									<span class="help-block">e.g: 5500 0000 0000 0004</span>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Occupation&nbsp;&nbsp;</label>
  								<div class="controls">
  									<input name="occupation" type="text" class="span6 m-wrap"/>
  									<span class="help-block">optional field</span>
  								</div>
  							</div>
  							<div class="control-group">
  								<label class="control-label">Category<span class="required">*</span></label>
  								<div class="controls">
  									<select class="span6 m-wrap" name="category">
  										<option value="">Select...</option>
  										<option value="Category 1">Category 1</option>
  										<option value="Category 2">Category 2</option>
  										<option value="Category 3">Category 5</option>
  										<option value="Category 4">Category 4</option>
  									</select>
  								</div>
  							</div>
  							<div class="form-actions">
  								<button type="submit" class="btn btn-primary">Validate</button>
  								<button type="button" class="btn">Cancel</button>
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
        <link href="<?php echo base_url();?>vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url();?>vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="<?php echo base_url();?>vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendors/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url();?>vendors/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url();?>vendors/bootstrap-datepicker.js"></script>

        <script src="<?php echo base_url();?>vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="<?php echo base_url();?>vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="<?php echo base_url();?>vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>assets/form-validation.js"></script>
        
	<script src="<?php echo base_url();?>assets/scripts.js"></script>
        <script>

	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
	

        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>