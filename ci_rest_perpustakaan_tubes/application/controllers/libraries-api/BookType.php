<?php
defined('BASEPATH') or exit('No direct script access allowed');

//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class BookType extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BookType_model');
    }

    //fungsi CRUD (GET, POST, PUT, DELETE) simpan di bawah sini
    public function bty_get()
    {
        $id = $this->get('book_type_id');
        $data = $this->BookType_model->getBookType($id);

        //Jika Variable $data terdapat data di dalamnya

        if ($data) {
            $this->response(
                [
                    'data' => $data,
                    'status' => 'success',
                    'response_code' => RestController::HTTP_OK
                ],
                RestController::HTTP_OK
            );
            //Jika data tidak ada
        } else {
            $this->response(
                [
                    'status' => false,
                    'massage' => 'Data not available',
                    'response_code' => RestController::HTTP_NOT_FOUND
                ],
                RestController::HTTP_NOT_FOUND
            );
        }
    }
    public function bty_post()
    {
        $data = array(
            'book_type_id' => $this->post('book_type_id'),
            'book_type_name' => $this->post('book_type_name')
        );

        $cek_data = $this->BookType_model->getBookType($this->post('book_type_id'));
        
        //Jika semua data wajib diisi
        if ($data['book_type_id'] == NULL || $data['book_type_name'] == NULL) {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'There must be no blank data!',
                ],
                RestController::HTTP_BAD_REQUEST
            );

            //Jika data duplikat
        } else if ($cek_data) {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Data Duplicate',
                ],
                RestController::HTTP_BAD_REQUEST
            );

            //Jika data tersimpan
        } elseif ($this->BookType_model->insertBookType($data) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Data added successfully!',
                ],
                RestController::HTTP_CREATED
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Failed to add data!',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }
    function bty_put()
    {
        $id = $this->put('book_type_id');
        $data = array(
            'book_type_id' => $this->put('book_type_id'),
            'book_type_name' => $this->put('book_type_name')

        );
        //Jika field Barang tidak diisi
        if ($id == NULL) {
            $this->response(
                [
                    'status' => $id,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'ID cannot be empty!',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Jika data berhasil berubah
        } elseif ($this->BookType_model->updateBookType($data, $id) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_CREATED,
                    'message' => 'Item data with item ID' . $id . ' successfully changed!',
                ],
                RestController::HTTP_CREATED
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Failed to modify data!',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }
    function bty_delete()
    {
        $id = $this->delete('book_type_id');
        //Jika field Barang tidak diisi
        if ($id == NULL) {
            $this->response(
                [
                    'status' => $id,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'ID cannot be empty!',
                ],
                RestController::HTTP_BAD_REQUEST
            );
            //Kondisi ketika OK
        } elseif ($this->BookType_model->deleteBookType($id) > 0) {
            $this->response(
                [
                    'status' => true,
                    'response_code' => RestController::HTTP_OK,
                    'message' => 'Item data with item ID' . $id . ' successfully changed!',
                ],
                RestController::HTTP_OK
            );
            //Kondisi gagal
        } else {
            $this->response(
                [
                    'status' => false,
                    'response_code' => RestController::HTTP_BAD_REQUEST,
                    'message' => 'Item data with item ID' . $id . ' not found',
                ],
                RestController::HTTP_BAD_REQUEST
            );
        }
    }
}