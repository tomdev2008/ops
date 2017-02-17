<?php $username = $this->session->userdata('username');?>				
<div class="span9" id="content">
    <div class="row-fluid">
        <!-- block -->
        <div class="block" style="position:absolute;margin-top:30px">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left">
                    企业邮箱密码重置
                </div>
            </div>
            <div class="alert alert-success" style="width:800px;height:500px;">
                <font size=5>
                    <div style="height:40px;margin-top:80px">
                      您的企业邮箱密码已重置~
                    </div>
                    <div style="height:40px">
                      初始密码：<strong>Abc110</strong><br>
                    </div>
                    —————————————————————————<br />
                    <div style="height:40px">
                      请注意：您的邮箱账号已开通<strong>微信动态认证</strong>~
                    </div>
                    <div style="height:40px">
                      可以自行在邮箱登录页面点击<strong>忘记密码</strong>按钮，进行密码重置~
                    </div>
                    <div style="height:40px">
                      邮箱登录地址：<a href="https://exmail.qq.com/login" target="_blank">https://exmail.qq.com/login</a>
                    </div>
                    <div style="height:40px">
                      Foxmail客户端下载地址：<a href="http://www.foxmail.com/win/download" target="_blank">http://www.foxmail.com/win/download</a>
                    </div>
                    <div style="text-align:center;margin-top: 20px">
                        <button class="btn btn-large btn-primary" type="button">
                            <a href="http://<?php echo $_SERVER['HTTP_HOST']?>"><font color="white">返回首页</font></a>
                        </button>
                    </div>
                </font>
            </div>
        </div>
    </div>		         
</div>
        <!-- /block -->
<!--/.fluid-container-->
<script src="<?php echo base_url();?>vendors/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/scripts.js"></script>
<script src="<?php echo base_url();?>layer/layer.js"></script>
<script src="<?php echo base_url();?>assets/DT_bootstrap.js"></script>
<script type="text/javascript">
        
</script>