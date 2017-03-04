<?php

class Dashboard_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_purchase_count() {
        $this->db->from('placedorders');
        $this->db->where('IsClosed', 0);
        //$this->db->where('PaymentStatus is NULL', NULL, FALSE);
        //$this->db->where('PurchaseUUID is NULL', NULL, FALSE);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_mobilepay_count() {
        $this->db->from('placedorders');
        $this->db->where('IsClosed', 1);
		$this->db->where('IsMerged', 0);
        $this->db->where('PaymentStatus is NULL', NULL, FALSE);
        $this->db->where('PurchaseUUID is NOT NULL', NULL, FALSE);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_otherpay_count() {
        $this->db->from('placedorders');
        $this->db->where('IsClosed', 1);
		$this->db->where('IsMerged', 0);
        $this->db->where('PaymentStatus is NULL', NULL, FALSE);
        $this->db->where('PurchaseUUID is NULL', NULL, FALSE);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_history_count() {
        $this->db->from('placedorders');
        $this->db->where('IsClosed', 1);
		$this->db->where('IsMerged', 0);
        $this->db->where('PaymentStatus is NOT NULL', NULL, FALSE);
        //$this->db->where('PurchaseUUID is NOT NULL', NULL, FALSE);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_todays_purchase_count($daystart, $dayend) {
        $this->db->from('placedorders');
        $this->db->where('OrderDateTime >= ', $daystart);
        $this->db->where('OrderDateTime <= ', $dayend);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_todays_orderstatus_count($daystart, $dayend) {
        $this->db->from('placedorders');
//        $this->db->where('PaymentStatus', PAID);
//        $this->db->where('OrderStatus !=', DELIVERED);
//        $this->db->where('MerchantId', $MerchantId);
        $this->db->where('OrderDateTime >= ', $daystart);
        $this->db->where('OrderDateTime <= ', $dayend);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_todays_history_count($daystart, $dayend) {
        $this->db->from('placedorders');
//        $this->db->where('OrderStatus', DELIVERED);
//        $this->db->or_where('OrderStatus', CANCELLED);
//        $this->db->where('MerchantId', $MerchantId);
        $this->db->where('OrderDateTime >= ', $daystart);
        $this->db->where('OrderDateTime <= ', $dayend);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function get_weekly_purchase_data($MerchantId, $week_start) {

        $this->db->select('count(PurchaseId) as PurchaseId,DAYNAME(FROM_UNIXTIME(PurchaseDateTime/1000)) as PurchaseDateTime');
        $this->db->from('purchase');
        $this->db->where('OrderStatus', DELIVERED);
        $this->db->where('MerchantId', $MerchantId);
        $this->db->where('PurchaseDateTime <= ', $week_start);
        $this->db->group_by('PurchaseDateTime');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_weekly_cancelled_data($MerchantId, $week_start) {
        $this->db->select('count(PurchaseId) as PurchaseId,DAYNAME(FROM_UNIXTIME(PurchaseDateTime/1000)) as PurchaseDateTime');
        $this->db->from('purchase');
        $this->db->where('OrderStatus', CANCELLED);
        $this->db->where('MerchantId', $MerchantId);
        $this->db->where('PurchaseDateTime <= ', $week_start);
        $this->db->group_by('PurchaseDateTime');
        $query = $this->db->get();
        return $query->result_array();
    }

}
