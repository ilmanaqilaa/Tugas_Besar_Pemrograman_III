<?php
defined('BASEPATH') or exit('No direct script access allowed');

//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Borrower extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Borrower_model');
    }

    //fungsi CRUD (GET, POST, PUT, DELETE) simpan di bawah sini
    public function bor_get()
    {
        $id = $this->get('borrower_id');
        $data = $this->Borrower_model->getBorrower($id);

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
    public function bor_post()
    {
        $data = array(
            'borrower_id' => $this->post('borrower_id'),
            'name' => $this->post('name'),
            'gender' => $this->post('gender'),
            'phone' => $this->post('phone'),
            'address' => $this->post('address'),
            'study_program' => $this->post('study_program'),
            'class' => $this->post('class')
        );

        $cek_data = $this->Borrower_model->getBorrower($this->post('borrower_id'));
        
        //Jika semua data wajib diisi
        if ($data['borrower_id'] == NULL || $data['name'] == NULL 
        || $data['gender'] == NULL || $data['phone'] == NULL 
        || $data['study_program'] == NULL || $data['class'] == NULL) {
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
        } elseif ($this->Borrower_model->insertBorrower($data) > 0) {
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
    function bor_put()
    {
        $id = $this->put('borrower_id');
        $data = array(
            'borrower_id' => $this->put('borrower_id'),
            'name' => $this->put('name'),
            'gender' => $this->put('gender'),
            'phone' => $this->put('phone'),
            'address' => $this->put('address'),
            'study_program' => $this->put('study_program'),
            'class' => $this->put('class')

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
        } elseif ($this->Borrower_model->updateBorrower($data, $id) > 0) {
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
    function bor_delete()
    {
        $id = $this->delete('borrower_id');
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
        } elseif ($this->Borrower_model->deleteBorrower($id) > 0) {
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