<?php

Class Archive extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Archive_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "Archive";
            $data['get_archive'] = "";

            $this->form_validation->set_rules('startdatetime', 'Start Date', 'required');
            $this->form_validation->set_rules('enddatetime', 'End Date', 'required');

            if ($this->form_validation->run() === FALSE) {
                
            } else {
                $startdatetime = $this->input->post('startdatetime');
                $enddatetime = $this->input->post('enddatetime');
                $data['get_archive'] = $this->Archive_model->get_archive($startdatetime, $enddatetime);
            }

            $this->load->view('templates/header', $data);
            $this->load->view('pages/archive', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

    public function archive_view($history_id) {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "View Archive";
            $data['get_archive_details'] = $this->Archive_model->get_archive_details($history_id);
            $data['get_item_details'] = $this->Archive_model->get_item_details($history_id);
            $this->load->view('templates/header', $data);
            $this->load->view('pages/archive_view', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

}
