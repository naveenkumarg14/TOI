<!-- start: Mobile -->
<div id="mimin-mobile" class="reverse">
    <div class="mimin-mobile-menu-list">
        <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
            <ul class="nav nav-list">
                <li><a href="#"><span class="fa-home fa"></span>Dashboard</a></li>
                <li><a href="purchase"><span class="fa-area-chart fa"></span>Purchase</a></li>
                <li><a href=""><span class="fa-diamond fa"></span>Order Status</a></li>
                <li><a href=""><span class="fa-send fa"></span>Delivered</a></li>
                <li><a href=""><span class="fa-warning fa"></span>Cancelled</a></li>
                <li><a href=""><span class="fa-history fa"></span>History</a></li>
                <li><a href=""><span class="fa-key fa"></span>Api Key</a></li>
                <li><a href=""><span class="fa-user fa"></span>Profile</a></li>
                <li><a href=""><span class="fa-contao fa"></span>Configuration</a></li>
            </ul>
        </div>
    </div>       
</div>
<button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
    <span class="fa fa-bars"></span>
</button>
<!-- end: Mobile -->

<!-- start: Javascript -->
<script src="<?php echo base_url(); ?>js/jquery.ui.min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<!-- plugins -->
<script src="<?php echo base_url(); ?>js/plugins/moment.min.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/datatables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/chart.min.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/jquery.nicescroll.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatables-example').DataTable({
            "ordering": false
        });
    });
</script>
<!-- custom -->
<script src="<?php echo base_url(); ?>js/main.js"></script>
<script type="text/javascript">
    idleTimer = null;
    idleState = false;
    idleWait = 600000;
    (function ($) {
        $(document).ready(function () {
            $('*').bind('mousemove keydown scroll', function () {
                clearTimeout(idleTimer);
                if (idleState === true) {
                    // Reactivated event
                    $("body").append("<p>Welcome Back.</p>");
                }
                idleState = false;
                idleTimer = setTimeout(function () {
                    // Idle Event
                    $("body").append("<p>You've been idle for " + idleWait / 1000 + " seconds.</p>");
                    var xhr = new XMLHttpRequest();
                    xhr.onload = function () {
                        document.location = 'signin/logout';
                    }
                    xhr.open('GET', '<?php echo base_url();?>signin/logout', true);
                    xhr.send();

                    idleState = true;
                }, idleWait);
            });
            $("body").trigger("mousemove");
        });
    })(jQuery)
</script>
<script type="text/javascript">

    function populateWeekGraph(purchaseData, cancelData) {

        var barData = {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "#A9282A",
                    strokeColor: "#A9282A",
                    highlightFill: "#A9282A",
                    highlightStroke: "#A9282A",
                    data: purchaseData
                },
                {
                    label: "My Second dataset",
                    fillColor: "#DB3739",
                    strokeColor: "#DB3739",
                    highlightFill: "#DB3739",
                    highlightStroke: "#DB3739",
                    data: cancelData
                }
            ]
        };

        var ctx4 = $(".bar-chart")[0].getContext("2d");
        window.myBar = new Chart(ctx4).Bar(barData, {
            responsive: true,
            showTooltips: true
        });

    }
    (function (jQuery) {

        var purchaseData = ["0", "0", "0", "0", "0", "0", "0"];
        var cancelData = ["0", "0", "0", "0", "0", "0", "0"];
        $.ajax({
            url: 'Pages/Get_weekly_data',
            type: 'get',
            dataType: "json",
            success: function (response) {

                purchaseData = response['purchaseData'];
                cancelData = response['cancelData'];
                populateWeekGraph(purchaseData, cancelData);
            },
            error: function (xhr, desc, err) {
                populateWeekGraph(purchaseData, cancelData);
            }
        });



        // Todays Purchase data
        var todaysPurchaseCount = document.getElementById('todaysPurchaseCount').value;
        var todaysOrderstatusCount = document.getElementById('todaysOrderstatusCount').value;
        var todaysHistoryCount = document.getElementById('todaysHistoryCount').value;
        if (todaysPurchaseCount > 0 || todaysOrderstatusCount > 0 || todaysHistoryCount > 0) {
            document.getElementById('nodaydata').style.display = 'none';
        } else {
            document.getElementById('nodaydata').style.display = 'block';
        }
        var TodaysPurchaseData = [
            {
                value: parseInt(todaysPurchaseCount),
                color: "#FF4E50",
                highlight: "#FF4E50",
                label: "Active Orders"
            },
            {
                value: parseInt(todaysOrderstatusCount),
                color: "#DB3739",
                highlight: "#DB3739",
                label: "Order Status"
            },
            {
                value: parseInt(todaysHistoryCount),
                color: "#A9282A",
                highlight: "#A9282A",
                label: "History"
            }

        ];

        window.onload = function () {

            var ctx = $(".todaypurchase-chart")[0].getContext("2d");
            window.myDoughnut = new Chart(ctx).Doughnut(TodaysPurchaseData, {
                responsive: true,
                showTooltips: true
            });

       };
    })(jQuery);

</script>

<script type="text/javascript">
                                            $(function () {
                                                $('#datetimepicker6').datetimepicker();
                                                $('#datetimepicker7').datetimepicker({
                                                    useCurrent: false
                                                });
                                                $("#datetimepicker6").on("dp.change", function (e) {
                                                    $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                                                });
                                                $("#datetimepicker7").on("dp.change", function (e) {
                                                    $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                                                });
                                            });
        </script>

<!-- end: Javascript -->
</body>
</html>