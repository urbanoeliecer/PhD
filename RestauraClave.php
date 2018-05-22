<?php
session_start();
$_SESSION = array();

include("simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();


$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Menu.php";
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
        <style type="text/css">
        pre {
            border: solid 1px #bbb;
            padding: 10px;
            margin: 2em;
        }

        img {
            border: solid 1px #ccc;
            margin: 0 2em;
        }
    </style>
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
                    <!--<img src = "../images/appisSin.png" width="63"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">-->
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">SAMII-DSS</a>
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
        <div class="container">
            <div class="col-lg-offset-3 col-lg-6">
                <?php
                echo '<form method="POST" action="administracion/ControlInsert.php">'; 
                echo '<h2 align="center"><span>Reiniciar Clave</span></h2>';
                echo 'Para reiniciar su password, ingrese el texto de control y su correo electrónico. ';
                echo '<div><table align="center" border="0"><tr>';
                echo '<td align="center">Digite el texto del cuadro:</td>';
                echo '<td>&nbsp;</td><td valign="middle" align="center"><input name="txtcpc" type="text" size="4" required></td>';
                echo '<td><img src="'.$_SESSION['captcha']['image_src'].'" alt="CAPTCHA code">';
                echo '</tr></table></div><br>';
                echo '<input type="hidden" name="tabla" value = "t_usuarios_fuecla">';
                echo 'Ingrese el email registrado: <input type="email" name="email" maxlenght="30" size="30"  required></input>';
                echo '<input type="submit"></form>';
                ?>
            </div>
        </div> 
    </div>
    <footer>
    <hr style="color: #0056b2;" /></footer>
    <div align="center">
        Desarrollado por Urbano E. Gómez Prada
        <br>2017 - 2018
    </div>
    </div>
</footer>
</div> 
    </body>
</html>
