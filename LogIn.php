<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//basedatos.php";
//if (headers_sent()) print "OK1";
//if (headers_sent()) print "OK2";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    //if (headers_sent()) print "OK3";
    $DBLINK = conectar();
    //if (headers_sent()) print "4";
    print $usuario = mysqli_real_escape_string($DBLINK, $_POST['usuario']);
    print $password = mysqli_real_escape_string($DBLINK, $_POST['password']);
    $password = hash("sha256", $password); //  gomez 09f5e38cb53313959c5e28864efd34dc
    $nombreUsuario = validarLogin($usuario, $password);
    //if (headers_sent()) print "OK5";
    if (!is_null($nombreUsuario)) {
        $_SESSION["Ancho"] = $_POST['txtancho']; // 160114 Recibir el ancho
        $_SESSION["usuario"] = $nombreUsuario[1];
        $_SESSION["IdUsuario"] = $nombreUsuario[0];
        $_SESSION["IdPerfil"] = $nombreUsuario[2];
        $_SESSION["idorg"] = $nombreUsuario[4];
        //$_SESSION["BD"] = $nombreUsuario[3];
        $_SESSION["IdLicencia"]=$nombreUsuario[3];
        //180425 Inserta un registro en uso por Visitantes
		include("administracion/conect.php");
		$SQL = 'select idcmn from usuariosxcomunidad where idusr = '.$_SESSION["IdUsuario"];
		$link = Conectarse();
		$p = mysqli_query($link,$SQL);
		while ($fila = mysqli_fetch_array($p)) {
		   $cmd = $fila[0];
		}
		$fch = date("Y-m-d H:i:s");
		$fch = strtotime ( '-7 hour' , strtotime ($fch) ) ; 
		$fch = date ( 'Y-m-j H:i:s' , $fch);
		$SQL = "insert into usos (usrid,fecha,registros, cmd) values (".$_SESSION["IdUsuario"].",'".$fch."',1,".$cmd.")";
		$p = mysqli_query($link,$SQL);
		// fin insertar
		
        header("Location: ./administracion/animales.php");
    }
    else{
        header("Location: IniciarSesion.php");
    }
}

