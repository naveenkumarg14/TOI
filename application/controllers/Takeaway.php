<?php

Class Takeaway extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Takeaway_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "TakeAway";
            $data['get_take_away'] = $this->Takeaway_model->get_take_away();

//            foreach ($data['get_purchase'] as $item) {
//                $data['get_purchase'] = $this->Purchase_model->get_total($item['PlacedOrdersId']);
//            }

            $this->load->view('templates/header', $data);
            $this->load->view('pages/takeaway', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

    

    public function takeaway_view($placed_orders_id) {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "View TakeAway Details";
            $data['get_take_away_order_details'] = $this->Takeaway_model->get_take_away_order_details($placed_orders_id);
            $data['get_item_details'] = $this->Takeaway_model->get_item_details($placed_orders_id);
            $this->load->view('templates/header', $data);
            $this->load->view('pages/takeaway_view', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

}
