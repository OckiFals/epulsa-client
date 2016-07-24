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
                                    <th>Transaction ID</th>
                                    <th>Order ID</th>
                                    <th>Total</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Order ID</th>
                                    <th>Total</th>
                                    <th>Time</th>
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

    <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Order Baru</h4>
                </div>
                <div class="modal-body">
                    Apakah Anda akan menerima order #<span id="order-id"></span> dari customer 
                    #<span id="customer-id"></span>senilai Rp. 
                    <strong id="order-purchase"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat btn-cancel">Tolak</button>
                    <a class="btn btn-info btn-flat btn-ok">Terima</a>
                </div>
            </div>
        </div>
    </div>

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
    <!-- datepicker -->
    <script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js') ?>"
            type="text/javascript"></script>

    <script type="text/javascript">
    $(function () {
        //The Calender
        $("#calendar").datepicker('setDate', 'today');
        //The modal
        var modal = $('#new-order');

        var order_table = $('#order-list').DataTable();
        var loading_indicator = $('#load-animate');
        var kuki = Cookies.getJSON('credential');
        $('#saldo').text(kuki.user.saldo);

        // panggil fungsi orderStreams() setiap 1 detik
        var interval = window.setInterval(function(){orderStreams()}, 1000);

        // mendapatkan transaksi oprder dari conter
        $.ajax({
            url: "http://localhost:8080/transaction/order",
            headers: {
                    Authorization: "JWT " + kuki.token 
            },
            success: function (data) {
                window.setTimeout(function () {
                    // isi data kedalam order table
                    $.each(data, function (index, obj) {
                        order_table.row.add([
                            // col 1
                            obj.id,
                                    // col 2
                            obj.order,
                                    // col 3
                            obj.total,
                                    // col 4
                            obj.time
                        ]).draw();
                    });
                    loading_indicator.remove();
                }, 500);
                window.clearInterval(interval);
            }
        });

        // fungsi untuk mendapatkan order baru secara real-time
        function orderStreams() {
            $.ajax({
                url: 'http://localhost:8080/order/streams/',
                headers: {
                    Authorization: "JWT " + kuki.token 
                },
                dataType: 'json',
                success: function (data) {
                    console.log('sent request')
                    if (0 != data.length) {
                        modal.find("#order-id").text(data[data.length-1].id);
                        modal.find("#customer-id").text(data[data.length-1].customer);
                        modal.find("#order-purchase").text(data[data.length-1].purchase);
                        modal.modal('show');
                    } else {
                        loading_indicator.remove();
                    }
                },
                error: function (er) {
                    console.log(er)
                }
            });
        }

        // ketika buton ok di click -> counter menerima order
        modal.find('.btn-ok').click(function () {
            // buat transaksi baru
            $.ajax({
                url: 'http://localhost:8080/transaction/order',
                type: 'post',
                data: {
                    "customer": parseInt(modal.find('#customer-id').text()),
                    "order": parseInt(modal.find('#order-id').text()),
                    "total": parseInt(modal.find('#order-purchase').text()),
                },
                headers: {
                    Authorization: "JWT " + kuki.token 
                },
                success: function (data) {
                    kuki.user.saldo = parseInt(kuki.user.saldo) - parseInt(modal.find('#order-purchase').text());
                    $('#saldo').text(kuki.user.saldo);
                    interval = window.setInterval(function(){orderStreams()}, 1000);
                },
                error: function (er) {
                    console.log(er);
                }
            });
            modal.modal('hide');
        });

        modal.find('.btn-cancel').click(function () {
            interval = window.setInterval(function(){orderStreams()}, 1000);
            modal.modal('hide');
        });

    });
    </script>
<?php $this->load->view('footer'); ?>