<!--<meta http-equiv="refresh" content="30" />-->
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

                    <form action="" method="POST">
                        <div class='col-md-4'>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker6'>
                                    <input type='text' class="form-control" name="startdatetime" id="startdatetime"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker7'>
                                    <input type='text' class="form-control" name="enddatetime" id="enddatetime"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-4'>
                            <div class="form-group">
                                <input type="submit" class="btn" value="submit"/>
                            </div>
                        </div>
                    </form>

                    <br><br>

                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Table No.</th>
                                    <th>Order Id</th>
                                    <th>Mobile</th>
                                    <th>Amount</th>
                                    <th>Amount Paid</th>
                                    <th>Order Date</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($get_archive !== "") {
                                    $totalrowcount = count($get_archive);
                                    foreach ($get_archive as $item):
                                        $HistoryId = $item['HistoryId'];
                                        $view_url = site_url('Archive/archive_view/' . $HistoryId);
                                        ?>
                                        <tr> 
                                            <td><?php echo $totalrowcount; ?> </td>
                                            <td><?php echo $item['TableNumber']; ?> </td>
                                            <td><?php echo $item['OrderId']; ?> </td>
                                            <td><?php echo $item['UserMobileNumber']; ?></td>
                                            <td><?php echo PRICE . $item['TotalPrice']; ?></td>
                                            <td><?php echo PRICE . $item['AmountPaid']; ?></td>
                                            <td><?php echo $item['OrderDateTime']; ?></td>
                                            <td><?php echo $item['PaymentStatus']; ?></td>
                                            <td><a href="<?php echo $view_url; ?>" class="btn btn-primary btn-sm" role="button">View</a></td>
                                        </tr>
                                        <?php
                                        $totalrowcount--;
                                    endforeach;
                                }
                                ?>                             
                            </tbody>                         
                        </table>
                    </div>

                </div>
            </div>
        </div>  
    </div>
</div>
<!-- end: content -->