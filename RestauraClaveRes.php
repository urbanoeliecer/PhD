<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = ""; //appgro//
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
//session_start();
//if (!isset($_SESSION["usuario"])) {
//    header("Location: ../IniciarSesion.php");
//}
$intro = "<h2><span>Bienvenido!</span></h2><p>Se ha enviado un Email para confirmación";
if (@$salto == 2) $intro = '<h2><span>Error!</span></h2><p>No se agregó el usuario, la palabra en el control no es igual a la de la figura, vuelva a intentarlo';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>AgroIT - appis</title>
<meta name="description" content="Place your description here">
<meta name="keywords" content="put, your, keyword, here">
<meta name="author" content="Templates.com - website templates provider">
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/script.js"></script>        
<link href="sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
<link href="sistema/estilos/css/appgro.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="sistema/estilos/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="design_appgro/backend/js/excanvas.min.js"></script> 
<script src="design_appgro/backend/js/chart.min.js" type="text/javascript"></script> 







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
    <div class="wrapper indent">
        <img src = "">
        <section id="content">
            <div id="slogan"><img src="images/slogan.png"></div>
            <div class="inside">
                
                <?php echo $intro; ?></p>
            </div>
        </section>
    </div><br>
<footer>
    <div align="center">
    Desarrollado por AgroIT
    <br>2015 - 2017
    </div>
</footer>
</div>
</body>
</html>