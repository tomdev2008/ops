<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; top:0px ;left:30px; right:50px; width:90%; height:90%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">修改友情链接信息</div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/gallery/update', $attributes);
    echo form_hidden('id', $id);
    echo '<br>';
?>
    <fieldset>
    <div class="control-group">
                  <label class="control-label">名称<span class="required">*</span></label>
                  <div class="controls">
                  <input type="text" name="name" data-required="1" style="width:250px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $name;?>" />
            </div>
                </div>
    <div class="control-group">
                  <label class="control-label">网址<span class="required">*</span></label>
                  <div class="controls">
                  <input type="text" name="url" data-required="1" style="width:250px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $url;?>" />
            </div>
                </div>   
    <div class="control-group">
                  <label class="control-label">负责人</label>
                  <div class="controls">
                  <select data-placeholder="<?php $user_id = $this->gallery_model->get_user_id_by_id($id);echo $user_name= $this->gallery_model->get_name_by_id($user_id)?>" name="user_id" style="width:250px;margin-right:10px;" class="chosen-select" tabindex="7">
                  <option></option>
                  <?php foreach($get_user_name as $user_name){
                  $user_id = $this->gallery_model->get_id_by_name($user_name->name);
                  ?>
                  <option value="<?php echo $user_id?>"><?php echo $user_name->name?></option>
                  <?php }?>
                  </select>
            </div>
    </div>     
    <div class="form-actions">
                  <button type="submit" class="btn btn-primary">确定</button>
                  <button type="button" class="btn" onclick="close_frame()">取消</button>
                </div>
          </fieldset>
          </div>
      </div>
      </div>
                      <!-- /block -->
        </div>
                     <!-- /validation -->
                </div>

<!--/.fluid-container-->
  <script src="http://ops.xkeshi.so/vendors/jquery-1.9.1.min.js"></script>
  <script src="http://ops.xkeshi.so/assets/scripts.js"></script>
  <script src="http://ops.xkeshi.so/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="http://ops.xkeshi.so/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/assets/styles.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="http://ops.xkeshi.so/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="<?php echo base_url();?>chosen_v1.6.2/chosen.css">
  <script src="<?php echo base_url();?>chosen_v1.6.2/chosen.jquery.js"></script>
 <script>

      function close_frame() {  
      var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
      parent.layer.close(index);
      }

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