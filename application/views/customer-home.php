<?php 
# set zona waktu lokal
date_default_timezone_set('Asia/Jakarta');
?>
<?php $this->load->view('header'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
                <li class="active">Dashboard</li>
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
                        <div class="box-header">
                            <h3 class="box-title">Latest Orders</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="order-list" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Phone</th>
                                    <th>Purchase</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Phone</th>
                                    <th>Purchase</th>
                                    <th>Status</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                        <!-- /.box-body -->
                        <div class="overlay" id="load-animate">
                            <i class="fa fa-refresh fa-spin"></i>
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

    <!-- Data Tables -->
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.js') ?>"></script>

    <!-- ./wrapper -->
    <!-- Sparkline -->

    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.js') ?>"
            type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.js') ?>"
            type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/chartjs/Chart.min.js') ?>" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js') ?>"
            type="text/javascript"></script>


    <script type="text/javascript">
    $(function () {
        //The Calender
        $("#calendar").datepicker('setDate', 'today');
        var order_table = $('#order-list').DataTable();
        var loading_indicator = $('#load-animate');
        var kuki = Cookies.getJSON('credential');
        $('#saldo').text(kuki.user.saldo);

        $.ajax({
            url: 'http://localhost:8080/order/',
            headers: {
                Authorization: "JWT " + kuki.token 
            },
            dataType: 'json',
            success: function (data) {
                window.setTimeout(function () {
                    $.each(data, function (index, obj) {
                        order_table.row.add([
                            // col 1
                            obj.id,
                            // col 2
                            obj.phone_number,
                            // col 3
                            obj.purchase,
                            // col 4
                            '<span class="label label-info">New</span>'
                        ]).draw();
                    });
                    loading_indicator.remove();
                }, 500);
            },
            error: function (er) {
                console.log(er)
            }
        });


    });
    </script>
<?php $this->load->view('footer'); ?>