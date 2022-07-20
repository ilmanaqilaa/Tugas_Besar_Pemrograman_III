<?php
defined('BASEPATH') or exit('No direct script access allowed');

class   Rack_model extends CI_Model
{
    private $Rack = 'rack';

    //Fungsi untuk medapat data
    public function getRack($id)
    {
        //Menggunakan Builder Query
        if ($id) {
            $this->db->from($this->Rack);
            $this->db->where('rack_id', $id);
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->Rack);
            $query = $this->db->get()->result_array();;
            return $query;
        }
    }
    //fungsi untuk menambahkan data
    public function insertRack($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->Rack, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updateRack($data, $id)
    {
        //Menggunakan Query Builder
        $this->db->update($this->Rack, $data, ['rack_id' => $id]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deleteRack($id)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->Rack, ['rack_id' => $id]);
        return $this->db->affected_rows();
        // return $query;
    }
}
