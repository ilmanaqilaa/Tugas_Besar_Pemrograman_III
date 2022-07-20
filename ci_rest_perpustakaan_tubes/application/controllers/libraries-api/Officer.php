<?php
defined('BASEPATH') or exit('No direct script access allowed');

//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Officer extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Officer_model');
    }

    //fungsi CRUD (GET, POST, PUT, DELETE) simpan di bawah sini
    public function off_get()
    {
        $id = $this->get('officer_id');
        $data = $this->Officer_model->getOfficer($id);

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
    public function off_post()
    {
        $data = array(
            'officer_id' => $this->post('officer_id'),
            'officer_name' => $this->post('officer_name'),
            'phone' => $this->post('phone'),
            'gender' => $this->post('gender')
        );

        $cek_data = $this->Officer_model->getOfficer($this->post('officer_id'));
        
        //Jika semua data wajib diisi
        if ($data['officer_id'] == NULL || $data['officer_name'] == NULL || $data['phone'] == NULL  || $data['gender'] == NULL ) {
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
        } elseif ($this->Officer_model->insertOfficer($data) > 0) {
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
    function off_put()
    {
        $id = $this->put('officer_id');
        $data = array(
            'officer_id' => $this->put('officer_id'),
            'officer_name' => $this->put('officer_name'),
            'phone' => $this->put('phone'),
            'gender' => $this->put('gender')

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
        } elseif ($this->Officer_model->updateOfficer($data, $id) > 0) {
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
    function off_delete()
    {
        $id = $this->delete('officer_id');
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
        } elseif ($this->Officer_model->deleteOfficer($id) > 0) {
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