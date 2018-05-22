<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "";
//$SystemFolder = "appconfig/appgro/sistema";
$SystemFolder = "sistema";//$AppName
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../loginForm.php");
}
//-----------Grafica de Barras1 : Tipos de Animales ---------------
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>AgroIT - appis</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
<link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script  src="../sistema/estilos/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<script src="../design_appgro/backend/js/excanvas.min.js"></script> 
<script src="../design_appgro/backend/js/chart.min.js" type="text/javascript"></script> 

<?php
include "$root//$AppName//$SystemFolder//funciones//ComboInput.php";
?></head>
<body>
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
                echo Menu($_SESSION["IdPerfil"]);
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                echo MenuUsuario();
                ?>
            </ul>
        </div>
    </div>
</nav><br/><br/>
<form action="informes_old.php" method="POST">
<div class="main">
<div class="main-inner">
<div class="container">
<div class="row">
<div class="span6">
<div class="widget">
<div class="widget-content"><?php
print $radOpc = @$_POST["radOpc"];
if (!isset($radOpc)) $radOpc = 1;
$idx=1;
switch ($radOpc){
case 1: $idx = 'area-chart'; $cl='';  break;
case 2: $idx = 'bar-chart';$cl='chart-holder'; break;
case 3: $idx = 'donut-chart';$cl='';  break;
case 4: $idx = 'pie-chart'; $cl='';break;
case 5: $idx = 'area-chart';$cl='';  break;
case 6: $idx = 'line-chart';$cl=''; break;
}
echo '<canvas id="'.$idx.'" class="chart-holder" height="250" width="350"></canvas>';
?>
</div>
</div>
<?php
$hoy = getdate();
$i=0;
foreach ($hoy as $k => $v) {
    $h[$i] = $v;
    $i++;
}
$fecAct = $h[6].'-'.str_pad($h[5],2,'0',STR_PAD_LEFT).'-'.str_pad($h[3],2,'0',STR_PAD_LEFT);
$fecAcIni = $h[6].'-'.str_pad($h[5],2,'0',STR_PAD_LEFT).'-01';
$idanimal = @$_POST["idanimal"];
$fecIni = @$_POST["fecIni"];
$fecFin = @$_POST["fecFin"];
if (!isset($fecIni)) $fecIni = $fecAcIni;
if (!isset($fecFin)) $fecFin = $fecAct;
$accion=1;
$novedad = 'Leche';
//Purgas Muertes 
//Individual  Compras Ventas Vacunas
?>
<table border="1" >
<tr><td>Tipo</td><td><input type="radio" name="radOpc" value ="1" checked>Linea - Producción
<br><input type="radio" name="radOpc" value ="2">Barras - Animales
<br><input type="radio" name="radOpc" value ="3">Donut - Animales
<br><input type="radio" name="radOpc" value ="4">Char  
<td><input type="radio" name="radOpc" value ="5">Contraste - Produ 
<br><input type="radio" name="radOpc" value ="6">Polar
<br><input type="radio" name="radOpc" value ="1">Peso
</td></tr>
<tr><td>Evento</td><td><input type="radio" name="radEvn" value ="2">Leche
<br><input type="radio" name="radEvn" value ="3">Cria
<br><input type="radio" name="radEvn" value ="4">Compra
<br><input type="radio" name="radEvn" value ="5">Venta
<td><input type="radio" name="radEvn" value ="6">Vacuna
<br><input type="radio" name="radEvn" value ="7">Purga
<br><input type="radio" name="radEvn" value ="8">Muerte
<br><input type="radio" name="radEvn" value ="9">Estado
<select></select>
</td></tr>
<?php
echo '<tr><td>Fechas:</td><td>';
date_default_timezone_set("America/Bogota");
echo '<input type="date" name="fecIni" value=' .$fecIni . ' style="height:22px;width:150px"/>';
echo '</td><td><input type="date" name="fecFin" value=' .$fecFin. ' style="height:22px;width:150px"/>';
echo '<tr><td>Animal</td><td>';
getCombo('t_animales','idanimal','',$_SESSION['idorg']);
echo '</td><td colspan="3" align="center"><input type="submit"></td></tr>';
?>
</table>
<?php
/*        
$datosInforme = Inf_TiposAnimales(); 
        $datax = array($datosInforme["descripcion"]);
        $datay = array($datosInforme["cuenta"]);
*/
switch ($radOpc){
    case 1: 
        $SQL = "SELECT sum(cantidad),fecha FROM t_movimientos WHERE idtipomovimiento = 2 and fecha >= '2016-01-01' and fecha <= '2016-01-07' GROUP BY fecha ";
    break;  
    case 2:
        $SQL = "SELECT count(a.IdTipoAnimal ), t.descripcion FROM t_animales a, t_tiposanimal t WHERE a.idorg = $idorg and a.IdTipoAnimal = t.IdTipoAnimal GROUP BY a.IdTipoAnimal ";
    break;
    case 5:
        print $SQL = "SELECT cantidad,fecha FROM t_movimientos where idanimal = 2"; //WHERE idtipomovimiento = 2 and fecha >= '$fecIni' and fecha <= '$fecFin' and idanimal = '$idanimal' ";
    break;
    default:
        $SQL = "SELECT count(a.IdTipoAnimal ), t.descripcion FROM t_animales a, t_tiposanimal t WHERE a.IdTipoAnimal = t.IdTipoAnimal GROUP BY a.IdTipoAnimal ";
}
//$SQL = "SELECT count(a.IdTipoAnimal ), t.descripcion FROM t_animales a, t_tiposanimal t WHERE a.IdTipoAnimal = t.IdTipoAnimal GROUP BY a.IdTipoAnimal ";
print $SQL;
$BD = 'appgrognrl'; //casta 
$link = conectar();
$p = consultaSQL($SQL, $BD);
echo '<table border="1" style="width:500px">';
$j=0;
while ($f = mysqli_fetch_array($p)) {
    echo '<tr>';
    echo '<td>'.$f[0].'</td><td>'.$f[1].'</td>';
    $cntAnm[$j]=(integer)$f[0];
    $grpAnm[$j]=$f[1];
    $j++;
}
echo '</table>';
//d.semana, 
print $SQL = "select d.cantidad from t_produccion p, t_producciondet d where p.idtipomovimiento = 2 and idraza = 1 ";
$p = consultaSQL($SQL, $BD);
$cntEsp[0] = 0; // Reiniciar por si no hay datos para la raza
$i=0;
while ($f = mysqli_fetch_array($p)) {
    $cntEsp[$i]= (integer)$f[0];
    $i++;
}
if ($i == '1'){
    for ($j=0;$j<6;$j++){
        $cntEsp[$j]=$cntEsp[0]; 
    }
} 
?>
<!-- Placed at the end of the document so the pages load faster --> 
<script>     
var colors = ["#F7464A","#46BFBD","#FDB45C","#949FB1","#4D5360","#0033cc","#FFFFF","#000000","#555555"];
var cntAnm = <?php echo json_encode($cntAnm);?>;
var grpAnm = <?php echo json_encode($grpAnm);?>;
var cntEsp = <?php echo json_encode($cntEsp);?>;
var radOpc = <?php echo $radOpc ?>;
switch (radOpc) 
{
case 1:
var lineChartData = {
    labels: grpAnm, 
    datasets: [
                {
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    data :cntAnm
                    //data: [65, 59, 90, 81, 56, 55, 40]
                }
                ]
}
var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);

break;
case 2:
var barChartData = {
            labels: grpAnm, 
            datasets: [
				{
				    fillColor: "rgba(220,220,220,0.5)",
				    strokeColor: "rgba(220,220,220,1)",
				    data: cntAnm //[65, 59, 90, 81, 56, 55, 40]
				}
			]

        }

var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);
   
break;

case 3:

var doughnutData = [{value: 67,color: "#F7464A"},{value:80,color: "#46BFBD"},{value: 42,color: "#FDB45C"},{value: 40,color: "#949FB1"},{ value: 48, color: "#4D5360"},{ value:80, color : "#46BFBD"},{ value: 42, color: "#FDB45C"},{ value: 40, color: "#949FB1"},{ value: 48, color: "#4D5360"}];
for (var i=0;i<9;i++){
    doughnutData[i].value = parseInt(cntAnm[i]);
    doughnutData[i].color = colors[i];
}
var myDoughnut = new Chart(document.getElementById("donut-chart").getContext("2d")).Doughnut(doughnutData);
break;
case 5:
var pieData = [
				{
				    value: 30,
				    color: "#F38630"
				},
				{
				    value: 50,
				    color: "#E0E4CC"
				},
				{
				    value: 100,
				    color: "#69D2E7"
				}

			];

				var myPie = new Chart(document.getElementById("pie-chart").getContext("2d")).Pie(pieData);
break;
case 4:
var lineChartData = {
    labels: grpAnm, //["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            data : cntAnm
            //data : [65, 59, 90, 81, 56, 55, 40]
        },
        {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            data : cntEsp
            //data : [11, 10, 10]
        }
    ]
}
var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);
    
break;
case 6: 
				var chartData = [
			{
			    value: Math.random(),
			    color: "#D97041"
			},
			{
			    value: Math.random(),
			    color: "#C7604C"
			},
			{
			    value: Math.random(),
			    color: "#21323D"
			},
			{
			    value: Math.random(),
			    color: "#9D9B7F"
			},
			{
			    value: Math.random(),
			    color: "#7D4F6D"
			},
			{
			    value: Math.random(),
			    color: "#584A5E"
			}
		];
				var myPolarArea = new Chart(document.getElementById("line-chart").getContext("2d")).PolarArea(chartData);
break;

}

</script>
</div>
</div>
</div>
</div>
</div>
</form>
</body>
</html>


