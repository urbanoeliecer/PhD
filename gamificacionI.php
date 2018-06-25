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
<script type="text/javascript" src="../js/jquery-2.1.1.js" ></script>
<script type="text/javascript" src="../js/github_contribution.js"></script>
<link href="../css/github_contribution_graph.css" media="all" rel="stylesheet" />
<?php
// 180508
include("conect.php");
$link = Conectarse();
// Cantidad de comunidades
$SQL = "SELECT cmn FROM comunidades where cmnid > 2";
$p = mysqli_query($link,$SQL);
$cntPrg = 0;
$j = 0;
while ($fila = mysqli_fetch_array($p)) { 
	$cntAnm[$j] = $fila[0];
	//print $cntAnm[$j].'<br>';
	$j++;
}	
// busca la cantidad de datos para cada comunidad
$SQL = "SELECT count(uc.idcmn),uc.idcmn, u.usrid, u.fecha FROM usos u, usuariosxcomunidad uc where  uc.idcmn > 2 and uc.idusr = u.usrid group by uc.idcmn order by uc.idcmn,u.usrid,u.fecha ";
$p = mysqli_query($link,$SQL);
$cntUsr = 0;
$minUsr = '';
while ($fila = mysqli_fetch_array($p)) { 
	$rgsxusr[$cntUsr] = $fila[0];
	//print $cntUsr.' '.$rgsxusr[$cntUsr].'<br>';
	// Calculo el menor idusr de la región
	if ($minUsr == '')
	  $minUsr = $fila[1];
	$cntUsr++;
}
// Debe hacer la resta de la fecha para sacar los días
$start = date("Y-m-d");
// busca las fechas y registros para cada usuario
$SQL = "SELECT uc.idcmn,u.usrid,u.fecha,u.registros FROM usos u, usuariosxcomunidad uc where uc.idcmn > 2 and uc.idusr = u.usrid  order by uc.idcmn,u.usrid,u.fecha";
$p = mysqli_query($link,$SQL);
$cntPrg = 0;
//$j = -1;
$usract = '';	
while ($fila = mysqli_fetch_array($p)) {  
	if ($usract != $fila[0]) {
		$j=0; 
		$usract = $fila[0];
	}
	$end = $fila[2];
	$diff = floor(1+(strtotime($start)- strtotime($end))/24/3600);
	$usr = $fila[0]-$minUsr;
	$dias[$usr][$j] = $diff;
	//print '<br>'.$fila[0].' '.$start.' '.$end.' '.$fila[2].'$dias['.$usr.']['.$j.'] = '.$diff;
	$j++;
}
?>
<script type="text/javascript">
var cntAnm = <?php echo json_encode($cntAnm);?>;
var entries = <?php echo json_encode($rgsxusr);?>; 
var dias = <?php echo json_encode($dias);?>; 
//Generate random number between min and max
function getRandomTimeStamps(usr){
	var return_list = [];
	// cantidad de datos para cada usuario
	for ( var i =0; i < entries[usr]; i++){
		var day = new Date();
		//Genrate random
		var previous_date = dias[usr][i];
		day.setDate( day.getDate() - previous_date );
		return_list.push( day.getTime() );
	}
	return return_list;
}
$(document).ready(function(){
	$('#github_chart_0').github_graph( {
	  //Generate random entries from 50-> 200 entries
	  data: getRandomTimeStamps(0) ,
	  texts: ['uno','varios']
	});
	$('#github_chart_1').github_graph( {
	  //Generate random entries from 50-> 200 entries
	  data: getRandomTimeStamps(1) ,
	  texts: ['completed task','completed tasks']
	});
	$('#github_chart_2').github_graph( {
	  //Generate random entries from 50-> 200 entries
	  data: getRandomTimeStamps(2) ,
	  texts: ['completed task','completed tasks']
	});
	/*
	$('#github_chart_3').github_graph( {
	  //Generate random entries from 50-> 200 entries
	  data: getRandomTimeStamps(3) ,
	  texts: ['completed task','completed tasks']
	});
	$('#github_chart_4').github_graph( {
	  //Generate random entries from 50-> 200 entries
	  data: getRandomTimeStamps(4) ,
	  texts: ['completed task','completed tasks']
	});
    */	
	
});
</script>    
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
// 180508 Cambios para resumen de visitas?>
<div align="center">
<h4>Informe de Usabilidad</h4>
<?php
//print 'Comunidad: '.$cmbCmn.'<br>';
echo @$cntAnm[0];
echo '<div id="github_chart_0"></div>';
echo @$cntAnm[1];
//if ($cntUsr > 1)
echo '<div id="github_chart_1" align="center"></div>';
echo @$cntAnm[2];
//if ($cntUsr > 2)
echo '<div id="github_chart_2" align="center"></div>';
?>
</div>
</form>
</body>
</html>
