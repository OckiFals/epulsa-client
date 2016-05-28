<?php $this->load->view('header', ['title' => 'Validasi Pembayaran']); ?>
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
                <li class="active"><i class="fa fa-check-square"></i> Validasi Pembayaran</li>
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
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Validasi Pembayaran</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- error message -->
                            <div class="alert alert-danger alert-dismissable" id="error-message" style="display: none">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-times"></i> Galat!</h4>
                                Kode Booking tidak Valid!
                            </div>
                            <!-- /error message -->
                            <!-- info message -->
                            <div class="alert alert-info alert-dismissable" id="info-message" style="display: none">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check-square-o"></i> Info</h4>
                                <span id="info-message-data"></span>
                            </div>
                            <!-- /info message -->
                            <div class="register-box-body">
                                <form action="" method="POST" enctype="multipart/form-data" id="validate-form"
                                      novalidate="novalidate">
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
                                        <input id="booking-code" name="booking_code" class="form-control"
                                               placeholder="Kode Booking" type="text" value="<?php echo $this->input->get('code') ?>">
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-10">

                                        </div>
                                        <!-- /.col -->
                                        <div class="col-xs-2">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat" id="btn-submit">
                                                Cari
                                            </button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                                <div id="payment-info" style="display: none;">
                                    <p class="lead">Data Pembayaran</p>

                                    <div class="table-responsive">
                                        <table class="table" id="payment-table">
                                            <tbody>
                                            <tr>
                                                <th style="width:50%">Pemilik Rekening:</th>
                                                <td>
                                                    <span id="account-holder">
                                                        <!-- insert by AJAX call soon -->
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Waktu Transfer:</th>
                                                <td>
                                                    <span id="time">
                                                        <!-- insert by AJAX call soon -->
                                                    </span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row no-print">
                                        <div class="col-xs-12">
                                            <a href="#" class="btn btn-success pull-right" id="btn-confirm"
                                                    data-toggle="modal" data-target="#confirm-validate">
                                                <i class="fa fa-check"></i> Validasi
                                            </a>
                                            <button class="btn btn-default pull-right" style="margin-right: 5px;"
                                                    id="btn-cancel">
                                                <i class="fa fa-times"></i> Batal
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="overlay" id="load-animate" style="display: none">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <div class="box-footer clearfix">

                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
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
                <!-- /.row -->
            </div>
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

    <script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>

    <script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js') ?>" type="text/javascript"></script>

    <div class="modal fade" id="confirm-validate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Konfirmasi</h4>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-danger btn-flat btn-ok">Ya</a>
                </div>
            </div>
        </div>
    </div>
<!-- ./wrapper -->

<script type="text/javascript">
    $(function () {
        /**
         * Kita ingin jika mengakses halaman ini langsung dengan mengklik salah satu info pembayaran 
         * di halaman utama agent, seharusnya data tampil tanpa perlu mengklik lagi tombol submit 
         */
        if ('' !== document.getElementById("booking-code").value) {
            // document.getElementById("validate-form").submit();
        }

        //The Calender
        $("#calendar").datepicker('setDate', 'today');

        $("#booking-code").focus();
        var form = $("#validate-form");
        var payment_info = $("#payment-info");
        var load_animate = $("#load-animate");
        var error_message = $('#error-message');
        var info_message = $('#info-message');
        var confirm_validate = $('#confirm-validate');

        form.validate({

            // Specify the validation rules
            rules: {
                booking_code: "required"
            },

            // Specify the validation error messages
            messages: {
                booking_code: "Tolong ketikkan kode booking"
            },

            submitHandler: function () {
                load_animate.show();

                $.ajax({
                    url: 'validation',
                    type: "POST",
                    data: {action: 'search', code: form.find("#booking-code").val()},
                    beforeSend: function (xhr) {
                        xhr.overrideMimeType("application/json; charset=x-user-defined");
                    }
                }).done(function (data) {
                    if (null !== data) {
                        form.find("#btn-submit").hide();
                        window.setTimeout(function () {
                            load_animate.hide();
                            payment_info.find("#account-holder").text(data.account_holder);
                            payment_info.find("#time").text(data.transfer_time);
                            payment_info.show();
                        }, 500);
                    } else {
                        load_animate.hide();
                        error_message.show();
                        window.setTimeout(function() {
                            error_message.fadeOut('normal');
                        }, 4000);
                    }
                });
            }
        });

        payment_info.find("#btn-cancel").click(function (e) {
            e.preventDefault();
            payment_info.hide();
            form.find("#booking-code").val('');
            form.find("#btn-submit").show();
        });

        confirm_validate.on('show.bs.modal', function (e) {
            var button = $(e.relatedTarget); // Button that triggered the modal
            var type = button.data('type-modal'); // Extract post id from data-name attribute
            var id = button.data('order-id'); // Extract post id from data-name attribute
            var title = button.data('order-name'); // Extract post id from data-name attribute

            var modal = $(this);
            modal.find('#order-id').text(id);
            modal.find('#type-modal').text(type);
            modal.find('#order-name').text(title);
        });

        confirm_validate.find(".btn-ok").click(function() {
            confirm_validate.modal('hide');
            $.ajax({
                url: 'validation',
                type: "POST",
                data: {action: 'validate', booking_code: form.find("#booking-code").val()},
                beforeSend: function () {
                    load_animate.show();
                }
            }).done(function (msg) {
                window.setTimeout(function() {
                    load_animate.hide();
                    info_message.find("#info-message-data").html(msg);
                    info_message.show();

                    payment_info.find("#btn-cancel").click();
                }, 500);
                window.setTimeout(function() {
                    info_message.fadeOut('normal');
                }, 4000);
            });
        });
    });
</script>
<?php $this->load->view('footer'); ?>