<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
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
                    <a class="navbar-brand" href="index.php">SAMII-DSS</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        echo MenuBas();
                        ?>
                    </ul>
                </div>
            </div>
        </nav><div id="main">
<?php
/*
$id = $_GET["id"];
if($id>0 && $id<7){
$BD = 'appgrognral'; 
$link = conectar();
$SQL = "select * from manual where id=".$id;
$p = consultaSQL($SQL, $BD);
while ($f = mysqli_fetch_array($p)) {
    $car1 = $f[1];
    $car2 = $f[2];
    $img = $f[3];
    $vid = $f[4];
}
*/
$car1 = "Dios";
$car2 = "";
?>
<div class="container">
<section id="content">
<div class="inside">
<h4><div align="center">Resumen de SAMII-DSS</div></h4>
1. El modelo permite entender, explicar y pronosticar resultados mediante la simulación de escenarios, a continuación es presentado el diagrama de influencias.<br>
<img src = "img/Samii_Modelo.jpg">
<br><br>2. Con base en el modelo, es desarrollado el videojuego serio (VS) en Unity, con este se busca que el usuario sea consciente de las decisiones que toma en la finca.<br>
<br><img src = "img/Samii-VS.png">
<br><br>3. Para consultar las decisiones tomadas en el VS se cuenta con un sistema de información para la toma de decisiones (DSS). En la figura es presentada la opción de Novedades (en donde se presentan los eventos que puede registrar para un animal).<br>
<br><img src = "img/Samii_DSS.png">
</span>
<table  width="340">
<tr><td>
<tr>
<td align="center"><img src="img/manual.jpg" width="325">
</table>
</div>
</section>
<aside>
<div class="inside">
<ul class="insurance">
<!--<iframe width="340" height="265" src="https://www.youtube.com/embed/<?php echo $vid;?>" frameborder="0" allowfullscreen></iframe>-->
<br>En el DSS tambien se pueden generar informes. En la figura es presentado la trazabilidad productiva de un animal, la que se obtubo al jugar vs la que se debió tener.<br>
<br><img src = "img/Samii_DSS_02.png">
<br><br>En la figura es presentado la distribución animal de la finca.<br>	
<br><img src = "img/Samii_DSS_03.png">
<br><br>En la siguiente figura se observa que las tres herramientas están alineadas de manera coherente, un ejemplo de ello (observe la figura a la izquierda) , es que en las tres se aprecian el peso del animal, la posibilidad de registrar el ordeño que genera leche, la opción de comprar animales, entre otras y se aprecia la importancia de identificar los diferentes grupos etarios para la producción. Se aprecian algunas opciones de interacción con la adminición del sistema tales como  municipios, fincas, razas y terceros con los que podría operar en su sistema productivo.<br>	
<br><img src = "img/Samii_Resumen.png">	
	
</ul>
</div>
</aside>
<?php
/*}
else {
    echo '<div align="center">Esa opción no existe en el Manual</div>';
}*/
?>
</div>
<footer>
<hr style="color: #0056b2;" />
<div align="center">
	Desarrollado por Urbano E. Gómez Prada
	<br>2017 - 2018<br>
		<img src = "img/logosU.png">
</div>
</footer>
</div>

</body>
</html>