  <head>
        <title>运维平台后端管理</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/vendors/easypiechart/jquery.easy-pie-chart.css">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/vendors/easypiechart/jquery.easy-pie-chart_custom.css">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/DT_bootstrap.css">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="<?php echo base_url();?>admin-static/css/bootstrap-admin-theme-change-size.css">
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>admin-static/js/bootstrap.min.js"></script>
 </head>
<body class="bootstrap-admin-without-padding">
        <div class="container" style="position:absolute;top:30%;left:20%">
            <div class="row">
                <div class="col-lg-12">
<?php
    $attributes = ['class' => 'bootstrap-admin-login-form', 'id' => 'myform'];
    echo form_open('admin/login', $attributes);
    $redirect_hidden_value = $this->input->get('redirect', TRUE) ? $this->input->get('redirect',TRUE) : $this->input->post('redirect');
    echo form_hidden('redirect', $redirect_hidden_value);
?>
                        <h1>运维平台后端登录</h1>
                        <div class="input-group" style="width:250px;margin-bottom:30px">
                            <input type="text" class="form-control" name="username">
                            <span class="input-group-addon">@xkeshi.com</span>
                        </div>
                        <div class="input-group" style="width:250px">
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="remember_me">
                                记住密码
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary" type="submit" style="margin-left:10px;margin-right:10px">登录</button>
                        <button class="btn btn-lg btn-default" type="button" onclick="location.href='http://<?php echo $_SERVER['HTTP_HOST']?>'">返回前台</button>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function() {
                // Setting focus
                $('input[name="email"]').focus();
                // Setting width of the alert box
                var alert = $('.alert');
                var formWidth = $('.bootstrap-admin-login-form').innerWidth();
                var alertPadding = parseInt($('.alert').css('padding'));

                if (isNaN(alertPadding)) {
                    alertPadding = parseInt($(alert).css('padding-left'));
                }

                $('.alert').width(formWidth - 2 * alertPadding);
            });
        </script>