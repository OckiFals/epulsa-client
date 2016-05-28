<?php

class Po extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Po_model');
    }

    public function index() {
    	echo json_encode($this->Po_model->getAll());
    }
}