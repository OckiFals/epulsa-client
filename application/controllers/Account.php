<?php

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Account_model');
    }

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
        
        $accounts = $this->Account_model->getAll();
        $this->load->view('accounts/account-all', ['accounts' => $accounts]);
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
        
        if ("POST" === $this->input->server('REQUEST_METHOD')) {
            $account = $this->Account_model
                ->getByPK($this->input->post('id'));

            # jika akun dengan id tersebut belum ada
            if (null === $account) {
                $this->Account_model->create();
                # tambahkan info bahwa data berhasil ditambahkan kedalam session
                $this->session->set_flashdata('flash-message', "Data baru berhasil ditambahkan!");
                # arahkan kembali ke /account
                redirect(base_url('account'));
            } else {
                # tambahkan info bahwa nama akun telah digunakan
                $this->session->set_flashdata('flash-message', "ID telah digunakan, silakan cari nama yang lain!");
                
                /**
                 * Kondisi gagal:
                 * Ketika username yang dimasukkan telah ada yang menggunakan
                 * 
                 * Tampung data post terdahulu agar aktor tidak perlu
                 * melakukan input nama dan type lagi
                 * 
                 */
                $formData = [
                    'name' => $this->input->post('name'),
                    'type' => $this->input->post('type')
                ];

                # parsing ke dalam view
                $this->load->view('accounts/add-account', ['form_data' => $formData]);
            }
        } else {
            $this->load->view('accounts/add-account');
        }
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

        if ("POST" === $this->input->server('REQUEST_METHOD')) {
            $this->Account_model->update($id);
            # tambahkan info bahwa data berhasil dirubah kedalam session
            $this->session->set_flashdata('flash-message', "Data dengan id={$id} berhasil dirubah!");
            # arahkan kembali ke /account
            redirect(base_url('account'));
        } else {
            $account_id = $this->Account_model->getByPK($id);
            $this->load->view('accounts/account-edit', ['account' => $account_id]);
        }
    }

    /**
     * Hapus akun
     * ------------------
     * Fungsi ini melaukan 2 hal:
     * 1. Mengecek bahwa aktor yang mengakses adalah admin
     * 2. Menghapus akun sesuai dengan id yang dikirim via AJAX
     *
     * @target: Admin
     * @method: AJAX
     * @route: /account/delete/[:id]
     */
    public function delete($id) {
        if (1 != $this->session->userdata('type'))
            show_error('401 Unauthorized Request', 401 );

        # jika request berasal dari AJAX
        if ($this->input->is_ajax_request()) {
            # hapus data
            $this->Account_model->delete($id);
            # cetak pesan, digunakan di account-all.php line 235 sebagai msg 
            echo 'Akun dengan ID: <strong>' . $id . '</strong> berhasil dihapus!';    
        } 
    }

}