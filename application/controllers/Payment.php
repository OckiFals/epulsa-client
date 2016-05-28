<?php

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Payment_model');
        $this->load->model('Reservation_model');
        $this->load->model('Po_model');
    }

    /**
     * Halaman data pembayaran
     * 
     * @target: Agent
     * @method: GET
     * @route: /payment  
     */
    public function index() {
        $graphic_incomes = [];
        $data = $this->Payment_model->getByYear();
        for ($i=0; $i<count($data); $i++) {
            $graphic_incomes[$data[$i]->month] = $data[$i]->count;
        }
        
        $this->load->view('all-onsales-data', [
            'reservations' => $this->Po_model->getReservations(),
            'graphic_incomes' => $graphic_incomes,
            'total_income' => $this->Po_model->getIncomeThisMonth()->total_income,
        ]);
    }

    public function sumByYear() {
        
    }

    public function sumByMonth() {
        
    }

}
