
        <div class="span9" id="content" style=" position:absolute; left:0; top:0px; width:100%; height:100%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">添加子项目</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
    echo form_open('admin/project/jenkins', $attributes);
    $oo = $this->project_model->get_env_alias_by_env($server_env);
?>
<input type="hidden" name="server_project2" value="<?php echo $server_project?>">
<input type="hidden" name="server_env2" value="<?php echo $server_env; ?>">
<input type="hidden" name="platform_id2" value="<?php echo $platform_id; ?>">
  <form name="project_form" action="admin/project_jenkins_add.php">
    <fieldset>
      <div class="control-group">
        <label class="control-label">项目中文名称<span class="required">*</span></label>
          <div class="controls">
            <?php echo form_error('cn_alias_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
            <input type="text" style="width:321px;height:30px" name="cn_alias_name" data-required="1" class="span2 m-wrap"/>-
            <input type="text" style="width:100px;height:30px" name="cn_alias_name2" readonly class="span2" value="<?php echo substr($oo, 0,6); ?>"/>
          </div>
      </div>
      <div class="control-group">
        <label class="control-label">是否Docker部署<span class="required">*</span></label>
          <div class="controls">
          <?php echo form_error('ops_docker_deploy', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
            <select id="ops_docker_deploy" class="span6 m-wrap" name="ops_docker_deploy">
              <option value="0" selected>否</option>
              <!-- <option data-prefix="scheduler" value="scheduler">scheduler</option>
              <option data-prefix="jar" value="jar">jar</option> -->
              <option value="1">是</option>
            </select>
          </div>
      </div>
      <div class="control-group">
        <label class="control-label">仓库类型<span class="required">*</span></label>
          <div class="controls">
            <?php echo form_error('ops_repo_type', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
            <select id="ops_repo_type" class="span6 m-wrap" name="ops_repo_type">
              <option value="git" selected>git</option>
              <option value="svn">svn</option>
              <option value="ftp">ftp</option>
            </select>
          </div>
      </div>
      <div class="control-group">
        <label class="control-label">仓库地址<span class="required">*</span></label>
          <div class="controls">
            <?php echo form_error('ops_repo_url', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
            <input type="text" style="width:321px;height:30px" name="ops_repo_url" data-required="1" class="span2 m-wrap"/>
          </div>
      </div>
      <div class="control-group">
        <label class="control-label">war包名称<span class="required"><br>若多个请用英文逗号隔开</span></label>
          <div class="controls">
            <?php echo form_error('ops_war_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
            <input type="text" style="width:321px;height:30px" name="ops_war_name" data-required="1" class="span2 m-wrap"/>
          </div>
      </div>
      <div class="control-group">
        <label class="control-label">应用日志路径</label>
          <div class="controls">
            <input type="text" style="width:321px;height:30px" name="app_logs_path" data-required="1" class="span2 m-wrap"/>
          </div>
      </div>
      <div class="control-group">
          <label class="control-label">项目环境</label>
            <div class="controls">
                <input type="text" id="server_env" name="server_env" class="span6 m-wrap" readonly value="<?php echo $this->project_model->get_env_alias_by_env($server_env); ?>" />
            </div>
      </div>
      <div class="control-group">
        <label class="control-label">项目容器<span class="required">*</span></label>
          <div class="controls">
            <?php echo form_error('server_type', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
            <select id="server_type" class="span6 m-wrap" name="server_type">
              <option value="" selected>--请选择容器--</option>
              <option data-prefix="backend" value="jetty">jetty</option>
              <option data-prefix="frontend" value="nodejs">nodejs</option>
            </select>
          </div>
      </div>
      <div class="control-group">
          <label class="control-label">项目Jenkins名称<span class="required">*</span></label>
            <div class="controls">
                      <input type="text" id="subPrjName1" name="server_env_name" data-required="1" class="span2" value="<?php echo $this->project_model->get_env_name_by_env($server_env); ?>" readonly/>-
                      <?php echo form_error('server_type_name', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <input type="text" id="subPrjName2" name="server_type_name" data-required="1" class="span2" readonly/>-
                      <input type="text" style="width:150px;height:30px" value="<?php echo $alias_name?>" id="subPrjName3" name="server_name" data-required="1" class="span2" readonly/>-
                      <?php echo form_error('server_contents', '<div class="alert alert-error"><button class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                      <input type="text" style="width:200px;height:30px" id="subPrjName4" name="server_contents" data-required="1" class="span2"/>
              </div>
          </div>
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
                    $port = (int)($this->project_model->get_MaxPort_by_ip())+1;
                    if ($port == 1) {
                      $port = 10000;
                    }
                    $default_dubbo_port = (int)($this->project_model->get_Max_dubbo_Port_by_ip())+1;
                    if ($default_dubbo_port == 1) {
                      $default_dubbo_port = 30000;
                    }
                    ?>
                    <option id="option_server" value="<?php echo $value->ip?>" data-port="<?php echo $port?>" data-default_dubbo_port="<?php echo $default_dubbo_port?>" ><?php echo $value->ip_alias.":".$value->ip."【已有".$port_num."个节点】"?></option>
                  <?php }?>
                </select>
              </div>
          </div>
        <div class="control-group">
          <label class="control-label">http端口<span class="required">*</span></label>
            <div class="controls">
                <input type="text" style="width:321px;height:30px" id="http_port" name="http_port" data-required="1" class="span2 m-wrap" readonly/>
              </div>
          </div>
        <div class="control-group">
          <label class="control-label">dubbo端口</label>
            <div class="controls">
                <input type="text" style="width:321px;height:30px" id="dubbo_port" name="dubbo_port" data-required="1" class="span2 m-wrap" />
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
    var TYPE_MAP = {
      'jetty': 'backend',
      'nodejs': 'frontend'
    }
    var $subPrjName2 = $('#subPrjName2')
    $('#server_type').on('change',change_type)
    function change_type(value){
      $subPrjName2.val(TYPE_MAP[$(this).val()])
    }
    $('#server').on('change',function(){
        $('#http_port').val($("#server").find("#option_server:selected").data("port"));
        $('#dubbo_port').val($("#server").find("#option_server:selected").data("default_dubbo_port"));
    });
    function buttoncheck(){
    $('#btn').on('click',function(){
           $("#btn").attr("disabled", true);
           return true;
    });
  }
 </script>