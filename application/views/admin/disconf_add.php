    <title>添加配置</title>
    <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
    <!-- bootstrap -->
    <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
	<link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-theme.min.css">
	<!-- chosen -->
    <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
    <script src="<?php echo base_url();?>chosen_v1.6.2/chosen.jquery.js"></script>
    <!-- textarea -->
	<link href="<?php echo base_url();?>admin-static/vendors/linedtextarea/jquery-linedtextarea.css" type="text/css" rel="stylesheet" />
    <script src="<?php echo base_url();?>admin-static/vendors/linedtextarea/jquery-linedtextarea.js"></script>
    <style>
        #main{margin-left:auto;margin-right:auto;}
    </style>
        <div id="main">
            <div class="col-md-10" style="float:left;width:100%;margin-top:5%">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default bootstrap-admin-no-table-panel">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">添加友情链接分组</div>
                                </div>
                <!-- <form class="form-horizontal" role="form"> -->
                <?php 
                    $attributes = ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data','id' => 'form_sample_1','onsubmit' => 'return buttoncheck()'];
                    echo form_open_multipart('admin/disconfig/add', $attributes);
                    $env = $this->input->get('env');
                    $projectid = $this->input->get('project_id');
                    $app = $this->input->get('app');
                    $version = $this->input->get('version');
                    $data = array(
                        'project' => $app,
                        'env' => $env
                    );
                    echo form_hidden($data);//隐藏传输
                ?>
                  <!-- 具体项目 -->
                  <div class="form-group" style="margin-top:10px">
                   <!--  <label for="inputEmail3" class="col-sm-2 control-label">选择具体项目</label>
                    <div class="col-sm-10">
                      <select data-placeholder="==请选择项目==" id="project" style="width:50%;" class="chosen-select" tabindex="7">
                            <option value=""></option>
                            <?php foreach($get_project_name as $project_name){
                                $project_id = $this->statistics_model->get_id_by_name($project_name->name);
                            ?>
                                <option value="<?php echo $project_id?>"><?php echo $project_name->name?></option>
                            <?php }?>
                      </select>
                    </div>
                  </div> -->
                  <!-- 子项目 -->
                  <!-- <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">选择子项目</label>
                    <div class="col-sm-10">
                        <select data-placeholder="==请选择子项目==" id="app" name="project" style="width:50%;" class="chosen-select-no-single" tabindex="9">
                        </select>
                    </div>
                  </div> -->
                  <!-- 环境 -->
                  <!-- <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">选择环境</label>
                    <div class="col-sm-10">
                        <select data-placeholder="==请选择环境==" id="env" name="env" style="width:50%;" class="chosen-select-env" tabindex="9">
                            <option value=""></option>
                            <?php foreach($get_env as $value){?>
                                <option value="<?php echo $value->id?>"><?php echo $value->server_env;?></option>
                            <?php }?>
                        </select>
                    </div>
                  </div> -->
                  <!-- 提交方式 -->
                  <div class="form-group">
                    <label for="inputPattern" class="col-sm-2 control-label">选择提交方式</label>
                    <div class="col-sm-10">
                        <select data-placeholder="==请选择提交方式==" id="pattern" name="pattern" style="width:30%;" class="chosen-select-pattern">
                            <option value=""></option>
                            <option value="uploadfile">上传配置文件</option>
                            <option value="inputtextarea">输入文本</option>
                        </select>
                    </div>
                  </div>
                  <!-- 版本 -->
                  <div class="form-group">
                    <label for="inputVersion" class="col-sm-2 control-label">选择版本</label>
                    <div class="col-sm-10">
                        <select data-placeholder="==请选择版本==" id="version" name="version" style="width:50%;" class="chosen-select-version">
                            <!-- <option value=""></option> -->
                            <?php 
                                $version_all = $this->disconfig_model->get_version_by_appid_env($app,$env);
                                foreach ($version_all as $value) {
                                    if ($value->version == $version) {
                            ?>
                                    <option value="<?php echo $value->version;?>" selected><?php echo $value->version;?></option>
                            <?php      
                                }else{
                            ?>
                                    <option value="<?php echo $value->version;?>"><?php echo $value->version;?></option>
                            <?php
                                    }
                                }
                            ?>
                                    <option value=""></option>
                                    <option value="version_custom">【 自定义 】</option>
                        </select>
                    </div>
                  </div>
                  <!-- 自定义版本号 -->
                  <div class="form-group" id="custom_version" style="display:none">
                        <label for="inputCustomVersion" class="col-sm-2 control-label">自定义版本号</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="version_custom" name="version_custom" value="<?php echo date("Ymd")?>" style="width:60%;">
                        </div>
                  </div>
                  <!-- 上传文件 -->
                  <div class="form-group" id="inputfile" style="display:none">
                    <label for="exampleInputFile" class="col-sm-2 control-label">选择配置文件</label>
                    <input type="file" id="exampleInputFile" style="margin-left:18%" name="inputfile">
                    <span class="help-block" style="margin-left:18%">支持任意类型配置文件(.properties文件可支持自动注入,非.properties文件则只是简单托管)</span>
                  </div>
                <div id="inputtext" style="display:none">
                  <!-- 文件名 -->
                  <div class="form-group">
                        <label for="inputFileName" class="col-sm-2 control-label">文件名</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="filename" type="text" name="filename" style="width:60%">
                        </div>
                  </div>
                  <!-- 文本 -->
                  <div class="form-group">
                        <label for="inputText" class="col-sm-2 control-label">输入文本</label>
                        <div class="col-sm-10">
                            <textarea class="lined" rows="15" id="text" cols="80" name="text" style="width:60%;height:40%"></textarea>
                        </div>
                  </div>
                </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" id="btn" class="btn btn-primary" onclick="return check();">确认</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // 隐藏自定义元素
        // function hidden(){
        //     document.getElementById("custom_version").style.display="none";
        // }
        // $(function(){
        //     $("#text").one(linedtextarea());
        // })
        var $chosenSelectSoSingle = $('.chosen-select-no-single')
        var $chosenSelectEnv = $('.chosen-select-env')
        var $chosenSelectVersion = $('.chosen-select-version')
        var $chosenSelectPattern = $(".chosen-select-pattern")
        $(".chosen-select-pattern").chosen();
        $(".chosen-select").chosen();
        $('.chosen-select-version').chosen();
        $chosenSelectSoSingle.chosen({
            disable_search_threshold:10
        });
        $chosenSelectEnv.chosen({
            disable_search_threshold:10
        });
        // 二级联动(项目->子项目)
        $(".chosen-select").on('change', function (){
            $.ajax({
              url: "/admin/disconfig/ajax_project?project_id="+$(this).val()+"/",
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
        // 三级联动(子项目&环境->版本)
        $('.chosen-select-env').on('change',function(){
                $.ajax({
                    url:"/admin/disconfig/ajax_version?app_id=" + $chosenSelectSoSingle.val() + "&env=" + $chosenSelectEnv.val() + "/",
                    dataType:"json",
                    beforeSend: function(){$('ul.chosen-select-version').empty();},
                    success: function( servers ) {
                    $chosenSelectVersion.empty()
                    servers.forEach(function( server ){
                      var version = server.version
                      $chosenSelectVersion.append('<option value="' + version + '">' + version + '</option>');
                    })
                    $chosenSelectVersion.append('<option value=""></option>');
                    $chosenSelectVersion.append('<option value="version_custom">【 自定义 】</option>');//增加自定义选项
                    $chosenSelectVersion.trigger("chosen:updated");
                  }
                });
             })
        //选择提交方式
        $chosenSelectPattern.on('change',function(){
            if ($(this).val() == "inputtextarea") {
                document.getElementById("inputtext").style.display="";//显示文本输入框
                document.getElementById("inputfile").style.display="none";//隐藏上传
            }
            else{
                document.getElementById("inputtext").style.display="none";//隐藏文本输入框
                document.getElementById("inputfile").style.display="";//显示上传
            }
        })
        //自定义版本
        $chosenSelectVersion.on('change',function(){
            if ($chosenSelectVersion.val() == "version_custom") {
                document.getElementById("custom_version").style.display="";//显示自定义文件名输入框
            }
            else{
                 document.getElementById("custom_version").style.display="none";//隐藏自定义文件名输入框
            }
        })
        // 检测输入是否为空
        function check(){
            var pattern = $('#pattern').val()
            var version = $('#version').val()
            var version_custom = $('#version_custom').val()
            var filename= $('#filename').val()
            var text = $('#text').val()
            var inputfile =$('#exampleInputFile').val()
            if (pattern == "inputtextarea") {
                if (version == "version_custom") {
                    if (version_custom == "") {
                        alert("请输入新版本号！！");
                        return false;
                    }
                    else{
                        if (filename == "") {
                            alert("请填写文件名！！");
                            return false;
                        }
                        else{
                            if (text == "") {
                                alert("请输入文本！！");
                                return false;
                            }
                            else{
                                return true;
                            }
                        }
                    }
                }
                else if(version == ""){
                    alert("请选择新版本号！！");
                    return false;
                }
                else{
                    if (filename == "") {
                        alert("请填写文件名！！");
                        return false;
                    }
                    else{
                        if (text == "") {
                            alert("请输入文本！！");
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                }
            }
            else if(pattern == "uploadfile"){
                if (version == "version_custom") {
                    if (version_custom == "") {
                        alert("请输入新版本号！！");
                        return false;
                    }
                    else{
                         if (inputfile == "") {
                            alert("请上传配置文件！！");
                            return false;
                        }
                        else{
                            // alert("上传成功！！");
                            return true;
                        }
                    }
                }
                else if(version == ""){
                    alert("请选择新版本号！！");
                    return false;
                }
                else{
                    if (inputfile == "") {
                        alert("请上传配置文件！！");
                        return false;
                    }
                    else{
                        // alert("上传成功！！");
                        return true;
                    }     
                }
            }
        }
        // 控制提交
        function buttoncheck(){
            $('#btn').on('click',function(){
              $("#btn").attr("disabled", true);
                setTimeout(function(){
                  $("#btn").attr("disabled", false);
                },3000);
                return true;
            });
        }
        </script>