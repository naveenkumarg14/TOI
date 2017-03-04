<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <button onclick="printReceipt();" class="btn pull-right">Print Receipt</button>
                <h3 class="animated fadeInLeft">View Mobile Pay - <?php echo $get_orderstatus_details->OrderId; ?> </h3>
                <p class="animated fadeInDown">
                    <a href="<?php echo base_url(); ?>orderstatus">Mobile Pay</a> <span class="fa-angle-right fa"></span> <?php echo $get_orderstatus_details->OrderId; ?>
                </p>                  
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <form action="" method="POST" name="otherpayform">
                        <div class="col-lg-8">
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group form-animate-text">
                                <input type="number" class="form-text" name="amountpaid" required>
                                <span class="bar"></span>
                                <label>Amount</label>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <br>
                            <input type="submit" class="btn" value="Submit"/>
                        </div>
                    </form>

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
                        <tr>
                            <th>Order Status</th>
                            <th><?php
                                $purchase_uuid = $get_orderstatus_details->PurchaseUUID;
                                if ($purchase_uuid != NULL) {
                                    echo "Synced";
                                } else {
                                    echo "Not Synced";
                                }
                                ?></th>
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
                                    <td><?php echo $item['TableNumber']; ?></td>
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

<div id="hidden_div" style="display: none;">
    <div class="inner-heading">
        <img src="<?php echo base_url(); ?>img/toi_logo.png"/> 
        <h4> Taste of India</h4>
        <p>293-295 High St N, <br>East Ham, <br>London E12 6SL</p>
    </div>
    <div class="inner-body">

        <div style="width:50%;float:left;">
            <p>Date : <?php echo date("d-M-Y", strtotime($get_orderstatus_details->LastUpdatedDateTime)); ?><br>
                Time : <?php echo date("H:i:s", strtotime($get_orderstatus_details->LastUpdatedDateTime)); ?></p>
        </div>

        <div  style="width:50%;float:left;">
            <p>Table No. <?php echo $get_orderstatus_details->TableNumber; ?><br>
                Bill No. <?php echo $get_orderstatus_details->OrderId; ?></p>
        </div>


        <table class="table table-bordered" width="100%" cellspacing="0" style="border: none;">
            <?php
            foreach ($get_item_details as $item):
                $quantity = $item['Quantity'];
                $price = $item['Price'];
                $cal_price = $price * $quantity;
                ?>
                <tr> 
                    <th><?php echo $quantity . " x " . $item['Name']; ?></th>
                    <td><?php echo PRICE . $cal_price; ?></td> 
                </tr>
            <?php endforeach; ?> 
            <tr>
                <th style="text-align: right;">SUBTOTAL</th>
                <td><?php echo PRICE . $get_orderstatus_details->TotalPrice; ?></td>
            </tr>
            <tr>
                <th style="text-align: right;">TAX</th>
                <td><?php echo PRICE . $get_orderstatus_details->TotalPrice; ?></td>
            </tr>
            <tr>
                <th style="text-align: right;">TOTAL</th>
                <td><?php echo PRICE . $get_orderstatus_details->TotalPrice; ?></td>
            </tr>
        </table>
    </div>
    <div class="inner-footer">
        <p>THANK YOU FOR DINING WITH US!<br>PLEASE COME AGAIN</p>
    </div>
</div>