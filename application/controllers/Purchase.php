<?php

Class Purchase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Purchase_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "Purchase";
            $data['get_purchase'] = $this->Purchase_model->get_purchase();

//            foreach ($data['get_purchase'] as $item) {
//                $data['get_purchase'] = $this->Purchase_model->get_total($item['PlacedOrdersId']);
//            }

            $this->load->view('templates/header', $data);
            $this->load->view('pages/purchase', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

    public function total_count($items) {
        $data['total'] = $this->Purchase_model->get_total($items);
    }

    public function purchase_view($placed_orders_id) {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "View Purchase";
            $data['get_purchase_details'] = $this->Purchase_model->get_purchase_details($placed_orders_id);
            $data['get_item_details'] = $this->Purchase_model->get_item_details($placed_orders_id);
            $this->load->view('templates/header', $data);
            $this->load->view('pages/purchase_view', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

}
