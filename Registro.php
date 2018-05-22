<?php
session_start();
$_SESSION = array();

include("simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();


$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "";
$SystemFolder = "sistema"; //$AppName//
include "$root//$SystemFolder//funciones//Vista.php";
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
        <title>AgroIT - appis</title>
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
                    <img src = "../images/appisSin.png" width="63"><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">AgroIT - appis</a>
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
                //print_r($_SESSION['captcha']);
                $tabla = "t_usuarios";
                echo '<h2 align="center"><span>Registro</span></h2>';
                echo 'Para recibir su password en Appis (control bovino), ingrese datos de la organización y usuario. ';
                echo 'Los datos serán protegidos por AgroIt y se solicitará confirmación al email del usuario y deberá ser respondida en 10 días hábiles para poder continuar con el servicio. '; //de la Organización ;
                echo '<font color=red>Todos los campos son obligatorios</font><br>';
                echo '<div><table align="center" border="0"><tr>';
                echo '<td align="center">Digite el texto del cuadro:</td>';
                echo '<td>&nbsp;</td><td valign="middle" align="center"><input name="txtcpc" type="text" size="4" required></td>';
                echo '<td><img src="'.$_SESSION['captcha']['image_src'].'" alt="CAPTCHA code">';
                echo '</tr></table></div><br>';
                //echo '<input type="submit"></form>';
                generarTablaAgregar($tabla,NULL,'');
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
