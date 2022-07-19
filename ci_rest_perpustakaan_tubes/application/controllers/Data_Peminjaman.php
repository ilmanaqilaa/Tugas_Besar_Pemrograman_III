<?php 

defined('BASEPATH') or exit('No  direct script access allowed');

// import library
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Data_Peminjaman extends RestController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_Peminjaman_model');
    }

    public function pmjmn_get()
    {
        $id_peminjaman = $this->get('id_peminjaman');
        $data = $this->Data_Peminjaman_model->getDataPeminjam($id_peminjaman);
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

    function pmjmn_post()
    {
        $data = array(
            'id_peminjaman' => $this->post('id_peminjaman'),
            'alasan_pinjam' => $this->post('alasan_pinjam'),
            'tgl_pinjam' => $this->post('tgl_pinjam'),
            'tgl_kembali' => $this->post('tgl_kembali'),
            'status' => $this->post('status'),
            'id_peminjam' => $this->post('id_peminjam'),
            'id_buku' => $this->post('id_buku')
        );
        
        $cek_data = $this->Data_Peminjaman_model->getDataPeminjam($this->post('id_peminjaman'));

        //Jika semua data wajib diisi
        if (
            $data['id_peminjaman'] == NULL || 
            $data['alasan_pinjam'] == NULL || 
            $data['tgl_pinjam'] == NULL || 
            $data['tgl_kembali'] == NULL || 
            $data['status'] == NULL || 
            $data['id_peminjam'] == NULL || 
            $data['id_buku'] == NULL) {
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
        } elseif ($this->Data_Peminjaman_model->insertPeminjam($data) > 0) {
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

    function pmjmn_put()
    {
        $id_peminjaman = $this->put('id_peminjaman');
        $data = array(
            'alasan_pinjam' => $this->put('alasan_pinjam'),
            'tgl_pinjam' => $this->put('tgl_pinjam'),
            'tgl_kembali' => $this->put('tgl_kembali'),
            'status' => $this->put('status'),
            'id_peminjam' => $this->put('id_peminjam'),
            'id_buku' => $this->put('id_buku')
        );
        //Jika field id_peminjaman tidak diisi
        if ($id_peminjaman == NULL) {
            $this->response(
                [
                    'status' => $id_peminjaman,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'id_peminjaman Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
                );
        //Jika data berhasil berubah
        } elseif ($this->Data_Peminjaman_model->updatePeminjam($data, $id_peminjaman) > 0) {
        $this->response(                    
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Peminjam Dengan id_peminjaman '.$id_peminjaman.' Berhasil Diubah',
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
        
        function pmjmn_delete()
        {
        $id_peminjaman = $this->delete('id_peminjaman');

        //Jika field id_peminjaman tidak diisi
        if ($id_peminjaman == NULL) {
            $this->response(
            [
                'status' => $id_peminjaman,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'id_peminjaman Tidak Boleh Kosong',
            ],
            RestController::HTTP_BAD_REQUEST
        );

        //Kondisi ketika OK
        } elseif ($this->Data_Peminjaman_model->deletePeminjam($id_peminjaman) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,    
                    'message' => 'Data Peminjam Dengan id_peminjaman '.$id_peminjaman.' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
                );
                //Kondisi gagal
                } else {
                $this->response(
                [
                'status' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Data Peminjam Dengan id_peminjaman '.$id_peminjaman.' Tidak Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
                );
                }
                }
                
}

?>