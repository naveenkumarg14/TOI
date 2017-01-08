<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Miminium Admin Template v.1">
        <meta name="author" content="Isna Nur Azis">
        <meta name="keyword" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Taste of India</title>
        <!-- start: Css -->
        <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/bootstrap.min.css">
        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/plugins/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/plugins/simple-line-icons.css"/>
        <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/plugins/animate.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/plugins/icheck/skins/flat/aero.css"/>
        <link href="<?php base_url(); ?>css/style.css" rel="stylesheet">
        <!-- end: Css -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>img/toi_logo.png">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
    </head>
    <body id="mimin" class="dashboard form-signin-wrapper">
        <div class="container">
            <form class="form-signin" action="" method="POST">
                <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger">';
                    echo $error;
                    echo '</div>';
                }
                ?>
                <div class="panel periodic-login">
                    <img src="img/toi_logo.png" style="float:left;"/> <p style="padding-top:55px;text-align:center;font-size: 22px;color:#000;" class="element-name"> Taste of India</p>
                    <div class="panel-body text-center">

                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="text" class="form-text" name="mobilenumber" required>
                            <span class="bar"></span>
                            <label>Username</label>
                        </div>
                        <div class="form-group form-animate-text" style="margin-top:40px !important;">
                            <input type="password" class="form-text" name="password" required>
                            <span class="bar"></span>
                            <label>Password</label>
                        </div>
                        <input type="submit" class="btn col-md-12" value="SignIn"/>
                    </div>
                    <div class="text-center" style="padding:5px;">

                    </div>
                </div>
            </form>
        </div>
        <!-- end: Content -->
        <!-- start: Javascript -->
        <script src="<?php base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php base_url(); ?>js/jquery.ui.min.js"></script>
        <script src="<?php base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php base_url(); ?>js/plugins/moment.min.js"></script>
        <script src="<?php base_url(); ?>js/plugins/icheck.min.js"></script>

        <!-- custom -->
        <script src="<?php base_url(); ?>js/main.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat-aero',
                    radioClass: 'iradio_flat-aero'
                });
            });
        </script>
        <!-- end: Javascript -->
    </body>
</html>