<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {
	
    public function customer() {
        $this->load->view('transaction/customer');
    }

    public function counter() {
        $this->load->view('transaction/counter');
    }
}