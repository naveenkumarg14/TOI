<?php

Class Otherpay extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Otherpay_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "Other Pay";
            $data['get_otherpay'] = $this->Otherpay_model->get_otherpay();
            $this->load->view('templates/header', $data);
            $this->load->view('pages/otherpay', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

    public function otherpay_view($placed_orders_id) {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "View Other Pay";
            $data['get_otherpay_details'] = $this->Otherpay_model->get_otherpay_details($placed_orders_id);
            $data['get_item_details'] = $this->Otherpay_model->get_item_details($placed_orders_id);

            $this->form_validation->set_rules('amountpaid', 'Amount Paid', 'required');
            if ($this->form_validation->run() === FALSE) {
                
            } else {
                $amountpaid = $this->input->post('amountpaid');
                $this->Otherpay_model->update_payment_details($placed_orders_id, $amountpaid);
                $url = base_url() . "otherpay";
                header("location:" . $url);
            }

            $this->load->view('templates/header', $data);
            $this->load->view('pages/otherpay_view', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

}
