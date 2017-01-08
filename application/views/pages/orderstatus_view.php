<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">View Order Status - <?php echo $get_orderstatus_details->OrderId; ?> </h3>
                <p class="animated fadeInDown">
                    <a href="<?php echo base_url(); ?>orderstatus">Order Status</a> <span class="fa-angle-right fa"></span> <?php echo $get_orderstatus_details->OrderId; ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">


                    <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <tr>
                            <th>Table No.</th>
                            <th><?php echo $get_orderstatus_details->TableNumber; ?></th>
                        </tr>
                        <tr>
                            <th>Order DateTime</th>
                            <th><?php echo $get_orderstatus_details->OrderDateTime; ?></th>
                        </tr>
                        <tr>
                            <th>Last Updated DateTime</th>
                            <th><?php echo $get_orderstatus_details->LastUpdatedDateTime; ?></th>
                        </tr>
                        <tr>
                            <th>User Mobile Number</th>
                            <th><?php echo $get_orderstatus_details->UserMobileNumber; ?></th>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <th><?php echo PRICE . $get_orderstatus_details->TotalPrice; ?></th>
                        </tr>
                    </table>


                    <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Menu Course</th>
                                <th>Food Category</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($get_item_details as $item):
                                $quantity = $item['Quantity'];
                                $price = $item['Price'];
                                $cal_price = $price * $quantity;
                                ?>
                                <tr> 
                                    <td><?php echo $item['ItemCode']; ?> </td>
                                    <td><?php echo $item['MenuCourseCategoryName']; ?></td>
                                    <td><?php echo $item['FoodCategoryName']; ?></td>
                                    <td><?php echo $item['Name']; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo PRICE . $cal_price; ?></td>                                   
                                </tr>
                            <?php endforeach; ?> 
                        </tbody>
                    </table>



                </div>
            </div>
        </div>  
    </div>
</div>
<!-- end: content -->