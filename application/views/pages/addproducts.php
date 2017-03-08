<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Add Products</h3>
                <p class="animated fadeInDown">
                    <a href="products">Products</a> <span class="fa-angle-right fa"></span>Add Products
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-4"></div>

        <div class="col-md-4">
            <div class="panel">
                <div class="panel-body">

                    <div class="col-md-12 panel-body" style="padding-bottom:30px;">
                        <?php
                        if (isset($productuploaderror)) {
                            echo '<div class="alert alert-danger">';
                            echo $productuploaderror;
                            echo '</div>';
                        }
                        ?>
                        <form action="<?php echo base_url(); ?>products/addproducts" method="POST" enctype="multipart/form-data" >
                            <div class="form-group" style="margin-top:40px !important;">
                                <input type="file" class="form-text" id="userfile" name="userfile" required="">
                                <span class="bar"></span>                   
                            </div>

                            <div class="col-md-6 panel" style="padding:20px;padding-bottom:0px;">
                                <div class="form-group form-animate-checkbox">
                                    <input type="checkbox" class="checkbox" name="check" id="check" value="1">
                                    <label> Checkbox</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <input class="submit btn right" type="submit" value="Upload">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4"></div>
        
      <?php
      
                      print_r($values);
      ?>

    </div>
</div>
<!-- end: content -->


