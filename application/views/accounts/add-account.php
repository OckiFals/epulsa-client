<?php
/**
 * @var array $form_data
 */

(isset($form_data)) ? $form_data = $form_data : $form_data = [];
?>
<?php $this->load->view('header', ['title' => 'Tambah Akun']) ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
                <li><a href="<?php echo base_url('account') ?>"><i class="fa fa-users"></i> Semua Akun</a></li>
                <li class="active"><i class="fa fa-edit"></i> Tambah Akun</li>
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

            <!-- flash message -->
            <div class="alert alert-danger alert-dismissable" id="flash-message" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <span id="flash-message-data"></span>
            </div>
            <!-- /flash message -->

            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
                    <div id="contentHolder">
                        <div class="box box-info" id="contentData">
                            <div class="box-header with-border">
                                <h3 class="box-title">Tambah Akun</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="register-box-body">
                                    <p class="login-box-msg">Daftarkan Akun Baru</p>

                                    <form action="" method="POST" enctype="multipart/form-data" id="register-form"
                                          novalidate="novalidate">
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            <input id="name" name="name" class="form-control" placeholder="Nama Lengkap"
                                                   type="text" <?php if (!empty($form_data)) echo "value='{$form_data['name']}'" ?>>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                                            <input id="id" name="id" class="form-control" placeholder="ID" type="text">
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
                                            <select class="form-control" id="type" name="type">
                                                <option value="">Pilih Tipe Akun</option>
                                                <option value="1" <?php if (!empty($form_data) && ('1' === $form_data['type'])) echo "selected" ?>>
                                                    Tipe: Admin
                                                </option>
                                                <option value="2" <?php if (!empty($form_data) && ('1' === $form_data['type'])) echo "selected" ?>>
                                                    Tipe: Agen
                                                </option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-8">

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-4">
                                                <button type="submit" class="btn btn-primary btn-block btn-flat">Tambah
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
            var flash_message = $('#flash-message');
            renderFlashInfo();

            $("#register-form").validate({

                // Specify the validation rules
                rules: {
                    name: "required",
                    id: "required",
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password2: {
                        required: true,
                        minlength: 5,
                        equalTo: '#password'
                    },
                    type: {
                        required: true
                    }
                },

                // Specify the validation error messages
                messages: {
                    name: "Tolong ketikkan nama akun",
                    id: "Tolong ketikkan akun ID",
                    password: {
                        required: "Tolong ketikkan password",
                        minlength: "Password setidaknya berisi 5 karakter"
                    },
                    password2: {
                        required: "Tolong ketikan password",
                        minlength: "Password setidaknya berisi 5 karakter",
                        equalTo: "Tidak cocok"
                    },
                    type: "Tolong pilih tipe akun"
                },

                submitHandler: function (form) {
                    form.submit();
                }
            });

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