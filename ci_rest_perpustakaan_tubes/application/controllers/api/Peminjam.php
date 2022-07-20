<?php 

defined('BASEPATH') or exit('No  direct script access allowed');

// import library
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Peminjam extends RestController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('peminjam_model');
    }

    public function lender_get()
    {
        $id_peminjam = $this->get('id_peminjam');
        $data = $this->peminjam_model->getDatapeminjam($id_peminjam);
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
                    'response_code' => ResController::HTTP_NOT_FOUND
                ],
                RestController::HTTP_NOT_FOUND
            );
        }
    }

    function lender_post()
    {
        $data = array(
            'id_peminjam' => $this->post('id_peminjam'),
            'nama' => $this->post('nama'),
            'jk' => $this->post('jk'),
            'no_telp' => $this->post('no_telp'),
            'alamat' => $this->post('alamat')
        );
        
        $cek_data = $this->peminjam_model->getDatapeminjam($this->post('id_peminjam'));

        //Jika semua data wajib diisi
        if (
            $data['id_peminjam'] == NULL || 
            $data['nama'] == NULL || 
            $data['jk'] == NULL || 
            $data['no_telp'] == NULL || 
            $data['alamat'] == NULL) {
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
        } elseif ($this->peminjam_model->insertpeminjam($data) > 0) {
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

    function lender_put()
    {
        $id_peminjam = $this->put('id_peminjam');
        $data = array(
            'nama' => $this->put('nama'),
            'jk' => $this->put('jk'),
            'no_telp' => $this->put('no_telp'),
            'alamat' => $this->put('alamat')
        );
        //Jika field id_peminjam tidak diisi
        if ($id_peminjam == NULL) {
            $this->response(
                [
                    'status' => $id_peminjam,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_peminjam Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
                );
        //Jika data berhasil berubah
        } elseif ($this->peminjam_model->updatepeminjam($data, $id_peminjam) > 0) {
        $this->response(                    
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data peminjam Dengan id_peminjam '.$id_peminjam.' Berhasil Diubah',
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
        
        function lender_delete()
        {
        $id_peminjam = $this->delete('id_peminjam');

        //Jika field id_peminjam tidak diisi
        if ($id_peminjam == NULL) {
            $this->response(
            [
                'status' => $id_peminjam,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'id_peminjam Tidak Boleh Kosong',
            ],
            RestController::HTTP_BAD_REQUEST
        );

        //Kondisi ketika OK
        } elseif ($this->peminjam_model->deletepeminjam($id_peminjam) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,    
                    'message' => 'Data peminjam Dengan id_peminjam '.$id_peminjam.' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
                );
                //Kondisi gagal
                } else {
                $this->response(
                [
                'status' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Data peminjam Dengan id_peminjam '.$id_peminjam.' Tidak
                Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
                );
                }
                }
                
}

?>