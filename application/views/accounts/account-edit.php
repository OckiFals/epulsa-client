<?php
/**
 * @var array $account
 */
?>
<?php $this->load->view('header', ['title' => 'Ubah Akun']) ?>
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

            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
                    <div id="contentHolder">
                        <div class="box box-info" id="contentData">
                            <div class="box-header with-border">
                                <h3 class="box-title">Ubah Akun</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="register-box-body">
                                    <p class="login-box-msg">Ubah Data Akun <?php echo $account['id']; ?></p>

                                    <form action="" method="POST" id="update-form" novalidate="novalidate">
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            <input id="name" name="name" class="form-control" placeholder="Nama Lengkap"
                                                   type="text" value="<?php echo $account['name']; ?>">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
                                            <input id="id" name="id" class="form-control" placeholder="ID"
                                                   type="text" value="<?php echo $account['id'] ?>">
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
                                            <select class="form-control" id="type" name="type"
                                                    value="<?php echo $account['type'] ?>">
                                                <option value="">Pilih Tipe Akun</option>
                                                <option
                                                    value="1" <?php echo (1 == $account['type']) ? 'selected' : '' ?>>
                                                    Tipe: Admin
                                                </option>
                                                <option
                                                    value="2" <?php echo (2 == $account['type']) ? 'selected' : '' ?>>
                                                    Tipe: Agen
                                                </option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-8">

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-4">
                                                <button type="submit" class="btn btn-primary btn-block btn-flat"
                                                        id="btn-update"
                                                        data-account-id="<?php echo $account['id']; ?>"
                                                        data-type-modal="User"
                                                        data-account-name="<?php echo $account['name']; ?>"
                                                        data-href=""
                                                        data-toggle="modal">
                                                    Ubah
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

    <div class="modal fade" id="confirm-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Konfirmasi Ubah</h4>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin untuk mengubah <span id="type-modal"> </span>
                    <strong id="order-name"> </strong> dengan #id=<span id="order-id"> </span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger btn-flat btn-ok" id="btn-confirm">Ubah</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js') ?>"
            type="text/javascript"></script>
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
            // The form
            var form = $("#update-form");
            // The modal
            var confirm_modal = $('#confirm-update');
            // button update
            var btn_update = $('#btn-update');

            //The Calender
            $("#calendar").datepicker('setDate', 'today');

            // focus to name 
            $('#name').focus();

            form.validate({

                // Specify the validation rules
                rules: {
                    name: "required",
                    id: "required",
                    type: {
                        required: true
                    }
                },

                // Specify the validation error messages
                messages: {
                    name: "Tolong ketikkan nama akun",
                    id: "Tolong ketikkan akun ID",
                    type: "Tolong pilih tipe akun"
                },

                submitHandler: function () {
                    confirm_modal.modal('show');
                }
            });

            confirm_modal.on('show.bs.modal', function () {
                var type = btn_update.data('type-modal');
                var id = btn_update.data('account-id');
                var title = btn_update.data('account-name');

                var modal = $(this);
                modal.find('#order-id').text(id);
                modal.find('#type-modal').text(type);
                modal.find('#order-name').text(title);
            });

            confirm_modal.find('.btn-ok').click(function (e) {
                // TODO kenapa harus native?
                document.getElementById("update-form").submit();
            });

        });
    </script>
<?php $this->load->view('footer') ?>