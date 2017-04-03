<?php
include_once 'includes/db_connect.php';
include_once 'includes/funciones.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
switch ($action){
    
    case 'add':
        $carton = isset($_REQUEST['carton']) ? $_REQUEST['carton'] : '';
        $mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : '';
        echo json_encode(addUsr($mysqli, $carton, $mail));
        exit();
    break;
    case 'addUsrSoloMail':
        $mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : '';
        echo json_encode(addUsr($mysqli, 0, $mail));
        exit();
    break;

    case 'removeUsr':
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        echo json_encode(deleteUsrById($mysqli, $id));
        exit();
    break;

    case 'editarUsr':
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $carton = isset($_REQUEST['carton']) ? $_REQUEST['carton'] : '';
        $mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : '';
        $habilitado = isset($_REQUEST['habilitado']) ? $_REQUEST['habilitado'] : 1;
        $logued = isset($_REQUEST['logued']) ? $_REQUEST['logued'] : 0;
        $name = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $nac = isset($_REQUEST['nac']) ? $_REQUEST['nac'] : '';
        $photo = isset($_REQUEST['photo']) ? $_REQUEST['photo'] : 'assets/img/profile-default.jpeg';
        $doc = isset($_REQUEST['doc']) ? $_REQUEST['doc'] : '';
        echo json_encode(updateUsrById($mysqli, $id, $carton, $mail, $habilitado, $logued, $name, $address, $nac, $photo, $doc));
        exit();
    break;
    case 'editGcmUsr':
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $gcmcode = isset($_REQUEST['gsmcode']) ? $_REQUEST['gsmcode'] : '';
        echo "jsonpCallback(".json_encode(updateUsrGcmById($mysqli, $id, $gcmcode)).")";
        exit();
    break;
    case 'getUsrById':
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        echo "jsonpCallback(".json_encode(getUsrById($mysqli, $id)).")";
        exit();
    break;
    case 'getUsrByMailCarton':
        $carton = isset($_REQUEST['carton']) ? $_REQUEST['carton'] : '';
        $mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : '';
        echo json_encode(getUsrByMailCarton($mysqli, $carton, $mail));
        exit();
    break;

    case 'getUsrByDocCarton':
        $carton = isset($_REQUEST['carton']) ? $_REQUEST['carton'] : '';
        $doc = isset($_REQUEST['doc']) ? $_REQUEST['doc'] : '';
        echo json_encode(getUsrByDocCarton($mysqli, $carton, $doc));
        exit();
    break;

    case 'getUsrByMail':
        $mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : '';
        echo json_encode(getUsrByMail($mysqli, $mail));
        exit();
    break;

    case 'updateUserLogStatus':
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $logued = isset($_REQUEST['logued']) ? $_REQUEST['logued'] : '';
        echo "jsonpCallback(".json_encode(updateUserLogStatus($mysqli, $id, $logued)).")";
        exit();
    break;

    case 'newNoticia':
        $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : '';
        $subtitulo = isset($_REQUEST['sub']) ? $_REQUEST['sub'] : '';
        $cuerpo = isset($_REQUEST['cuerpo']) ? $_REQUEST['cuerpo'] : '';
        $habilitado = isset($_REQUEST['habilitado']) ? $_REQUEST['habilitado'] : '';
        addNew($mysqli, $_FILES, $titulo, $subtitulo, $cuerpo, $habilitado);
    break;

    case 'editarNoticia':
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : '';
        $subtitulo = isset($_REQUEST['subtitulo']) ? $_REQUEST['subtitulo'] : '';
        $cuerpo = isset($_REQUEST['cuerpo']) ? $_REQUEST['cuerpo'] : '';
        $habilitado = isset($_REQUEST['habilitado']) ? $_REQUEST['habilitado'] : '';
        updateNew($mysqli, $_FILES, $titulo, $subtitulo, $cuerpo, $habilitado, $id);
    break;

    case 'borrarNoticia':
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        deleteNew($mysqli, $id);
    break;

    case 'getNews':
        $habilitadas = isset($_REQUEST['habilitadas']) ? $_REQUEST['habilitadas'] : "no";
        echo json_encode(getNews($mysqli,$habilitadas));
    break;

//GANADORES

    case 'newGanador':
        $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : '';
        $subtitulo = isset($_REQUEST['subtitulo']) ? $_REQUEST['subtitulo'] : '';
        $texto = isset($_REQUEST['texto']) ? $_REQUEST['texto'] : '';
        $habilitado = isset($_REQUEST['habilitado']) ? $_REQUEST['habilitado'] : '';
        addGanador($mysqli, $_FILES, $titulo, $subtitulo, $texto, $habilitado);
    break;

    case 'editarGanador':
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $texto = isset($_REQUEST['texto']) ? $_REQUEST['texto'] : '';
        $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : '';
        $subtitulo = isset($_REQUEST['subtitulo']) ? $_REQUEST['subtitulo'] : '';
        $habilitado = isset($_REQUEST['habilitado']) ? $_REQUEST['habilitado'] : '';
        updateGanador($mysqli, $_FILES, $titulo, $subtitulo, $texto, $habilitado, $id);
    break;

    case 'borrarGanador':
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        deleteGanador($mysqli, $id);
    break;

    case 'getGanadores':
        $habilitadas = isset($_REQUEST['habilitadas']) ? $_REQUEST['habilitadas'] : "no";
        echo json_encode(getGanadores($mysqli, $habilitadas));
    break;

    case 'sendNotifications':
        $messageText = isset($_REQUEST['messageText']) ? $_REQUEST['messageText'] : '';
        $titulo = isset($_REQUEST['titulo']) ? $_REQUEST['titulo'] : '';
        echo json_encode(sendNotifications($mysqli,$titulo, $messageText));
    break;

    case 'cambiarPass':
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        echo json_encode(cambiarPass($mysqli, $email));
    break;

    default:
    break;
}

