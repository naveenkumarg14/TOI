<?php

class Otherpay_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_otherpay() {
        $this->db->select('OrderId,PlacedOrdersId,TotalPrice,PurchaseUUID,TableNumber,UserMobileNumber,DATE_FORMAT(FROM_UNIXTIME(LastUpdatedDateTime/1000),"%d-%m-%Y %h:%i %p") as LastUpdatedDateTime,,DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime');
        $this->db->from('placedorders');
        $this->db->join('tablelist', 'tablelist.TableListId = placedorders.TableListId');
        $this->db->where('IsClosed', 1);
        $this->db->where('IsMerged', 0);
        $this->db->where('PaymentStatus is NULL', NULL, FALSE);
        $this->db->where('PurchaseUUID is NULL', NULL, FALSE);
        $this->db->order_by('LastUpdatedDateTime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_otherpay_details($placed_orders_id) {
        $this->db->select('OrderId,TaxAmount,Discount,PlacedOrdersId,PlacedOrdersUuid,PurchaseUUID,TotalPrice,TableNumber,UserMobileNumber,DATE_FORMAT(FROM_UNIXTIME(LastUpdatedDateTime/1000),"%d-%m-%Y %h:%i %p") as LastUpdatedDateTime,,DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime');
        $this->db->from('placedorders');
        $this->db->join('tablelist', 'tablelist.TableListId = placedorders.TableListId');
        $this->db->where('PlacedOrdersId', $placed_orders_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_item_details($placed_orders_id) {
        $this->db->select('ItemCode,LastUpdatedTime,OrderDateTime,TableNumber,OrderStatus,Quantity,menuentity.Name,menuentity.Price,menuentity.MenuCourseId,menuentity.FoodCategoryId,menucourse.CategoryName as MenuCourseCategoryName,foodcategory.CategoryName as FoodCategoryName');
        $this->db->from('placedorderitems');
        $this->db->join('menuentity', 'menuentity.MenuId = placedorderitems.MenuId');
        $this->db->join('menucourse', 'menucourse.MenuCourseId = menuentity.MenuCourseId');
        $this->db->join('foodcategory', 'foodcategory.FoodCategoryId = menuentity.FoodCategoryId');
        $this->db->where('IsDeleted', false);
        $this->db->where('PlacedOrdersId', $placed_orders_id);
        $this->db->order_by('OrderDateTime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_payment_details($placed_orders_id, $amountpaid) {
        $data = array('AmountPaid' => $amountpaid, 'PaymentStatus' => 'PAID');
        $this->db->where('PlacedOrdersId', $placed_orders_id);
        $this->db->update('placedorders', $data);
    }

}
