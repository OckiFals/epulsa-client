<?php

class Ticket extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ticket_model');
    }

    public function search() {

    }
    
    public function export_pdf() {
        if (2 != $this->session->userdata('type')) 
            show_error('401 Unauthorized Request', 401 );

        if ($this->input->is_ajax_request()) {
        	if ($data = $this->validate()) {
        		echo json_encode($data);
        	}
        } else {
            $this->load->view('print-ticket');
        }
    }

    /**
     * Melakukan pengecekan terlebih dahulu
     * sebelum dapat melakukan cetak tiket
     *
     * Ada dua kondisi yang diharapkan:
     * 1. Pembayaran terkait dengan reservasi tiket harus sudah 
     *    di konfirmasi oleh pelanggan
     * 2. Reservasi tiket harus sudah di validasi oleh Agent
     * @return mixed data-reservasi: jika telah tervalidasi; false: jika belum
     */
    public function validate() {
        $reservation_data = $this
            ->Ticket_model->getByBookingCode(
                $this->input->get("booking_code")
        );

        if (!empty($reservation_data) && ('3' === $reservation_data[0]->status))
            return $reservation_data;
        else
            return false;
    }

}
