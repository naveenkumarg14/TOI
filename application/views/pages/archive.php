<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Archive</h3>
                <p class="animated fadeInDown">
                    <a href="home">Home</a> <span class="fa-angle-right fa"></span> Archive
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    
                    <div class="container">
    <div class='col-md-5'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker6'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-5'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker7'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>
                    
                    
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Mobile</th>
                                    <th>Amount</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($get_archive as $item):
                                    $placed_orders_id = $item['PlacedOrdersId'];
                                    $view_url = site_url('History/history_view/' . $placed_orders_id);
                                    ?>
                                    <tr> 
                                        <td><?php echo $item['OrderId']; ?> </td>
                                        <td><?php echo $item['UserMobileNumber']; ?></td>
                                        <td><?php echo PRICE . $item['TotalPrice']; ?></td>
                                        <td><?php echo $item['OrderDateTime']; ?></td>
                                        <td><a href="<?php echo $view_url; ?>" class="btn btn-primary btn-sm" role="button">View</a></td>
                                    </tr>
                                <?php endforeach; ?>                             
                            </tbody>                         
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- end: content -->