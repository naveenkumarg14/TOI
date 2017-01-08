<?php

Class Signin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('signin_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index() {
        $data['title'] = "Signin";

        $this->form_validation->set_rules('mobilenumber', 'Mobile Number', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            
        } else {
            $MobileNumber = $this->input->post('mobilenumber');
            $Password = $this->input->post('password');
            $CheckLogin = $this->signin_model->check_login($MobileNumber, $Password);

            if ($CheckLogin == false) {
                $data["error"] = "Invalid username or password. Please try again.";
            } else {
                $MerchantId = $CheckLogin->MerchantId;
                $MerchantName = $CheckLogin->MerchantName;
                $this->session->set_userdata('MobileNumber', $MobileNumber);
                $this->session->set_userdata('MerchantId', $MerchantId);
                $this->session->set_userdata('MerchantName', $MerchantName);
                redirect(base_url());
            }
        }
        $this->load->view('signin', $data);
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('signin');
    }

}
