<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Miminium Admin Template v.1">
        <meta name="author" content="Isna Nur Azis">
        <meta name="keyword" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="30" />
        <title>Taste of India</title>
        <!-- start: Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/plugins/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/plugins/simple-line-icons.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/plugins/datatables.bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/plugins/animate.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/plugins/fullcalendar.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/plugins/spinkit.css"/>
        <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
        <!-- end: Css -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/toi_logo.png">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->



        <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/plugins/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/plugins/animate.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/plugins/nouislider.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/plugins/select2.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/plugins/ionrangeslider/ion.rangeSlider.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/plugins/ionrangeslider/ion.rangeSlider.skinFlat.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/plugins/bootstrap-material-datetimepicker.css"/>
        <link href="<?php echo base_url(); ?>/css/style.css" rel="stylesheet">


    </head>

    <body id="mimin" class="dashboard">
        <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
            <div class="col-md-12 nav-wrapper">
                <div class="navbar-header" style="width:100%;">
                    <div class="opener-left-menu is-open">
                        <span class="top"></span>
                        <span class="middle"></span>
                        <span class="bottom"></span>
                    </div>
<!--                    <img src="img/toi_logo.png"/> -->
                    <a href="home" class="navbar-brand"> 
                        <b>Taste of India</b>
                    </a>

                    <ul class="nav navbar-nav navbar-right user-nav">
                        <li class="user-name"><span><?php echo $this->session->userdata['MerchantName']; ?></span></li>
                        <li class="dropdown avatar-dropdown">
                            <img src="<?php echo base_url(); ?>img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                            <ul class="dropdown-menu user-dropdown">
                                <li><a href="<?php echo base_url(); ?>signin/logout"><span class="fa fa-power-off "> Log out</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end: Header -->

        <div class="container-fluid mimin-wrapper">
            <!-- start:Left Menu -->
            <div id="left-menu">
                <div class="sub-left-menu scroll">
                    <ul class="nav nav-list"> 
                        <li><div class="left-bg"></div></li>
                        <li class="time">
                            <h1 class="animated fadeInLeft">21:00</h1>
                            <p class="animated fadeInRight">Sat,October 1st 2029</p>
                        </li>
                        <li><a href="<?php echo base_url(); ?>home"><span class="fa-home fa"></span>Dashboard</a></li>
                        <li><a href="<?php echo base_url(); ?>purchase"><span class="fa-area-chart fa"></span>Active Orders</a></li>
                        <li><a href="<?php echo base_url(); ?>orderstatus"><span class="fa-diamond fa"></span> Order Status</a></li>
                        <li><a href="<?php echo base_url(); ?>history"><span class="fa-history fa"></span> History</a></li>
                        <li><a href="<?php echo base_url(); ?>products"><span class="fa-list fa"></span> Products</a></li>
                    </ul>   
                </div>
            </div>
            <!-- end: Left Menu -->
        </div>