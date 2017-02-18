<?php

Class Products extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Products_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('excel');
    }

    public function index() {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "Products";
            $data['get_products'] = $this->Products_model->get_products();
            $this->load->view('templates/header', $data);
            $this->load->view('pages/products', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

    public function editproduct($editproductid) {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "Edit Product";
            $data['editproductid'] = $editproductid;
            $data['get_edit_product'] = $this->Products_model->get_edit_product($editproductid);
            $data['get_menucourse'] = $this->Products_model->get_menucourse();
            $data['get_foodcategory'] = $this->Products_model->get_foodcategory();

            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            if ($this->form_validation->run() === FALSE) {
                
            } else {
                $this->Products_model->update_product($editproductid);
                redirect('products');
            }
            $this->load->view('templates/header', $data);
            $this->load->view('pages/editproduct', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

    public function addproducts() {
        if (!empty($_SESSION['MerchantId'])) {
            $data['title'] = "Add Products";
            $isorderclosesd = $this->Products_model->check_is_order_closed();
            $checked = $this->input->post('check');
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);

            if ($isorderclosesd == 0) {
                if ((int) $checked == 1) {
                    $this->Products_model->delete_product();
                    if (!$this->upload->do_upload('userfile')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = $this->upload->data();
                        $file = $data['full_path'];
                        //read file from path
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                        //get only the Cell Collection
                        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                        //extract to a PHP readable array format
                        foreach ($cell_collection as $cell) {
                            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                            //header will/should be in row 1 only. of course this can be modified to suit your need.
                            if ($row == 1) {
                                $header[$row][$column] = $data_value;
                            } else {
                                $arr_data[$row][$column] = $data_value;
                            }
                        }
                        //send the data in an array format
                        $data['header'] = $header;
                        $data['values'] = $arr_data;
                        $addproducts = $this->Products_model->add_products($data['values']);
                        redirect('products');
                    }
                } else {
                    if (!$this->upload->do_upload('userfile')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = $this->upload->data();
                        $file = $data['full_path'];
                        //read file from path
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                        //get only the Cell Collection
                        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
                        //extract to a PHP readable array format
                        foreach ($cell_collection as $cell) {
                            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
                            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
                            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
                            //header will/should be in row 1 only. of course this can be modified to suit your need.
                            if ($row == 1) {
                                $header[$row][$column] = $data_value;
                            } else {
                                $arr_data[$row][$column] = $data_value;
                            }
                        }
                        //send the data in an array format
                        $data['header'] = $header;
                        $data['values'] = $arr_data;
                        $addproducts = $this->Products_model->add_products($data['values']);
                        redirect('products');
                    }
                }
            } else {
                $data["productuploaderror"] = "Products can only be uploaded post the existing orders";
            }

            $this->load->view('templates/header', $data);
            $this->load->view('pages/addproducts', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

}
