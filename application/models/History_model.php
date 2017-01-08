<?php

class History_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_history() {
        $this->db->select('OrderId,PlacedOrdersId,TotalPrice,TableNumber,UserMobileNumber,DATE_FORMAT(FROM_UNIXTIME(LastUpdatedDateTime/1000),"%d-%m-%Y %h:%i %p") as LastUpdatedDateTime,,DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime');
        $this->db->from('placedorders');
        $this->db->join('tablelist', 'tablelist.TableListId = placedorders.TableListId');
        $this->db->where('PaymentStatus is NOT NULL', NULL, FALSE);
        $this->db->where('PurchaseUUID is NOT NULL', NULL, FALSE);
        $this->db->order_by('ServerDateTime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_history_details($placed_orders_id) {
        $this->db->select('OrderId,PlacedOrdersId,PlacedOrdersUuid,TotalPrice,TableNumber,UserMobileNumber,DATE_FORMAT(FROM_UNIXTIME(LastUpdatedDateTime/1000),"%d-%m-%Y %h:%i %p") as LastUpdatedDateTime,,DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime');
        $this->db->from('placedorders');
        $this->db->join('tablelist', 'tablelist.TableListId = placedorders.TableListId');
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
