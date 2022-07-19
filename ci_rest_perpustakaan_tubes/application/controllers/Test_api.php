<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;
//extends class dari RestController
class Test_api extends RestController {

public function index_get(){
    //testing response
    $response['status'] = true;

    $response['message'] = 'Tes Response';
    //tampil response
    $this->response($response);
}

public function user_get(){
    //test response
    $response['error'] = false;
    $response['user']['username'] = 'Peter';
    $response['user']['email'] = 'peter@poltekpos.ac.id';
    $response['user']['detail']['fullname'] = 'Peter Holland';
    $response['user']['detail']['role'] = 'Programmer';
    $response['user']['detail']['joined_date'] = '2020-02-02';

    //tampil response
    $this->response($response);
}
}
