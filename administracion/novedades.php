<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema";
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
        <title>SAMII-DSS</title>
        <link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
        <link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../sistema/estilos/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<script src="../design_appgro/backend/js/excanvas.min.js"></script> 
<script src="../design_appgro/backend/js/chart.min.js" type="text/javascript"></script> 

    <?php
    include "$root//$SystemFolder//funciones//ComboInput.php"; //$AppName//
    ?>        
    </head>
    <body>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <!--<img src = "../images/appisSin.png" width="63">
                    <a href="Manual.php?id=6" target="_blank"><img src = "../images/descarga.png" width="33"></a>
                    -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
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
        <div class="container">
            <h1 style="text-align: center">Novedades</h1>
            <?php
            if ($_SESSION['IdPerfil'] != 2) {
                $page = basename($_SERVER['PHP_SELF'], ".php");
                echo generarAgregar($page); // Pinta los botones
            }
//160108 Filtros
?>
<form action="novedades.php" method="POST">
<div class="main">
<div class="main-inner">
<div class="container">
<div class="row">
<div class="span6">
<?php
$hoy = getdate();
$i=0;
foreach ($hoy as $k => $v) {
    $h[$i] = $v;
    $i++;
}
$fecAct = $h[6].'-'.str_pad($h[5],2,'0',STR_PAD_LEFT).'-'.str_pad($h[3],2,'0',STR_PAD_LEFT);
$idanimal = @$_POST["idanimal"];
$fecIni = @$_POST["fecIni"];
$fecFin = @$_POST["fecFin"];
$radEvn = @$_POST["radEvn"];
$filtro = '';
if (isset($idanimal)) $filtro .= ' and m.idanimal = '.$idanimal;
if (isset($radEvn))  $filtro .= ' and m.idtipomovimiento = '.$radEvn;
if ($fecIni != '')   $filtro .= ' and m.fecha >= '.$fecIni;
if ($fecFin != '')   $filtro .= ' and m.fecha <= '.$fecFin;
$novedad = 'Leche';
print $filtro;
?>
<table align="center" style="width:320px">
<tr>
<td><input type="radio" name="radEvn" value ="1">Peso
<td><input type="radio" name="radEvn" value ="2">Leche
<td><input type="radio" name="radEvn" value ="3">Cria
<td><input type="radio" name="radEvn" value ="4">Compra
<td><input type="radio" name="radEvn" value ="5">Venta
<tr><td><input type="radio" name="radEvn" value ="6">Vacuna
<td><input type="radio" name="radEvn" value ="7">Purga
<td><input type="radio" name="radEvn" value ="8">Muerte
<td><input type="radio" name="radEvn" value ="9">Estado
</td>
<td>&nbsp;</td></tr>
</table>
<table align="center" style="width:320px">
<?php
echo '<tr><td align="center">';
date_default_timezone_set("America/Bogota");
echo '<input type="date" name="fecIni" value="' .$fecIni . '" style="height:22px;width:138px"/>';
echo '</td><td align="center"><input type="date" name="fecFin" value="' .$fecFin. '" style="height:22px;width:138px"/>';
echo '</table><table align="center" style="width:320px"><tr><td>Animal</td><td colspan="3">';
getCombo('t_animales','idanimal','','','',$_SESSION['idorg']);
echo '</td><td colspan="3" align="center"><input type="submit" value="Enviar"></td></tr>';
?>
</table>
</form>
<?php
DibujarTabla("t_movimientos", $_SESSION['idorg'],'',$filtro);
//DibujarTabla("t_movimientos", $_SESSION['idorg'],'1',$filtro);
?>
</div>
</body>
</html>