<?php
// Esta pagina permite ver las g´raficas, tipo git de las actividades
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii";
$SystemFolder = $AppName."//sistema";
//include "$root//$SystemFolder//funciones//Vista.php";
//include "$root//$SystemFolder//funciones//Menu.php";
/*
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../IniciarSesion.php");
}
*/
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
<title>SAMI-DSS - Gamificacion</title><!--
<link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
<link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../sistema/estilos/js/bootstrap.min.js"/></script>
<script type="text/javascript" src="../js/jquery-2.1.1.js" ></script>
<script type="text/javascript" src="../js/github_contribution.js"></script>
<link href="../css/github_contribution_graph.css" media="all" rel="stylesheet" />-->
</head>

<body><table border="0" align="center"><tr><td align="right">
	Id del profesor:&nbsp;
	<td><div class="textOption idUsuario"><input type="text" class="textOption__value" />
	</div>

    <tr><td align="right">
        Dinero inicial ($):&nbsp;
        <td><div class="selectableOption dineroInicial"><select class="selectableOption__choice">
            <option value='0'>1000000</option>
            <option value='1'>2000000</option>
            <option value='2'>3000000</option>
            <option value='3'>4000000</option>
            <option value='4'>5000000</option>
            <option value='5'>6000000</option>
            <option value='6'>7000000</option>
            <option value='7'>8000000</option>
            <option value='8'>9000000</option>
            <option value='9'>10000000</option>
        </select>
    </div>
    <tr><td align="right">
        Duración Partida (meses):&nbsp;
        <td><div class="selectableOption duracionPartida"><select class="selectableOption__choice">
            <option value='0'>0</option>
            <option value='1'>12</option>
            <option value='2'>18</option>
            <option value='3'>24</option>
            <option value='4'>30</option>
            <option value='5'>36</option>
            <option value='6'>42</option>
            <option value='7'>48</option>
            <option value='8'>54</option>
            <option value='9'>60</option>
        </select>
    </div>
    <tr><td align="right">
        Precio de Compra del Kg Pasto ($/Kg):&nbsp; 
        <td><div class="selectableOption precioKgPasto"><select class="selectableOption__choice">
            <option value='0'>300</option>
            <option value='1'>600</option>
            <option value='2'>900</option>
            <option value='3'>1200</option>
            <option value='4'>1500</option>
            <option value='5'>1800</option>
            <option value='6'>2100</option>
            <option value='7'>2400</option>
            <option value='8'>2700</option>
            <option value='9'>3000</option>
        </select>
    </div>
    <tr><td align="right">
        Precio de Compra del Litro de Agua ($/Litro):&nbsp;
        <td><div class="selectableOption precioLitroAgua"><select class="selectableOption__choice">
            <option value='0'>50</option>
            <option value='1'>100</option>
            <option value='2'>150</option>
            <option value='3'>200</option>
            <option value='4'>250</option>
            <option value='5'>300</option>
            <option value='6'>350</option>
            <option value='7'>400</option>
            <option value='8'>450</option>
            <option value='9'>500</option>
        </select>
    </div>
    <tr><td align="right">
        Precio de Venta del Litro de Leche ($/Litro):&nbsp;
        <td><div class="selectableOption precioLitroLeche"><select class="selectableOption__choice">
            <option value='0'>500</option>
            <option value='1'>600</option>
            <option value='2'>700</option>
            <option value='3'>800</option>
            <option value='4'>900</option>
            <option value='5'>1000</option>
            <option value='6'>1100</option>
            <option value='7'>1200</option>
            <option value='8'>1300</option>
            <option value='9'>1400</option>
        </select>
    </div>
    <tr><td align="right">
        Precio por Pajilla ($/Pajilla):&nbsp;
        <td><div class="selectableOption precioPrenar"><select class="selectableOption__choice">
            <option value='0'>50000</option>
            <option value='1'>100000</option>
            <option value='2'>150000</option>
            <option value='3'>200000</option>
            <option value='4'>250000</option>
            <option value='5'>300000</option>
            <option value='6'>350000</option>
            <option value='7'>400000</option>
            <option value='8'>450000</option>
            <option value='9'>500000</option>
        </select>
    </div>
    <tr><td align="right">
        Precio de compra de la Unidad de Medicina ($/Unidad):&nbsp;
        <td><div class="selectableOption precioUnidadMedicina"><select class="selectableOption__choice">
            <option value='0'>10000</option>
            <option value='1'>20000</option>
            <option value='2'>30000</option>
            <option value='3'>40000</option>
            <option value='4'>50000</option>
            <option value='5'>60000</option>
            <option value='6'>70000</option>
            <option value='7'>80000</option>
            <option value='8'>90000</option>
            <option value='9'>100000</option>
        </select>
    </div>
    <tr><td align="right">
        Probabilidad de Enfermar (%):&nbsp;
        <td><div class="selectableOption probabilidadEnfermar"><select class="selectableOption__choice">
            <option value='0'>0</option>
            <option value='1'>3</option>
            <option value='2'>6</option>
            <option value='3'>9</option>
            <option value='4'>12</option>
            <option value='5'>15</option>
            <option value='6'>18</option>
            <option value='7'>21</option>
            <option value='8'>24</option>
            <option value='9'>27</option>
        </select>
    </div>
	
    <tr><td align="right">
        Valor de Mantenimiento mensual por Vaca ($/(vaca * mes)):&nbsp;
        <td><div class="selectableOption precioMantenimientoPorVaca">           <select class="selectableOption__choice">
            <option value='0'>0</option>
            <option value='1'>10000</option>
            <option value='2'>20000</option>
            <option value='3'>30000</option>
            <option value='4'>40000</option>
            <option value='5'>50000</option>
            <option value='6'>60000</option>
            <option value='7'>70000</option>
            <option value='8'>80000</option>
            <option value='9'>90000</option>
        </select>
    </div>
    <tr><td align="right">
        Precio de compra por Kg para la raza Holstein ($/Kg):&nbsp;
        <td><div class="selectableOption precioKgRaza precioKgRaza--holstein"><select class="selectableOption__choice">
            <option value='0'>3000</option>
            <option value='1'>3500</option>
            <option value='2'>4000</option>
            <option value='3'>4500</option>
            <option value='4'>5000</option>
            <option value='5'>5500</option>
            <option value='6'>6000</option>
            <option value='7'>6500</option>
            <option value='8'>7000</option>
            <option value='9'>7500</option>
        </select>
    </div>

    <tr><td align="right">
        Precio de compra por Kg para la raza Brahman Rojo ($/Kg):&nbsp;
        <td><div class="selectableOption precioKgRaza precioKgRaza--brahmanrojo"><select class="selectableOption__choice">
            <option value='0'>3000</option>
            <option value='1'>3500</option>
            <option value='2'>4000</option>
            <option value='3'>4500</option>
            <option value='4'>5000</option>
            <option value='5'>5500</option>
            <option value='6'>6000</option>
            <option value='7'>6500</option>
            <option value='8'>7000</option>
            <option value='9'>7500</option>
        </select>
    </div>

    <tr><td align="right">
        Precio de compra por Kg para la raza Brahman Blanco ($/Kg):&nbsp;
        <td><div class="selectableOption precioKgRaza precioKgRaza--brahmanblanco"><select class="selectableOption__choice">
            <option value='0'>3000</option>
            <option value='1'>3500</option>
            <option value='2'>4000</option>
            <option value='3'>4500</option>
            <option value='4'>5000</option>
            <option value='5'>5500</option>
            <option value='6'>6000</option>
            <option value='7'>6500</option>
            <option value='8'>7000</option>
            <option value='9'>7500</option>
        </select>
    </div>
    <tr><td colspan="2" align="center">
    <div class="output">
        <p class="output__code"></p>
    </div>
    </table>
    <script src="jquery-3.3.1.slim.min.js"></script>
    <script>
        $(function()
        {
		
		    function refreshCode()
            {
                var code = generateCodeFromChoices();
				code = addTimeCheck(code);
                var codeBase36 = encodeToBase36(code);
				codeBase36 = getChecksum(code) + codeBase36;
				codeBase36 = addUserId(codeBase36);
                $(".output__code").text(codeBase36);
            }
		
            function generateCodeFromChoices()
            {
                var pieces = ["dineroInicial", "precioKgPasto", "precioLitroAgua", "precioLitroLeche", "precioUnidadMedicina", "precioPrenar",
                            "probabilidadEnfermar", "duracionPartida", "precioMantenimientoPorVaca", "precioKgRaza--holstein", "precioKgRaza--brahmanrojo", "precioKgRaza--brahmanblanco"];
                var rawCode = "";
                for (var i=0; i<pieces.length; i++)
                {
                    var selectedOption = $("."+pieces[i]+" select").val();
                    rawCode += selectedOption;
                }
                return rawCode;
            }
			
			function addTimeCheck(code)
			{
				var today = new Date();
				var years = today.getFullYear()-2018;
				var months = today.getMonth(); //0-based.
				var days = today.getDate()-1;
				var approxDays = days + months * 30 + years * 360;
				code = toInt(code) + approxDays;
				return code.toString();
			}

			function toInt(value)
			{
				return parseInt(value,10);
			}
		
            function encodeToBase36(code)
            {
                var codeAsNumber = toInt(code);
                return codeAsNumber.toString(36).toUpperCase();
            }
			
			var sum = function(a,b){return a+b;}
			
			function getChecksum(code)
			{
				var sumOfDigits = code.split('').map(toInt).reduce(sum, 0);
				var checksum = (sumOfDigits*19)%36;
				return encodeToBase36(checksum);
			}
			
			function addUserId(code)
			{
				var userId = $(".idUsuario .textOption__value").val();
				if (userId=="" || !userId.match(/^[A-Za-z0-9]$/)) 
				{
					userId = "0";
					$(".idUsuario .textOption__value").val(userId);
				}
				
				return userId + code;
			}

            $("select, input").change(function()
            {
                refreshCode();
            });

            refreshCode();
            
        });
    </script>
</body>
</html>