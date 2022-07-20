<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Book_model extends CI_model
{
    private $_table_book = 'book';

    //Get data book
    public function getDatabook($book_id)
    {
        //menggunakan query builder
        $this->db->from($this->_table_book);
        if($book_id){
            $this->db->where('book_id', $book_id);
        }
            $this->db->join('publisher', 'book.publisher_id = publisher.publisher_id');
            $this->db->join('book_type', 'book.book_type_id = book_type.book_type_id');
            $this->db->join('rack', 'book.rack_id = rack.rack_id');
            $this->db->select('book_id, publisher_name, book_type_name, rack_name');
            $query = $this->db->get()->result_array();
            return $query;
    }

    //Tambah data book
    public function insertbook($data)
    {
        //menggunakan query builder
        $this->db->insert($this->_table_book, $data);
        return $this->db->affected_rows();
        //return $query;
    }
    //Ubah data book
    public function updatebook($data, $book_id)
    {
        //menggunakan query builder
        $this->db->update($this->_table_book, $data, ['book_id' => $book_id]);
        return $this->db->affected_rows();
        //return $query;
    }

    //Hapus data book
    public function deletebook($book_id)
    {
        //Menggunakan query builder
        $this->db->delete($this->_table_book, ['book_id' => $book_id]);
        return $this->db->affected_rows();
        // return Query
    }
}

?>