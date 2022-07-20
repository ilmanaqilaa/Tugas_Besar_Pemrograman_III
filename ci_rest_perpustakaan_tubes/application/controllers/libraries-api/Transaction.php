<?php 

defined('BASEPATH') or exit('No  direct script access allowed');

// import library
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Transaction extends RestController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction_model');
    }

    public function trans_get()
    {
        $transaction_id = $this->get('transaction_id');
        $data = $this->transaction_model->getDatatransaction($transaction_id);
        // Jika variable data terdapat data didalamnya
        if($data){
            $this->response(
                [
                    'data'          => $data,
                    'stat'        => 'success',
                    'response_code'   => RestController::HTTP_OK
                ],
                RestController::HTTP_OK
            );
            //jika data tidak ada
        }else {
            $this->response(
                [
                    'stat'        => false,
                    'message'       => 'Data Tidak Ada',
                    'response_code' => RestController::HTTP_NOT_FOUND
                ],
                RestController::HTTP_NOT_FOUND
            );
        }
    }

    function trans_post()
    {
        $data = array(
            'transaction_id' => $this->post('transaction_id'),
            'book_id' => $this->post('book_id'),
            'officer_id' => $this->post('officer_id'),
            'borrower_id' => $this->post('borrower_id'),
            'borrow_date' => $this->post('borrow_date'),
            'return_date' => $this->post('return_date'),
            'status' => $this->post('status')
        );
        
        $cek_data = $this->transaction_model->getDatatransaction($this->post('transaction_id'));

        //Jika semua data wajib diisi
        if (
            $data['transaction_id'] == NULL || 
            $data['book_id'] == NULL || 
            $data['officer_id'] == NULL || 
            $data['borrower_id'] == NULL || 
            $data['borrow_date'] == NULL || 
            $data['return_date'] == NULL || 
            $data['status'] == NULL) {
        $this->response(
        [
            'borrow_date' => false,
            'response_code' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Data Yang Dikirim Tidak Boleh Ada Yang Kosong',
        ],
        RestController::HTTP_BAD_REQUEST

        );
        
        //Jika data duplikat
        } else if ($cek_data) {
        $this->response(
            [
                'stat' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Data Duplikat',
            ],
            RestController::HTTP_BAD_REQUEST
        );
        //Jika data tersimpan
        } elseif ($this->transaction_model->inserttransaction($data) > 0) {
            $this->response(
            [
                'stat' => true,
                'response_code' => RestController::HTTP_CREATED,
                'message' => 'Data Berhasil Ditambahkan',
            ],
            RestController::HTTP_CREATED
            );
        } else {
            $this->response(
            [
                'borrow_date' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Gagal Menambahkan Data',
            ],
            RestController::HTTP_BAD_REQUEST
            );
        }
    }

    function trans_put()
    {
        $transaction_id = $this->put('transaction_id');
        $data = array(
            'book_id' => $this->put('book_id'),
            'officer_id' => $this->put('officer_id'),
            'borrower_id' => $this->put('borrower_id'),
            'borrow_date' => $this->put('borrow_date'),
            'return_date' => $this->put('return_date'),
            'status' => $this->put('status')
        );
        //Jika field transaction_id tidak diisi
        if ($transaction_id == NULL) {
            $this->response(
                [
                    'stat' => $transaction_id,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'transaction_id Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
                );
        //Jika data berhasil berubah
        } elseif ($this->transaction_model->updatetransaction($data, $transaction_id) > 0) {
        $this->response(                    
                [
                    'stat' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data transaction Dengan transaction_id '.$transaction_id.' Berhasil Diubah',
                ],
                RestController::HTTP_CREATED
                );
        } else {
                $this->response(
                [
                    'stat' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Gagal Mengubah Data',
                ],
                RestController::HTTP_BAD_REQUEST
                );
                }
        }
        
        function trans_delete()
        {
        $transaction_id = $this->delete('transaction_id');

        //Jika field transaction_id tidak diisi
        if ($transaction_id == NULL) {
            $this->response(
            [
                'borrow_date' => $transaction_id,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'transaction_id Tidak Boleh Kosong',
            ],
            RestController::HTTP_BAD_REQUEST
        );

        //Kondisi ketika OK
        } elseif ($this->transaction_model->deletetransaction($transaction_id) > 0) {
            $this->response(
                [
                    'borrow_date' => true,
                    'response_code' => RestController::HTTP_OK,    
                    'message' => 'Data transaction Dengan transaction_id '.$transaction_id.' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
                );
                //Kondisi gagal
                } else {
                $this->response(
                [
                'borrow_date' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Data transaction Dengan transaction_id '.$transaction_id.' Tidak Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
                );
                }
                }
                
}

?>