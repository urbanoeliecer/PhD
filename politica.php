<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "";
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
<title>AgroIT - appis - Política</title>
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
<div class="inside">
<div  align="center">
<h2><span>Política e Privacidad y Tratamiento de los Datos Personales</span></h2></div><br><table width="90%" align="center"><tr><td>
La privacidad de sus datos es muy importante para agroIt.co. Por ello, queremos asegurarnos que conozca cómo guardamos la integridad, confidencialidad y disponibilidad, de los datos personales que nos suministra, en apego a la legislación colombiana en cumplimiento al Artículos 10 del Decreto 1377 de 2013, con su registro en el portal autoriza para continuar con el tratamiento de sus datos personales con el fin de recolectar, almacenar, usar, circular, suprimir, procesar, actualizar, disponer de los datos personales que usted nos suministra. 
<br><br>
Usted podrá ejercer los derechos de conocer, actualizar, rectificar, suprimir, ser informado del uso de sus datos personales, presentar ante la Superintendencia de Industria y Comercio quejas por infracciones a los dispuesto en la presente ley y las demás normas que la modifiquen, adicionen o complementen, para cualquier inquietud al respecto ponemos a su disposición el correo electrónico co.agroit@gmail.com
<br><br>
En aquello que no sea competente la legislación de protección de datos personales, se ajustará a lo dispuesto respecto al tratamiento de información personal según la legislación vigente.
Este documento contempla nuestra política de protección y tratamiento de los datos personales la cual tiene como fin informar cuáles datos son capturados en la prestación de nuestros servicios y productos y para cuales finalidades, como la usamos y protegemos.
<br><br>
La información y/o datos personales que recolectamos de usted que es nuestro cliente, son los siguientes:
<br>
1. A los usuarios: nombres y apellidos, tipo de identificación, número de identificación, email.
<br>
2. A la organización: Razón social, NIT, dirección, teléfono, correo electrónico, ciudad.
<br><br> 
Datos para la Operación:<br>
1. Terceros: Nombre o Razón social, Documento o NIT, teléfono.<br> 
2. Fincas: Nombre, Municipio.<br> 
3. Animales: Numero, Razo, Fecha de Nacimiento, Padre y Madre (opcional).<br> 
4. Movimientos: Tipo de Movimiento, Cantidad, Fecha y Observación
<br><br> 
Es Información necesaria para realizar el proceso que orienta a Appis pero brindaremos al privacidad que exige la Normatividad Colombiana.
</td></tr></table>
</div>
</div>
<footer>
<div align="center">
<hr style="color: #0056b2;" />
Desarrollado por AgroIT 
<br>2015 - 2017
</div>
</footer>
</div>
</body>
</html>