<?php

class Products_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_products() {
        $this->db->select('*,b.CategoryName as FoodCategoryName, c.CategoryName as MenuCourseCategory');
        $this->db->from('menuentity a');
        $this->db->join('foodcategory b', 'b.FoodCategoryId=a.FoodCategoryId', 'left');
        $this->db->join('menucourse c', 'c.MenuCourseId=a.MenuCourseId', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_edit_product($productid) {
        $this->db->select('*,a.DisplayOrder as MenuEntityDisplayOrder, b.CategoryName as FoodCategoryName, c.CategoryName as MenuCourseCategory');
        $this->db->from('menuentity a');
        $this->db->where('MenuId', $productid);
        $this->db->join('foodcategory b', 'b.FoodCategoryId=a.FoodCategoryId', 'left');
        $this->db->join('menucourse c', 'c.MenuCourseId=a.MenuCourseId', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function update_product($productid) {
        $todaysdate = date("Y-m-d H:i:s");
        $todaysdate = strtotime($todaysdate) * 1000;
        $menucode = $this->input->post('menucode');
        $name = $this->input->post('name');
        $displayorder = $this->input->post('displayorder');
        $spicy = $this->input->post('spicy');
        $foodtype = $this->input->post('foodtype');
        $price = $this->input->post('price');
        $status = $this->input->post('status');
        $description = $this->input->post('description');
        $data = array('MenuItemCode' => $menucode, 'Name' => $name, 'Price' => $price, 'Status' => $status, 'ServerTime' => $todaysdate, 'DisplayOrder' => $displayorder, 'TasteType' => $spicy, 'FoodType' => $foodtype, 'Description' => $description);
        $this->db->where('MenuId', $productid);
        $this->db->update('menuentity', $data);
        return true;
    }

    public function delete_product() {
        $this->db->empty_table('menuentity');
        $this->db->empty_table('foodcategory');
        $this->db->empty_table('menucourse');
    }

    public function add_products($excel_val) {
        $todaysdate = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
        $todaysdate = strtotime($todaysdate) * 1000;

        foreach ($excel_val as $value) {
            $MenuItemCode = $value['A'];
            $Name = $value['B'];
            $Description = $value['C'];
            $FoodCategory = $value['D'];
            $FoodCategoryDisplayOrder = $value['E'];
            $MenuCourse = $value['F'];
            $MenuCourseDisplayOrder = $value['G'];
            $DisplayOrder = $value['H'];
            $Price = $value['I'];
            $Status = $value['J'];
            $Spicy = $value['K'];
            $FoodType = $value['L'];

            $menucourseid = $this->menu_course($MenuCourse, $todaysdate, $MenuCourseDisplayOrder);
            $foodcategoryid = $this->food_category($FoodCategory, $menucourseid, $todaysdate, $FoodCategoryDisplayOrder);
            $menuitemcode = $this->menu_item_code($MenuItemCode, $menucourseid, $foodcategoryid, $todaysdate);

            if ($menuitemcode == 0) {
                $itemcode_data = array(
                    'DateTime' => $todaysdate, 'MenuItemCode' => $MenuItemCode, 'MenuUuid' => $this->generate_secure_token(),
                    'Name' => $Name, 'Price' => $Price, 'Status' => $Status, 'FoodCategoryId' => $foodcategoryid, 'MenuCourseId' => $menucourseid, 'ServerTime' => $todaysdate,
                    'DisplayOrder' => $DisplayOrder, 'FoodType' => $FoodType, 'TasteType' => $Spicy, 'Description' => $Description);
                $this->db->insert('menuentity', $itemcode_data);
            } else {
                $data = array(
                    'DateTime' => $todaysdate, 'Name' => $Name, 'Price' => $Price, 'Status' => $Status, 'FoodCategoryId' => $foodcategoryid, 'MenuCourseId' => $menucourseid,
                    'ServerTime' => $todaysdate, 'DisplayOrder' => $DisplayOrder, 'FoodType' => $FoodType, 'TasteType' => $Spicy, 'Description' => $Description);
                $this->db->where('MenuId', $menuitemcode);
                $this->db->update('menuentity', $data);
            }
        }
        return;
    }

    public function menu_course($category, $todaysdate, $mcdisplayorder) {
        $this->db->from('menucourse');
        $this->db->where('CategoryName', $category);
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        if ($rowcount == 0) {
            $menucourse_data = array(
                'CategoryName' => $category,
                'DateTime' => $todaysdate,
                'MenuCourseUuid' => $this->generate_secure_token(),
                'DisplayOrder' => $mcdisplayorder
            );
            $this->db->insert('menucourse', $menucourse_data);
            return $this->db->insert_id();
        } else {
            return $query->row('MenuCourseId');
        }
    }

    public function food_category($category, $menucourseid, $todaysdate, $foodddisplayorder) {
        $this->db->from('foodcategory');
        $this->db->where('CategoryName', $category);
        $this->db->where('MenuCourseId', $menucourseid);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        if ($rowcount == 0) {
            $foodcategory_data = array(
                'CategoryName' => $category,
                'DateTime' => $todaysdate,
                'FoodCategoryUuid' => $this->generate_secure_token(),
                'MenuCourseId' => $menucourseid,
                'DisplayOrder' => $foodddisplayorder
            );
            $this->db->insert('foodcategory', $foodcategory_data);
            return $this->db->insert_id();
        } else {
            return $query->row('FoodCategoryId');
        }
    }

    public function menu_item_code($itemcode, $menucourseid, $foodcategoryid, $todaysdate) {
        $this->db->from('menuentity');
        $this->db->where('MenuItemCode', $itemcode);
        $this->db->where('MenuCourseId', $menucourseid);
        $this->db->where('FoodCategoryId', $foodcategoryid);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        if ($rowcount == 0) {
            return $rowcount;
        } else {
            return $query->row('MenuId');
        }
    }

    public function get_menucourse() {
        $this->db->select('CategoryName,MenuCourseId');
        $this->db->from('menucourse');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_foodcategory() {
        $this->db->select('CategoryName,FoodCategoryId');
        $this->db->from('foodcategory');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function generate_secure_token() {
        $bytes = random_bytes(20);
        return (bin2hex($bytes));
    }

}
