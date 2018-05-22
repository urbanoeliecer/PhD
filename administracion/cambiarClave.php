<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../loginForm.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SAMII-DSS</title>
        <meta charset="utf-8">
        <link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
        <link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script  src="../sistema/estilos/js/bootstrap.min.js"></script>
    </head>
    <body>

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <!--<img src = "../images/appisSin.png" width="63">--><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SAMII-DSS</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        echo Menu($_SESSION["IdPerfil"]);
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        echo MenuUsuario();
                        ?>
                    </ul>                    
                </div><!--/.nav-collapse -->
            </div>
        </nav>
<div class="tail-bottom">
    <div id="main">        
        <div class="container">
            <div class="col-lg-offset-3 col-lg-6">
                <?php
                echo '<form method="POST" action="ControlInsert.php">'; 
                //$tabla = "t_usuarios_dntclv";
                echo '<h2 align="center"><span>Cambiar Password</span></h2>';
                echo 'Debe volver a Ingresar a Appis (control bovino)<br>';
                echo '<input type="hidden" name="tabla" value = "t_usuarios_dntclv">';
                echo 'Ingrese la Nueva Clave: <input type="text" name="pass" maxlenght="10" size="10"  required></input>';
                echo '<input type="submit"></form>';
                ?>
            </div>
        </div> 
    </div>
    <footer>
    <hr style="color: #0056b2;" /></footer>
    <div align="center">
        Desarrollado por AgroIT 
        <br>2015 - 2017
    </div>
</footer>
</div> 
    </body>
</html>
