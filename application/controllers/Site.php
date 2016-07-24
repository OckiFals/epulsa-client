<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
	
	

    /**
     * Halaman Utama Sistem
     * ---------------------
     * Menentukan isi halaman yang akan dimuat
     * berdasarkan pada jenis aktor  
     * 
     * @target: all
     * @method: GET
     * @route: /  
     */
    public function index() {
        if (null === $this->session->userdata('id'))
            redirect(base_url('login'), 'refresh');

        # jika request berasal dari admin
        if (1 == $this->session->userdata('type')) {
            $this->load->view('admin-home');
        } else if (2 == $this->session->userdata('type')) {
            $this->load->view('counter-home');
        } else {
            $this->load->view('customer-home');
        }
    }

    /**
     * Halaman Login
     * --------------
     * Menyediakan layanan untuk menulis sesi aktif pada sistem
     * 
     * @target: Admin, Agent
     * @method: GET, POST
     * @route: /login-rahasia 
     */
    public function login() {
        # memastikan aktor tidak melakukan login dua kali
        if (null !== $this->session->userdata('id'))
            redirect(base_url(), 'refresh');

        $this->load->view('login');
    }

    /**
     * Fungsi Logout
     * --------------
     * Menyediakan layanan untuk menghapus sesi aktif
     * 
     * @target: Admin, Agent
     * @method: GET
     * @route: /logout-rahasia 
     */
    public function logout() {
        $this->session->unset_userdata([
            'id' => '',
            'name' => '',
            'type' => '',
            'created_at' => ''
        ]);
        $this->session->sess_destroy();
        # arahkan kembali ke home
        redirect(base_url(), 'refresh');
    }

    public function validate() {
        # set data session sebagai tanda bahwa user telah ter otentifikasi
        $this->session->set_userdata([
            'id' => $this->input->get('id'),
            'username' => $this->input->get('username'),
            'token' => $this->input->get('token'),
            'type' => $this->input->get('type')
        ]);
        # arahkan kembali ke home
        redirect(base_url(), 'refresh');
    }

    public function order() {
        $this->load->view('order');
    }
}