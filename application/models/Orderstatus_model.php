<?php

class Orderstatus_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_orderstatus() {
        $this->db->select('OrderId,PlacedOrdersId,TotalPrice,PurchaseUUID,TableNumber,UserMobileNumber,DATE_FORMAT(FROM_UNIXTIME(LastUpdatedDateTime/1000),"%d-%m-%Y %h:%i %p") as LastUpdatedDateTime,DATE_FORMAT(FROM_UNIXTIME(OrderDateTime/1000),"%d-%m-%Y %h:%i %p") as OrderDateTime');
        $this->db->from('placedorders');
        $this->db->join('tablelist', 'tablelist.TableListId = placedorders.TableListId');
        $this->db->where('IsClosed', 1);
		$this->db->where('IsMerged', 0);
		$this->db->where('OrderType', 0);
        $this->db->where('PaymentStatus is NULL', NULL, FALSE);
        $this->db->where('PurchaseUUID is NOT NULL', NULL, FALSE);
        $this->db->order_by('LastUpdatedDateTime', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_orderstatus_details($placed_orders_id) {
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

    public function send_mobilepay_details($placed_orders_id, $amountpaid) {
        $this->load->helper('url');

        //API Url
        //$url = WEBSERVICEURL . 'login.html';

        $url = base_url() . '/mobile/discardData.html';
        // Initiate cURL.
        $ch = curl_init($url);
        //The JSON data.
        $jsonData = array(
            'placedOrderUUid' => $placed_orders_id
        );
        //Encode the array into JSON.
        $jsonDataEncoded = json_encode($jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, true);
        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //Execute the request
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
