<?php

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function view($page = 'home') {

        if (!empty($_SESSION['MerchantId'])) {
            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                // Whoops, we don't have a page for that!
                show_404();
            }
            $data['title'] = ucfirst($page); // Capitalize the first letter

            date_default_timezone_set('UTC');

            $data['purchaseCount'] = $this->Dashboard_model->get_purchase_count();
            $data['mobilepayCount'] = $this->Dashboard_model->get_mobilepay_count();
            $data['otherpayCount'] = $this->Dashboard_model->get_otherpay_count();
            $data['get_history_count'] = $this->Dashboard_model->get_history_count();
            $data['todaysPurchaseCount'] = $this->Dashboard_model->get_purchase_count();
            $data['todaysOrderstatusCount'] = $this->Dashboard_model->get_mobilepay_count();
            $data['todaysOtherpayCount'] = $this->Dashboard_model->get_otherpay_count();
            $data['todaysHistoryCount'] = $this->Dashboard_model->get_history_count();

            $this->load->view('templates/header', $data);
            $this->load->view('pages/' . $page, $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('signin');
        }
    }

    public function Get_weekly_data() {
        $WeekleyGraphData = array();

        $week_start = date("Y-m-d 00:00:00", strtotime("last monday"));
        $week_start = strtotime($week_start) * 1000;
        $data['dbWeeklyPurchaseData'] = $this->Dashboard_model->get_weekly_purchase_data($this->session->MerchantId, $week_start);
        $WeeklyPurchaseData = $this->Process_weekly_data($data['dbWeeklyPurchaseData']);

        $data['dbWeeklyCancelledData'] = $this->Dashboard_model->get_weekly_cancelled_data($this->session->MerchantId, $week_start);
        $WeeklyCancelledData = $this->Process_weekly_data($data['dbWeeklyCancelledData']);

        $post_data = array(
            'purchaseData' => $WeeklyPurchaseData,
            'cancelData' => $WeeklyCancelledData
        );
        echo json_encode($post_data);
    }

    public function Process_weekly_data($data) {
        $WeeklyPurchaseData = array("0", "0", "0", "0", "0", "0", "0");
        foreach ($data as $value) {
            switch ($value['PurchaseDateTime']) {
                case 'Monday':
                    $WeeklyPurchaseData[0] = $value['PurchaseId'];
                    break;
                case 'Tuesday':
                    $WeeklyPurchaseData[1] = $value['PurchaseId'];
                    break;
                case 'Wednesday':
                    $WeeklyPurchaseData[2] = $value['PurchaseId'];
                    break;
                case 'Thursday':
                    $WeeklyPurchaseData[3] = $value['PurchaseId'];
                    break;
                case 'Friday':
                    $WeeklyPurchaseData[4] = $value['PurchaseId'];
                    break;
                case 'Saturday':
                    $WeeklyPurchaseData[5] = $value['PurchaseId'];
                    break;
                case 'Sunday':
                    $WeeklyPurchaseData[6] = $value['PurchaseId'];
                    break;
                default:
                    break;
            }
        }
        return $WeeklyPurchaseData;
    }

}
