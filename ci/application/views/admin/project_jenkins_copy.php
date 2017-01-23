
        <div class="span9" id="content" style=" position:absolute; left:0; top:0px; width:100%; height:100%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">复制子项目</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
    echo form_open('admin/project/jenkins_copy', $attributes);
?>
<input type="hidden" name="jenkins" id="jenkins" value="<?php echo $server_name?>">
  <form name="project_form" action="admin/project_jenkins_add.php">
    <fieldset>
      <div class="control-group">
          <label class="control-label">jenkins名称<span class="required">*</span></label>
            <div class="controls">
            <label class="span6 m-wrap"><?php echo $server_name;?></label>
              </div>
          </div>
      <div class="control-group">
          <label class="control-label">选择服务器<span class="required">*</span></label>
            <div class="controls">
                      <?php echo form_error('server', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                <select id="server" class="span6 m-wrap" name="server">
                  <option value="" selected>--请选择--</option>
                  <?php
                  $former_ip = $this->project_model->get_former_ip($server_name);
                  $ip = $this->project_model->get_ServerName_by_ServerEnv_copy($server_env,$platform_id,$former_ip);
                  foreach($ip as $value){
                    $port_num = $this->project_model->get_PortNum_by_ip($value->ip);
                    ?>
                    <option id="option_server" value="<?php echo $value->ip?>"><?php echo $value->ip_alias.":".$value->ip."【已有".$port_num."个节点】"?></option>
                  <?php }?>
                </select>
              </div>
          </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary" id="btn">确定</button>
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
    function buttoncheck(){
    $('#btn').on('click',function(){
           $("#btn").attr("disabled", true);
           return true;
    });
  }
 </script>