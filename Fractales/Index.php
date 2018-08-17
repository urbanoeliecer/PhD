<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "fractales/";
$SystemFolder = $AppName."sistema";
//include "$root//$SystemFolder//funciones//Vista.php";
//include "$root//$SystemFolder//funciones//Menu.php";
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
<title>FRACTALES</title>
<meta charset="utf-8">

<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/script.js"></script>        

<link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
<link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../sistema/estilos/js/bootstrap.min.js"></script>
<?php
$intro = "Este programa permite generar fractales como el de la figura inferior, interactuar con la cantidad de iteraciones, combinar los colores, hacer zoom en los lugares deseados y conocer con ejemplos como es que se generan, presentando otros como la planta y la bola de nieve o graficando las funciones de convergencia."; 
?>
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
                    <a class="navbar-brand" href="#">Fractales</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav"><?php
                        //echo MenuBas();
                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

<div id="main">
    <div class="container">
        <section id="content">
            <div class="inside">
                <h2><span>Bienvenido!</span></h2>
                <p><?php echo $intro; ?></p>
            </div>
        </section>
        <aside>
            <div class="inside">
                <ul class="insurance"><?php
				?>
				<br><a href="Fractales.zip" download="Fractales.zip"><img src="img/pc.png" width="14">&nbsp;Fractales para PC Windows</a>&nbsp; Descarga y descomprima
                </ul>
                
            </div>
        </aside>
    </div>
<footer>
    <div align="center">
        <div id="slogan"><img src="img/slogan.png"></div><br>
		Desarrollado por Urbano E. Gómez Prada (Docente de Ingeniería de Sistemas e Informática de la UPB)
        <br>Bucaramanga - Colombia<br>
		
    </div>
</footer>
</div>
</body>
</html>