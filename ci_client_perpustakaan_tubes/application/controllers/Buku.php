<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('buku_model'); // load model buku
        $this->load->library('Form_validation'); // load form buku
        
    }

    public function index()
    {

        $data['title'] = "List Data buku";
        $data['buku'] = $this->buku_model->getALL();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('buku/index',$data);
        $this->load->view('templates/footer');
    }

    public function detail($id_buku)
    {

        $data['title'] = "Detail Data buku";
        $data['buku'] = $this->buku_model->getById($id_buku);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu.php');
        $this->load->view('buku/detail', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {

        $data['title'] = "Tambah Data buku";
        $data['data_buku'] =  

        $this->form_validation->set_rules('id_buku', 'id_buku', 'trim|required');
        $this->form_validation->set_rules('nama_buku', 'nama_buku', 'trim|required');
        $this->form_validation->set_rules('halaman_buku', 'halaman_buku', 'trim|required');
        $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
        $this->form_validation->set_rules('tahun_terbit', 'tahun_terbit', 'trim|required');
        $this->form_validation->set_rules('id_jenis_buku', 'id_jenis_buku', 'trim|required');

        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('buku/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                "id_buku"           => $this->input-> post('id_buku'),
                "nama_buku"          => $this->input-> post('nama_buku'),
                "halaman_buku" => $this->input-> post('halaman_buku'),
                "penerbit"         => $this->input-> post('penerbit'),
                "tahun_terbit"         => $this->input-> post('tahun_terbit'),
                "id_jenis_buku"         => $this->input-> post('id_jenis_buku'),
                "KEY"           => "ulbi123"
            ];

            $insert = $this->buku_model->save($data);
            if($insert['response_code'] === 201){
                $this->session->set_flashdata('flash', 'Data Ditambahkan');
                redirect('buku');
            } elseif ($insert['response_code'] === 400){
                $this->session->set_flashdata('message', 'Data Duplikat BOS!');
                redirect('buku');
            } else{
                $this->session->set_flashdata('message', 'Data gagal Ditambahkan ni BOS!');
                redirect('buku');
            }
        }

    }
    
    public function edit($id_buku)
    {

        $data['title'] = "Ubah Data buku";
        $data['buku'] = $this->buku_model->getById($id_buku);

        $this->form_validation->set_rules('id_buku', 'id_buku', 'trim|required');
        $this->form_validation->set_rules('nama_buku', 'nama_buku', 'trim|required');
        $this->form_validation->set_rules('halaman_buku', 'halaman_buku', 'trim|required');
        $this->form_validation->set_rules('penerbit', 'penerbit', 'trim|required');
        $this->form_validation->set_rules('tahun_terbit', 'tahun_terbit', 'trim|required');
        $this->form_validation->set_rules('id_jenis_buku', 'id_jenis_buku', 'trim|required');

        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('buku/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                "id_buku"     => $this->input-> post('id_buku'),
                "nama_buku"     => $this->input-> post('nama_buku'),
                "halaman_buku"        => $this->input-> post('halaman_buku'),
                "penerbit"       => $this->input-> post('penerbit'),
                "tahun_terbit"            => $this->input-> post('tahun_terbit'),
                "id_jenis_buku"            => $this->input-> post('id_jenis_buku'),
                "KEY"               => "ulbi123"
            ];

            $update = $this->buku_model->update($data);
            if($update['response_code'] === 201){
                $this->session->set_flashdata('flash', 'Data Berhasil Diubah');
                redirect('buku');
            } elseif ($update['response_code'] === 400){
                $this->session->set_flashdata('message', 'Data gagal Diubah');
                redirect('buku');
            } else{
                $this->session->set_flashdata('message', 'Data gagal Diubah ni BOS!');
                redirect('buku');
            }
        }

    }

    public function delete($id_buku)
    {
        $update = $this->buku_model->delete($id_buku);
            if($update['response_code'] === 200){
                $this->session->set_flashdata('flash', 'Data Berhasil Dihapus');
                redirect('buku');
            } else{
                $this->session->set_flashdata('message', 'Data gagal Dihapus ni BOS!');
                redirect('buku');
            }
    }
}