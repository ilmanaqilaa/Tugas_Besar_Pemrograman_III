<?php 

defined('BASEPATH') or exit('No  direct script access allowed');

// import library
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Jenis_Buku extends RestController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jenis_buku_model');
    }

    public function jns_get()
    {
        $id_jenis_buku = $this->get('id_jenis_buku');
        $data = $this->jenis_buku_model->getDatajenis_buku($id_jenis_buku);
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

    function jns_post()
    {
        $data = array(
            'id_jenis_buku' => $this->post('id_jenis_buku'),
            'nama_jenis_buku' => $this->post('nama_jenis_buku')
        );
        
        $cek_data = $this->jenis_buku_model->getDatajenis_buku($this->post('id_jenis_buku'));

        //Jika semua data wajib diisi
        if (
            $data['id_jenis_buku'] == NULL || 
            $data['nama_jenis_buku'] == NULL) {
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
        } elseif ($this->jenis_buku_model->insertjenis_buku($data) > 0) {
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

    function jns_put()
    {
        $id_jenis_buku = $this->put('id_jenis_buku');
        $data = array(
            'nama_jenis_buku' => $this->put('nama_jenis_buku')
        );
        //Jika field id_jenis_buku tidak diisi
        if ($id_jenis_buku == NULL) {
            $this->response(
                [
                    'status' => $id_jenis_buku,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_jenis_buku Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
                );
        //Jika data berhasil berubah
        } elseif ($this->jenis_buku_model->updatejenis_buku($data, $id_jenis_buku) > 0) {
        $this->response(                    
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data jenis_buku Dengan id_jenis_buku '.$id_jenis_buku.' Berhasil Diubah',
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
        
        function jns_delete()
        {
        $id_jenis_buku = $this->delete('id_jenis_buku');

        //Jika field id_jenis_buku tidak diisi
        if ($id_jenis_buku == NULL) {
            $this->response(
            [
                'status' => $id_jenis_buku,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'id_jenis_buku Tidak Boleh Kosong',
            ],
            RestController::HTTP_BAD_REQUEST
        );

        //Kondisi ketika OK
        } elseif ($this->jenis_buku_model->deletejenis_buku($id_jenis_buku) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,    
                    'message' => 'Data jenis_buku Dengan id_jenis_buku '.$id_jenis_buku.' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
                );
                //Kondisi gagal
                } else {
                $this->response(
                [
                'status' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Data jenis_buku Dengan id_jenis_buku '.$id_jenis_buku.' Tidak
                Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
                );
                }
                }
                
}

?>