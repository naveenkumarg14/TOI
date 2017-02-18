<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Edit Product</h3>
                <p class="animated fadeInDown">
                    <a href="<?php echo base_url(); ?>products">Products</a> <span class="fa-angle-right fa"></span>Edit Products
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">

        <div class="col-md-12">
            <div class="col-md-12 panel">
                <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                    <div class="col-md-12">

                        <form class="cmxform" id="signupForm" method="POST" action="">
                            <div class="col-md-6">

                                <input type="hidden" id="productid"  value="<?php echo $get_edit_product->MenuId; ?>" name="productid">


                                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                    <input type="text" class="form-text" id="menucode"  value="<?php echo $get_edit_product->MenuItemCode; ?>" name="menucode" aria-required="true">
                                    <span class="bar"></span>
                                    <label>Menu Code</label>
                                </div>

                                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                    <input type="text" class="form-text" id="name"  value="<?php echo $get_edit_product->Name; ?>" name="name" required="" aria-required="true">
                                    <span class="bar"></span>
                                    <label>Name</label>
                                </div>

                                <div class="form-group form-animate-text" style="margin-top:42px !important;">
                                    <select class="form-text" name="course" id="course"  required="" aria-required="true">
                                        <?php
                                        foreach ($get_menucourse as $course) {
                                            $menu_course_id = $course['MenuCourseId'];
                                            $menu_category_name = $course['CategoryName'];
                                            ?>
                                            <option value="<?php echo $menu_course_id; ?>" <?php echo set_select('course', $menu_category_name, (!empty($get_edit_product->MenuCourseId) && $get_edit_product->MenuCourseId == $menu_course_id ? TRUE : FALSE)); ?> ><?php echo $menu_category_name; ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <span class="bar"></span>
                                    <div class="select-wrapper">
                                        <label>Course</label>
                                    </div>
                                </div>

                                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                    <input type="text" class="form-text" id="category"  value="<?php echo $get_edit_product->FoodCategoryName; ?>" name="category" required="" aria-required="true">
                                    <span class="bar"></span>
                                    <label>Category</label>
                                </div>

                                <div class="form-group form-animate-text" style="margin-top:42px !important;">
                                    <select class="form-text" name="foodtype" id="foodtype"  required="" aria-required="true">
                                        <option value="VEG" <?php echo set_select('foodtype', 'VEG', (!empty($get_edit_product->FoodType) && $get_edit_product->FoodType == "VEG" ? TRUE : FALSE)); ?> >VEG</option>
                                        <option value="NONVEG" <?php echo set_select('foodtype', 'NONVEG', (!empty($get_edit_product->FoodType) && $get_edit_product->FoodType == "NONVEG" ? TRUE : FALSE)); ?> >NONVEG</option>
                                    </select>
                                    <span class="bar"></span>
                                    <div class="select-wrapper">
                                        <label>Type</label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                    <input type="text" class="form-text" id="displayorder"  value="<?php echo $get_edit_product->MenuEntityDisplayOrder; ?>" name="displayorder" required="" aria-required="true">
                                    <span class="bar"></span>
                                    <label>Display Order</label>
                                </div>

                                <div class="form-group form-animate-text" style="margin-top:42px !important;">
                                    <select class="form-text" name="spicy" id="spicy"  required="" aria-required="true">
                                        <option value="Mild" <?php echo set_select('spicy', 'Mild', (!empty($get_edit_product->Spicy) && $get_edit_product->Spicy == "Mild" ? TRUE : FALSE)); ?> >Mild</option>
                                        <option value="Medium" <?php echo set_select('spicy', 'Medium', (!empty($get_edit_product->Spicy) && $get_edit_product->Spicy == "Medium" ? TRUE : FALSE)); ?> >Medium</option>
                                        <option value="Hot" <?php echo set_select('spicy', 'Hot', (!empty($get_edit_product->Spicy) && $get_edit_product->Spicy == "Hot" ? TRUE : FALSE)); ?> >Hot</option>
                                    </select>
                                    <span class="bar"></span>
                                    <div class="select-wrapper">
                                        <label>Spicy</label>
                                    </div>
                                </div>

                                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                    <input type="text" class="form-text" id="price"  value="<?php echo $get_edit_product->Price; ?>" name="price" required="" aria-required="true">
                                    <span class="bar"></span>
                                    <label>Price</label>
                                </div>

                                <div class="form-group form-animate-text" style="margin-top:42px !important;">
                                    <select class="form-text" name="status" id="status"  required="" aria-required="true">
                                        <option value="UN_AVAILABLE" <?php echo set_select('status', 'UN_AVAILABLE', (!empty($get_edit_product->Status) && $get_edit_product->Status == "UN_AVAILABLE" ? TRUE : FALSE)); ?> >UN_AVAILABLE</option>
                                        <option value="AVAILABLE" <?php echo set_select('status', 'AVAILABLE', (!empty($get_edit_product->Status) && $get_edit_product->Status == "AVAILABLE" ? TRUE : FALSE)); ?> >AVAILABLE</option>
                                    </select>
                                    <span class="bar"></span>
                                    <div class="select-wrapper">
                                        <label>Status</label>
                                    </div>
                                </div>

                                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                                    <textarea class="form-text" id="description" name="description" required="" aria-required="true" ><?php echo $get_edit_product->Description; ?></textarea>
                                    <span class="bar"></span>
                                    <label>Description</label>
                                </div>

                                <input class="submit btn right" type="submit" value="Submit">

                            </div>                   
                            <div class="col-md-12">

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>



    </div>
</div>
<!-- end: content -->


