<?php $this->load->view('header', ['title' => 'Tambah Data Bus']); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('') ?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
                <li><a href="<?php echo base_url('bus') ?>"><i class="fa fa-road"></i> Semua Data Bus</a></li>
                <li class="active"><i class="fa fa-edit"></i> Tambah Data Bus</li>
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
                            <h3 class="box-title">Tambah Data Bus</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="register-box-body">
                                <form action="" method="POST" enctype="multipart/form-data" id="bus-form"
                                      novalidate="novalidate">
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        <select class="form-control" id="po" name="po">
                                            <option value="">Pilih PO</option>
                                            <?php foreach ($po as $index => $value): ?>
                                                <option
                                                    value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-road form-control-feedback"></span>
                                        <input id="bus" name="bus" class="form-control" placeholder="Nama Bus"
                                               type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-screenshot form-control-feedback"></span>
                                        <input id="destination" class="form-control" placeholder="Tujuan"
                                               name="destination" type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-star form-control-feedback"></span>
                                        <select class="form-control" id="class" name="class">
                                            <option value="">Pilih Kelas</option>
                                            <option value="1">Kelas: Eksekutif</option>
                                            <option value="2">Kelas: Bisnis</option>
                                            <option value="3">Kelas: Ekonomi</option>
                                        </select>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-plus-sign form-control-feedback"></span>
                                        <input id="capacity" class="form-control" placeholder="Kapasitas Penumpang"
                                               name="capacity" type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-usd form-control-feedback"></span>
                                        <input id="ticket_price" class="form-control" placeholder="Harga Tiket"
                                               name="ticket_price" type="text">
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
    <!-- autocomplete plugins JS -->
    <script src="<?php echo base_url('assets/plugins/autocomplete/jquery.autocomplete.js') ?>"
            type="text/javascript"></script>
    <!-- autocomplete plugins JS -->
    <link href="<?php echo base_url('assets/plugins/autocomplete/jquery.autocomplete.css') ?>" rel="stylesheet"
          type="text/css"/>
    <!-- JQuery Validate -->
    <script src="<?php echo base_url('assets/plugins/validate/jquery.validate.min.js') ?>"
            type="text/javascript"></script>

    <script type="application/javascript">
        $(document).ready(function () {
            //The Calender
            $("#calendar").datepicker('setDate', 'today');

            var dest_states = [];

            $.ajax({
                url: '../destination',
                beforeSend: function (xhr) {
                    xhr.overrideMimeType("application/json; charset=x-user-defined");
                },
                success: function (data) {

                    $.each(data, function (index, destination) {
                        dest_states[index] = destination.region + ' (' + destination.alias.toUpperCase() + ')';
                    });

                    $('#destination').autocomplete({
                        source: [dest_states]
                    });

                }
            });

            $("#bus-form").validate({

                // Specify the validation rules
                rules: {
                    po: "required",
                    bus: {
                        required: true,
                        rangelength: [4, 16]
                    },
                    destination: "required",
                    class: {
                        required: true,
                        range: [1, 3]
                    },
                    capacity: {
                        required: true,
                        range: [16, 100]
                    },
                    ticket_price: {
                        required: true,
                        digits: true,
                        rangelength: [5, 6]
                    }
                },

                // Specify the validation error messages
                messages: {
                    po: "Tolong pilih PO",
                    bus: {
                        required: "Tolong ketikkan nama bus",
                        rangelength: "Jumlah karakter harus berada diantara 4 dan 16"
                    },
                    destination: "Tolong ketikkan tujuan",
                    class: {
                        required: "Tolong pilih kelas",
                        range: "Kelas tidak valid"
                    },
                    capacity: {
                        required: "Tolong ketikkan kapasitas penumpang",
                        range: "Jumlah kursi tidak valid, harus diantara 16 dan 100"
                    },
                    ticket_price: {
                        required: "Tolong ketikkan harga tiket",
                        digits: "Haruslah berupa angka",
                        rangelength: "Digit angka harus berada diantara 5 dan 6"
                    }
                },

                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
<?php $this->load->view('footer'); ?>