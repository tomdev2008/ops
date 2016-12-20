<div class="span9" id="content">
    <div class="row-fluid">
        <div class="block">
        	<div class="navbar navbar-inner block-header">
                <div class="muted pull-left"><strong>图书类别选择</strong></div>
            </div>
            <div class="block-content collapse in">
                 <div class="span12">
                 	<?php
                    $user_id = $this->session->userdata('u_id');
                    $admin = 168;
                 	$level = $this->input->get('level');
                 	echo $level == "" ? anchor('book', "所有类别", 'class="btn btn-default active" style="margin-left:10px" title=所有类别') : anchor('book', "所有类别", 'class="btn btn-default" style="margin-left:10px" title=所有类别');
                 	foreach ($book_level as $value) {
                 		$level_name = str_replace('组','类',$value->level_name);
                 		echo $value->id == $level ? anchor('book?level='.$value->id, $level_name, 'class="btn btn-default active" style="margin-left:10px" title='.$level_name) : anchor('book?level='.$value->id, $level_name, 'class="btn btn-default" style="margin-left:10px" title='.$level_name);
                 	}
                 	?>
                 </div>
            </div>
        </div>
        <!-- block -->
        <div class="block">
        	<div class="navbar navbar-inner block-header" style="margin-bottom: 20px">
                <div class="muted pull-left"><span class="badge badge-info"></span>
					<strong>图书借阅情况 : 目前共有书籍<?php echo $book_sum;?>本，已借出<?php echo $book_lend_sum;?>本</strong>
                </div>
            </div>
             <div class="table-toolbar">
	            <div class="bootstrap-admin-panel-content" style="margin-left: 10px">
                    <?php if ($user_id == $admin) {?>
	             	    <a class="btn btn-success" href="javascript:;" onclick="books_add('book/add')">书籍添加<i class="icon-plus icon-white"></i></a>
	                    <a class="btn btn-default" href="javascript:;" onclick="books_borrow_logs('book/books_borrow_logs')">借阅记录<i class="icon-search"></i></a>
                    <?php }?>
		       </div>
            </div>
            <hr style="margin:10px auto; width=90% ;color=#987cb9; size=1">
            <!-- table -->
        	<table class="table table-striped table-bordered dataTable" id="example" style="width:90%;margin:20px auto;">
        		<thead>
					<tr>
						<th style="width: 10%;text-align: center;">#</th>
						<th style="width: 15%;text-align: center;">编号</th>
						<th style="width: 40%;text-align: center;">书名</th>
						<th style="width: 10%;text-align: center;">类别</th>
						<th style="width: 25%;text-align: center;">借阅情况</th>
					</tr>
        		</thead>
        		<tbody>
					<?php 
                        $info1 = $this->book_model->get_bookinfo_desc();
                        $info2 = $this->book_model->get_bookinfo_asc();
                        $info3 = $this->book_model->get_bookinfo_by_level_desc($level);
                        $info4 = $this->book_model->get_bookinfo_by_level_asc($level);
						if ($level == "") {
                            $book_info = $user_id == $admin ? $info1 : $info2;
                        }
                        else{
                            $book_info = $user_id == $admin ? $info3 : $info4;
                        }
						$n = 0;
						foreach ($book_info as $book) {
							$book_level = str_replace('组','类',$this->book_model->get_booklevel_by_id($book->level));
                            $book_log = $this->book_model->search_log_by_id($book->id);
                            @$lendtime = date("Y-m-d H:i",strtotime($book_log[0]->lendtime));
					?>
						<tr>
							<td style="text-align:center"><?php echo $n = $n+1;?></td>
							<td style="text-align:center"><?php echo "A".$book->id?></td>
							<td>
                                <a href="javascript:;" onclick="book_remark('<?php echo $book->remark == "" ? "暂无简介" : $book->remark;?>')">
                                    <?php echo "《".$book->name."》";?>
                                </a>
								<?php if ($book->borrow == 0) {
                                    echo $user_id == $admin ? '<a href="javascript:;" onclick="lend_book('.$book->id.')" class="btn btn-warning btn-mini" >借出</a>' :
                                    '<a href="javascript:;" onclick="order_book('.$book->id.')" class="btn btn-warning btn-mini" >预定借阅</a>';
                                     }else if ($book->borrow == 1 && $user_id == $admin){ ?>
										<a href="javascript:;" onclick="return_book('<?php echo $book->id;?>')" class="btn btn-success btn-mini">归还</a>
								<?php }else if ($book->borrow == 2 && $user_id == $admin){?>
                                    <a href="javascript:;" onclick="order_book_check('<?php echo $book->id;?>','<?php echo $this->book_model->search_orderlog_by_id($book->id)[0]->user?>')" class="btn btn-danger btn-mini">预定审核</a>
                                    <?php } ?>
							</td>
							<td style="text-align:center"><span class="label label-info"><?php echo $book_level?></span></td>
							<td style="text-align:center">
                                <?php if ($book->borrow == 0){?>
                                    <span class="label label-success">在库</span>
                                <?php }else if($book->borrow == 2){?>
                                    <span class="label label-warning">已预订</span>
                                <?php }else{echo $book_log[0]->user."于".$lendtime;} ?>
							</td>
						</tr>
					<?php } ?>
        		</tbody>
        	</table>
        </div>
    </div>
</div>

	<!--/.fluid-container-->
    <script src="<?php echo base_url();?>vendors/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>vendors/easypiechart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo base_url();?>assets/scripts.js"></script>
    <script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
    <script src="<?php echo base_url();?>vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo base_url();?>layer/layer.js"></script>
    <script type="text/javascript">
    // 归还操作
    function return_book(info){
        layer.confirm('确定已还吗？', {
            btn:['确定','取消']
        },function(){
        $.ajax({
            type:"GET",
            url:"/book/book_return?id="+info,
            success:function(data){
                layer.msg(data+'归还成功', {time: 1000,icon: 1},function(){
                    parent.window.location.reload();
                });
            },
            error: function () {
                layer.msg('归还失败', {time: 1000,icon: 1});
            }
       	  })
        });
    }
    // 预定操作
    function order_book(info){
        layer.confirm('确定预定吗？', {
            btn:['确定','取消']
        },function(){
        $.ajax({
            type:"GET",
            url:"/book/book_order?id="+info,
            success:function(data){
                layer.msg(data+'预定成功', {time: 1000,icon: 1},function(){
                    parent.window.location.reload();
                });
            },
            error: function () {
                layer.msg('预定失败', {time: 1000,icon: 1});
            }
          })
        });
    }
    // 预定审核
    function order_book_check(info,name){
        layer.confirm('确定由 ' + name + ' 借出吗？', {
            btn:['确定','取消']
        },function(){
        $.ajax({
            type:"GET",
            url:"/book/book_order_lend?id="+info,
            success:function(data){
                layer.msg(data+'已借出', {time: 1000,icon: 1},function(){
                    parent.window.location.reload();
                });
            },
            error: function () {
                layer.msg('借出失败', {time: 1000,icon: 1});
            }
          })
        });
    }
	// 借阅操作
    function lend_book(id){
        layer.prompt({
            title :'请输入借阅人姓名',
        },function(val){
            $.ajax({
                type:"GET",
                url:"/book/book_lend?id=" + id + "&name=" + val,
                success:function(data){
                    layer.msg(val + "成功借阅" + data , {time: 3000,icon: 1}, function(){
                        parent.window.location.reload();
                	});
            	},
            	error: function () {
                	layer.msg('程序内部错误', {time: 3000,icon: 1});
                }
            })
        });
    }
    function books_add(url){
        layer.open({
            title :'书籍添加',
			type: 2,
			skin: 'layui-layer-demo', //样式类名
			area: ['35%', '50%'],
			content: url,
        });
    }
    // 查询书籍简介
    function book_remark(val){
        layer.open({
          type: 0,
          skin: 'layui-layer-demo', //样式类名
          closeBtn: 0, //不显示关闭按钮
          anim: 2,
          shadeClose: true, //开启遮罩关闭
          content: val
        });
    }
    
    // $('#remark').on('click',function(val){

    // })
    function book_remark(remark){
        layer.open({
            title :'书籍借阅情况',
			type: 1,
			skin: 'layui-layer-demo', //样式类名
			area: ['360px', '200px'],
			content: remark,
        });
    }
    // 查询所有书籍借阅情况
    function books_borrow_logs(url){
        layer.open({
            title :'书籍借阅记录',
			type: 2,
			skin: 'layui-layer-demo', //样式类名
			area: ['35%', '50%'],
			content: url,
        });
    }
    </script>