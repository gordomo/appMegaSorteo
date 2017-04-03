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
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
        <link href="assets/css/table-responsive.css" rel="stylesheet">
        <script src="assets/js/main.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <?php include_once 'header.php'; ?>
        <?php include_once 'sidebar.php'; ?>
        <section id="main-content">
            <section class="wrapper">
                <div class="row mt form-panel">
                    <div class="col-md-12">
                        <h4><i class="fa fa-angle-right"></i> Notificaciones</h4>
                    </div>        
                    <section>
                        <form method="post" action="../actions.php">
                            <input type="hidden" value="sendNotifications" name="action" id="action">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" required="true" name="titulo" id="titulo" placeholder="titulo">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" required="true" name="messageText" id="messageText" placeholder="texto"></textarea>
                                </div>    
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" id="enviar">
                                </div>
                            </div>
                        </form>
                    </section>
                </div>    
            </section>        
        </section><! --/wrapper -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>