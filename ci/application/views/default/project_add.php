<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
<div class="span9" id="content" style=" position:absolute; left:0; top:0px; width:875px; height:415px">
  <!-- validation -->
  <div class="row-fluid">
    <!-- block -->
    <div class="block" >
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">添加子项目【1】</div>
      </div>
        <div class="block-content collapse in">
          <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('project/add', $attributes);
    $server_project = $this->input->get('server_project');
    $project_name = $this->input->get('project_name');
    $platform_id = $this->input->get('platform_id');
    $alias_name = $this->project_model->get_AliasName_by_id($server_project);
    $data = [
        'server_project' => $server_project,
        'project_name' => $project_name,
        'platform_id' => $platform_id
    ];
    echo form_hidden($data);
?>
    <fieldset>
      <div class="control-group">
          <label class="control-label">项目环境<span class="required">*</span></label>
            <div class="controls">
                      <?php echo form_error('server_env', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                <select id="server_env" class="span6 m-wrap" name="server_env">
                  <option value="" selected>--请选择环境--</option>
                  <option value="1">开发环境</option>
                  <option value="2">测试环境</option>
                  <option value="3">预发布环境</option>
                  <option value="4">生产环境</option>
                </select>
              </div>
          </div>
        <div class="control-group">
          <label class="control-label">项目容器<span class="required">*</span></label>
            <div class="controls">
                      <?php echo form_error('server_type', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                <select id="server_type" class="span6 m-wrap" name="server_type">
                  <option value="" selected>--请选择容器--</option>
                  <!-- <option data-prefix="tomcat" value="tomcat">tomcat</option> -->
                  <option data-prefix="backend" value="jetty">jetty</option>
                  <!-- <option data-prefix="scheduler" value="scheduler">scheduler</option>
                  <option data-prefix="jar" value="jar">jar</option> -->
                  <option data-prefix="frontend" value="nodejs">nodejs</option>
                </select>
              </div>
          </div>
      <div class="control-group">
          <label class="control-label">项目Jenkins名称<span class="required">*</span></label>
            <div class="controls">
                      <?php echo form_error('server_env_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <input type="text" id="subPrjName1" name="server_env_name" data-required="1" class="span2" readonly/>-
                      <?php echo form_error('server_type_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <input type="text" id="subPrjName2" name="server_type_name" data-required="1" class="span2" readonly/>-
                      <?php echo form_error('server_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <input type="text" style="width:150px;height:30px" value="<?php echo $alias_name?>" id="subPrjName3" name="server_name" data-required="1" class="span2" readonly/>-
                      <?php echo form_error('server_contents', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <input type="text" style="width:200px;height:30px" id="subPrjName4" name="server_contents" data-required="1" class="span2"/>
              </div>
          </div>
        <div class="control-group">
          <label class="control-label">项目中文名称<span class="required">*</span></label>
            <div class="controls">
                      <?php echo form_error('alias_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <input type="text" style="width:321px;height:30px" name="alias_name" data-required="1" class="span2 m-wrap"/>
              </div>
          </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">下一步</button>
                  <button type="button" class="btn" onclick="history.go(-1)">取消</button>
                </div>
          </fieldset>
        </form>
    </div>
          </div>
      </div>
    </div>
    <!-- /block -->
  </div>
  <!-- /validation -->
</div>

<!--/.fluid-container-->
  <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/scripts.js"></script>
  <script src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
 <script>
    var ENV_MAP = {
      1: 'dev',
      2: 'test',
      3: 'pre',
      4: 'product'
    }
    var TYPE_MAP = {
      'jetty': 'backend',
      'nodejs': 'frontend'
    }
    var $subPrjName1 = $('#subPrjName1')
    var $subPrjName2 = $('#subPrjName2')
    $('#server_env').on('change', change_env)
    $('#server_type').on('change',change_type)
    function change_env(value){
      $subPrjName1.val(ENV_MAP[$(this).val()])
    }
    function change_type(value){
      $subPrjName2.val(TYPE_MAP[$(this).val()])
    }
 </script>