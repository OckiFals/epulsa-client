<?php

class Reservation extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Reservation_model');
        $this->load->model('Payment_model');
        $this->load->model('Schedule_model');
        $this->load->model('Ticket_model');
    }

    public function index() {
        
    }

    /**
     * Buat Pemesanan
     * --------------
     * 1. Form ditampilkan jika HTTP method yang digunakan adalah GET
     *    (untuk pengaksesan pertama kali)
     * 2. HTTP method akan berubah menjadi POST jika aktor melakukan submit
     * 3. Kemudian data disimpan kedalam database
     *    
     * @target: Pelanggan
     * @method: GET, POST 
     * @route: /pemesanan
     */
    public function add() {
        if ("POST" === $this->input->server('REQUEST_METHOD')) {
            # tampung jumlah tiket yang dipesan
            $ticket_count = $this->input->post('ticket_count');
            # buat reservasi sekaligus mendapatkan kode booking
            # lihat model
            $booking_code = $this->Reservation_model->create();

            /**
             * Iterasi sebanyak jumlah tiket yang dipesan
             *
             * Untuk menyimpan setiap data pesanan sesuai dengan jumlah tiket, 
             * digunakan index pada setiap input name (lihat reservation.php)
             * 
             * passanger_name_[index]
             * passanger_id_[index]
             * passanger_birth_[index]
             *
             * Dimana index = 1 sampai 3
             *
             * Contoh pada view
             * <input class="form-control" id="passenger_name_1" name="passenger_name_1" 
             *       placeholder="Masukkan nama pemesan 1" type="text">
             *
             * 
             * Jika tiket yang dipesan adalah 1, maka data post yang diambil adalah
             *
             * passanger_name_1
             * passanger_id_1
             * passanger_birth_1
             *  
             */
            for ($i=1; $i < $ticket_count+1; $i++) { 
                $passenger_name = $this->input->post("passenger_name_{$i}");
                $passenger_id = $this->input->post("passenger_id_{$i}");
                $passenger_birth = $this->input->post("passenger_birth_{$i}");

                $this->Ticket_model->create(
                    $passenger_name,
                    $passenger_id,
                    $passenger_birth
                );
            }

            # generate booking_code 
            echo $booking_code;

        } else {
            $this->load->view('reservation', [
                'data' => $this->Schedule_model->getByPK(
                    # id jadwal
                    $this->input->get('q')
                )
            ]);
        }
    }

    public function cancel() {

    }
    
    /**
     * Konfirmasi Pembayaran 
     * ----------------------
     * Untuk menghindari Pelanggan melakukan konfirmasi lebih dari satu
     * Sebelum data disimpan, dilakukan pengecekan terlebih dahulu
     * 1. Jika tidak ada data konfirmasi untuk kode booking tersebut
     *    Simpan data konfirmasi baru
     * 2. Jika data konfirmasi telah ada
     *    Perbarui berdasarkan data input yang baru 
     * @target: Pelanggan
     * @method: GET, POST 
     * @route: /konfirmasi-pembayaran
     */
    public function confirmation() {
        if ("POST" === $this->input->server('REQUEST_METHOD')) {
            $data = $this->Reservation_model->getByBookingCode($this->input->post('booking_code'));
            # jika kode booking valid
            if (null !== $data) {
                # membuat data konfirmasi baru
                if (null === $data->reservation_id) {
                    $this->Payment_model->create();
                } else { # ubah konfirmasi yang sudah ada
                    $this->Payment_model->update();
                }
                # mengubah status pesanan menjadi 2('terkonfirmasi')
                $this->Reservation_model->confirm();
                echo 'valid';
            } else {
                echo 'tidak-valid';
            }

        } else {
            $this->load->view('payment-confirmation');
        }
    }

    /**
     * Method ini menjalankan 2 hal:
     * 1. Menampilkan data pesanan ketika $_POST['action'] adalah search
     * 2. Memvalidasi pembayaran ketika $_POST['action'] adalah validate
     * Lihat if-else
     *
     * Perlu diingat method ini dipanggil secara aasynchronous mengunakan AJAX
     * Lihat validate-paymnet.php
     * 
     * @target: Agent
     * @method: POST, AJAX 
     * @route: /reservation/validation
     */
    public function validation() {
        # memastikan agen
        if (2 != $this->session->userdata('type'))
            show_error('401 Unauthorized Request', 401 );
        
        if ("POST" === $this->input->server('REQUEST_METHOD')) {
            if ("search" === $this->input->post('action')) {
                echo json_encode(
                    # ambil data pesanan sesuia dengan kode booking
                    # yang telah diinputkan
                    $this->Reservation_model->getByBookingCode(
                        $this->input->post('code')
                    )
                ); 
            } else if ("validate" === $this->input->post('action')) {
                # ubah status pembayaran menjai 3('tervalidasi')
                $this->Reservation_model->validate();
                echo "Pembayaran dengan kode booking <strong>" .
                    $this->input->post('booking_code') .
                    "</strong> telah divalidasi!";
            }
        } else {
            $this->load->view('validate-payment');   
        }
    }

}
