<?php

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Schedule_model');
        $this->load->model('Bus_model');
        $this->load->model('Test_model');
    }

    /**
     * Form tambah jadwal
     *
     * @target: Admin
     * @method: POST, GET
     * @route: /schedule/add
     */
    public function tambah_jadwal() {
        
        try {
            # test case
            $post = [
                'bus' => 'Mayasari Bhakti (ID: 5)',
                'day' => 'friday-5',
                'time' => '09:15'
            ];
            
                # set zona waktu lokal
            date_default_timezone_set('Asia/Jakarta');
                # ambil !D bus
            $bus = substr($post['bus'], strpos(
                $post['bus'], ':'
                ) + 2, -1
            );
            /**
            * monday-1 senin, tuesday-2 selasa, dst...
            * Jika input post hari adalah tuesday-2 maka akan
            * di explode menjadi [0] => 'tuesday', [1] => 2
            */
            $schedule_day = explode('-', $post['day']);
            $schedule_time = date('H:i:s', strtotime($post['time']));
            $startDateSource = strtotime("next {$schedule_day[0]}");
            $startDate = date('Y-m-d', $startDateSource);
            # simpan 1 jadwal pertama dalam database
            $this->Schedule_model->create($bus, "{$startDate} {$schedule_time}");
            $dateNext = $startDateSource;
            $i = 0;
            for (; $i < 11; $i++) {
                # simpan 11 jadwal sisanya dalam database
                $this->Schedule_model->create($bus, date('Y-m-d', strtotime('+1 week', $dateNext)) . ' ' . $schedule_time);
                $dateNext = strtotime('+1 week', $dateNext);
            }

            echo 'Data jadwal berhasil ditambahkan!';
        } catch(Exception $e) {
            echo 'Terjadi galat!';
            var_dump($e);
        }
            

    }

    public function tambah_pesanan() {
        try {
            $schedule_id = 34;
            $ticket_count = 1;

            $post = [
                # data pesanan
                'q' => 34,
                'customer_name' => 'Dyah Pitaloka R C',
                'customer_phone' => '0856778898',
                # data tiket
                'passenger_name_1' => 'Dyah Pitaloka R C',
                'passenger_id_1' => '1351502000022',
                'passenger_birth_1' => '1998/02/23'
            ];

            $booking_code = $this->Test_model->tambah_pesanan($post);

            for ($i=1; $i < $ticket_count+1; $i++) { 
                $passenger_name = $post["passenger_name_{$i}"];
                $passenger_id = $post["passenger_id_{$i}"];
                $passenger_birth = $post["passenger_birth_{$i}"];

                $this->Test_model->tambah_tiket(
                    $schedule_id,
                    $passenger_name,
                    $passenger_id,
                    $passenger_birth
                );
            }

            echo "Pesanan telah dikirim dengan kode booking: <br>";
            # simpan informasi 'Pesanan telah dikirim' kedalam session
            # generate booking_code 
            echo $booking_code;
        } catch(Exception $e) {
            echo "Terjadi galat!";
            var_dump($e);
        }
    }

    public function validasi_pembayaran() {
        
        $this->Test_model->validasi_pembayaran($this->input->get('code'));
            echo "Pembayaran dengan kode booking <strong>" .
                $this->input->get('code') .
            "</strong> telah divalidasi!";
            
    }
}
