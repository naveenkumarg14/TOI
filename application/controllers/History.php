<?php

Class History extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('History_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "History";
            $data['get_history'] = $this->History_model->get_history();
            $this->load->view('templates/header', $data);
            $this->load->view('pages/history', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }
    
     public function history_view($placed_orders_id) {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "View History";
            $data['get_history_details'] = $this->History_model->get_history_details($placed_orders_id);
            $data['get_item_details'] = $this->History_model->get_item_details($placed_orders_id);
            $this->load->view('templates/header', $data);
            $this->load->view('pages/history_view', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

}
