<?php 

defined('BASEPATH') or exit('No  direct script access allowed');

// import library
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Book extends RestController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Book_model');
    }

    public function book_get()
    {
        $book_id = $this->get('book_id');
        $data = $this->Book_model->getDataBook($book_id);
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
            'book_id' => $this->post('book_id'),
            'publisher_id' => $this->post('publisher_id'),
            'book_type_id' => $this->post('book_type_id'),
            'rack_id' => $this->post('rack_id'),
            'book_name' => $this->post('book_name'),
            'page' => $this->post('page'),
            'publication_year' => $this->post('publication_year')
        );
        
        $cek_data = $this->Book_model->getDataBook($this->post('book_id'));

        //Jika semua data wajib diisi
        if (
            $data['book_id'] == NULL || 
            $data['publisher_id'] == NULL || 
            $data['book_type_id'] == NULL || 
            $data['rack_id'] == NULL || 
            $data['book_name'] == NULL || 
            $data['page'] == NULL ||
            $data['publication_year'] == NULL ) {
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
        } elseif ($this->Book_model->insertBook($data) > 0) {
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
        $book_id = $this->put('book_id');
        $data = array(
            'publisher_id' => $this->put('publisher_id'),
            'book_type_id' => $this->put('book_type_id'),
            'rack_id' => $this->put('rack_id'),
            'book_name' => $this->put('book_name'),
            'page' => $this->put('page'),
            'publication_year' => $this->put('publication_year')
        );
        //Jika field book_id tidak diisi
        if ($book_id == NULL) {
            $this->response(
                [
                    'status' => $book_id,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'book_id Tidak Boleh Kosong',
                ],
                RestController::HTTP_BAD_REQUEST
                );
        //Jika data berhasil berubah
        } elseif ($this->Book_model->updateBook($data, $book_id) > 0) {
        $this->response(                    
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data Book Dengan book_id '.$book_id.' Berhasil Diubah',
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
        $book_id = $this->delete('book_id');

        //Jika field book_id tidak diisi
        if ($book_id == NULL) {
            $this->response(
            [
                'status' => $book_id,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'book_id Tidak Boleh Kosong',
            ],
            RestController::HTTP_BAD_REQUEST
        );

        //Kondisi ketika OK
        } elseif ($this->Book_model->deleteBook($book_id) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,    
                    'message' => 'Data Book Dengan book_id '.$book_id.' Berhasil Dihapus',
                ],
                RestController::HTTP_OK
                );
                //Kondisi gagal
                } else {
                $this->response(
                [
                'status' => false,
                'response_code' => RestController::HTTP_BAD_REQUEST,
                'message' => 'Data Book Dengan book_id '.$book_id.' Tidak Ditemukan',
                ],
                RestController::HTTP_BAD_REQUEST
                );
                }
                }
                
}

?>