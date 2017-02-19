<?php

class Archive_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_archive() {
        $this->db->select('HistoryId,OrderId, DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime,TotalPrice,UserMobileNumber,PaymentStatus,TableNumber,AmountPaid');
        $this->db->from('history');
        $this->db->join('tablelist', 'tablelist.TableListId = history.TableListId');
        $this->db->order_by('OrderDateTime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_archive_details($history_id) {
        $this->db->select('HistoryId,OrderId, DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime,TotalPrice,UserMobileNumber,PaymentStatus,b.TableNumber,AmountPaid');
        $this->db->from('history a');
        $this->db->join('tablelist b', 'b.TableListId = a.TableListId');
        $this->db->where('HistoryId', $history_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_item_details($history_id) {
        $this->db->select('ItemDetails');
        $this->db->from('historydetails');
        $this->db->where('HistoryId', $history_id);
        $query = $this->db->get();
        return $query->result_array();
    }

}
