<?php
include_once '../includes/db_connect.php';
include_once '../includes/funciones.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

if($logged == 'out'){
    header("Location: login.php");
    exit();
}

$resp = getNews($mysqli);
$news = $resp['news'];

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

  <section id="container" >
    <?php include_once 'header.php'; ?>
    <?php include_once 'sidebar.php'; ?>
            <section id="main-content">
                <section class="wrapper">
                    <h3><i class="fa fa-angle-right"></i>NOTICIAS</h3>
                    <div class="row mt">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h4><i class="fa fa-angle-right"></i> Nueva Noticia</h4>
                                <section id="editor_grilla_nueva">
                                    <form class="form" enctype="multipart/form-data" method="POST" action="../actions.php">
                                        <input type="hidden" value="newNoticia" name="action" id="action">
                                        <div class="form-group">
                                            <input type="file" accept="file_extension|image"  id="photo" name="photo" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">Titulo: </label>
                                            <input type="text" class="form-control" required="true" name="titulo" id="titulo">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">Subtitulo: </label>
                                            <input type="text" class="form-control" required="true" name="sub" id="sub">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">Cuerpo: </label>
                                            <textarea id='cuerpo' name="cuerpo" required="true" style="width: 100%;height: 7rem;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-2 control-label">Habilitado: </label>
                                            <select class="form-control" name="habilitado">
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                                <button type="submit" class="btn btn-success">Agregar Noticia</button>
                                                <img class="newImgCargando" src="assets/img/preloader.gif">
                                                <span class="newImgCargando">Cargando...</span>
                                        </div>
                                    </form>
                                </section>
                            </div><!-- /content-panel -->
                        </div>
                    </div>
                    
                    <div class="row mt form-panel">
                        <div class="col-md-12">
                            <h4><i class="fa fa-angle-right"></i> EDITAR NOTICIAS</h4>
                        </div>        
                        <section>
                                    <?php foreach ($news as $new){ ?>
                                    <div class="edicionFotos">
                                        <form class="form" enctype="multipart/form-data" method="POST" action="../actions.php">
                                            <input type="hidden" value="editarNoticia" name="action" id="action">
                                            <input type="hidden" value="<?= $new['id'] ?>" name="id" id="id">
                                            <div class="form-group col-md-4" style="height: 200px; width: 200px">
                                                <img class="img-responsive" src="../<?= $new['url_thumb'] ?>" style="max-height: 200px !important;">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" accept="file_extension|image"  id="photo" name="photo" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label">Titulo: </label>
                                                <input type="text" class="form-control" required="true" name="titulo" id="titulo" value="<?= $new['titulo'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label">Subtitulo: </label>
                                                <input type="text" class="form-control" required="true" name="subtitulo" id="subtitulo" value="<?= $new['subtitulo'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label">Cuerpo: </label>
                                                <textarea id='cuerpo' name="cuerpo" style="width: 100%;height: 7rem;"><?= $new['cuerpo'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label">Habilitado: </label>
                                                <select class="form-control" name="habilitado">
                                                    <option value="1" <?php if($new['habilitado'] == 1){echo 'selected';}?>>Si</option>
                                                    <option value="0" <?php if($new['habilitado'] == 0){echo 'selected';}?>>No</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success">Editar Noticia</button>
                                            <a class="btn btn-danger borrar" href="../actions.php?action=borrarNoticia&id=<?=$new['id']?>">Eliminar Noticia</a>
                                            <img style="display: none" class="editImgCargando<?=$new['id']?>" src="assets/img/preloader.gif">
                                            <span style="display: none" class="editImgCargando<?=$new['id']?>">Cargando...</span>
                                        </form>
                                    </div>
                                    <?php } ?>
                                </section>
                            </div>
                    
                      
                </section>        
            </section><! --/wrapper -->