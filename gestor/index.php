<?php
include_once '../includes/db_connect.php';
include_once '../includes/funciones.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
if ($logged == 'out') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">

        <title>Administración MEGA SORTEO</title>

        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <!--external css-->

        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
        <link href="assets/css/table-responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <section id="container" >
            <?php include_once 'header.php'; ?>

            <?php include_once 'sidebar.php'; ?>
            <!-- **********************************************************************************************************************************************************
            MAIN CONTENT
            *********************************************************************************************************************************************************** -->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper site-min-height">
                    <div class="row mt">
                        <!-- PANEL 1 -->
                        <div class="col-md-4 mb">
                            <div class="panel-1 pn">
                                <div class="panel-1-header">
                                    <h5>USUARIOS</h5>
                                </div>
                                <div class="centered">

                                </div>
                            </div>
                        </div>
                        <!-- PANEL 2 -->
                        <div class="col-md-4 mb">
                            <div class="panel-2 pn">
                                <div class="panel-2-header">
                                    <h5>NOTICIAS</h5>
                                </div>
                                <div class="centered">

                                </div>
                            </div>
                        </div>
                        <!-- PANEL 3 -->
                        <div class="col-md-4 mb">
                            <div class="panel-3 pn">
                                <div class="panel-3-header">
                                    <h5>GANADORES</h5>
                                </div>
                                <div class="centered">

                                </div>
                            </div>
                        </div>
                        <!-- PANEL 4 -->
                        <div class="col-md-4 mb">
                            <div class="panel-4 pn">
                                <div class="panel-4-header">
                                    <h5>NOTIFICACIONES</h5>
                                </div>
                                <div class="centered">

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!--script for this page-->
        <script>
            $('.panel-1').click(function () {
                location.href = 'usr-edit.php';
            });
            $('.panel-2').click(function () {
                location.href = 'news-edit.php';
            });
            $('.panel-3').click(function () {
                location.href = 'ganadores-edit.php';
            });
            $('.panel-4').click(function () {
                location.href = 'notificaciones.php';
            });

        </script>

    </body>
</html>
