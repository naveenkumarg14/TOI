<?php

class Purchase_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_purchase() {
        $result = array();

        $this->db->select('OrderId,PlacedOrdersId,TotalPrice,TableNumber,UserMobileNumber,DATE_FORMAT(FROM_UNIXTIME(LastUpdatedDateTime/1000),"%d-%m-%Y %h:%i %p") as LastUpdatedDateTime,DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%h:%i %p") as OrderDateTime');
        $this->db->from('placedorders');
        $this->db->where('IsClosed', 0);
		$this->db->where('IsMerged', 0);
		$this->db->where('OrderType', 0);
       // $this->db->where('PaymentStatus is NULL', NULL, FALSE);
       // $this->db->where('PurchaseUUID is NULL', NULL, FALSE);
        $this->db->join('tablelist', 'tablelist.TableListId = placedorders.TableListId');
        $this->db->order_by('OrderDateTime', 'DESC');
        $query = $this->db->get();

        $var = $query->result_array();

        foreach ($var as $value) {
            $value['totalorders'] = $this->get_total_orders($value['PlacedOrdersId']);
            $value['totaldeliveredorders'] = $this->get_total_delivered($value['PlacedOrdersId']);
            $value['totalactiveorders'] = $this->get_total_activeorders($value['PlacedOrdersId']);
            array_push($result, $value);
        }

        return $result;
    }

    public function get_total_orders($placeodrderid) {
        $this->db->select('SUM(Quantity) as totalquantity');
        $this->db->from('placedorderitems');
        $this->db->where('PlacedOrdersId', $placeodrderid);
        $this->db->where('IsDeleted', false);
        $query = $this->db->get();
        $result = $query->row()->totalquantity;
		if($result == null){
			$result = 0;
		}
		return $result;
    }

    public function get_total_delivered($placeodrderid) {
        $this->db->select('SUM(Quantity) as totalquantity');
        $this->db->from('placedorderitems');
        $this->db->where('PlacedOrdersId', $placeodrderid);
        $this->db->where('OrderStatus', 'DELIVERED');
        $this->db->where('IsDeleted', false);
        $query = $this->db->get();
        $result = $query->row()->totalquantity;
		if($result == null){
			$result = 0;
		}
		return $result;
    }

    public function get_total_activeorders($placeodrderid) {
        $this->db->select('SUM(Quantity) as totalquantity');
        $this->db->from('placedorderitems');
        $this->db->where('PlacedOrdersId', $placeodrderid);
        $this->db->where('OrderStatus', 'ORDERED');
        $this->db->where('IsDeleted', false);
        $query = $this->db->get();
         $result = $query->row()->totalquantity;
		if($result == null){
			$result = 0;
		}
		return $result;
    }

    public function get_purchase_details($placed_orders_id) {
        $this->db->select('OrderId,PlacedOrdersId,PlacedOrdersUuid,TotalPrice,TableNumber,UserMobileNumber,DATE_FORMAT(FROM_UNIXTIME(LastUpdatedDateTime/1000),"%d-%m-%Y %h:%i %p") as LastUpdatedDateTime,,DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime');
        $this->db->from('placedorders');
        $this->db->join('tablelist', 'tablelist.TableListId = placedorders.TableListId');
        $this->db->where('PlacedOrdersId', $placed_orders_id);
        $this->db->order_by('OrderDateTime', 'DESC');
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
        $this->db->where('IsDeleted', false);
        $this->db->order_by('OrderDateTime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

}
