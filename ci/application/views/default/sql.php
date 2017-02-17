<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title>数据库查询</title>
	<!-- DT CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>datatables/css/jquery.dataTables.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>admin-static/vendors/bootstrap-switch/build/css/bootstrap3/bootstrap-switch.css"> -->
    <link href="<?php echo base_url();?>bo-sw/dist/css/bootstrap2/bootstrap-switch.css" rel="stylesheet">
</head>
<body>
	<div class="span9" id="content">
        <div class="row-fluid">
        	<!-- block 选择数据库和数据表-->
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">数据库查询</div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">
                    	<div style="margin:20px">
							<?php 
								echo anchor('sql?env=pre', '预发布环境', 'class="btn" style="margin-right:10px" title="预发布环境"');
								// echo anchor('sql?env=product', '生产环境', 'class="btn" title="生产环境"');
							?>
						</div>
                        <!-- Form表单信息 -->
                    	<?php 
                    		$attributes = [
                    			'class' => 'form-horizontal',
                    			'method' => 'get',
                    			'id' => 'sql_select',
                    			'onsubmit' => 'return bottoncheck()'
                    		];// 表头信息
                    		echo form_open('sql',$attributes);
                    		$database = $this->input->get("database");
                			$table = $this->input->get("table");
                			$field = $this->input->get("field");
                            $symbol = $this->input->get("symbol");
                			$value = $this->input->get("value");
                            $num = $this->input->get("selectnum");
                            $data = [];
                            $data = $this->input->get();// 获得所有get数据
                			if ($database != NULL && $table != NULL && $field != NULL && $symbol != NULL && $value != NULL && $num == 0) {
                				$res = $this->sql_model->SelectResult($database,$table,$field,$symbol,$value);
                                $count = $this->sql_model->SelectResultCount($database,$table,$field,$symbol,$value);
								$fields = $this->sql_model->GetFieldsByTable($database,$table);
                			}
                            else if ($num != 0) {
                                $fields = $this->sql_model->GetFieldsByTable($database,$table);
                                $res = $this->sql_model->SelectResultBy($data);
                                $count = $this->sql_model->SelectResultCountBy($data);
                            }
                    	 ?>
                            <!-- 查询数据库和数据表 -->
							<div class="control-group">
								<!-- <label class="control-label" for="selectError">选择下拉框进行查询<span class="required">*</span></label> -->
								<select class="database-select" id="database" name="database" style="width:180px;">
									<option value="" selected>==请选择具体数据库==</option>
									<?php 
										foreach ($pre_database as $key => $value) {
											$selected = $key == $database ? 'selected' : '';
									?>
										<option value="<?php echo $key;?>" <?php echo $selected;?> ><?php echo $key;?></option>
									<?php } ?>
								</select>
								<select class="table-select" id="table" name="table" style="width:180px;">
									<option value="" selected>==请选择具体数据表名==</option>
								</select>
							</div>
                            <!-- 查询字段以及相应的值 -->
                            <div id = "selectsql">
                                <div class="control-group">
                                    <!-- <label class="control-label" for="selectError">选择字段并输入查询<span class="required">*</span></label> -->
                                    <div class="input-prepend">
                                        <select class="field-select" id="field" name="field">
                                            <option value="" selected>==请选择具体字段==</option>
                                        </select>
                                        <select class="symbol-select" id="symbol" name="symbol" style="width:100px;margin-left:5px">
                                            <option value="1" selected> =（等于） </option>
                                            <!-- <option value="2"> <（小于） </option>
                                            <option value="3"> >（大于） </option>
                                            <option value="4"> >=（大于等于） </option>
                                            <option value="5"> <=（小于等于） </option> -->
                                        </select>
                                        <input type="text" id="value" name="value" style="width:150px;margin-left:5px"/>
                                    </div>
                                    <button type="button" class="btn btn-success" id="addselect">
                                        条件<i class="icon-plus icon-white"></i></button>
                                    
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="return form_check()">
                                        查询<i class="icon-search icon-white"></i></button>
                            <button type="button" class="btn btn-default" onclick="location='/sql'">
                                        重置查询<i class="icon-refresh"></i></button>
                        </form>
					</div>
                </div>
            </div>
           	<!-- block 查询结果-->
           	 <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left" id="AddSelect">查询结果</div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">
                        <div class="alert" style="display: none">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>提醒：</strong>总共查询到<strong><?php print_r($count);?></strong>条数据，最多只能查询前100条数据内容！！
                        </div>
                    	<!-- DataTable -->
                        <table class="table table-bordered" id="result_table">
							<thead>
								<tr>
									<?php 
										if (@$fields != NULL) {
											foreach ($fields as $key => $value) {
									?>
										<th><?php echo $value;?></th>
									<?php
											}
										}
									 ?>
								</tr>
							</thead>
							<tbody>	
								<?php
									if (@$res != NULL) {
										 foreach ($res as $key => $res_value) {
								?>
										<tr>
										<?php
										 	foreach ($res_value as $key => $value) {
										?>
												<td><?php echo $value;?></td>
										<?php
											}
										?>
										</tr>
								<?php
										}
									}
								?>
							</tbody>
                         </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script type="text/javascript" src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/scripts.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>chosen_v1.6.2/chosen.jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>layer/layer.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>bo-sw/dist/js/bootstrap-switch.js"></script>
    <script type="text/javascript">
    	var database_val = $("#database")
    	var table_val = $("#table")
    	var field_val = $("#field")
    	var value_val = $("#value")
    	// Jqurey 得到url参数
    	function getUrlParam(name) {
           	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
           	var r = window.location.search.substr(1).match(reg);  //匹配目标参数
           	if (r != null) return unescape(r[2]); return null; //返回参数值
       	}
       	var url_database = getUrlParam('database')
       	var url_table = getUrlParam('table')
       	var url_field = getUrlParam('field')
        var url_symbol = getUrlParam('symbol')
       	var url_value = getUrlParam('value')
        // 联动方法(添加的下拉框)
        function database_fields(a) {
            var field_id = "#field" + a
            $.ajax({
                url:"sql/ajax_fields?database=" + $("#database").val() + "&table=" + $("#table").val(),
                dataType:"json",
                success:function(fields) {
                    fields.forEach(function(field) {
                        $(field_id).append('<option value="' + field + '">' + field + '</option>');
                    })
                    $(field_id).trigger("chosen:updated");
                }
            });
        }
        // 创建添加搜索条件的操作
        function addselect(a) {
            var div_header = "<div class='control-group' id='AddSelectd"+ a +"'><div class='input-prepend'>"
            var Switch = "<input type='checkbox' name='switch" + a + "' id='switch' value='and' checked/>"
            var FieldSelect = "<select class='field-select' id='field" + a + "' name='field" + a + "' style='margin-left:25px'><option value='' selected>==请选择具体字段==</option></select>"
            var SymbolSelect = "<select class='symbol-select' id='symbol" + a + "' name='symbol" + a + "' style='width:100px;margin-left:5px'><option value='1' selected> =（等于） </option></select>"
            var VauleInput = "<input type='text' id='value" + a + "' name='value" + a + "' style='width:150px;margin-left:5px;margin-right:5px'/>"
            var Remove = "<button class='btn btn-danger btn-mini' type='button' onclick='RemoveDiv("+ a +")'>删除</button>"
            $('#selectsql').append(div_header + Switch + FieldSelect + SymbolSelect + VauleInput + Remove + "</div></div>");
        }
    	// 数据库联动到表
    	$('.database-select').on('change',function(){
    		$.ajax({
    			url:"sql/ajax_table?database=" + $(this).val(),
    			dataType:"json",
    			beforeSend:function() {
    				$('.table-select').empty();
    				$('.field-select').empty();
    			},
    			success:function(tables) {
    				$('.field-select').append('<option value="">==请选择要查询的字段==</option>');
    				$('.table-select').append('<option value="">==请选择要查询的表==</option>');
    				tables.forEach(function(table) {
    					var selected = table == url_table ? 'selected' : '';
    					$('.table-select').append('<option value="' + table + '" "'+ selected +'">' + table + '</option>');
    				})
    				$('.table-select').trigger("chosen:updated");
    			}
    		});
    	})
    	// 数据表联动到字段
    	$('.table-select').on('change',function(){
    		$.ajax({
    			url:"sql/ajax_fields?database=" + $("#database").val() + "&table=" + $(this).val(),
    			dataType:"json",
    			beforeSend:function(){
    				$('.field-select').empty();
    			},
    			success:function(fields) {
    				$('.field-select').append('<option value="">==请选择要查询的字段==</option>');
    				fields.forEach(function(field) {
    					$('.field-select').append('<option value="' + field + '">' + field + '</option>');
    				})
    				$('.field-select').trigger("chosen:updated");
    			}
    		});
    	})
        // 追加查询条件的输入框
        var a = 0
        var hidden_selectnum = "<input type='hidden' id='selectnum' name='selectnum' value='"+ a +"' />"
        $("#sql_select").append(hidden_selectnum);// 加载隐藏元素
        $("#addselect").click(function() {
            a += 1;
            $("#selectnum").val(a);// 重定义条件数量的值
            addselect(a);
            database_fields(a);
            $("[id='switch']").bootstrapSwitch();// switch组件初始化
        })
        // 清除查询条件的输入框
        function RemoveDiv(id) {
            a = a-1;
            var id = "#AddSelectd" + id
            $(id).remove(); // 清除操作
            $("#selectnum").val(a);// 重定义条件数量的值
        }
        // 默认加载选择器
        $(function() {
            if(url_database != null && url_table != null && url_field != null && url_symbol != null && url_value != null){
            $.ajax({
                url:"sql/ajax_table?database=" + url_database,
                dataType:"json",
                beforeSend:function() {
                    $('.table-select').empty();
                    $('.field-select').empty();
                },
                success:function(tables) {
                    $('.table-select').append('<option value="">==请选择要查询的表==</option>');
                    tables.forEach(function(table) {
                        var selected = table == url_table ? 'selected' : '';
                        $('.table-select').append('<option value="' + table + '" '+ selected +'>' + table + '</option>');
                    })
                    $('.table-select').trigger("chosen:updated");
                }
            });
            $.ajax({
                url:"sql/ajax_fields?database=" + url_database + "&table=" + url_table,
                dataType:"json",
                beforeSend:function(){
                    $('.field-select').empty();
                },
                success:function(fields) {
                    $('.field-select').append('<option value="">==请选择要查询的字段==</option>');
                    fields.forEach(function(field) {
                        var selected = field == url_field ? 'selected' : '';
                        $('.field-select').append('<option value="' + field + '" ' + selected + '>' + field + '</option>');
                    })
                    $('.field-select').trigger("chosen:updated");
                }
            });
            $("#symbol").val(url_symbol);
            $("#value").val(url_value);
            $('.alert').show();
        }
        });
        // bootstrap+datatable水平滚动条
        $(document).ready(function(){
            $('#result_table').DataTable({
                "bLengthChange": true,
                "iDisplayLength" :25,
                "aLengthMenu": [[25, 50 ],[ "25", "50"]],
                "sScrollX": "100%",
                "sScrollXInner": "150%",
                "bScrollCollapse": true
            });
        });
        // 表单验证
        function form_check() {
            var r = 1;
            if (database_val.val() == "") {
                r = 0;
                layer.msg("请选择具体数据库",{time:2000,icon:1});
            }
            else if (table_val.val() == "") {
                r = 0;
                layer.msg("请选择数据表",{time:2000,icon:1});
            }
            else if(field_val.val() == ""){
                r = 0;
                layer.msg("请选择要查询的字段",{time:2000,icon:1});
            }
            else if(value_val.val() == ""){
                r = 0;
                value_val.focus();
                layer.msg("请填写字段的值",{time:2000,icon:1});
            }
            for (var i = 1; i <= a; i++) {
                var fields = "#field" + i
                var values = "#value" + i
                if ($(fields).val() == "") {
                    r = 0;
                    layer.msg("请选择要查询的字段",{time:2000,icon:1});
                }
                else if($(values).val() == ""){
                    r = 0;
                    $(values).focus();
                    layer.msg("请填写字段的值",{time:2000,icon:1});
                }
            }
            if (r == 1) {
                $("#sql_select")[0].submit();
            }
        }
    	// 控制提交
	    function buttoncheck(){
	        $("#btn").on('click',function(){
	          	$("#btn").attr("disabled", true);
	            setTimeout(function(){
	                $("#btn").attr("disabled", false);
	            },3000);
	            return true;
	        });
	    }
    </script>
</body>
</html>