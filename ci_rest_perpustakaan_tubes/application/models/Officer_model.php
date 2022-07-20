<?php
defined('BASEPATH') or exit('No direct script access allowed');

class   Officer_model extends CI_Model
{
    private $Officer = 'officer';

    //Fungsi untuk medapat data
    public function getOfficer($id)
    {
        //Menggunakan Builder Query
        if ($id) {
            $this->db->from($this->Officer);
            $this->db->where('officer_id', $id);
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->Officer);
            $query = $this->db->get()->result_array();;
            return $query;
        }
    }
    //fungsi untuk menambahkan data
    public function insertOfficer($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->Officer, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updateOfficer($data, $id)
    {
        //Menggunakan Query Builder
        $this->db->update($this->Officer, $data, ['officer_id' => $id]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deleteOfficer($id)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->Officer, ['officer_id' => $id]);
        return $this->db->affected_rows();
        // return $query;
    }
}
