<?php

class Bus extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Bus_model');
        $this->load->model('Po_model');
    }

    /**
     * Halaman kelola bus
     * Pada halaman ini semua bus yang ada
     * ditampilkan menggunakan AJAX request
     *
     * @target: Admin
     * @method: GET
     * @route: /bus
     */
    public function index() {
        if (1 != $this->session->userdata('type'))
            show_error('401 Unauthorized Request', 401 );

        $buses = $this->Bus_model->getAll();
        $this->load->view('buses/bus-all', ['buses' => $buses]);
    }

    /**
     * Form tambah bus
     *
     * @target: Admin
     * @method: POST, GET
     * @route: /bus/add  
     */
    public function add() {
        if (1 != $this->session->userdata('type'))
            show_error('401 Unauthorized Request', 401 );

        if ("POST" === $this->input->server('REQUEST_METHOD')) {
            $this->Bus_model->create();
            # tambahkan info bahwa data berhasil dirubah kedalam session
            $this->session->set_flashdata('flash-message', "Data Bus berhasil ditambahkan!");
            # arahkan kembali ke /bus
            redirect(base_url('bus'));
        } else {
            # ambil semua PO untuk fitur auto complete
            $po = $this->Po_model->getAll();
            $this->load->view('buses/add-bus', ['po' => $po]);
        }
    }

    public function edit($id) {
        if (1 != $this->session->userdata('type'))
            show_error('401 Unauthorized Request', 401 );

        if ("POST" === $this->input->server('REQUEST_METHOD')) {
            $this->Bus_model->update($id);
            # tambahkan info bahwa data berhasil dirubah kedalam session
            $this->session->set_flashdata('flash-message', "Data Bus dengan id={$id} berhasil dirubah!");
            # arahkan kembali ke /bus
            redirect(base_url('bus'));
        } else {
            # ambil data bus yang ingin diedit
            $bus = $this->Bus_model->getByPK($id);
            # ambil semua PO untuk fitur auto complete
            $po = $this->Po_model->getAll();
            $this->load->view('buses/bus-edit', [
                'bus' => $bus,
                'po' => $po
            ]);
        }
    }

    /**
     * Hapus data bus
     * ------------------
     * Fungsi ini melaukan 2 hal:
     * 1. Mengecek bahwa aktor yang mengakses adalah admin
     * 2. Menghapus bus sesuai dengan id yang dikirim via AJAX
     *
     * @target: Admin
     * @method: AJAX
     * @route: /bus/delete/[:id]
     */
    public function delete($id) {
        if (1 != $this->session->userdata('type'))
            show_error('401 Unauthorized Request', 401 );

        # jika request berasal dari AJAX
        if ($this->input->is_ajax_request()) {
            # hapus data
            $this->Bus_model->delete($id);
            echo 'Bus dengan ID: <strong>' . $id . '</strong> berhasil dihapus!';    
        } 
    }

}
