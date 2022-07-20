<?php
defined('BASEPATH') or exit('No direct script access allowed');

class   Borrower_model extends CI_Model
{
    private $Borrower = 'borrower';

    //Fungsi untuk medapat data
    public function getBorrower($id)
    {
        //Menggunakan Builder Query
        if ($id) {
            $this->db->from($this->Borrower);
            $this->db->where('borrower_id', $id);
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->Borrower);
            $query = $this->db->get()->result_array();;
            return $query;
        }
    }
    //fungsi untuk menambahkan data
    public function insertBorrower($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->Borrower, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updateBorrower($data, $id)
    {
        //Menggunakan Query Builder
        $this->db->update($this->Borrower, $data, ['borrower_id' => $id]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deleteBorrower($id)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->Borrower, ['borrower_id' => $id]);
        return $this->db->affected_rows();
        // return $query;
    }
}
