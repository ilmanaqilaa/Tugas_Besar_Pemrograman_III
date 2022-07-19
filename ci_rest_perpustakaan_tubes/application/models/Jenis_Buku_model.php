<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_Buku_model extends CI_model
{
    private $_table_jenis_buku = 'jenis_buku';

    //Get data jenis_buku
    public function getDatajenis_buku($id_jenis_buku)
    {
        //menggunakan query builder
        if($id_jenis_buku){
            $this->db->from($this->_table_jenis_buku);
            $this->db->where('id_jenis_buku', $id_jenis_buku);
            $query = $this->db->get()->result_array();
            return $query;
        } else {
            $this->db->from($this->_table_jenis_buku);
            $query = $this->db->get()->result_array();
            return $query;
        }
    }

    //Tambah data jenis_buku
    public function insertjenis_buku($data)
    {
        //menggunakan query builder
        $this->db->insert($this->_table_jenis_buku, $data);
        return $this->db->affected_rows();
        //return $query;
    }
    //Ubah data jenis_buku
    public function updatejenis_buku($data, $id_jenis_buku)
    {
        //menggunakan query builder
        $this->db->update($this->_table_jenis_buku, $data, ['id_jenis_buku' => $id_jenis_buku]);
        return $this->db->affected_rows();
        //return $query;
    }

    //Hapus data jenis_buku
    public function deletejenis_buku($id_jenis_buku)
    {
        //Menggunakan query builder
        $this->db->delete($this->_table_jenis_buku, ['id_jenis_buku' => $id_jenis_buku]);
        return $this->db->affected_rows();
        // return Query
    }
}

?>