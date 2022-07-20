<?php
defined('BASEPATH') or exit('No direct script access allowed');

class   BookType_model extends CI_Model
{
    private $BookType = 'book_type';

    //Fungsi untuk medapat data
    public function getBookType($id)
    {
        //Menggunakan Builder Query
        if ($id) {
            $this->db->from($this->BookType);
            $this->db->where('book_type_id', $id);
            $query = $this->db->get()->row_array();
            return $query;
        } else {
            $this->db->from($this->BookType);
            $query = $this->db->get()->result_array();;
            return $query;
        }
    }
    //fungsi untuk menambahkan data
    public function insertBookType($data)
    {
        //Menggunakan Query Builder
        $this->db->insert($this->BookType, $data);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk mengubah data
    public function updateBookType($data, $id)
    {
        //Menggunakan Query Builder
        $this->db->update($this->BookType, $data, ['book_type_id' => $id]);
        return $this->db->affected_rows();
        // return $query;
    }

    //fungsi untuk menghapus data
    public function deleteBookType($id)
    {
        //Menggunakan Query Builder
        $this->db->delete($this->BookType, ['book_type_id' => $id]);
        return $this->db->affected_rows();
        // return $query;
    }
}
