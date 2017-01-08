<?php

class Signin_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function check_login($MobileNumber, $Password) {
        $this->db->select('MerchantId,MerchantName');
        $this->db->from('merchant');
        $login_array = array('MobileNumber' => $MobileNumber, 'Password' => $Password);
        $this->db->where($login_array);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

}
