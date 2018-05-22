<?php
$car1 = '<br>Somos una organización que tiene por objetivo  brindar a las organizaciones agrícolas la tecnología para facilitar la toma de las mejores decisiones en sus sistemas productivos.';
$car2 = '<br>En 2015 inició AgroIT, una plataforma de software que aplica los avances tecnológicos de sus autores en materia de simulación y control de los sistemas productivos, originados a partir de sus experiencias en investigación en el area de la simulación para la agroindustria.';
?>
<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema";
//include "$root//$SystemFolder//funciones//Vista.php";
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
<title>AgroIT</title>
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
                    <!--<img src = "../images/appisSin.png" width="63">-->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Videojuego sobre SAMII-DSS</a>
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
                <div >
                    <h2 align="center"><span>En construcción</span> </h2>
                    <!--<div class="img-box"><img src="images/agroITProd.jpg"><br/><?php echo $car1; ?></div>-->
                    <p><?php //echo $car2; ?></p>
                </div>
            </div>
        
    </div><br>
<footer>
    <hr style="color: #0056b2;" />
    <div align="center">
        Desarrollado por Urbano Eliécer Gómez Prada 
        <br>2017 - 2018
    </div>
</footer>
</div>
</body>
</html>