<!-- start: content -->
<div id="content">

    <input type="hidden" id="todaysPurchaseCount" value="<?php echo $todaysPurchaseCount; ?>"/>
    <input type="hidden" id="todaysOrderstatusCount" value="<?php echo $todaysOrderstatusCount; ?>"/>
    <input type="hidden" id="todaysHistoryCount" value="<?php echo $todaysHistoryCount; ?>"/>

    <div class="col-md-12" style="padding:20px;">

        <div class="col-md-4">
            <div class="panel box-v1">
                <div class="panel-heading bg-white border-none">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                        <h4 class="text-left">Active Orders</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <h4>
                            <span class="fa-area-chart fa text-right"></span>
                        </h4>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <h1><?php echo $purchaseCount; ?></h1>
                    <p>Orders</p>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel box-v1">
                <div class="panel-heading bg-white border-none">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                        <h4 class="text-left">Order Status</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <h4>
                            <span class="fa-diamond fa text-right"></span>
                        </h4>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <h1><?php echo $orderstatusCount; ?></h1>
                    <p>Unpaid</p>
                    <hr/>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel box-v1">
                <div class="panel-heading bg-white border-none">
                    <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                        <h4 class="text-left">History</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <h4>
                            <span class="fa-history fa text-right"></span>
                        </h4>
                    </div>
                </div>
                <div class="panel-body text-center">
                    <h1><?php echo $get_history_count; ?></h1>
                    <p>Delivered | Cancelled</p>
                    <hr/>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12" style="padding:20px;">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading-white panel-heading text-center">
                    <h4>Today's Orders</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <center>
                        <p id="nodaydata" style="display:none;">No purchase yet</p>
                        <canvas class="todaypurchase-chart"></canvas>
                    </center>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading-white panel-heading text-center">
                    <h4>Weekly Orders</h4>
                </div>
                <div class="panel-body">
                    <canvas class="bar-chart"></canvas>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- end: content 