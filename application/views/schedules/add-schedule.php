<?php
/**
 * @var stdClass $buses
 */
?>
<?php $this->load->view('header', ['title' => 'Tambah Jadwal Bus']); ?>
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
                <li><a href="<?php echo base_url('schedule') ?>"><i class="fa fa-book"></i> Semua Jadwal Bus</a></li>
                <li class="active"><i class="fa fa-edit"></i> Tambah Jadwal Bus</li>
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
                            <h3 class="box-title">Tambah Jadwal Bus</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="register-box-body">
                                <form action="" method="POST" enctype="multipart/form-data" id="bus-form"
                                      novalidate="novalidate">
                                    <div class="form-group has-feedback">
                                        <span class="glyphicon glyphicon-road form-control-feedback"></span>
                                        <input id="bus" name="bus" class="form-control" placeholder="Nama Bus"
                                               type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <select class="form-control" id="day" name="day">
                                            <option value="">Pilih Hari Keberangkatan</option>
                                            <option value="monday-1">Senin</option>
                                            <option value="tuesday-2">Selasa</option>
                                            <option value="wednesday-3">Rabu</option>
                                            <option value="thursday-4">Kamis</option>
                                            <option value="friday-5">Jum'at</option>
                                            <option value="saturday-6">Sabtu</option>
                                            <option value="sunday-7">Minggu</option>
                                        </select>
                                    </div>
                                    <div class="form-group has-feedback">

                                        <span class="glyphicon glyphicon-time form-control-feedback"></span>

                                        <input id="time" class="form-control" placeholder="Waktu Keberangkatan"
                                               name="time" type="text">
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

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <a>Made By <i>Ngaji 2.0, AngularJS</i> and <i class="fa fa-heart"></i></a>
        </div>
        <strong>Copyright &copy;<a>OckiFals</a>.</strong> All
        rights reserved.
        <!-- /.container -->
    </footer>

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
    <!-- autocomplete plugins JS -->
    <script src="<?php echo base_url('assets/plugins/autocomplete/jquery.autocomplete.js') ?>"
            type="text/javascript"></script>
    <!-- autocomplete plugins JS -->
    <link href="<?php echo base_url('assets/plugins/autocomplete/jquery.autocomplete.css') ?>" rel="stylesheet"
          type="text/css"/>
    <!-- clock picker plugins JS -->
    <script src="<?php echo base_url('assets/plugins/clock-time/bootstrap-clockpicker.min.js') ?>"
            type="text/javascript"></script>
    <!-- clock picker plugins JS -->
    <link href="<?php echo base_url('assets/plugins/clock-time/jquery-clockpicker.min.css') ?>" rel="stylesheet"
          type="text/css"/>

    <script type="application/javascript">
        $(document).ready(function () {
            //The Calender
            $("#calendar").datepicker('setDate', 'today');

            var bus_states = [];

            var bus_data = [
                <?php foreach ($buses as $index => $bus): ?>
                {
                    id: <?php echo $bus->id ?>,
                    name: '<?php echo $bus->bus_name ?>'
                },
                <?php endforeach; ?>
            ];

            $.each(bus_data, function (index, bus) {
                bus_states[index] = bus.name + ' (ID: ' + bus.id + ')';
            });

            $('#bus').autocomplete({
                source: [bus_states]
            });

            $('#time').clockpicker({
                placement: 'bottom',
                align: 'left',
                autoclose: true
            });

            $("#bus-form").validate({

                // Specify the validation rules
                rules: {
                    bus: "required",
                    time: "required",
                    day: "required"
                },

                // Specify the validation error messages
                messages: {
                    bus: "Tolong ketikkan nama bus",
                    day: "Tolong isi hari keberangkatan",
                    time: "Tolong ketikkan waktu keberangkatan"
                },

                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
<?php $this->load->view('footer'); ?>