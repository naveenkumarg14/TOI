<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Active Orders</h3>
                <p class="animated fadeInDown">
                    <a href="home">Home</a> <span class="fa-angle-right fa"></span> Active Orders
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Table No.</th>
                                    <th>Order Id</th>
                                    <th>Mobile</th>
                                    <th>Amount</th>
                                    <th>Order Date</th>
                                    <th>Total Items</th>
                                    <th>Delivered Items</th>
                                    <th>Not Delivered Items</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalrowcount = count($get_purchase);
                                foreach ($get_purchase as $item):
                                    $placed_orders_id = $item['PlacedOrdersId'];
                                    $view_url = site_url('purchase/purchase_view/' . $placed_orders_id);
                                    ?>
                                    <tr> 
                                        <td><?php echo $totalrowcount; ?> </td>
                                        <td><?php echo $item['TableNumber']; ?> </td>
                                        <td><?php echo $item['OrderId']; ?> </td>
                                        <td><?php echo $item['UserMobileNumber']; ?></td>
                                        <td><?php echo PRICE . $item['TotalPrice']; ?></td>
                                        <td><?php echo $item['OrderDateTime']; ?></td>
                                        <td><?php echo $item['totalorders']; ?></td>
                                        <td><?php echo $item['totaldeliveredorders']; ?></td>
                                        <td><?php echo $item['totalactiveorders']; ?></td>
                                        <td><a href="<?php echo $view_url; ?>" class="btn btn-primary btn-sm" role="button">View</a></td>
                                    </tr>
                                <?php $totalrowcount--; endforeach; ?>                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- end: content -->
