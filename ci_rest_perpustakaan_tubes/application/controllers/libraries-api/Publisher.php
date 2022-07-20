<?php 

defined('BASEPATH') or exit('No  direct script access allowed');

// import library
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Publisher extends RestController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('publisher_model');
    }

    public function pub_get()
    {
        $publisher_id = $this->get('publisher_id');
        $data = $this->publisher_model->getDatapublisher($publisher_id);
        // Jika variable data terdapat data didalamnya
        if($data){
            $this->response(
                [
                    'data'          => $data,
                    'status'        => 'success',
                    'response_code'   => RestController::HTTP_OK
                ],
                RestController::HTTP_OK
            );
            //jika data tidak ada
        }else {
            $this->response(
                [
                    'status'        => false,
                    'message'       => 'Data Tidak Ada',
                    'response_code' => RestController::HTTP_NOT_FOUND
                ],
                RestController::HTTP_NOT_FOUND
            );
        }
    }

    function pub_post()
    {
        $data = array(
            'publisher_id' => $this->post('publisher_id'),
            'publisher_name' => $this->post('publisher_name')
        );
        
        $cek_data = $this->publisher_model->getDatapublisher($this->post('publisher_id'));

        //Jika semua data wajib diisi
        if (
            $data['publisher_id'] == NULL || 
            $data['publisher_name'] == NULL) {
        $this->response(
        [
            'status' => false,
            'response_code' => RestController::HTTP_BAD_REQUEST,
            'message' => 'Data Yang Dikirim Tidak Boleh Ada Yang Kosong',
        ],
        RestController::HTTP_BAD_REQUEST

        );
        
        //Jika data duplikat
        } else if ($cek_data) {
        $this->response(
            [
                'status' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Data Duplikat',
            ],
            RestController::HTTP_BAD_REQUEST
        );
        //Jika data tersimpan
        } elseif ($this->publisher_model->insertpublisher($data) > 0) {
            $this->response(
            [
                'status' => true,
                'response_code' => RestController::HTTP_CREATED,
                'message' => 'Data Berhasil Ditambahkan',
            ],
            RestController::HTTP_CREATED
            );
        } else {
            $this->response(
            [
                'status' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Gagal Menambahkan Data',
            ],
            RestController::HTTP_BAD_REQUEST
            );
        }
    }

    function pub_put()
    {
        $publisher_id = $this->put('publisher_id');
        $data = array(
            'publisher_name' => $this->put('publisher_name')
        );
        //Jika field publisher_id tidak diisi
        if ($publisher_id == NULL) {
            $this->response(
                [
                    'status' => $publisher_id,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'publisher_id Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
                );
        //Jika data berhasil berubah
        } elseif ($this->publisher_model->updatepublisher($data, $publisher_id) > 0) {
        $this->response(                    
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data publisher Dengan publisher_id '.$publisher_id.' Berhasil Diubah',
                ],
                RestController::HTTP_CREATED
                );
        } else {
                $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Gagal Mengubah Data',
                ],
                RestController::HTTP_BAD_REQUEST
                );
                }
        }
        
        function pub_delete()
        {
        $publisher_id = $this->delete('publisher_id');

        //Jika field publisher_id tidak diisi
        if ($publisher_id == NULL) {
            $this->response(
            [
                'status' => $publisher_id,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'publisher_id Tidak Boleh Kosong',
            ],
            RestController::HTTP_BAD_REQUEST
        );

        //Kondisi ketika OK
        } elseif ($this->publisher_model->deletepublisher($publisher_id) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,    
                    'message' => 'Data publisher Dengan publisher_id '.$publisher_id.' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
                );
                //Kondisi gagal
                } else {
                $this->response(
                [
                'status' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Data publisher Dengan publisher_id '.$publisher_id.' Tidak
                Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
                );
                }
                }
                
}

?>