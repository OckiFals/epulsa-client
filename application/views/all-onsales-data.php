<?php
/**
 * @var array $reservations
 * @var array $graphic_incomes
 * @var array $total_income
 */
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
                    <div class="box box-solid bg-light-blue-gradient">
                        <div class="box-header ui-sortable-handle">
                            <i class="fa fa-th"></i>

                            <h3 class="box-title">Sales Graph <?php echo date("Y"); ?></h3>

                            <div class="box-tools pull-right">
                                <button class="btn bg-light-blue btn-sm" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                                <button class="btn bg-light-blue btn-sm" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body border-radius-none">
                            <canvas class="chart" id="salesChart" height="240" width="480">

                            </canvas>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info" style="min-height: 420px">
                        <div class="box-header">
                            <h3 class="box-title">Reservasi Terbaru</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="payment-list" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID Pemesanan</th>
                                    <th>Kode Booking</th>
                                    <th>Nama Pemesan</th>
                                    <th>Status</th>
                                    <th>Jumlah Tiket</th>
                                    <th>Total Harga</th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- js load soon -->
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID Pemesanan</th>
                                    <th>Kode Booking</th>
                                    <th>Nama Pemesan</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- Loading Indicator -->
                        <div class="overlay" id="load-animate">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <!-- /.box-body -->
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
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo count($reservations) ?></h3>

                            <p>Reservasi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>

                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>Rp. <?php echo $total_income ?></h3>

                            <p>Total Pendapatan Bulan Ini</p>
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
            var payment_table = $('#payment-list').DataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
            var load_indicator = $('#load-animate');

            //The Calender
            $("#calendar").datepicker('setDate', 'today');

            // iterasi stdClass data ke dalam object javascript
            var data = [
                <?php foreach($reservations as $index => $reservation): ?>
                {
                    id: <?php echo "'{$reservation->id}'" ?>,
                    booking_code: <?php echo "'{$reservation->booking_code}'" ?>,
                    customer_name: <?php echo "'{$reservation->customer_name}'" ?>,
                    status_display: <?php echo ('1' === $reservation->status) ? 
                        "'<span class=\"label label-default\">Baru</span>'" :
                        (('2' === $reservation->status) ? "'<span class=\"label label-primary\">Terkonfirmasi</span>'" : 
                            "'<span class=\"label label-success\">Tervalidasi</span>'") ?>,
                    ticket_count: "<?php echo $reservation->ticket_count ?>",
                    total_income: "<?php echo $reservation->total_income ?>"
                },
                <?php endforeach; ?>
            ];

            window.setTimeout(function () {
                render_data(data);
                load_indicator.remove();
            }, 500);

            function render_data(data) {
                $.each(data, function (index, obj) {
                    payment_table.row.add([
                        obj.id,
                        obj.booking_code,
                        obj.customer_name,
                        obj.status_display,
                        obj.ticket_count,
                        "Rp. " + obj.total_income
                    ]).draw();
                });
            }

            var sales = document.getElementById("salesChart").getContext("2d");

            var dataSales = {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December"
                ],

                datasets: [
                    {
                        label: "Orders dataset",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: [
                            <?php for($i=1; $i<=12; $i++): ?>
                                <?php echo (array_key_exists($i, $graphic_incomes)) ? $graphic_incomes[$i] : 0 ?>,
                            <?php endfor; ?>
                        ]
                    }
                ]
            };

            new Chart(sales).Bar(dataSales);
        });
    </script>
<?php $this->load->view('footer'); ?>