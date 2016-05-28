<?php $this->load->view('header', ['title' => 'Cetak Tiket']); ?>
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
                <li class="active"><i class="fa fa-print"></i> Print Tiket</li>
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
                    <div class="box box-info hide-print">
                        <div class="box-header with-border">
                            <h3 class="box-title">Print Tiket</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <!-- error message -->
                            <div class="alert alert-danger alert-dismissable" id="error-message" style="display: none">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-times"></i> Galat!</h4>
                                Kode Booking tidak valid atau belum dilakukan pembayaran!
                            </div>
                            <!-- /error message -->
                            <!-- info message -->
                            <div class="alert alert-info alert-dismissable" id="info-message" style="display: none">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check-square-o"></i> Info</h4>
                                Data ditemukan. Print dengan menekan tombol 'Cetak'!
                            </div>
                            <div class="register-box-body">
                                <form action="" method="POST" enctype="multipart/form-data" id="validate-form"
                                      novalidate="novalidate">
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-qrcode form-control-feedback"></span>
                                        <input id="booking-code" name="booking_code" class="form-control"
                                               placeholder="Kode Booking" type="text">
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-10">

                                        </div>
                                        <!-- /.col -->
                                        <div class="col-xs-2">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat"
                                                    id="btn-submit">
                                                <i class="fa fa-search"></i> Cari
                                            </button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>
                                <div id="payment-info" style="display: none;">
                                    <p class="lead">Data Pemesanan</p>

                                    <div class="table-responsive">
                                        <table class="table" id="payment-table">
                                            <tbody>
                                            <tr>
                                                <th style="width:50%">Nama Pemesan:</th>
                                                <td>
                                                    <span id="customer_name">
                                                        <!-- insert by AJAX call soon -->
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Bus:</th>
                                                <td>
                                                    <span id="bus_name">
                                                        <!-- insert by AJAX call soon -->
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tujuan:</th>
                                                <td>
                                                    <span id="destination">
                                                        <!-- insert by AJAX call soon -->
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Berangkat:</th>
                                                <td>
                                                    <span id="time">
                                                        <!-- insert by AJAX call soon -->
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Jumlah Tiket:</th>
                                                <td>
                                                    <span id="ticket_count">
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
                                               data-toggle="modal" data-target="#confirm-to-print">
                                                <i class="fa fa-print"></i> Cetak
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
                    <div id="section-to-print" style="display: none; visibility: hidden"></div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-4 hide-print">
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

    <script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js') ?>"
            type="text/javascript"></script>

    <script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js') ?>"
            type="text/javascript"></script>

    <script src="<?php echo base_url('assets/plugins/barcode/jquery-barcode.min.js') ?>"
            type="text/javascript"></script>

    <div class="modal fade" id="confirm-to-print" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
            var form = $("#validate-form");
            //The Calender
            $("#calendar").datepicker('setDate', 'today');

            $("#booking-code").focus();
            // tombol submit
            var btn_submit = $("#btn-submit");
            // tabel data pemesanan
            var payment_info = $("#payment-info");
            // flash message error
            var error_message = $('#error-message');
            // flash message info
            var info_message = $('#info-message');
            var load_animate = $("#load-animate");
            var confirm_to_print = $('#confirm-to-print');
            var section_to_print = $("#section-to-print");

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
                        url: '/toba/print-ticket',
                        data: {booking_code: form.find("#booking-code").val()},
                        beforeSend: function (xhr) {
                            xhr.overrideMimeType("application/json; charset=x-user-defined");
                        }
                    }).done(function (data) {
                        // parsing data pemesanan
                        payment_info.find("#customer_name").text(data[0].customer_name);
                        payment_info.find("#bus_name").text(data[0].bus_name);
                        payment_info.find("#destination").text(data[0].region);
                        payment_info.find("#time").text(data[0].time);
                        payment_info.find("#ticket_count").text(data.length);
                        // tampilkan flash message info
                        info_message.show();
                        // hilangkan flash message info dengan delay 4 s
                        window.setTimeout(function () {
                            info_message.fadeOut('normal');
                        }, 4000);
                        // sembunyikan tombol submit
                        btn_submit.hide();
                        // tampilkan data pemesanan
                        payment_info.show();

                        print_ticket(data);
                    }).fail(function () {
                        form.find("#booking-code").focus();
                        error_message.show();
                        window.setTimeout(function () {
                            error_message.fadeOut('normal');
                        }, 4000);
                    }).always(function () {
                        window.setTimeout(function () {
                            load_animate.hide();
                        }, 500);
                    });

                }
            });

            payment_info.find("#btn-cancel").click(function (e) {
                e.preventDefault();
                payment_info.hide();
                section_to_print.empty();
                btn_submit.show();
                form.find("#booking-code").focus();
            });

            confirm_to_print.on('show.bs.modal', function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var type = button.data('type-modal'); // Extract post id from data-name attribute
                var id = button.data('order-id'); // Extract post id from data-name attribute
                var title = button.data('order-name'); // Extract post id from data-name attribute

                var modal = $(this);
                modal.find('#order-id').text(id);
                modal.find('#type-modal').text(type);
                modal.find('#order-name').text(title);

                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });

            confirm_to_print.find(".btn-ok").click(function () {
                confirm_to_print.modal('hide');
                section_to_print.show();
                window.print();
                section_to_print.hide();
            });

            function print_ticket(data) {
                var content = '';
                $.each(data, function (index, obj) {
                    content += '<div class="box box-default box-solid">' +
                        '<div class="box-header with-border"><h3 class="box-title">Tiket Bus Terminal Arjosati</h3>' +
                        '<div class="box-tools pull-right"><i class="fa fa-ticket"></i></div>' +
                        '</div>' +
                        '<div class="box-body">' +
                        '<div class="row">' +
                        '<div class="col-xs-9">' +
                        '<div class="table-responsive">' +
                        '<table class="table">' +
                        '<tbody>' +
                        '<tr>' +
                        '<th style="width:50%">Nama Penumpang:</th>' +
                        '<td>' + obj.passenger_name + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th>Nomor Identitas:</th>' +
                        '<td>' + obj.identity_no + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th>Tanggal Lahir:</th>' +
                        '<td>' + obj.date_of_birth + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th>Bus:</th>' +
                        '<td>' + obj.bus_name + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th>Tujuan:</th>' +
                        '<td>' + obj.region + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<th>Berangkat:</th>' +
                        '<td>' + obj.time + '</td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-xs-3">' +
                        '<div id="bcTarget-'+ index +'"></div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                });
                // parsing content kedalam element
                section_to_print.html(content);
                // tambahkan barcode pada setiap tiket
                for (var i = 0; i < data.length; i++) {
                    section_to_print.find("#bcTarget-" + i).barcode({
                            code: data[i].id, crc: false
                        }, "int25", {barWidth: 2, barHeight: 30}
                    );
                }
            }
        });
    </script>

    <style type="text/css">
        @media print {
            .content-header, .content-header *, .hide-print, .hide-print *, footer, footer * {
                visibility: hidden;
                display: none;
            }

            .box-info {
                border-top: none;
            }

            #section-to-print * {
                visibility: visible;
            }
        }
    </style>
<?php $this->load->view('footer'); ?>