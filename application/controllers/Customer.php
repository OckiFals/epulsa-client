<?php

class Customer extends CI_Controller {

    /**
     * Kelola akun
     * ------------
     * 
     * Pada halaman ini semua akun yang ada
     * ditampilkan menggunakan dataTable
     *
     * @target: Admin
     * @method: GET
     * @route: /account  
     */
    public function index() {
        if (1 != $this->session->userdata('type'))
            show_error('401 Unauthorized Request', 401 );
        
        $this->load->view('accounts/customer-all');
    }

    /**
     * Tambah akun
     * ------------
     *
     * 1. Form ditampilkan jika HTTP method yang digunakan adalah GET
     *    (untuk pengaksesan pertama kali)
     * 2. HTTP method akan berubah menjadi POST jika aktor melakukan submit
     * 3. Kemudian data disimpan dalam database,
     *    sebelum data tersebut disimpan terlebih dahulu dilakukan pengecekan
     *    untuk menjamin bahwa ID yang digunakan adalah unik
     * 
     * @target: Admin
     * @method: POST, GET
     * @route: /account/add  
     */
    public function add() {
        if (1 != $this->session->userdata('type'))
            show_error('401 Unauthorized Request', 401 );
        
        $this->load->view('accounts/admin-add');
    }

    /**
     * Ubah data akun
     * ------------------
     * Fungsi ini melaukan 3 hal:
     * 1. Mengecek bahwa aktor yang mengakses adalah admin
     * 2. Menampilkan form ubah data jika HTTP method yang digunakan GET
     * 3. Mengubah akun sesuai dengan data yang dikirim 
     *    jika HTTP method yang digunakan POST
     *
     * @target: Admin
     * @method: GET, POST
     * @route: /account/update/[:id]
     */
    public function edit($id) {
        if (1 != $this->session->userdata('type'))
            show_error('401 Unauthorized Request', 401 );

        $this->load->view('accounts/admin-edit', ['account_id' => $id]);
    }

    public function isiSaldo() {
        $this->load->view('isi-saldo');
    }

}