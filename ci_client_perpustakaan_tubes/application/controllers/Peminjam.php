<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjam extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('peminjam_model'); // load model peminjam
        $this->load->library('Form_validation'); // load form peminjam
        
    }

    public function index()
    {

        $data['title'] = "List Data peminjam";
        $data['peminjam'] = $this->peminjam_model->getALL();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('peminjam/index',$data);
        $this->load->view('templates/footer');
    }

    public function detail($id_peminjam)
    {

        $data['title'] = "Detail Data peminjam";
        $data['peminjam'] = $this->peminjam_model->getById($id_peminjam);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu.php');
        $this->load->view('peminjam/detail', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {

        $data['title'] = "Tambah Data peminjam";
        $data['data_peminjam'] =  

        $this->form_validation->set_rules('id_peminjam', 'id_peminjam', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('jk', 'jk', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'trim|required|numeric');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('peminjam/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                "id_peminjam"           => $this->input-> post('id_peminjam'),
                "nama"          => $this->input-> post('nama'),
                "jk" => $this->input-> post('jk'),
                "no_telp"        => $this->input-> post('no_telp'),
                "alamat"         => $this->input-> post('alamat'),
                "KEY"           => "ulbi123"
            ];

            $insert = $this->peminjam_model->save($data);
            if($insert['response_code'] === 201){
                $this->session->set_flashdata('flash', 'Data Ditambahkan');
                redirect('peminjam');
            } elseif ($insert['response_code'] === 400){
                $this->session->set_flashdata('message', 'Data Duplikat BOS!');
                redirect('peminjam');
            } else{
                $this->session->set_flashdata('message', 'Data gagal Ditambahkan ni BOS!');
                redirect('peminjam');
            }
        }

    }
    
    public function edit($id_peminjam)
    {

        $data['title'] = "Ubah Data peminjam";
        $data['peminjam'] = $this->peminjam_model->getById($id_peminjam);

        $this->form_validation->set_rules('id_peminjam', 'id_peminjam', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'trim|required|numeric');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('peminjam/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                "id_peminjam"     => $this->input-> post('id_peminjam'),
                "nama"     => $this->input-> post('nama'),
                "jk"        => $this->input-> post('jk'),
                "no_telp"       => $this->input-> post('no_telp'),
                "alamat"            => $this->input-> post('alamat'),
                "KEY"               => "ulbi123"
            ];

            $update = $this->peminjam_model->update($data);
            if($update['response_code'] === 201){
                $this->session->set_flashdata('flash', 'Data Berhasil Diubah');
                redirect('peminjam');
            } elseif ($update['response_code'] === 400){
                $this->session->set_flashdata('message', 'Data gagal Diubah');
                redirect('peminjam');
            } else{
                $this->session->set_flashdata('message', 'Data gagal Diubah ni BOS!');
                redirect('peminjam');
            }
        }

    }

    public function delete($id_peminjam)
    {
        $update = $this->peminjam_model->delete($id_peminjam);
            if($update['response_code'] === 200){
                $this->session->set_flashdata('flash', 'Data Berhasil Dihapus');
                redirect('peminjam');
            } else{
                $this->session->set_flashdata('message', 'Data gagal Dihapus ni BOS!');
                redirect('peminjam');
            }
    }
}