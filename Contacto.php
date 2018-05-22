<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
//session_start();
//if (!isset($_SESSION["usuario"])) {
//    header("Location: ../IniciarSesion.php");
//}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>AgroIT - Contacto</title>
<meta charset="utf-8">
<link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
<link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script  src="../sistema/estilos/js/bootstrap.min.js"></script>

       
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <img src = "../images/appisSin.png" width="63"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">AgroIT</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        echo MenuBas();
                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
<div class="tail-bottom">
    <div id="main">
           <div class="wrapper indent">

                <div class="inside">
                <h2 align="center"><span>Contacto</span> </h2>
                <form id="contacts-form" action="ContactoRes.php" method="POST">
                <table align="center">
                <tr>
                    <td><b>Email:</b><td>co.agroit@gmail.com<br>
                <tr>
                    <td><b>País:</b><td>Colombia<br>
                <tr>
                    <td><b>Telephone:&nbsp;&nbsp;</b><td>(+57)3177548291<br>
                <tr><td>&nbsp;<tr>
                    <td>Nombre:
                    <td><input type="text" name = "txtNmb" value="" size="27" required>
                <tr><td>&nbsp;<tr>
                    <td>E-mail:
                    <td><input type="email" value="" name ="txtEml" size="27" required>
                <tr><td>&nbsp;<tr>
                    <td>Mensaje:
                    <td><textarea cols="32" rows="2" name = "txtMns" required></textarea>
                <tr><td>&nbsp;<tr><td colspan="2" align="center"><input  class="btn btn-sm btn-primary btn-block" type="submit" value ="Enviar">
                </table>
                </form>
            </div></div><br>
<footer>
    <hr style="color: #0056b2;" />
    <div align="center">
        Desarrollado por AgroIT 
        <br>2015 - 2017
    </div>
</footer>
</div>
</body>
</html>