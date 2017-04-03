<?php
include_once '../includes/db_connect.php';
include_once '../includes/funciones.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
    header("Location: index.php");
    exit();
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Salon de fiestas y eventos">
        <meta name="author" content="grupo veta srl">
        <title>ADMIN MEGA SORTEO</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">
        <!--external css-->
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style-responsive.css" rel="stylesheet">
        <link href="assets/css/table-responsive.css" rel="stylesheet">
        <!-- Custom CSS -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" type="image/png" href="img/favicon/favicon.ico"/>
    </head>
    <body>
        <div id="login-page">
            <div class="container">
                <form class="form-login" id="form-login" method="POST" action="process_login.php">
                <?php
                if (isset($_GET['error'])) 
                {
                    echo '<p class="error">email o password incorrecto</p>';
                }
                ?>
                <h2 class="form-login-heading">Administrador MEGA SORTEO </h2>
                <div class="login-wrap">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" autofocus />
                    <br>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                    <br />
                        <button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-lock"></i> Ingresar</button>
                    <br />
                    <a href="#" id='cambiarPass'>cambiar password</a> <div class="loading" style="float: right; display: none"><img style="max-width: 30px;" src="assets/img/preloader.gif"</div>
               </div>
                <div class="alert alert-info modificarClave"></div>
                </form>
            </div>
        </div>
        <script src="assets/js/jquery-3.2.0.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>