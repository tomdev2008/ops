<!--  <div style=" position:absolute; left:0; top:0px; width:100%; height:100%"> -->
                <div class="span9" id="content" style=" position:absolute; top:0px ;left:30px; right:50px; width:90%; height:90%">
                     <!-- validation -->
                    <div class="row-fluid">
                         <!-- block -->
                        <div class="block" >
                          <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><?php echo $title?></div>
                                </div>
                              <div class="block-content collapse in">
                                  <div class="span12">
<?php
    $attributes = ['class' => 'form-horizontal', 'id' => 'form_sample_1'];
    echo form_open('admin/project/update', $attributes);
    echo form_hidden('id', $id);
    echo '<br>';
?>
    <fieldset>
   <?php 
   foreach ($project as $key => $value) {                                                             
     ?>   
    <div class="control-group">
                  <label class="control-label">项目名称<span class="required">*</span></label>
                  <div class="controls">
                  <input type="text" name="name" data-required="1" style="width:350px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $value->name;?>" />
            </div>
                </div>
    <div class="control-group">
                  <label class="control-label">项目别名</label>
                  <div class="controls">
                  <input type="text" name="alias" readonly data-required="1" style="width:350px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $value->alias_name;?>" />
            </div>
                </div>   
    <div class="control-group">
                  <label class="control-label">项目分组选择<span class="required">*</span></label>
                  <div class="controls">
                    <select class="span6 m-wrap" name="category">
                    <?php 
                      foreach ($platform_list as $key => $va) { 
                            if ($va->id == $value->platform_id) {
                        ?>    
                      <option selected value="<?php echo $va->id?>"><?php echo $va->name?></option>
                        <?php 
                          }
                          else if ($va->id != $value->platform_id) { 
                        ?>
                        <option value="<?php echo $va->id?>"><?php echo $va->name?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
            </div> 
    <div class="control-group">
                  <label class="control-label">负责人</label>
                  <div class="controls">
                  <select data-placeholder="<?php $user_id = $this->project_model->get_user_id_by_id($id);echo $user_name= $this->project_model->get_name_by_id($user_id)?>" name="user_id" style="width:350px;margin-right:10px;" class="chosen-select" tabindex="7">
                  <option value="<?php echo $user_id?>" selected ><?php echo $this->project_model->get_user_name_by_id($user_id)?></option>
                  <?php foreach($get_user_name as $user_name){
                  $user_id = $this->project_model->get_id_by_name($user_name->name);
                  ?>
                  <option value="<?php echo $user_id?>"><?php echo $user_name->name?></option>
                  <?php }?>
                  </select>
            </div>
    </div>     
    <div class="control-group">
                  <label class="control-label">生产开发环境域名</label>
                  <div class="controls">
                  <input type="text" name="dev_url" data-required="1" style="width:350px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $value->dev_url;?>" />
            </div>
                </div>   
    <div class="control-group">
                  <label class="control-label">测试环境域名</label>
                  <div class="controls">
                  <input type="text" name="test_url" data-required="1" style="width:350px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $value->test_url;?>" />
            </div>
                </div>   
    <div class="control-group">
                  <label class="control-label">预发布环境域名</label>
                  <div class="controls">
                  <input type="text" name="pre_url" data-required="1" style="width:350px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $value->pre_url;?>" />
            </div>
                </div> 
    <div class="control-group">
                  <label class="control-label">生产环境域名</label>
                  <div class="controls">
                  <input type="text" name="product_url" data-required="1" style="width:350px; margin-right:10px;" class="span2 m-wrap" value="<?php echo $value->product_url;?>" />
            </div>
                </div>    
    <div class="form-actions">
                  <button type="submit" class="btn btn-primary">确定</button>
                  <button type="button" class="btn" onclick="close_frame()">取消</button>
                </div>
    <?php                                                               
    } ?>
          </fieldset>
          </div>
      </div>
      </div>
                      <!-- /block -->
        </div>
                     <!-- /validation -->
                </div>

<!--/.fluid-container-->
  <script type="text/javascript" src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/scripts.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/styles.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>assets/DT_bootstrap.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url();?>bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" media="screen">
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