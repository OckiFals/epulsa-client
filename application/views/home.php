<?php $this->load->view('customer-header'); ?>
    <!-- wrapper -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    MITI
                    <small>Group 2</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#"><i class="fa fa-search"></i> Home</a>
                    </li>
                </ol>
            </section>

            <section class="content">

                <div class="row">
                    <div class="col-lg-8 col-md-10 col-sm-12 center-block" style="float:none">
                        <div class="search-ticket">
                            <div class="box-header">
                                <h3 class="box-title">Cari Tiket Disini</h3>
                            </div>
                            <!-- /.box-header -->

                            <div class="box-body">
                                <form role="form" action="">
                                    <div class="input-group margin">
                                        <input type="text" class="form-control input-lg"
                                               placeholder="Ketikkan Tujuan ..."
                                               id="input-search" name="dest" value="">
                                <span class="input-group-btn">
                                    <input class="btn btn-lg btn-info btn-flat" id="btn-search" type="submit"
                                           value="Cari">
                                </span>
                                    </div>
                                    <div class="form-inline margin">
                                        <div class="input-group has">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                            <input class="form-control input-sm" id="date_of_departure"
                                                   name="date_of_departure"
                                                   placeholder="Tanggal Keberangkatan" type="text">
                                        </div>

                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="all" checked>Semua Kelas
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="1">Eksekutif
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="2">Bisnis
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" value="3">Ekonomi
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-12" id="load-animate" style="display: none">
                            <div class="box box-solid" style="background: none; border-top: none; box-shadow: none">
                                <div class="box-body">

                                </div>
                                <!-- /.box-body -->
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay" style="background: none">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </div>
                                <!-- end loading -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- bus-load -->
                        <div id="bus-load" style="display: none">
                            <!-- AJAX call soon  -->
                        </div>
                        <!-- /bus-load -->
                    </div>
                </div>

                <!-- /.col -->

            </section>
        </div>
        <!-- /.container -->
    </div>

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js') ?>" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/app.min.js') ?>" type="text/javascript"></script>
    <!-- autocomplete plugins JS -->
    <script src="<?php echo base_url('assets/plugins/autocomplete/jquery.autocomplete.js') ?>"
            type="text/javascript"></script>
    <!-- autocomplete plugins JS -->
    <link href="<?php echo base_url('assets/plugins/autocomplete/jquery.autocomplete.css') ?>" rel="stylesheet"
          type="text/css"/>
    <!-- autocomplete plugins JS -->
    <script src="<?php echo base_url('assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js') ?>"
            type="text/javascript"></script>
    <!-- autocomplete plugins JS -->
    <link href="<?php echo base_url('assets/plugins/datetimepicker/jquery.datetimepicker.css') ?>" rel="stylesheet"
          type="text/css"/>

    <script type="text/javascript">
        $(document).ready(function () {
            // buat element input cari tiket(baris 35) kedalam objek jquery
            var input_search = $('#input-search');
            // holder element input cari tiket, untuk tujuan variasi aja
            var search_ticket = $('.search-ticket');
            // buat element input tanngal kedalam objek jquery
            var date = $('#date_of_departure');
            // holder hasil pencarian, pertama muat hidden
            var bus_box = $('#bus-load');
            // anilasi loading
            var load_indicator = $('#load-animate');

            // animasi menurunkan element input, ketika pertama halaman dimuat
            search_ticket.animate({
                marginTop: "+60px"
            }, 800);

            // elemet input tanggal
            date.datetimepicker({
                timepicker: false,
                minDate: '-1970/01/01',
                format: 'Y/m/d'
            });

            // ketika btn cari di klik
            $('#btn-search').click(function (e) {
                // tahan submit
                e.preventDefault();

                // jika input cari kosong
                if ('' === input_search.val())
                    // jangan lakukan apa-apa
                    return;
                // jika input tanggal kosong
                if ('' === date.val()) {
                    // fokuskan ke input tanggal
                    date.focus();
                    return;
                }
                // jika holder hasil pencarian tidak kosong
                // ketika telah melakukan pencarian sebelumnya
                if (0 !== bus_box.children().length)
                    // kosongkan holder
                    bus_box.empty();

                // tampilkan animasi loading
                load_indicator.show();

                // animasi menaikan input cari tiket ke atas 
                search_ticket.animate({
                    marginTop: "-4"
                }, 1000);

                // cetak hasil pencarian
                showBusContent();

            });

            // ajax untuk autocomplete tujuan
            $.ajax({
                url: 'destination/busjoin',
                beforeSend: function (xhr) {
                    xhr.overrideMimeType("application/json; charset=x-user-defined");
                },
                success: function (data) {

                    var states = [];

                    $.each(data, function (index, destination) {
                        states[index] = destination.region;
                    });

                    input_search.autocomplete({
                        source: [states]
                    });

                    input_search.focus();
                }
            });

            // fungsi untuk menampilkan hasil pencarian
            // mentransformasi objek json kedalam element HTLM
            function showBusContent() {
                // kirim request AJAX
                // ke halaman /search
                $.ajax({
                    url: 'search',
                    data: { 'dest': input_search.val(), 'date': date.val(), 'class':  $('form input[type=radio]:checked').val()},
                    beforeSend: function (xhr) {
                        // meminta balasan berupa objek JSON
                        xhr.overrideMimeType("application/json; charset=x-user-defined");
                    }
                }).done(function (data) {
                    // server mebalas JSON dalam variabel data
                    
                    // 
                    var content = '';

                    // jika data tidak kosong
                    if (0 < data.length) {
                        // iterasi objek
                        $.each(data, function (index, bus) {
                            var class_display;
                            // ubah type bus dari int ke String
                            switch(bus.class) {
                                case '1': 
                                    class_display = 'Eksekutif';
                                    break;
                                case '2': 
                                    class_display = 'Bisnis';
                                    break;
                                case '3': 
                                    class_display = 'Ekonomi';
                                    break; 
                            }

                            // perbaruin variabel content
                            content += '' +
                                '<div class="col-md-4 col-sm-6 col-xs-12 center-block">' +
                                '<div class="info-box">' +
                                '<span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>' +
                                '<div class="info-box-content">' +
                                '<a href="pemesanan?q=' + bus.schedule_id + '" class="info-box-text">' + bus.bus_name + '</a>' +
                                '<span class="label label-primary"><i class="fa  fa-star"></i> ' + class_display + '</span>' +
                                '<span class="info-box-number">Rp.' + bus.ticket_price + '</span>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        });
                    } else { // jika data kosong, buat element data tidak ditemukan
                        content += '' +
                        '   <div class="col-md-12 center-block">' +
                            '<div class="alert alert-info alert-dismissable">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                            '<h4><i class="icon fa fa-info"></i> Data Tidak Ditemukan!</h4>' +
                            'Silakan cari yang lainnya.' +
                            '</div>' +
                            '</div>';
                    }

                    // sembunyikan animasi laoding
                    load_indicator.hide();
                    // tambahkan content ke holder hasil pencarian
                    bus_box.append(content);
                    // tampilkan holder dengan animasi fade in
                    bus_box.fadeIn();
                }).fail(function (thrownError) { // server tidak mengirimkan data
                    // sembunyikan animasi loading
                    load_indicator.hide();
                });
            }
        });
    </script>
<?php $this->load->view('customer-footer'); ?>