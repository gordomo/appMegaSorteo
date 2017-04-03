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
$order = (!empty($_GET['order'])) ? $_GET['order'] : false;
$ascdesc = (!empty($_GET['ascdesc'])) ? $_GET['ascdesc'] : false;

$resp = getUsrs($mysqli, $order, $ascdesc);
$usrs = $resp['usrs'];
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
                            <h4><i class="fa fa-angle-right"></i> USUARIOS</h4>
                        </div>        
                        <section>
                            <table class="table table-striped" style="width:100%">
                                <tr>
                                    <th class="order" data-order="name" data-ascdesc="<?=($order == "name" && $ascdesc == 'desc') ? 'asc' : 'desc'?>">Nombre <i class="<?=($order == "name" && $ascdesc == 'desc') ? 'fa fa-arrow-up' : 'fa fa-arrow-down'?>" aria-hidden="true"></i></th>
                                    <th class="order" data-order="mail" data-ascdesc="<?=($order == "mail" && $ascdesc == 'desc') ? 'asc' : 'desc'?>">e-mail <i class="<?=($order == "mail" && $ascdesc == 'desc') ? 'fa fa-arrow-up' : 'fa fa-arrow-down'?>" aria-hidden="true"></i></th>
                                    <th class="order" data-order="tel" data-ascdesc="<?=($order == "tel" && $ascdesc == 'desc') ? 'asc' : 'desc'?>">telefono <i class="<?=($order == "tel" && $ascdesc == 'desc') ? 'fa fa-arrow-up' : 'fa fa-arrow-down'?>" aria-hidden="true"></i></th>
                                    <th class="order" data-order="carton" data-ascdesc="<?=($order == "carton" && $ascdesc == 'desc') ? 'asc' : 'desc'?>">carton <i class="<?=($order == "carton" && $ascdesc == 'desc') ? 'fa fa-arrow-up' : 'fa fa-arrow-down'?>" aria-hidden="true"></i></th>
                                </tr>
                            
                            <?php foreach ($usrs as $usr) { ?>
                                <tr>
                                    <td><?=($usr['name'] == '') ? "No completó" : $usr['name'] ?></td>
                                    <td><?=($usr['mail'] == '') ? "No completó" : $usr['mail'] ?></td>
                                    <td><?=($usr['tel'] == 0) ? "No completó" : $usr['name'] ?></td>
                                    <td><?=($usr['carton'] == 0) ? "No completó" : $usr['carton'] ?></td>
                                </tr>
                            <?php } ?>
                            </table>
                        </section>
                    </div>    
                </section>        
            </section><! --/wrapper -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script>
                $(".order").on("click", function(){
                   location.href = "/megaback/gestor/usr-edit.php"+ "?order=" + $(this).data("order") + "&ascdesc=" + $(this).data("ascdesc");
                });
            </script>