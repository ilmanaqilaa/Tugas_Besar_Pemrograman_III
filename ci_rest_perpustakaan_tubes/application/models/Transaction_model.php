<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_model extends CI_model
{
    private $_table_transaction = 'transaction';

    //Get data Transaction
    public function getDataTransaction($transaction_id)
    {
        //menggunakan query builder
        $this->db->from($this->_table_transaction);
        if($transaction_id){
            $this->db->where('transaction_id', $transaction_id);
        }
            $this->db->join('book', 'transaction.book_id = book.book_id');
            $this->db->join('publisher', 'book.publisher_id = publisher.publisher_id');
            $this->db->join('book_type', 'book.book_type_id = book_type.book_type_id');
            $this->db->join('rack', 'book.rack_id = rack.rack_id');
            $this->db->join('officer', 'transaction.officer_id = officer.officer_id');
            $this->db->join('borrower', 'transaction.borrower_id = borrower.borrower_id');
            $this->db->select('transaction_id, book.book_name, book_type_name, publisher_name, officer.officer_name, rack.rack_name, borrower.name');
            $query = $this->db->get()->result_array();
            return $query;
    }

    //Tambah data Transaction
    public function insertTransaction($data)
    {
        //menggunakan query builder
        $this->db->insert($this->_table_transaction, $data);
        return $this->db->affected_rows();
        //return $query;
    }
    //Ubah data Transaction
    public function updateTransaction($data, $transaction_id)
    {
        //menggunakan query builder
        $this->db->update($this->_table_transaction, $data, ['transaction_id' => $transaction_id]);
        return $this->db->affected_rows();
        //return $query;
    }

    //Hapus data Transaction
    public function deleteTransaction($transaction_id)
    {
        //Menggunakan query builder
        $this->db->delete($this->_table_transaction, ['transaction_id' => $transaction_id]);
        return $this->db->affected_rows();
        // return Query
    }
}

?>