<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Data_Peminjaman_model extends CI_model
{
    private $_table_peminjaman = 'data_peminjaman';

    //Get data Peminjam
    public function getDataPeminjam($id_peminjaman)
    {
        //menggunakan query builder
        $this->db->from($this->_table_peminjaman);
        if($id_peminjaman){
            $this->db->where('id_peminjaman', $id_peminjaman);
        }
            $this->db->join('buku', 'data_peminjaman.id_buku = buku.id_buku');
            $this->db->join('jenis_buku', 'buku.id_jenis_buku = jenis_buku.id_jenis_buku');
            $this->db->join('peminjam', 'data_peminjaman.id_peminjam = peminjam.id_peminjam');
            $this->db->select('id_peminjaman, peminjam.nama, nama_buku, nama_jenis_buku, alasan_pinjam, status, peminjam.id_peminjam, buku.id_buku, tgl_pinjam, tgl_kembali');
            $query = $this->db->get()->result_array();
            return $query;
    }

    //Tambah data Peminjam
    public function insertPeminjam($data)
    {
        //menggunakan query builder
        $this->db->insert($this->_table_peminjaman, $data);
        return $this->db->affected_rows();
        //return $query;
    }
    //Ubah data Peminjam
    public function updatePeminjam($data, $id_peminjaman)
    {
        //menggunakan query builder
        $this->db->update($this->_table_peminjaman, $data, ['id_peminjaman' => $id_peminjaman]);
        return $this->db->affected_rows();
        //return $query;
    }

    //Hapus data Peminjam
    public function deletePeminjam($id_peminjaman)
    {
        //Menggunakan query builder
        $this->db->delete($this->_table_peminjaman, ['id_peminjaman' => $id_peminjaman]);
        return $this->db->affected_rows();
        // return Query
    }
}

?>