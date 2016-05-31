<?php

?>
<?php $this->load->view('header', ['title' => 'Ubah Akun Admin']) ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
                <li><a href="<?php echo base_url('account/admin') ?>"><i class="fa fa-users"></i> Semua Akun Admin</a></li>
                <li class="active"><i class="fa fa-edit"></i> Ubah Akun</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Content -->
            <div id="content" class="colM">
                <!--                <h1>Dashboard</h1>-->

                <br class="clear"/>
            </div>
            <!-- END Content -->

            <!-- flash message error -->
            <div class="alert alert-danger alert-dismissable" id="flash-message-error" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <div id="errors-list">
                    <span id="flash-message-span"></span>
                </div>
            </div>
            <!-- /flash message error -->

             <!-- flash message success -->
            <div class="alert alert-info alert-dismissable" id="flash-message-success" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Info!</h4>
                <div id="errors-list">
                    Akun dengan username <strong><span id="success-message"></span></strong> berhasil dirubah.
                </div>
            </div>
            <!-- /flash message success -->

            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
                    <div id="contentHolder">
                        <div class="box box-info" id="contentData">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ubah data Akun Admin</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="register-box-body">
                                    <p class="login-box-msg">Ubah data Akun Admin Baru</p>

                                    <form action="" method="POST" id="register-form" novalidate="novalidate">
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            <input id="username" name="username" class="form-control" placeholder="Username" type="text">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                            <input id="password" class="form-control" placeholder="Password"
                                                   name="password" type="password">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-repeat form-control-feedback"></span>
                                            <input id="password2" class="form-control"
                                                   placeholder="Tulis Ulang Password" name="password2" type="password">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-repeat form-control-feedback"></span>
                                            <input id="email" class="form-control"
                                                   placeholder="Email" name="email" type="text">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-repeat form-control-feedback"></span>
                                            <input id="first_name" class="form-control"
                                                   placeholder="Nama Depan" name="first_name">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-repeat form-control-feedback"></span>
                                            <input id="last_name" class="form-control"
                                                   placeholder="Nama Belakang" name="last_name">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-8">

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-4">
                                                <button class="btn btn-primary btn-block btn-flat">Ubah
                                                </button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </form>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">

                            </div>
                            <!-- /.box-footer -->
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-4">
                    <!-- Calendar -->
                    <div class="box box-solid bg-light-blue-gradient">
                        <div class="box-header">
                            <i class="fa fa-calendar"></i>

                            <h3 class="box-title">Calendar</h3>
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button class="btn btn-default btn-sm" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                                <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- / Calendar .box -->
                </div>
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- jQuery 2.1.3 -->

    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js') ?>" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->

    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <!-- AdminLTE App -->

    <script src="<?php echo base_url('assets/dist/js/app.min.js') ?>" type="text/javascript"></script>

    <!-- datepicker -->
    <script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js') ?>"
            type="text/javascript"></script>
    <!-- JQuery Validate -->
    <script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js') ?>"
            type="text/javascript"></script>

    <script type="application/javascript">
        $(document).ready(function () {
            //The Calender
            $("#calendar").datepicker('setDate', 'today');
            var form = $("#register-form");
            var flash_message = $('#flash-message-error');
            var kuki = Cookies.getJSON('credential');

            initial_form_data = {};
            
            renderDefaultValue(kuki);

            renderFlashInfo();

            console.log(initial_form_data)


            form.submit(function(e) {
                e.preventDefault();
            }).validate({
                // Specify the validation rules
                rules: {
                    username: "required",
                    email: "required",
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true
                    }
                },

                // Specify the validation error messages
                messages: {
                    username: "Tolong ketikkan username",
                    email: "Tolong ketikkan email",
                    first_name: {
                        required: "Tolong ketikan nama depan"
                    },
                    last_name: {
                        required: "Tolong ketikan nama belakang"
                    }
                },

                submitHandler: function (form) {
                    $.ajax({
                        url: "http://localhost:8080/user/admin/<?php echo $account_id ?>/",
                        type: "PUT",
                        dataType: "json",
                        headers: {
                            Authorization: "JWT " + kuki.token 
                        },
                        data: {
                            username: document.getElementById('username').value,
                            password: document.getElementById('password').value,
                            email: document.getElementById('email').value,
                            first_name: document.getElementById('first_name').value,
                            last_name: document.getElementById('last_name').value
                        },
                        success: function (data) {
                            var flash_message_success = $('#flash-message-success')

                            flash_message_success.find('#success-message').text(data.username)
                            flash_message_success.show()
                            $("html, body").animate({ scrollTop: 0 }, "slow");

                            window.setTimeout(function () {
                                flash_message_success.fadeOut('normal');
                            }, 4000);
                        },
                        error: function (er) {
                            console.log(er)
                            $.each(er.responseJSON, function (index, obj) {
                                $.each(obj, function (jindex, jobj) {
                                    flash_message.find('#errors-list').append(
                                        "<strong>" + index + "</strong>" + " -> " + jobj + "<br>"
                                    );
                                });
                            });

                            flash_message.show();
                            $("html, body").animate({ scrollTop: 0 }, "slow");

                            window.setTimeout(hideFlashMessage, 8000);

                            function hideFlashMessage() {
                                flash_message.fadeOut('normal');
                                flash_message.find('#errors-list').empty();
                            }
                        }
                    });
                }
            });

            function renderDefaultValue(kuki) {
                $.ajax({
                    url: "http://localhost:8080/user/admin/<?php echo $account_id ?>/",
                    dataType: "json",
                    headers: {
                        Authorization: "JWT " + kuki.token 
                    },
                    success: function (data) {
                        let initial_form_data = data;
                        $.each(data, function (index, obj) {
                            form.find('#' + index).val(obj);
                        });
                    },
                    error: function (er){
                        console.log(er)
                    }
                });
            }

            function renderFlashInfo() {
                var eventInfo = '<?php echo $this->session->flashdata('flash-message') ?>' || null; 
                if (eventInfo) {
                    flash_message.find('#flash-message-data').html(eventInfo);
                    flash_message.fadeIn('normal');
                    window.setTimeout(hideFlashMessage, 4000);
                }
            }

            function hideFlashMessage() {
                flash_message.fadeOut('normal');
            }
        });
    </script>
<?php $this->load->view('footer') ?>