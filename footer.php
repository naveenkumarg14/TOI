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
<script>
    function printReceipt() {
        document.getElementById('hidden_div').style.display = 'block';
        window.print();
        document.getElementById('hidden_div').style.display = 'none'
    }
</script>

<!-- start: Javascript -->
<!--<script src="<?php //echo base_url();                ?>js/jquery.min.js"></script>
<script src="<?php //echo base_url();                ?>js/jquery.ui.min.js"></script>
<script src="<?php //echo base_url();                ?>js/bootstrap.min.js"></script>-->

<!-- plugins -->
<script src="<?php echo base_url(); ?>js/plugins/moment.min.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/jquery.datatables.min.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/datatables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/chart.min.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/morris.min.js"></script>
<script src="<?php echo base_url(); ?>js/plugins/raphael.min.js"></script>
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
                    xhr.open('GET', '<?php echo base_url(); ?>signin/logout', true);
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
        var todaysOtherPayCount = document.getElementById('todaysOtherPayCount').value;
        var todaysHistoryCount = document.getElementById('todaysHistoryCount').value;
        if (todaysPurchaseCount > 0 || todaysOrderstatusCount > 0 || todaysHistoryCount > 0 || todaysOtherPayCount > 0) {
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
                label: "Mobile Pay"
            },
            {
                value: parseInt(todaysHistoryCount),
                color: "#A9282A",
                highlight: "#A9282A",
                label: "History"
            },
            {
                value: parseInt(todaysOtherPayCount),
                color: "#E35151",
                highlight: "#E35151",
                label: "Other Pay"
            }

        ];

        var doughnutData = [
            {
                value: 100,
                color: "#4ED18F",
                highlight: "#15BA67",
                label: "Alfa"
            },
            {
                value: 250,
                color: "#15BA67",
                highlight: "#15BA67",
                label: "Beta"
            },
            {
                value: 100,
                color: "#5BAABF",
                highlight: "#15BA67",
                label: "Gamma"
            },
            {
                value: 40,
                color: "#94D7E9",
                highlight: "#15BA67",
                label: "Peta"
            },
            {
                value: 120,
                color: "#BBE0E9",
                highlight: "#15BA67",
                label: "X"
            }

        ];

        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(21,186,103,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(21,113,186,0.5)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        };

        window.onload = function () {

            var ctx = $(".todaypurchase-chart")[0].getContext("2d");
            window.myDoughnut = new Chart(ctx).Doughnut(TodaysPurchaseData, {
                responsive: true,
                showTooltips: true
            });

            var ctx2 = $(".pie-chart")[0].getContext("2d");
            window.myPie = new Chart(ctx2).Pie(doughnutData, {
                responsive: true,
                showTooltips: true
            });

            var ctx3 = $(".line-chart")[0].getContext("2d");
            window.myLine = new Chart(ctx3).Line(lineChartData, {
                responsive: true,
                showTooltips: true
            });
        };
    })(jQuery);


    (function (jQuery) {
        Morris.Bar({
            element: 'bar-chart1',
            data: [
                {x: '2011 Q1', y: 3, z: 2, a: 3},
                {x: '2011 Q2', y: 2, z: null, a: 1},
                {x: '2011 Q3', y: 0, z: 2, a: 4},
                {x: '2011 Q4', y: 2, z: 4, a: 3}
            ],
            xkey: 'x',
            ykeys: ['y', 'z', 'a'],
            labels: ['Buyer', 'Creditor', 'Investor'],
            barColors: ['#FF3835', '#515151', '#6C76FF']
        }).on('click', function (i, row) {
            console.log(i, row);
        });
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