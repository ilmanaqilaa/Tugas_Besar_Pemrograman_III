<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Publisher_model extends CI_model
{
    private $_table_publisher = 'publisher';

    //Get data publisher
    public function getDatapublisher($publisher_id)
    {
        //menggunakan query builder
        if($publisher_id){
            $this->db->from($this->_table_publisher);
            $this->db->where('publisher_id', $publisher_id);
            $query = $this->db->get()->result_array();
            return $query;
        } else {
            $this->db->from($this->_table_publisher);
            $query = $this->db->get()->result_array();
            return $query;
        }
    }

    //Tambah data publisher
    public function insertpublisher($data)
    {
        //menggunakan query builder
        $this->db->insert($this->_table_publisher, $data);
        return $this->db->affected_rows();
        //return $query;
    }
    //Ubah data publisher
    public function updatepublisher($data, $publisher_id)
    {
        //menggunakan query builder
        $this->db->update($this->_table_publisher, $data, ['publisher_id' => $publisher_id]);
        return $this->db->affected_rows();
        //return $query;
    }

    //Hapus data publisher
    public function deletepublisher($publisher_id)
    {
        //Menggunakan query builder
        $this->db->delete($this->_table_publisher, ['publisher_id' => $publisher_id]);
        return $this->db->affected_rows();
        // return Query
    }
}

?>