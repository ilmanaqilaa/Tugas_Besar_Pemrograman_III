<?php 

defined('BASEPATH') or exit('No  direct script access allowed');

// import library
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Buku extends RestController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Buku_model');
    }

    public function book_get()
    {
        $id_buku = $this->get('id_buku');
        $data = $this->Buku_model->getDataBuku($id_buku);
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

    function book_post()
    {
        $data = array(
            'id_buku' => $this->post('id_buku'),
            'nama_buku' => $this->post('nama_buku'),
            'halaman_buku' => $this->post('halaman_buku'),
            'penerbit' => $this->post('penerbit'),
            'tahun_terbit' => $this->post('tahun_terbit'),
            'id_jenis_buku' => $this->post('id_jenis_buku')
        );
        
        $cek_data = $this->Buku_model->getDataBuku($this->post('id_buku'));

        //Jika semua data wajib diisi
        if (
            $data['id_buku'] == NULL || 
            $data['nama_buku'] == NULL || 
            $data['halaman_buku'] == NULL || 
            $data['penerbit'] == NULL || 
            $data['tahun_terbit'] == NULL || 
            $data['id_jenis_buku'] == NULL) {
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
        } elseif ($this->Buku_model->insertBuku($data) > 0) {
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

    function book_put()
    {
        $id_buku = $this->put('id_buku');
        $data = array(
            'nama_buku' => $this->put('nama_buku'),
            'halaman_buku' => $this->put('halaman_buku'),
            'penerbit' => $this->put('penerbit'),
            'tahun_terbit' => $this->put('tahun_terbit'),
            'id_jenis_buku' => $this->put('id_jenis_buku')
        );
        //Jika field id_buku tidak diisi
        if ($id_buku == NULL) {
            $this->response(
                [
                    'status' => $id_buku,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_buku Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
                );
        //Jika data berhasil berubah
        } elseif ($this->Buku_model->updateBuku($data, $id_buku) > 0) {
        $this->response(                    
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Buku Dengan id_buku '.$id_buku.' Berhasil Diubah',
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
        
        function book_delete()
        {
        $id_buku = $this->delete('id_buku');

        //Jika field id_buku tidak diisi
        if ($id_buku == NULL) {
            $this->response(
            [
                'status' => $id_buku,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'id_buku Tidak Boleh Kosong',
            ],
            RestController::HTTP_BAD_REQUEST
        );

        //Kondisi ketika OK
        } elseif ($this->Buku_model->deleteBuku($id_buku) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,    
                    'message' => 'Data Buku Dengan id_buku '.$id_buku.' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
                );
                //Kondisi gagal
                } else {
                $this->response(
                [
                'status' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Data Buku Dengan id_buku '.$id_buku.' Tidak Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
                );
                }
                }
                
}

?>