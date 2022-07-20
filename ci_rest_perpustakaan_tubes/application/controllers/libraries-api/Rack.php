<?php
defined('BASEPATH') or exit('No direct script access allowed');

//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Rack extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rack_model');
    }

    //fungsi CRUD (GET, POST, PUT, DELETE) simpan di bawah sini
    public function rack_get()
    {
        $id = $this->get('rack_id');
        $data = $this->Rack_model->getRack($id);

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
    public function rack_post()
    {
        $data = array(
            'rack_id' => $this->post('rack_id'),
            'rack_name' => $this->post('rack_name'),
            'rack' => $this->post('rack'),
            'coloumn' => $this->post('coloumn')
        );

        $cek_data = $this->Rack_model->getRack($this->post('rack_id'));
        
        //Jika semua data wajib diisi
        if ($data['rack_id'] == NULL || $data['rack_name'] == NULL 
        || $data['rack'] == NULL || $data['coloumn'] == NULL) {
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
        } elseif ($this->Rack_model->insertRack($data) > 0) {
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
    function rack_put()
    {
        $id = $this->put('rack_id');
        $data = array(
            'rack_id' => $this->put('rack_id'),
            'book_type_name' => $this->put('book_type_name'),
            'rack' => $this->put('rack'),
            'coloumn' => $this->put('coloumn')

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
        } elseif ($this->Rack_model->updateRack($data, $id) > 0) {
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
    function rack_delete()
    {
        $id = $this->delete('rack_id');
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
        } elseif ($this->Rack_model->deleteRack($id) > 0) {
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