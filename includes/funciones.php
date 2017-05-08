<?php
require("class.phpmailer.php");
require("class.smtp.php");
include_once 'resizeImage.php';

########################GETTERS#################################################
################################################################################

function getUsrByCarton($mysqli, $carton = '') {
    $usrs = [];
    $message = '';
    $result = "ok";
    $found = false;
    $query = "SELECT id, mail, carton, habilitado, logued, name, address, nac, photo, doc FROM usuarios WHERE carton = ?";
    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("s", $carton);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($id, $mail, $carton, $habilitado, $logued, $name, $address, $nac, $photo, $doc);
        /* obtener valor */
        while ($stmt->fetch()) {
            $usrs[] = ["id" => $id, "mail" => $mail, "carton" => $carton, "habilitado" => $habilitado, "logued" => $logued, "name" => $name, "address" => $address, "nac" => $nac, "photo" => $photo, "doc" => $doc];
            $found = true;
        }
        /* cerrar sentencia */
        $stmt->close();
    }
    return ["result" => $result, "message" => $message, "usrs" => $usrs, "found" => $found];
}

function getUsrById($mysqli, $id = '') {
    $usrs = [];
    $message = '';
    $result = "ok";
    $found = false;
    $query = "SELECT id, mail, carton, habilitado, logued, name, address, nac, photo, doc, gcmcode FROM usuarios WHERE id = ?";
    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("i", $id);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($id, $mail, $carton, $habilitado, $logued, $name, $address, $nac, $photo, $doc, $gcmcode);
        /* obtener valor */
        $stmt->fetch();
        $usr = ["id" => $id, "mail" => $mail, "carton" => $carton, "habilitado" => $habilitado, "logued" => $logued, "name" => $name, "address" => $address, "nac" => $nac, "photo" => $photo, "doc" => $doc, "gcmcode" => $gcmcode];
        $found = ($mail !== '');
        /* cerrar sentencia */
        $stmt->close();
    }
    return ["result" => $result, "message" => $message, "usr" => $usr, "found" => $found];
}

function getUsrByMail($mysqli, $mail = '') {
    $message = '';
    $result = "ok";
    $found = false;
    $query = "SELECT id, mail, carton, habilitado, logued, name, address, nac, photo, doc, gcmcode FROM usuarios WHERE mail = ? LIMIT 1";
    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("s", $mail);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($id, $mail, $carton, $habilitado, $logued, $name, $address, $nac, $photo, $doc, $gcmcode);
        /* obtener valor */
        $found = $stmt->fetch();
        $usr = ["id" => $id, "mail" => $mail, "carton" => $carton, "habilitado" => $habilitado, "logued" => $logued, "name" => $name, "address" => $address, "nac" => $nac, "photo" => $photo, "doc" => $doc, "gcmcode" => $gcmcode];

        /* cerrar sentencia */
        $stmt->close();
    }
    if(!$found) $found = false;
    return ["result" => $result, "message" => $message, "usr" => $usr, "found" => $found];
}

function getUsrByMailCarton($mysqli, $carton = '', $mail = '') {

    $message = '';
    $result = "ok";
    $found = false;
    $query = "SELECT id, mail, carton, habilitado, logued, name, address, nac, photo, doc, gcmcode FROM usuarios WHERE carton = ? and mail = ?";
    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("ss", $carton, $mail);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($id, $mail, $carton, $habilitado, $logued, $name, $address, $nac, $photo, $doc, $gcmcode);
        /* obtener valor */
        $found = $stmt->fetch();
        $usr = ["id" => $id, "mail" => $mail, "carton" => $carton, "habilitado" => $habilitado, "logued" => $logued, "name" => $name, "address" => $address, "nac" => $nac, "photo" => $photo, "doc" => $doc, "gcmcode" => $gcmcode];

        /* cerrar sentencia */
        $stmt->close();
    }
    return ["result" => $result, "message" => $message, "usr" => $usr, "found" => $found];
}

function getUsrByDocCarton($mysqli, $carton = '', $doc = '') {

    $message = '';
    $result = "ok";
    $found = false;
    $query = "SELECT id, mail, carton, habilitado, logued, name, address, nac, photo, doc FROM usuarios WHERE carton = ? and doc = ?";
    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("ss", $carton, $doc);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($id, $mail, $carton, $habilitado, $logued, $name, $address, $nac, $photo, $doc);
        /* obtener valor */
        $found = $stmt->fetch();
        $usr = ["id" => $id, "mail" => $mail, "carton" => $carton, "habilitado" => $habilitado, "logued" => $logued, "name" => $name, "address" => $address, "nac" => $nac, "photo" => $photo, "doc" => $doc];

        /* cerrar sentencia */
        $stmt->close();
    }
    return ["result" => $result, "message" => $message, "usr" => $usr, "found" => $found];
}

function getUsrs($mysqli, $order = false, $ascdesc = "desc") {

    $usrs = [];
    $message = '';
    $result = "ok";
    $query = "SELECT id, mail, carton, habilitado, logued, name, address, nac, photo, doc, tel, gcmcode FROM usuarios ";
    if ($order) {
        $query .= "order by " . $order;

        switch ($ascdesc) {
            case "asc":
                $query .= " " . $ascdesc;
                break;
            case "desc":
                $query .= " " . $ascdesc;
                break;
        }
    }
    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($id, $mail, $carton, $habilitado, $logued, $name, $address, $nac, $photo, $doc, $tel, $gcmcode);
        /* obtener valor */
        while ($stmt->fetch()) {
            $usrs[] = ["id" => $id, "mail" => $mail, "carton" => $carton, "habilitado" => $habilitado, "logued" => $logued, "name" => $name, "address" => $address, "nac" => $nac, "photo" => $photo, "doc" => $doc, "tel" => $tel, "gcmcode" => $gcmcode];
        }
        /* cerrar sentencia */
        $stmt->close();
    }
    return ["result" => $result, "message" => $message, "usrs" => $usrs];
}

function getNews($mysqli, $habilitadoGet = "no") {

    $news = [];
    $message = '';
    $result = "ok";
    $query = "SELECT id, titulo, subtitulo, cuerpo, url, url_thumb, habilitado FROM noticias";

    if ($habilitadoGet != "no") {
        $query .= " WHERE habilitado = ?";
    }
    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        if ($habilitadoGet != "no") {
            $stmt->bind_param("i", $habilitadoGet);
        }
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($id, $titulo, $subtitulo, $cuerpo, $url, $url_thumb, $habilitado);
        /* obtener valor */
        while ($stmt->fetch()) {
            $news[] = ["id" => $id, "titulo" => $titulo, "subtitulo" => $subtitulo, "cuerpo" => $cuerpo, "url" => $url, "url_thumb" => $url_thumb, "habilitado" => $habilitado];
        }
        /* cerrar sentencia */
        $stmt->close();
    }
    return ["result" => $result, "message" => $message, "news" => $news];
}

function getGanadores($mysqli, $habilitadas = "no") {

    $ganadores = [];
    $message = '';
    $result = "ok";
    $query = "SELECT id, titulo, subtitulo, texto, url_thumb, habilitado FROM ganadores";

    if ($habilitadas != "no") {
        $query .= " WHERE habilitado = ?";
    }

    if ($stmt = $mysqli->prepare($query)) {
        if ($habilitadas != "no") {
            $stmt->bind_param("i", $habilitadas);
        }
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($id, $titulo, $subtitulo, $texto, $url_thumb, $habilitado);
        /* obtener valor */
        while ($stmt->fetch()) {
            $ganadores[] = ["id" => $id, "titulo"=> $titulo, "subtitulo"=> $subtitulo, "texto" => $texto, "url_thumb" => $url_thumb, "habilitado" => $habilitado];
        }
        /* cerrar sentencia */
        $stmt->close();
    }
    return ["result" => $result, "message" => $message, "ganadores" => $ganadores];
}

########################ADD#####################################################
################################################################################

function addUsr($mysqli, $carton = 0, $mail = '', $doc = 0, $habilitado = 1, $logued = 0, $name = "Usuario Nuevo", $address = "Sin Dirección", $nac = '', $photo = 'assets/img/profile-default.jpeg') {

    $result = "ok";
    $message = "Usuario creado correctamente";
    $resp = getUsrByMailCarton($mysqli, $carton, $mail);
    $nac = ($nac === '') ? date('Y-m-d') : $nac;
    if ($resp["found"]) {
        return ["result" => "ko", "message" => "usuario ya registrado"];
    }

    if ($stmt = $mysqli->prepare("INSERT INTO usuarios (carton, mail, habilitado, logued, name, address, nac, photo, doc) values (?, ?, ?, ? ,? ,?, ? ,?, ?)")) {
        $stmt->bind_param("ssiissssi", $carton, $mail, $habilitado, $logued, $name, $address, $nac, $photo, $doc);

        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }
        $stmt->close();
    } else {
        $message = "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
        $result = "ko";
    }

    return ["result" => $result, "message" => $message, "usr" => ["carton" => $carton, "mail" => $mail, "habilitado" => $habilitado, "logued" => $logued, "name" => $name, "address" => $address, "nac" => $nac, "photo" => $photo, "doc" => $doc]];
}

function addNew($mysqli, $file, $titulo, $subtitulo, $cuerpo, $habilitado = 1) {

    $result = "ok";
    $message = "Noticia Agregada Correctamente";

    if (isset($file['photo']['name']) && $file['photo']['name'] != '') {
        //if no errors...
        if (!$file['photo']['error']) {
            $valid_file = true;
            //now is the time to modify the future file name and validate the file
            $new_file_name = strtolower($file['photo']['name']); //rename file
            $Length = 10;
            $RandomString = substr(str_shuffle(md5(time())), 0, $Length);

            $new_file_name = $RandomString . "_" . str_replace(' ', '-', $new_file_name);
            if ($file['photo']['size'] > (6144000)) { //can't be larger than 6 MB
                $valid_file = false;
                $message = 'Oops!  Your file\'s size is to large.';
            }

            $pos = strpos($file['photo']['type'], "image");
            if ($pos === FALSE) {
                $valid_file = false;
                $message = 'Oops!  El archivo no es una imagen.';
            }
            //if the file has passed the test
            if ($valid_file) {
                //move it to where we want it to be
                $ruta = 'includes/img-app/news/' . $new_file_name;
                //ruta de los thumbs
                $ruta_thumb = 'includes/img-app/news/thumbs/' . $new_file_name;

                move_uploaded_file($file['photo']['tmp_name'], $ruta);

                //creo el thumb
                $newThumb = new resize($ruta);
                $newThumb->resizeImage(150, 632, "landscape");
                $exito = $newThumb->saveImage($ruta_thumb);

                // prepare and bind
                if ($stmt = $mysqli->prepare("INSERT INTO noticias (`titulo`, `subtitulo`, `cuerpo`, `url`, `url_thumb`, `habilitado`) values (?, ?, ?, ?, ?, ?)")) {

                    $stmt->bind_param("sssssi", $titulo, $subtitulo, $cuerpo, $ruta, $ruta_thumb, $habilitado);

                    if (!$stmt->execute()) {
                        $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
                        $result = "ko";
                    }

                    $stmt->close();
                } else {
                    $message = "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
                    $result = "ko";
                }
            }
            //if there is an error...
            else {
                //set that to be the returned message
                $message = 'Ooops!  Your upload triggered the following error:  invalid file';
                $result = "ko";
            }
        }
        //if there is an error...
        else {
            //set that to be the returned message
            $message = 'Ooops!  Your upload triggered the following error:  ' . $file['photo']['error'];
        }
    } else {
        $message = 'Ooops! No se recibio ninguna imagen';
        $result = "ko";
    }

    header("Location: gestor/news-edit.php?resul=" . $result . "&mensaje=" . $message);
}

function addGanador($mysqli, $file, $titulo, $subtitulo, $texto, $habilitado) {

    $result = "ok";
    $message = "Ganador Agregada Correctamente";

    if (isset($file['photo']['name']) && $file['photo']['name'] != '') {
        //if no errors...
        if (!$file['photo']['error']) {
            $valid_file = true;
            //now is the time to modify the future file name and validate the file
            $new_file_name = strtolower($file['photo']['name']); //rename file
            $Length = 10;
            $RandomString = substr(str_shuffle(md5(time())), 0, $Length);

            $new_file_name = $RandomString . "_" . str_replace(' ', '-', $new_file_name);
            if ($file['photo']['size'] > (6144000)) { //can't be larger than 6 MB
                $valid_file = false;
                $message = 'Oops!  Your file\'s size is to large.';
            }

            $pos = strpos($file['photo']['type'], "image");
            if ($pos === FALSE) {
                $valid_file = false;
                $message = 'Oops!  El archivo no es una imagen.';
            }
            //if the file has passed the test
            if ($valid_file) {
                //move it to where we want it to be
                $ruta = 'includes/img-app/ganadores/' . $new_file_name;
                //ruta de los thumbs
                $ruta_thumb = 'includes/img-app/ganadores/thumbs/' . $new_file_name;

                move_uploaded_file($file['photo']['tmp_name'], $ruta);

                //creo el thumb
                $newThumb = new resize($ruta);
                $newThumb->resizeImage(150, 632, "landscape");
                $exito = $newThumb->saveImage($ruta_thumb);

                // prepare and bind
                if ($stmt = $mysqli->prepare("INSERT INTO ganadores (`titulo`, `subtitulo`, `texto`, `url`, `url_thumb`, `habilitado`) values (?, ?, ?, ?, ?, ?)")) {

                    $stmt->bind_param("sssssi", $titulo, $subtitulo, $texto, $ruta, $ruta_thumb, $habilitado);

                    if (!$stmt->execute()) {
                        $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
                        $result = "ko";
                    }

                    $stmt->close();
                } else {
                    $message = "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
                    $result = "ko";
                }
            }
            //if there is an error...
            else {
                //set that to be the returned message
                $message = 'Ooops!  Your upload triggered the following error:  invalid file';
                $result = "ko";
            }
        }
        //if there is an error...
        else {
            //set that to be the returned message
            $message = 'Ooops!  Your upload triggered the following error:  ' . $file['photo']['error'];
        }
    } else {
        $message = 'Ooops! No se recibio ninguna imagen';
        $result = "ko";
    }

    header("Location: gestor/ganadores-edit.php?resul=" . $result . "&mensaje=" . $message);
}

#########################DELETE#################################################
################################################################################

function deleteUsrById($mysqli, $id) {

    $message = 'Usuario borrado correctamente';
    $result = "ok";
    $query = "DELETE FROM usuarios WHERE ID = ?";

    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("i", $id);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        $stmt->close();
    }
    return ["result" => $result, "message" => $message];
}

function deleteNew($mysqli, $id) {

    $message = 'Noticia borrada correctamente';
    $result = "ok";
    $query = "DELETE FROM noticias WHERE ID = ?";

    if ($stmt = $mysqli->prepare("SELECT url, url_thumb FROM noticias WHERE id=?")) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("s", $id);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($url, $url_thumb);

        /* obtener valor */
        $stmt->fetch();
        /* cerrar sentencia */
        $stmt->close();

        if (file_exists($url)) {
            unlink($url);
        }
        if (file_exists($url_thumb)) {
            unlink($url_thumb);
        }
    }

    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("i", $id);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        $stmt->close();
    }
    header("Location: gestor/news-edit.php?resul=" . $result . "&mensaje=" . $message);
}

function deleteGanador($mysqli, $id) {

    $message = 'Ganador borrada correctamente';
    $result = "ok";
    $query = "DELETE FROM ganadores WHERE ID = ?";

    if ($stmt = $mysqli->prepare("SELECT url, url_thumb FROM ganadores WHERE id=?")) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("s", $id);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* ligar variables de resultado */
        $stmt->bind_result($url, $url_thumb);

        /* obtener valor */
        $stmt->fetch();
        /* cerrar sentencia */
        $stmt->close();

        if (file_exists($url)) {
            unlink($url);
        }
        if (file_exists($url_thumb)) {
            unlink($url_thumb);
        }
    }

    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("i", $id);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        $stmt->close();
    }
    header("Location: gestor/ganadores-edit.php?resul=" . $result . "&mensaje=" . $message);
}

########################UPDATE##################################################
################################################################################

function updateUserLogStatus($mysqli, $id, $logued) {

    $message = 'Usuario editado correctamente';
    $result = "ok";
    $query = "UPDATE usuarios set logued = ? WHERE id = ?";

    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("ii", $logued, $id);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* cerrar sentencia */
        $stmt->close();
    }

    $usrObj = getUsrById($mysqli, $id);

    return ["result" => $result, "message" => $message, "usr" => $usrObj['usr']];
}

function updateUsrById($mysqli, $id, $carton, $mail, $habilitado, $logued, $name, $address, $nac, $photo, $doc) {

    $message = 'Usuario editado correctamente';
    $result = "ok";
    $query = "UPDATE usuarios set mail = ?, carton = ?, habilitado = ? , logued = ?, name = ?, address = ?, nac = ?, photo = ?, doc = ? WHERE id = ?";

    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("ssiissssii", $mail, $carton, $habilitado, $logued, $name, $address, $nac, $photo, $doc, $id);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* cerrar sentencia */
        $stmt->close();
    }
    $usrObj = getUsrById($mysqli, $id);

    return ["result" => $result, "message" => $message, "usr" => $usrObj['usr']];
}

function updateUsrGcmById($mysqli, $id, $gcmcode) {

    $message = 'Usuario editado correctamente';
    $result = "ok";
    $query = "UPDATE usuarios set gcmcode = ? WHERE id = ?";

    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("si", $gcmcode, $id);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            $result = "ko";
        }

        /* cerrar sentencia */
        $stmt->close();
    }
    $usrObj = getUsrById($mysqli, $id);

    return ["result" => $result, "message" => $message, "usr" => $usrObj['usr']];
}

function updateNew($mysqli, $file, $titulo, $subtitulo, $cuerpo, $habilitado, $id) {

    $message = 'Noticia editada correctamente';
    $result = "ok";

    if (isset($file['photo']['name']) && $file['photo']['name'] != '') {
        //if no errors...
        if (!$file['photo']['error']) {
            $valid_file = true;
            //now is the time to modify the future file name and validate the file
            $new_file_name = strtolower($file['photo']['name']); //rename file
            $Length = 10;
            $RandomString = substr(str_shuffle(md5(time())), 0, $Length);

            $new_file_name = $RandomString . "_" . str_replace(' ', '-', $new_file_name);
            if ($file['photo']['size'] > (6144000)) { //can't be larger than 6 MB
                $valid_file = false;
                $message = 'Oops!  Your file\'s size is to large.';
            }

            $pos = strpos($file['photo']['type'], "image");
            if ($pos === FALSE) {
                $valid_file = false;
                $message = 'Oops!  El archivo no es una imagen.';
            }
            //if the file has passed the test
            if ($valid_file) {
                //si la nueva imagen es valida, borro la anterior
                if ($stmt = $mysqli->prepare("SELECT url, url_thumb FROM noticias WHERE id=?")) {
                    /* ligar parámetros para marcadores */
                    $stmt->bind_param("s", $id);

                    /* ejecutar la consulta */
                    if (!$stmt->execute()) {
                        $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
                        $result = "ko";
                    }

                    /* ligar variables de resultado */
                    $stmt->bind_result($url, $url_thumb);

                    /* obtener valor */
                    $stmt->fetch();
                    /* cerrar sentencia */
                    $stmt->close();

                    if (file_exists($url)) {
                        unlink($url);
                    }
                    if (file_exists($url_thumb)) {
                        unlink($url_thumb);
                    }
                }

                //move it to where we want it to be
                $ruta = 'includes/img-app/news/' . $new_file_name;
                //ruta de los thumbs
                $ruta_thumb = 'includes/img-app/news/thumbs/' . $new_file_name;
                //subo la nueva
                move_uploaded_file($file['photo']['tmp_name'], $ruta);

                //creo el thumb
                $newThumb = new resize($ruta);
                $newThumb->resizeImage(150, 632, "landscape");
                $exito = $newThumb->saveImage($ruta_thumb);

                $query = "UPDATE noticias set titulo = ?, subtitulo = ?, cuerpo = ? , url = ?, url_thumb = ?, habilitado = ? WHERE id = ?";

                if ($stmt = $mysqli->prepare($query)) {
                    /* ligar parámetros para marcadores */
                    $stmt->bind_param("sssssii", $titulo, $subtitulo, $cuerpo, $ruta, $ruta_thumb, $habilitado, $id);
                    /* ejecutar la consulta */
                    if (!$stmt->execute()) {
                        $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
                        $result = "ko";
                    }

                    /* cerrar sentencia */
                    $stmt->close();
                }
            }
        }
    } else {
        $query = "UPDATE noticias set titulo = ?, subtitulo = ?, cuerpo = ?, habilitado = ? WHERE id = ?";

        if ($stmt = $mysqli->prepare($query)) {
            /* ligar parámetros para marcadores */
            $stmt->bind_param("sssii", $titulo, $subtitulo, $cuerpo, $habilitado, $id);
            /* ejecutar la consulta */
            if (!$stmt->execute()) {
                $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
                $result = "ko";
            }
            /* cerrar sentencia */
            $stmt->close();
        }
    }
    header("Location: gestor/news-edit.php?resul=" . $result . "&mensaje=" . $message);
}

function updateGanador($mysqli, $file, $titulo, $subtitulo, $texto, $habilitado, $id) {

    $message = 'Ganador editada correctamente';
    $result = "ok";

    if (isset($file['photo']['name']) && $file['photo']['name'] != '') {
        //if no errors...
        if (!$file['photo']['error']) {
            $valid_file = true;
            //now is the time to modify the future file name and validate the file
            $new_file_name = strtolower($file['photo']['name']); //rename file
            $Length = 10;
            $RandomString = substr(str_shuffle(md5(time())), 0, $Length);

            $new_file_name = $RandomString . "_" . str_replace(' ', '-', $new_file_name);
            if ($file['photo']['size'] > (6144000)) { //can't be larger than 6 MB
                $valid_file = false;
                $message = 'Oops!  Your file\'s size is to large.';
            }

            $pos = strpos($file['photo']['type'], "image");
            if ($pos === FALSE) {
                $valid_file = false;
                $message = 'Oops!  El archivo no es una imagen.';
            }
            //if the file has passed the test
            if ($valid_file) {
                //si la nueva imagen es valida, borro la anterior
                if ($stmt = $mysqli->prepare("SELECT url, url_thumb FROM ganadores WHERE id=?")) {
                    /* ligar parámetros para marcadores */
                    $stmt->bind_param("s", $id);

                    /* ejecutar la consulta */
                    if (!$stmt->execute()) {
                        $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
                        $result = "ko";
                    }

                    /* ligar variables de resultado */
                    $stmt->bind_result($url, $url_thumb);

                    /* obtener valor */
                    $stmt->fetch();
                    /* cerrar sentencia */
                    $stmt->close();

                    if (file_exists($url)) {
                        unlink($url);
                    }
                    if (file_exists($url_thumb)) {
                        unlink($url_thumb);
                    }
                }

                //move it to where we want it to be
                $ruta = 'includes/img-app/ganadores/' . $new_file_name;
                //ruta de los thumbs
                $ruta_thumb = 'includes/img-app/ganadores/thumbs/' . $new_file_name;
                //subo la nueva
                move_uploaded_file($file['photo']['tmp_name'], $ruta);

                //creo el thumb
                $newThumb = new resize($ruta);
                $newThumb->resizeImage(150, 632, "landscape");
                $exito = $newThumb->saveImage($ruta_thumb);

                $query = "UPDATE ganadores set titulo = ?, subtitulo = ?texto = ? , url = ?, url_thumb = ?, habilitado = ? WHERE id = ?";

                if ($stmt = $mysqli->prepare($query)) {
                    /* ligar parámetros para marcadores */
                    $stmt->bind_param("sssssii", $titulo, $subtitulo, $texto, $ruta, $ruta_thumb, $habilitado, $id);
                    /* ejecutar la consulta */
                    if (!$stmt->execute()) {
                        $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
                        $result = "ko";
                    }

                    /* cerrar sentencia */
                    $stmt->close();
                }
            }
        }
    } else {
        $query = "UPDATE ganadores set titulo = ?, subtitulo = ?, texto = ?, habilitado = ? WHERE id = ?";

        if ($stmt = $mysqli->prepare($query)) {
            /* ligar parámetros para marcadores */
            $stmt->bind_param("sssii", $titulo, $subtitulo, $texto, $habilitado, $id);
            /* ejecutar la consulta */
            if (!$stmt->execute()) {
                $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
                $result = "ko";
            }
            /* cerrar sentencia */
            $stmt->close();
        }
    }
    header("Location: gestor/ganadores-edit.php?resul=" . $result . "&mensaje=" . $message);
}

function cambiarPass($mysqli, $email) {

    $result = "ok";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return ["result" => "ko", "mensaje" => "El Correo No es valido"];
    }

    $query = "UPDATE admin set pass = ? WHERE usr = ?";

    $pass = randomPassword();
    if ($stmt = $mysqli->prepare($query)) {
        /* ligar parámetros para marcadores */
        $stmt->bind_param("ss", $pass, $email);
        /* ejecutar la consulta */
        if (!$stmt->execute()) {
            $message = "Falló la ejecución: (" . $stmt->errno . ") " . $stmt->error;
            return ["result" => "ko", "mensaje" => $message];
        }
        /* cerrar sentencia */
        $stmt->close();
    }

    if ($result === 'ok') {
        
        // Datos de la cuenta de correo utilizada para enviar vía SMTP
        $smtpHost = "y6000244.ferozo.com";  // Dominio alternativo brindado en el email de alta 
        $smtpUsuario = "contacto@grupovetasrl.com";  // Mi cuenta de correo
        $smtpClave = "Emanuel85sag";  // Mi contraseña
// Email donde se enviaran los datos cargados en el formulario de contacto
        $emailDestino = $email;
        $mensaje = "Su nuevo password para la administración de la app de mega sorteo  es: " . $pass;
        
        try {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->IsHTML(true);
            $mail->CharSet = "utf-8";

// VALORES A MODIFICAR //
            $mail->Host = $smtpHost;
            $mail->Username = $smtpUsuario;
            $mail->Password = $smtpClave;
            
            $mail->From = "contacto@grupovetasrl.com"; // Email desde donde envío el correo.
            $mail->FromName = "cambio pass";
            $mail->AddAddress($emailDestino); // Esta es la dirección a donde enviamos los datos del formulario

            $mail->Subject = "Cambio de pass desde el admin de mega sorteo"; // Este es el titulo del email.
            $mensajeHtml = nl2br($mensaje);
            $mail->Body = $mensajeHtml; // Texto del email en formato HTML
            $mail->AltBody = $mensaje; // Texto sin formato HTML
// FIN - VALORES A MODIFICAR //

            $mail->Send();
            $result = "ok";
        } catch (phpmailerException $e) {
            $resp = "Error enviando el mensaje, intende de nuevo más tarde - " + $e->getMessage();
            return ["result" => "ko", "mensaje" => $resp];
        } catch (Exception $e) {
            $resp = "Error enviando el mensaje, intende de nuevo más tarde - " + $e->getMessage();
            return ["result" => "ko", "mensaje" => $resp];
        }
    }

    return ["result" => $result, "pass" => $pass];
}

########################OTHERS##################################################
################################################################################

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
}

function login_check() {
    return isset($_SESSION['user_login_checked']) ? $_SESSION['user_login_checked'] : false;
}

function sendNotifications($mysqli, $titulo, $messageText) {

    $apiKey = 'AAAA8elYBUw:APA91bF0f9VBUY3hXCP9ea0rU0IhOc-cmJxfVljF_KUO3GIgFVTqiW1d1dB9UwI4g4N2kWSct7FtpZD7LWQAJ7VArWXAGUXIjwClJnvWiSQFFcdV825qt1X28Y3thuE-xdmJRWhrdmYQ';

    $usrs = getUsrs($mysqli);
    $userIdentificador = [];

    foreach ($usrs['usrs'] as $usr) {
        $userIdentificador[] = $usr["gcmcode"];
    }

    $headers = array('Authorization:key=' . $apiKey, "Content-Type: application/json");
    $data = [];
//    $data['data']['collapse_key'] = $titulo;
    $data['to'] = "/topics/all";
    $data['notification']['title'] = $titulo;
    $data['notification']["body"] = $messageText;
    $data['data']['message'] = $messageText;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    die(var_dump($response));
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        return 'fail';
    }
    if ($httpCode != 200) {
        return 'status code 200';
    }
    curl_close($ch);
    return $response;
}
