
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Not Authorized </title>
        <link rel="shortcut icon" href="<?=URL ?>public/image/icon.ico">
        <link href="<?=URL ?>public/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=URL ?>public/css/custom_1.css" rel="stylesheet">
        <script src="<?=URL ?>public/js/jquery.min.js"></script>


    </head>


    <body class="nav-md">

        <div class="container body">

            <div class="main_container">

                <!-- page content -->
                <div class="col-md-12">
                    <div class="col-middle">
                        <div class="text-center">
                            <h1 class="error-number">Not Authorized</h1>
                            <h2><?=$message?$message:"Login to view the requested page"?></h2>
                            <p>We track these errors automatically, but if the problem persists feel free to contact us. <br>In the meantime, try refreshing. <a href="#">Report this?</a>
                            </p>
                            <p><a href="<?=URL ?>logout">Refresh Page</a>
                            </p>
                       
                        </div>
                    </div>
                </div>
                <!-- /page content -->

            </div>
            <!-- footer content -->
        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        <script src="<?=URL ?>js/bootstrap.min.js"></script>
    </body>

</html>