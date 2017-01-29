<?php

class Archive_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_archive() {
        $this->db->select('HistoryId,OrderId, DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime,TotalPrice,UserMobileNumber');
        $this->db->from('history');
        $this->db->order_by('OrderDateTime', 'DESC');
        $query = $this->db->get();
        $this->db->limit('50');
        return $query->result_array();
    }

    public function get_history_details($placed_orders_id) {
        $this->db->select('a.OrderId,a.PlacedOrdersId,c.PayedAmount,c.OrderStatus,a.PlacedOrdersUuid,a.PurchaseUUID,a.TotalPrice,b.TableNumber,a.UserMobileNumber,DATE_FORMAT(FROM_UNIXTIME(LastUpdatedDateTime/1000),"%d-%m-%Y %h:%i %p") as LastUpdatedDateTime,DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime,DATE_FORMAT(FROM_UNIXTIME(c.PaymentDateTime/1000),"%d-%m-%Y %h:%i %p") as PaymentDateTime');
        $this->db->from('placedorders a');
        $this->db->join('tablelist b', 'b.TableListId = a.TableListId');
        $this->db->join('paymentdetails c', 'c.PurchaseUuid = a.PurchaseUUID');
        $this->db->where('PlacedOrdersId', $placed_orders_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_item_details($placed_orders_id) {
        $this->db->select('ItemCode,LastUpdatedTime,OrderDateTime,OrderStatus,Quantity,menuentity.Name,menuentity.Price,menuentity.MenuCourseId,menuentity.FoodCategoryId,menucourse.CategoryName as MenuCourseCategoryName,foodcategory.CategoryName as FoodCategoryName');
        $this->db->from('placedorderitems');
        $this->db->join('menuentity', 'menuentity.MenuId = placedorderitems.MenuId');
        $this->db->join('menucourse', 'menucourse.MenuCourseId = menuentity.MenuCourseId');
        $this->db->join('foodcategory', 'foodcategory.FoodCategoryId = menuentity.FoodCategoryId');
        $this->db->where('PlacedOrdersId', $placed_orders_id);
        $query = $this->db->get();
        return $query->result_array();
    }

}
