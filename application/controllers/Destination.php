<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Destination extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Destination_model');
    }
    
    /**
     * Mencetak semua kota dalam bentuk JSON
     *
     * Digunakan oleh ADMIN ketika melakukan tambah bus atau ubah bus
     * semua kota-kota yang telah didefinisikan
     * data yang disajikan bagi fitur autocomplete pada field tujuan 
     * 
     * @target: all
     * @route: /destination
     */
    public function index() {
        echo json_encode($this->Destination_model->getAll());
    }

    /**
     * Mencetak kota yang berelasi dengan bus dalam bentuk JSON
     *
     * Digunakan untuk fitur autocomplete field cari tiket
     * tidak semua nama kota dihadirkan 
     * hanya nama kota-kota yang telah memiliki rute bus
     * 
     * Lihat home.php
     * 
     * @target: all
     * @route: /destination/busjoin
     */
    public function busJoin() {
        echo json_encode($this->Destination_model->getBusJoin());
    }

}
