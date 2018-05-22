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
<title>SAMII-DSS</title>
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
//
$intro = '<b>SAMII-DSS</b> es un sistema de información para apoyar la toma de decisiones en la agroindustria. SAMII-DSS surge como estrategia del trabajo de investigación doctoral “Estrategia metodológica para la apropiación de sistemas de información para el apoyo en la toma de decisiones, soportada en Dinámica de Sistemas y videojuegos. Caso de estudio: Administración de Sistemas Productivos Agroindustriales Bovinos” que se lleva a cabo en la <b>UIB</b>.<br><br><b>SAMII-DSS</b> es su primer producto y permite la administración de ganaderías bovinas en modalidad de Cría, Ceba, Doble Propósito, Lechería o Ciclo Completo. Puede manejar y controlar: Inventario de animales, reproducción, producción de leche, carne, sanidad, alimentación, genealogía, lotes, entre otros, conozca nuestra política de protección de datos <a href="politica.php">aquí</a>. Para conocer mas del videojuego de clic <a href="Videojuego.php">aquí</a>.<br>';
$tit1 = "Informes";
$tit2 = ""; //<div class="wrapper"><a href="#" class="link1"><span><span>More Services</span></span></a></div>
$tit3 = "SAMII-DSS - Novedades"; 
$tit4 = "SAMII-DSS - Instrucciones";
$tit5 = "SAMII-DSS";
$car2 = "";
$car3 = "Como posibilidad de mejora, SAMII-DSS ofrece la posibilidad de contar con modelos de simulación para contrastar sus resultados con lo de las mejores decisiones que pudo tomar. "; // e identificación electrónica con lectores RFID";
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
                    <a class="navbar-brand" href="#">SAMII-DSS</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav"><?php
                        echo MenuBas();
                        ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

<div id="main">
    <div class="container">
        <section id="content">
            <div id="slogan"><img src="images/slogan.png"></div>
            <div class="inside">
                <h2><span>Bienvenido!</span></h2>
                <p><?php echo $intro; ?></p>
            </div>
        </section>
        <aside>
            <div class="inside">
                <ul class="insurance"><?php
                //echo '<li><strong>'.$tit1.'</strong>'.$car1.'</li>';
                echo '<li><strong>'.$tit2.'</strong>'.$car2.'</li>';
                echo '<li><strong>'.$tit3.'</strong>'.$car3.'</li>';
                echo '<li><strong>'.$tit4.'</strong>';?>
                <!--<a href = "Manualf.php?id=3"><img src="images/descargablanca.png" width="14">&nbsp;Regístrese</a>-->
                <!--<br><a href = "Manualf.php?id=2"><img src="../images/descargablanca.png" width="14">&nbsp;Inicie el uso de Appis desde el Celular</a>-->
                <br><a href = "Manualf.php"><img src="images/descargablanca.png" width="14">&nbsp;Consultar mas información</a>
				<br><a href="SAMII.zip" download="SAMII-VS_PC"><img src="img/pc.png" width="14">&nbsp;SAMII-VS para PC Windows</a>
				<br><a href="SAMII.apk" download="SAMII-VS_Cel"><img src="img/android.png" width="14">&nbsp;SAMII-VS para Android</a>

				<?php
                echo '</li>';
                echo '<li><strong>'.$tit5.'</strong>';
				echo 'La estrategia espera que haya Apropiación del DSS a partir de la comprensión de un modelo de simulación desarrollado con Dinámica de Sistemas (DS) que se transformó en un videojuego serio (VS) que genera información que se almacena en el DSS, jugar implica tomar conciencia para que decidadn registrar la información de sus sistemas real. Hay comunidades que haran uso de la metodología y hay una de control que no seguirá la estrategia y solo adoptará la herramienta.';
               echo'<img src = "img/SamiiApropiacion.png">';
				//echo '<iframe width="360" height="265" src="https://www.youtube.com/embed/hUippuPj-Ec" frameborder="0" allowfullscreen></iframe>';
                ?>
                </ul>
                
            </div>
        </aside>
    </div>
<footer>
    <div align="center">
        Desarrollado por Urbano E. Gómez Prada (Docente de Ingeniería de Sistemas e Informática de la UPB)
        <br>Bucaramanga - Colombia<br>
		<br>2017 - 2018<br>
		<img src = "img/logosU.png">
    </div>
</footer>
<div align="center">
<iframe width="340" height="215" src="https://www.youtube.com/embed/8uHL3JFFsD8" frameborder="0" allowfullscreen></iframe><br><br>
<iframe width="340" height="215" src="https://www.youtube.com/embed/gd1kXhPeqo4" frameborder="0" allowfullscreen></iframe><br><br>
<iframe width="340" height="215" src="https://www.youtube.com/embed/RhO4-NAFUxQ" frameborder="0" allowfullscreen></iframe>

</div>
</div>
</body>
</html>