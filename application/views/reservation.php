<?php

/**
 * @var stdClass $data
 */

if (empty($data))
    redirect(base_url());
?>

<?php $this->load->view('customer-header', ['title' => 'Pesan Tiket']); ?>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Software Engineering
                    <small>Group 2</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="fa fa-search"></i> Home</a></li>
                    <li class="active">
                        <i class="fa fa-credit-card"></i> Reservasi
                    </li>
                </ol>
            </section>

            <section class="content">

                <div class="row">
                    <div class="col-sm-12 center-block" style="float: none">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h2 class="box-title">
                                    <span id="content-title">Isi form pemesanan</span>
                                </h2>
                            </div>
                            <!-- /.box-header -->
                            <!-- Loading Indicator -->
                            <div class="overlay" id="load-animate" style="display: none">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                            <!-- / Loading Indicator -->
                            <div class="box-body">
                                <!-- flash message -->
                                <div class="alert alert-info alert-dismissable" id="flash-message" style="display: none">
                                    <h4><i class="icon fa fa-check-square-o"></i> Pesanan telah dikirim!</h4>
                                    Kode booking Anda adalah <strong id="booking-code"></strong>.
                                    Simpan baik-baik, dan segera lakukan pembayaran! Anda juga dapat 
                                    <a href="#print" id="btn-print">Mencetak</a> bukti pemesanan ini!
                                </div>
                                <!-- /flash message -->
                                <div class="table-responsive">
                                    <p class="lead">Informasi Tiket</p>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width: 50%">Tujuan</th>
                                                <td><?php echo $data->destination_display ?></td>
                                            </tr>
                                            <tr>
                                                <th>Bus</th>
                                                <td><?php echo $data->bus_name ?></td>
                                            </tr>
                                            <tr>
                                                <th>Waktu Keberangkatan</th>
                                                <td><?php echo $data->time ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <form role="form" action="" id="reservation_form" method="POST">

                                    <div class="form-group">
                                        <label for="ticket_count">Jumlah tiket</label>
                                        <select class="form-control" id="ticket_count" name="ticket_count">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="customer_name">Nama Pemesan</label>
                                        <input class="form-control" id="customer_name" name="customer_name" 
                                               placeholder="Masukkan nama pemesan" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="customer_phone">Nomor Telepon</label>
                                        <input class="form-control" id="customer_phone" name="customer_phone" 
                                               placeholder="Masukkan nomor telepon" type="text">
                                    </div>

                                    <!-- Form Data Diri Penumpang -->
                                    <div class="col-sm-12" id="passenger_data_1">
                                        <div class="box box-info box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Data Penumpang 1</h3>

                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                            class="fa fa-minus"></i></button>
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="passenger_name_1">Nama Penumpang 1</label>
                                                    <input class="form-control" id="passenger_name_1" name="passenger_name_1" 
                                                           placeholder="Masukkan nama pemesan 1" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="passenger_id_1">Nomor identitas penumpang 1</label>
                                                    <input class="form-control" id="passenger_id_1" name="passenger_id_1" 
                                                           placeholder="Masukkan nomor identitas pemesan 1"
                                                           type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="passenger_birth_1">Tanggal Lahir penumpang 1</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input class="form-control" name="passenger_birth_1" 
                                                               data-inputmask="'alias': 'dd/mm/yyyy'"
                                                               data-mask="" id="passenger_birth_1" type="text">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4" id="passenger_data_2" style="display: none">
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Data Penumpang 2</h3>

                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                            class="fa fa-minus"></i></button>
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="passenger_name_2">Nama Penumpang 2</label>
                                                    <input class="form-control" id="passenger_name_2" name="passenger_name_2" 
                                                           placeholder="Masukkan nama pemesan 2" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="passenger_id_2">Nomor identitas penumpang 2</label>
                                                    <input class="form-control" id="passenger_id_2" name="passenger_id_2" 
                                                           placeholder="Masukkan nomor identitas pemesan 2"
                                                           type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="passenger_birth_2">Tanggal Lahir penumpang 2</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input class="form-control"
                                                               data-inputmask="'alias': 'dd/mm/yyyy'" name="passenger_birth_2" 
                                                               data-mask="" id="passenger_birth_2" type="text">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4" id="passenger_data_3" style="display: none">
                                        <div class="box box-warning box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Data Penumpang 3</h3>

                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i
                                                            class="fa fa-minus"></i></button>
                                                </div>
                                                <!-- /.box-tools -->
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="passenger_name_3">Nama Penumpang 3</label>
                                                    <input class="form-control" id="passenger_name_3" name="passenger_name_3" 
                                                           placeholder="Masukkan nama pemesan 3" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="passenger_id_3">Nomor identitas penumpang 3</label>
                                                    <input class="form-control" id="passenger_id_3" name="passenger_id_3" 
                                                           placeholder="Masukkan nomor identitas pemesan 3"
                                                           type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="passenger_birth_3">Tanggal Lahir penumpang 3</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input class="form-control" name="passenger_birth_3" 
                                                               data-inputmask="'alias': 'dd/mm/yyyy'"
                                                               data-mask="" id="passenger_birth_3" type="text">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <!-- /Form Data Diri Penumpang -->

                                    <div class="box-footer" id="form-submit-div">

                                        <div class="row">
                                            <div class="col-md-11 col-xs-8">

                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-1 col-xs-4">
                                                <button type="submit" id="btn-submit" class="btn btn-primary btn-block">Submit
                                                </button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                </form>
                                <div class="row" id="print" style="display: none">
                                    <div class="col-xs-12">
                                        <button onclick="window.print()" class="btn btn-default">
                                            <i class="fa fa-print"></i> Print
                                        </button>
                                        <a href="<?php echo base_url() ?>" class="btn btn-success pull-right">
                                            <i class="fa fa-check-square-o"></i> Selesai
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.col -->

            </section>


        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js') ?>" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/app.min.js') ?>" type="text/javascript"></script>
    <!-- jquery.inputmask -->
    <script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js') ?>"
            type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') ?>"
            type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js') ?>"
            type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var form = $('#reservation_form');
            var ticket_count = form.find('#ticket_count');
            var loading_indicator = $("#load-animate");

            ticket_count.change(function (e) {
                var val = $(this).val();
                var data1 = form.find('#passenger_data_1');
                var data2 = form.find('#passenger_data_2');
                var data3 = form.find('#passenger_data_3');

                // cari cara yang lebih efisien
                if ('1' === val) {
                    data1.removeAttr('class').attr('class', 'col-sm-12').show();
                    data2.hide();
                    data3.hide();
                } else if ('2' === val) {
                    data1.removeAttr('class').attr('class', 'col-sm-6').show();
                    data2.removeAttr('class').attr('class', 'col-sm-6').show();
                    data3.hide();
                } else {
                    data1.removeAttr('class').attr('class', 'col-sm-4').show();
                    data2.removeAttr('class').attr('class', 'col-sm-4').show();
                    data3.removeAttr('class').attr('class', 'col-sm-4').show();
                }
            });

            // FIXME validasi otomatis gagal kudu manual, mumet wess
            $('#btn-submit').click(function(e) {
                e.preventDefault();

                // validasi untuk form data pemesan
                if (1 > ticket_count.val() && 3 < ticket_count.val()) {
                    alert('Awas mau main-main ya!');
                    return;
                } else if('' === form.find('#customer_name').val()) {
                    alert('Tolong isi nama pemesan!');
                    return;
                } else if('' === form.find('#customer_phone').val()) {
                    alert('Tolong isi nomor telepon pemesan!');
                    return;
                }

                // validasi untuk form data penumpang 1
                if (1 <= ticket_count.val()) {
                    if ('' === form.find('#passenger_name_1').val()) {
                        alert('Tolong isikan nama penumpang 1');
                        return;
                    } else if ('' === form.find('#passenger_id_1').val()) {
                        alert('Tolong isi nomor identias penumpang 1!');
                        return;
                    } else if ('' === form.find('#passenger_birth_1').val()) {
                        alert('Tolong isi tanggal lahir penumpang 1!');
                        return;
                    }
                }

                // validasi untuk form data penumpang 2
                if (2 <= ticket_count.val()) {
                    if ('' === form.find('#passenger_name_2').val()) {
                        alert('Tolong isikan nama penumpang 2');
                        return;
                    } else if ('' === form.find('#passenger_id_2').val()) {
                        alert('Tolong isi nomor identias penumpang 2!');
                        return;
                    } else if ('' === form.find('#passenger_birth_2').val()) {
                        alert('Tolong isi tanggal lahir penumpang 2!');
                        return;
                    }
                }

                // validasi untuk form data penumpang 3
                if (3 == ticket_count.val()) {
                    if ('' === form.find('#passenger_name_3').val()) {
                        alert('Tolong isikan nama penumpang 3');
                        return;
                    } else if ('' === form.find('#passenger_id_3').val()) {
                        alert('Tolong isi nomor identias penumpang 3!');
                        return;
                    } else if ('' === form.find('#passenger_birth_3').val()) {
                        alert('Tolong isi tanggal lahir penumpang 3!');
                        return;
                    }
                }

                // form.submit();
                $.post("pemesanan?q=<?php echo $this->input->get('q')?>", 
                    form.serialize()
                ).done(function(msg) {
                    loading_indicator.show();
                    
                    // gunakan delay 0.5 detik sebagai variasi
                    window.setTimeout(function () {
                        loading_indicator.hide();
                        // tampilkan informasi pesanan terkirim
                        $("#flash-message").show().find("#booking-code").html(msg);
                    }, 500);

                    $("#content-title").html("Informasi Pemesanan");

                    $("html, body").animate({ scrollTop: 0 }, 400);

                    // tampilkan button tambahan
                    $("#print").show();
                    $("select").prop('disabled', true);
                    $("input").prop('disabled', true);
                    form.find("#form-submit-div").remove();

                });

            });

            $("#btn-print").click(function (e) {
                e.preventDefault();
                $("html, body").animate({ scrollTop: $(document).height() }, 1000);
            });

            //Datemask dd/mm/yyyy
            $("#passenger_birth_1").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
            $("#passenger_birth_2").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
            $("#passenger_birth_3").inputmask("yyyy/mm/dd", {"placeholder": "dd/mm/yyyy"});
        });
    </script>

    <style type="text/css">
        @media print {
            body * {
                visibility: hidden;
            }
            .content, .content * {
                visibility: visible;
            }

            #print * {
                visibility: hidden;
            }
        }
    </style>
<?php $this->load->view('customer-footer'); ?>