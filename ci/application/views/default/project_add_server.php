<div class="span9" id="content" style=" position:absolute; left:0; top:0px; width:875px; height:415px">
  <!-- validation -->
  <div class="row-fluid">
    <!-- block -->
    <div class="block" >
      <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">添加子项目【2】</div>
      </div>
        <div class="block-content collapse in">
          <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
    echo form_open('project/add_project', $attributes);
    $server_env = $this->input->get('server_env');
    $ServerName = $this->input->get('ServerName');
    $alias_name = $this->input->get('alias_name');
    $server_type = $this->input->get('server_type');
    $server_project = $this->input->get('server_project');
    $project_name = $this->input->get('project_name');
    $platform_id = $this->input->get('platform_id');
    $data = [
        'server_env' => $server_env,
        'ServerName' => $ServerName,
        'alias_name' => $alias_name,
        'server_type' => $server_type,
        'server_project' => $server_project,
        'project_name' => $project_name
    ];
    echo form_hidden($data);
?>
    <fieldset>
      <div class="control-group">
          <label class="control-label">选择服务器<span class="required">*</span></label>
            <div class="controls">
                      <?php echo form_error('server', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                <select id="server" class="span6 m-wrap" name="server">
                  <option value="" selected>--请选择--</option>
                  <?php
                  $ip = $this->project_model->get_ServerName_by_ServerEnv($server_env,$platform_id);
                  foreach($ip as $value){
                    $port_num = $this->project_model->get_PortNum_by_ip($value->ip);
                    $port = (int)($this->project_model->get_MaxPort_by_ip($value->ip))+1;
                    if ($port == 1) {
                      $port = 8081;
                    }
                    ?>
                    <option value="<?php echo $value->ip?>" data-port="<?php echo $port?>"><?php echo $value->ip_alias.":".$value->ip."【已有".$port_num."个节点】"?></option>
                  <?php }?>
                </select>
              </div>
          </div>
        <div class="control-group">
          <label class="control-label">选择端口<span class="required">*</span></label>
            <div class="controls">
                      <?php echo form_error('port', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <input type="text" style="width:321px;height:30px" id="port" name="port" data-required="1" class="span2 m-wrap" readonly/>
              </div>
          </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary" id="btn" >确认添加</button>
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
    $('#server').on('change',function(){
        $('#port').val($("option:selected").data("port"));
    });
    function buttoncheck(){
    $('#btn').on('click',function(){
           $("#btn").attr("disabled", true);
           return true;
    });
  }
 </script>