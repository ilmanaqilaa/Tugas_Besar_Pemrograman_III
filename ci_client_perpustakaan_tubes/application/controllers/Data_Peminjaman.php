<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Peminjaman extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('data_peminjaman_model'); // load model data_peminjaman
        $this->load->library('Form_validation'); // load form data_peminjaman
        $this->load->model('peminjam_model'); // load form peminjam
        $this->load->model('buku_model'); // load form buku
        
    }

    public function index()
    {

        $data['title'] = "List Data data_peminjaman";
        $data['data_peminjaman'] = $this->data_peminjaman_model->getALL();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('data_peminjaman/index',$data);
        $this->load->view('templates/footer');
    }

    public function detail($id_peminjaman)
    {

        $data['title'] = "Detail Data Peminjaman";
        $data['data_peminjaman'] = $this->data_peminjaman_model->getById($id_peminjaman);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu.php');
        $this->load->view('data_peminjaman/detail', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {

        $data['title'] = "Tambah Data Peminjaman";
        $data['data_peminjam'] = $this->peminjam_model->getAll();
        $data['data_buku'] = $this->buku_model->getAll();

        $this->form_validation->set_rules('id_peminjaman', 'id_peminjaman', 'trim|required');
        $this->form_validation->set_rules('alasan_pinjam', 'alasan_pinjam', 'trim|required');
        $this->form_validation->set_rules('tgl_pinjam', 'tgl_pinjam', 'trim|required');
        $this->form_validation->set_rules('tgl_kembali', 'tgl_kembali', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('id_peminjam', 'id_peminjam', 'trim|required');
        $this->form_validation->set_rules('id_buku', 'id_buku', 'trim|required');

        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('data_peminjaman/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                "id_peminjaman"           => $this->input-> post('id_peminjaman'),
                "alasan_pinjam"          => $this->input-> post('alasan_pinjam'),
                "tgl_pinjam" => $this->input-> post('tgl_pinjam'),
                "tgl_kembali"        => $this->input-> post('tgl_kembali'),
                "status"         => $this->input-> post('status'),
                "id_peminjam"         => $this->input-> post('id_peminjam'),
                "id_buku"         => $this->input-> post('id_buku'),
                "KEY"           => "ulbi123"
            ];

            $insert = $this->data_peminjaman_model->save($data);
            if($insert['response_code'] === 201){
                $this->session->set_flashdata('flash', 'Data Ditambahkan');
                redirect('data_peminjaman');
            } elseif ($insert['response_code'] === 400){
                $this->session->set_flashdata('message', 'Data Duplikat BOS!');
                redirect('data_peminjaman');
            } else{
                $this->session->set_flashdata('message', 'Data gagal Ditambahkan ni BOS!');
                redirect('data_peminjaman');
            }
        }

    }
    
    public function edit($id_peminjaman)
    {

        $data['title'] = "Ubah Data data_peminjaman";
        $data['data_peminjaman'] = $this->data_peminjaman_model->getById($id_peminjaman);
        $data['data_peminjam'] = $this->peminjam_model->getAll();
        $data['data_buku'] = $this->buku_model->getAll();

        $this->form_validation->set_rules('id_peminjaman', 'id_peminjaman', 'trim|required');
        $this->form_validation->set_rules('alasan_pinjam', 'alasan_pinjam', 'trim|required');
        $this->form_validation->set_rules('tgl_pinjam', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('tgl_kembali', 'tgl_kembali', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('id_peminjam', 'No HP', 'trim|required');
        $this->form_validation->set_rules('id_buku', 'id_buku', 'trim|required');

        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('data_peminjaman/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                "id_peminjaman"     => $this->input-> post('id_peminjaman'),
                "alasan_pinjam"     => $this->input-> post('alasan_pinjam'),
                "tgl_pinjam"        => $this->input-> post('tgl_pinjam'),
                "tgl_kembali"       => $this->input-> post('tgl_kembali'),
                "status"            => $this->input-> post('status'),
                "id_peminjam"       => $this->input-> post('id_peminjam'),
                "id_buku"           => $this->input-> post('id_buku'),
                "KEY"               => "ulbi123"
            ];

            $update = $this->data_peminjaman_model->update($data);
            if($update['response_code'] === 201){
                $this->session->set_flashdata('flash', 'Data Berhasil Diubah');
                redirect('data_peminjaman');
            } elseif ($update['response_code'] === 400){
                $this->session->set_flashdata('message', 'Data gagal Diubah');
                redirect('data_peminjaman');
            } else{
                $this->session->set_flashdata('message', 'Data gagal Diubah ni BOS!');
                redirect('data_peminjaman');
            }
        }

    }

    public function delete($id_peminjaman)
    {
        $update = $this->data_peminjaman_model->delete($id_peminjaman);
            if($update['response_code'] === 200){
                $this->session->set_flashdata('flash', 'Data Berhasil Dihapus');
                redirect('data_peminjaman');
            } else{
                $this->session->set_flashdata('message', 'Data gagal Dihapus ni BOS!');
                redirect('data_peminjaman');
            }
    }
}