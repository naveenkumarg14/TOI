<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">View Archive - <?php echo $get_archive_details->OrderId; ?> </h3>
                <p class="animated fadeInDown">
                    <a href="<?php echo base_url(); ?>archive">Archive</a> <span class="fa-angle-right fa"></span> <?php echo $get_archive_details->OrderId; ?>
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
                            <th>Order ID</th>
                            <th><?php echo $get_archive_details->OrderId; ?></th>
                        </tr>
                        <tr>
                            <th>Table No.</th>
                            <th><?php echo $get_archive_details->TableNumber; ?></th>
                        </tr>
                        <tr>
                            <th>Order DateTime</th>
                            <th><?php echo $get_archive_details->OrderDateTime; ?></th>
                        </tr>
                        <tr>
                            <th>User Mobile Number</th>
                            <th><?php echo $get_archive_details->UserMobileNumber; ?></th>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <th><?php echo PRICE . $get_archive_details->TotalPrice; ?></th>
                        </tr>
                        <tr>
                            <th>Total Amount Paid</th>
                            <th><?php echo PRICE . $get_archive_details->AmountPaid; ?></th>
                        </tr>
                        <tr>
                            <th>Payment Status</th>
                            <th><?php echo $get_archive_details->PaymentStatus; ?></th>
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
                                <th>Table No.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($get_item_details as $item) {
                                $json_item_details = $item['ItemDetails'];
                                $result_item_details = json_decode($json_item_details, true);

                                $quantity = $result_item_details['quantity'];
                                $price = $result_item_details['price'];
                                $cal_price = $price * $quantity;
                                ?> 
                                <tr> 
                                    <td><?php echo $result_item_details['menuItemCode']; ?> </td>
                                    <td><?php echo $result_item_details['menuCourse']; ?></td>
                                    <td><?php echo $result_item_details['foodCategory']; ?></td>
                                    <td><?php echo $result_item_details['name']; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo PRICE . $cal_price; ?></td>  
                                    <td><?php echo $result_item_details['tableNumber']; ?></td>
                                </tr>
                            <?php } ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- end: content -->