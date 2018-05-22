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
$cmbCmn = @$_POST["cmbCmn"];
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
include("conect.php");
$link = Conectarse();
$SQL = "SELECT nombres FROM usuariosxcomunidad where idcmn = $cmbCmn";
$p = mysqli_query($link,$SQL);
$cntPrg = 0;
$j = 0;
while ($fila = mysqli_fetch_array($p)) { 
	$cntAnm[$j] = $fila[0];
	$j++;
}
// Busacar el mayor end
/*$SQL = "SELECT max(fecha) FROM usos where idcmn = $cmbCmn";
$p = mysqli_query($link,$SQL);
$cntPrg = 0;
$j = 0;
while ($fila = mysqli_fetch_array($p)) { 
	$end = $fila[0];
	$j++;
}	*/
// busca la cantidad de datos para cada usuario
$SQL = "SELECT count(u.usrid), u.usrid FROM usos u, usuariosxcomunidad uc where uc.idusr = u.usrid and uc.idcmn = $cmbCmn group by u.usrid order by u.usrid ";
$p = mysqli_query($link,$SQL);
$cntUsr = 0;
$minUsr = '';
while ($fila = mysqli_fetch_array($p)) { 
	$rgsxusr[$cntUsr] = $fila[0];
	// Calculo el menor idusr de la región
	if ($minUsr == '')
		$minUsr = $fila[1];
	$cntUsr++;
}
// Debe hacer la resta de la fecha para sacar los días
$start = date("Y-m-d");
// busca las fechas y registros para cada usuario
print $SQL = "SELECT u.usoid,u.usrid,u.fecha,u.registros FROM usos u, usuariosxcomunidad uc where uc.idusr = u.usrid and uc.idcmn = $cmbCmn order by u.usrid,u.fecha";
//print $SQL;
$p = mysqli_query($link,$SQL);
$cntPrg = 0;
//$j = -1;
$usract = '';	
while ($fila = mysqli_fetch_array($p)) {  
	if ($usract != $fila[1]) {
		$j=0; 
		$usract = $fila[1];
	}
	$end = $fila[2];
	
	$diff = 1+floor((strtotime($start)- strtotime($end))/24/3600);
	$usr = $fila[1]-$minUsr;
	//print $usr.'<br>';
	$dias[$usr][$j] = $diff;
	print '<br>'.$fila[1].' '.$start.' '.$end.' '.$fila[2].'$dias['.$usr.']['.$j.'] = '.$diff;
	$j++;
}
?>
<script type="text/javascript">
var cntAnm = <?php echo json_encode($cntAnm);?>;
var entries = <?php echo json_encode($rgsxusr);?>; 
var dias = <?php echo json_encode($dias);?>;
/*
alert(cntAnm);
alert(entries);
alert(dias); 
*/
//Generate random number between min and max
function getRandomTimeStamps(usr){
	var return_list = [];
	// cantidad de datos para cada usuario
	for ( var i =0; i < entries[usr]; i++){
		var day = new Date();
		
		//Genrate random
		var previous_date = dias[usr][i];
		//alert(day.getDate()+" "+previous_date);
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
	$('#github_chart_5').github_graph( {
	  //Generate random entries from 50-> 200 entries
	  data: getRandomTimeStamps(5) ,
	  texts: ['completed task','completed tasks']
	});
	$('#github_chart_6').github_graph( {
	  //Generate random entries from 50-> 200 entries
	  data: getRandomTimeStamps(6) ,
	  texts: ['completed task','completed tasks']
	});	
	
});
</script>
</head>
<body>
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
		</div>
	</div>
</nav>
<div align="center">
<h4>Informe de Usabilidad</h4>
<?php
print 'Comunidad: '.$cmbCmn.'<br>';
print $cntUsr;
echo @$cntAnm[0];
echo '<div id="github_chart_0"></div>';
echo @$cntAnm[1];
if ($cntUsr > 1)
echo '<div id="github_chart_1" align="center"></div>';
echo @$cntAnm[2];
if ($cntUsr > 2)
echo '<div id="github_chart_2" align="center"></div>';
echo @$cntAnm[3];
if ($cntUsr > 3)
echo '<div id="github_chart_3" align="center"></div>';
echo @$cntAnm[4];
if ($cntUsr > 4)
echo '<div id="github_chart_4" align="center"></div>';
echo @$cntAnm[5];
if ($cntUsr > 5)
echo '<div id="github_chart_5" align="center"></div>';
echo @$cntAnm[6];
if ($cntUsr > 6)
echo '<div id="github_chart_6" align="center"></div>';
?>
</div>
</body>
</html>
<!--eeeee
<td></td></td><td>&nbsp;
<td width="40%" align="center">Tareas Pendientes</td></td><td>&nbsp;</td>
<td valign="top"><?php DibujarTabla("tareaspendientes", $_SESSION['idorg'],''); ?>
<td>&nbsp;</td>
-->