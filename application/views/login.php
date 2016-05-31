<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>E-Pulsa | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url('assets/dist/css/font-awesome.min.css') ?>" rel="stylesheet"
          type="text/css"/>
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css"/>
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/plugins/iCheck/square/blue.css') ?>" rel="stylesheet" type="text/css"/>
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Epulsa</b>LTE</a>
    </div>
    <!-- /.login-logo -->

        <div class="alert alert-danger alert-dismissable" id="flash-message-div" style="display:none">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            <span id="flash-message-span"></span>
        </div>

    <div class="login-box-body">
        <p class="login-box-msg">Silakan sign in untuk memulai</p>

        <form action="" method="POST" id="login-form" novalidate="novalidate">
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <input type="text" class="form-control" id="id" name="id" placeholder="ID"/>
            </div>
            <div class="form-group has-feedback">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
            </div>
            <div class="row">
                <div class="col-xs-8">
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button id="btn-login" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/cookie/js.cookie.js') ?>" type="text/javascript"></script>


<script>
    $(function () {
        $('#id').focus();

        var form = $('#login-form');
        var flashmsg = $('#flash-message-div');

        // hapus kuki pada sesi sebelumnya
        if (undefined !== Cookies.get('credential'))
            Cookies.remove('credential', { path: 'localhost/epulsa-client' });

        $(form).submit(function(e) {
            e.preventDefault();
        }).validate({
            rules: {
                id: 'required',
                password: 'required'
            },
            messages: {
                id: 'Tolong isi dengan ID akun',
                password: 'Tolong isi dengan password akun',
            },

            submitHandler: function (form) {
                $.ajax({
                    url: "http://localhost:8080/api-auth2/",
                    type: "POST",
                    dataType: "json",
                    data: {
                        username: document.getElementById('id').value,
                        password: document.getElementById('password').value
                    },
                    success: function (data) {
                        Cookies.set('credential', data, { expires: 7, path: 'localhost/epulsa-client' });

                        var username = null;
                        var user_type = null;

                        if ("user" in data.user) {
                            username = data.user.user.username;
                            user_type = data.user.type;
                        } else {
                            username = data.user.username;
                            user_type = 1;
                        }

                        // similar behavior as an HTTP redirect
                        window.location.replace("validate?id=" + data.user.id + 
                            "&username=" + username + "&type=" + user_type +
                            "&token=" + data.token);
                    },
                    error: function (er) {
                        flashmsg.find('#flash-message-span').text(er.responseJSON.__all__[0]);
                        flashmsg.show();

                        window.setTimeout(hideFlashMessage, 4000);

                        function hideFlashMessage() {
                            $(flashmsg).fadeOut('normal');
                        }
                    }
                });
            }

        });
    });
</script>
</body>
</html>
</html>