<?php

Class Orderstatus extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Orderstatus_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "Order Status";
            $data['get_orderstatus'] = $this->Orderstatus_model->get_orderstatus();
            $this->load->view('templates/header', $data);
            $this->load->view('pages/orderstatus', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }
    
    public function orderstatus_view($placed_orders_id) {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "View Purchase";
            $data['get_orderstatus_details'] = $this->Orderstatus_model->get_orderstatus_details($placed_orders_id);
            $data['get_item_details'] = $this->Orderstatus_model->get_item_details($placed_orders_id);
            $this->load->view('templates/header', $data);
            $this->load->view('pages/orderstatus_view', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

}
