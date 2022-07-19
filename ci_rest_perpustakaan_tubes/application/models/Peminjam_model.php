<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Peminjam_model extends CI_model
{
    private $_table_peminjam = 'peminjam';

    //Get data peminjam
    public function getDatapeminjam($id_peminjam)
    {
        //menggunakan query builder
        if($id_peminjam){
            $this->db->from($this->_table_peminjam);
            $this->db->where('id_peminjam', $id_peminjam);
            $query = $this->db->get()->result_array();
            return $query;
        } else {
            $this->db->from($this->_table_peminjam);
            $query = $this->db->get()->result_array();
            return $query;
        }
    }

    //Tambah data peminjam
    public function insertpeminjam($data)
    {
        //menggunakan query builder
        $this->db->insert($this->_table_peminjam, $data);
        return $this->db->affected_rows();
        //return $query;
    }
    //Ubah data peminjam
    public function updatepeminjam($data, $id_peminjam)
    {
        //menggunakan query builder
        $this->db->update($this->_table_peminjam, $data, ['id_peminjam' => $id_peminjam]);
        return $this->db->affected_rows();
        //return $query;
    }

    //Hapus data peminjam
    public function deletepeminjam($id_peminjam)
    {
        //Menggunakan query builder
        $this->db->delete($this->_table_peminjam, ['id_peminjam' => $id_peminjam]);
        return $this->db->affected_rows();
        // return Query
    }
}

?>