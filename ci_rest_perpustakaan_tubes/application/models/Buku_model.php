<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_model
{
    private $_table_buku = 'buku';

    //Get data Buku
    public function getDataBuku($id_buku)
    {
        //menggunakan query builder
        if($id_buku){
            $this->db->from($this->_table_buku);
            $this->db->where('id_buku', $id_buku);
            $query = $this->db->get()->result_array();
            return $query;
        } else {
            $this->db->from($this->_table_buku);
            $query = $this->db->get()->result_array();
            return $query;
        }
    }

    //Tambah data Buku
    public function insertBuku($data)
    {
        //menggunakan query builder
        $this->db->insert($this->_table_buku, $data);
        return $this->db->affected_rows();
        //return $query;
    }
    //Ubah data Buku
    public function updateBuku($data, $id_buku)
    {
        //menggunakan query builder
        $this->db->update($this->_table_buku, $data, ['id_buku' => $id_buku]);
        return $this->db->affected_rows();
        //return $query;
    }

    //Hapus data Buku
    public function deleteBuku($id_buku)
    {
        //Menggunakan query builder
        $this->db->delete($this->_table_buku, ['id_buku' => $id_buku]);
        return $this->db->affected_rows();
        // return Query
    }
}

?>