<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii";
$SystemFolder = $AppName."//sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";

session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../IniciarSesion.php");
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>SAMI-DSS - Gamificacion</title>
        <link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
        <link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../sistema/estilos/js/bootstrap.min.js"/></script>
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <!--<img src = "../images/appisSin.png" width="63">
                    <a href="Manual.php?id=5" target="_blank"><img src = "../images/descarga.png" width="33"></a>-->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SAMI-DSS</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        //echo Menu($_SESSION["IdPerfil"]);
						echo MenuGame();
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
<form action="gamificacionInf.php" method = "POST">
<div align="center">
<table align="center"Informe de Usabilidad</h4>
<?php
include("conect.php");
// Empieza la página

echo '<table align="center" width="95%"><tr><td align="center">';
$usr = $_SESSION["IdUsuario"];
$fch = date("Y-m-d H:i:s");
$SQP = ' select * from comunidades where cmnId > 2 ';
echo 'Seleccione la comunidad para la que desea analizar la autonomía:<br><select name="cmbCmn">';
$link = Conectarse();
$p = mysqli_query($link,$SQP);
while ($fila = mysqli_fetch_array($p)) {
	echo '<option value = "'.$fila[0].'">'.$fila[1].'</option>';
}
echo '</select><br><br><input type = "submit" value = "Enviar" name="btn">';
echo '<tr><td align="center"><br><br><a href="gamificacion.php" target="_blank">Atrás</a>';
echo '</table>';
?>
</div>
</form>
</body>
</html>
