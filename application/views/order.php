<?php $this->load->view('header', ['title' => 'Order']) ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
                <li class="active"><i class="fa fa-edit"></i> Order</li>
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
            <div class="alert alert-info alert-dismissable" id="flash-message" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Info!</h4>
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
                                <h3 class="box-title">Order</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="register-box-body">
                                    <p class="login-box-msg">Isi form berikut</p>

                                    <form action="" method="POST" id="order-form"
                                          novalidate="novalidate">
                                        <div class="form-group has-feedback">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                            <input id="phone" name="phone" class="form-control" placeholder="Nomor Telepon"
                                                   type="text">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <select class="form-control" id="purchase" name="purchase">
                                                <option value="0">Pilih Harga</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-8">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-4">
                                                <button class="btn btn-primary btn-block btn-flat">Order</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                            <!-- /.col -->
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

                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>Rp. 
                                <span id="saldo"></span>
                            </h3>

                            <p>Saldo</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.box -->
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

            form = $("#order-form");

            // ambil data dari kuki
            var kuki = Cookies.getJSON('credential');
            // atur nomor telepon default
            form.find('#phone').val(kuki.user.phone);

            $('#saldo').text(kuki.user.saldo);

            // saldo yang tersedia
            var available_saldo = [5000, 10000, 25000, 50000, 100000];
            // ambil data user saldo dari kuki
            var user_saldo = kuki.user.saldo;

            // tambahkan opsi harga berdasarkan saldo yang dimiliki user
            // opsi yang ditambahkan hanya jika saldo user lebih besar dari index yang diiterasi
            for (var i = 0; i < available_saldo.length; i++) {
                if (user_saldo >= available_saldo[i])
                    form.find('#purchase').append($("<option></option>")
                        .attr("value", available_saldo[i])
                        .text(available_saldo[i])); 
            }

            $(form).submit(function(e) {
                e.preventDefault();
            }).validate({

                // Specify the validation rules
                rules: {
                    phone: "required",
                    purchase: {
                        required: true
                    }
                },

                // Specify the validation error messages
                messages: {
                    phone: "Tolong ketikkan nomor telepon",
                    purchase: {
                        required: "Tolong pilih harga"
                    }
                },

                submitHandler: function (f) {
                    $.ajax({
                        url: 'http://localhost:8080/order/',
                        type: 'post',
                        data: {
                            phone_number: document.getElementById('phone').value,
                            purchase: document.getElementById('purchase').value
                        },
                        headers: {
                            Authorization: "JWT " + kuki.token 
                        },
                        dataType: 'json',
                        success: function (data) {
                            form[0].reset();
                            form.find('#phone').val(kuki.user.phone);
                            renderFlashInfo('Order dengan id=' + data.id + " berhasil ditambahkan!");
                        },
                        error: function (er) {
                            console.log(er)
                            form[0].reset();
                            form.find('#phone').val(kuki.user.phone);
                        }
                    });
                }
            });

            function renderFlashInfo(eventInfo) {
                flash_message.find('#flash-message-data').html(eventInfo);
                flash_message.fadeIn('normal');
                window.setTimeout(hideFlashMessage, 4000);
            }

            function hideFlashMessage() {
                flash_message.fadeOut('normal');
            }
        });
    </script>
<?php $this->load->view('footer') ?>