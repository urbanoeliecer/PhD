<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema"; 
include "$root//$SystemFolder//parametros//basedatos.php";
//if (headers_sent()) print "OK1";
function conectar() { 
    //print_r($GLOBALS["SERVIDOR_DB"]." ".$GLOBALS["USUARIO_DB"]." ".$GLOBALS["CONTRASENA_DB"]." ".$GLOBALS["DB"], $GLOBALS["PUERTO_DB"]);//, $GLOBALS["PUERTO_DB"]
    $CONEXION_DB = mysqli_connect($GLOBALS["SERVIDOR_DB"], $GLOBALS["USUARIO_DB"], $GLOBALS["CONTRASENA_DB"], $GLOBALS["DB"]) or die("Error al conectar verifique la conexión");
    return $CONEXION_DB;
}

function consultaSQL($SQL) {
    $link = conectar();
//    if (isset($BD)) {
//        mysqli_select_db($link, $BD);
//    }
    $result = mysqli_query($link, $SQL);
    if (!stripos($SQL, "select")) {
        $_SESSION['UltimoId'] = mysqli_insert_id($link);
    }
    $_SESSION['UltimoIn']=1;
    mysqli_close($link);
    return $result;
}
function consultaSQLUnique($SQL, $BD = NULL) {
    $link = conectar();
    if (isset($BD)) {
        mysqli_select_db($link, $BD);
    }
    $result = mysqli_query($link, $SQL);
    if (!stripos($SQL, "select")) {
        $_SESSION['UltimoId'] = mysqli_insert_id($link);
        if ($_SESSION['UltimoId'] == 0)
          unset($_SESSION['UltimoIn']); // = $_SESSION['UltimoId'];
    }
    mysqli_close($link);
    return $result;
}

function validarLogin($USUARIO, $PASSWORD) {
    print $SQL = "SELECT IdUsuario, Nombre1, IdPerfil, IdLicencia, idorg from t_usuarios WHERE Estado = 1 and Usuario = '$USUARIO' and Pass = '$PASSWORD'";
    $listaUsuarios = consultaSQL($SQL);
    if (mysqli_num_rows($listaUsuarios) == 1) {
        $datosUsuario = mysqli_fetch_array($listaUsuarios);
        return $datosUsuario;
    } else {
        return NULL;
    }
}

function validarLicenciaUbicaciones($IdLicencia, $BD) {
    $SQL = "SELECT NumeroUbicaciones FROM t_licencias WHERE IdLicencia = $IdLicencia";
    $registroLicencia = mysqli_fetch_array(consultaSQL($SQL));
    $numeroUbicaciones = $registroLicencia[0];
    settype($numeroUbicaciones, "integer");
    $SQL = "SELECT COUNT(*) FROM t_ubicaciones";
    $registroUbicaciones = mysqli_fetch_array(consultaSQL($SQL, $BD));
    $numeroActual = $registroUbicaciones[0];
    settype($numeroActual, "integer");
    if ($numeroActual < $numeroUbicaciones) {
        return true;
    } else {
        return false;
    }
}