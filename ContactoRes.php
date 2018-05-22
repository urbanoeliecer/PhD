<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = ""; //appgro//
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
//session_start();
//if (!isset($_SESSION["usuario"])) {
//    header("Location: ../IniciarSesion.php");
//}
$txtNmb = strtoupper($_POST["txtNmb"]);
$txtMns = strtoupper($_POST["txtMns"]);
$txtEml = strtoupper($_POST["txtEml"]);
$ss = fnctContacto('co.agroit@gmail.com',$txtNmb,$txtEml,'Contacto AgroIT',$txtMns);
$intro = "Se ha enviado su mensaje, pronto tendrá respuesta";
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>AgroIT</title>
<meta charset="utf-8">
<link href="../sistema/estilos/css/bootstrap.min.css" rel="stylesheet">
<link href="../sistema/estilos/css/appgro.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script  src="../sistema/estilos/js/bootstrap.min.js"></script>
    </head>
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
                    <a class="navbar-brand" href="#">AgroIT</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php
                        echo MenuBas();
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
<div class="tail-bottom">
    <div id="main">
        <div class="wrapper indent">
            <div class="inside" align="center">
                <h2 align="center"><span>Comunicación Recibida!</span></h2>
                <div align="center"><p><?php echo $intro; ?></p></div>
            </div>
    </div><br>
<footer>
   <div align="center"> <div align="center">
        <hr style="color: #0056b2;" />
        Desarrollado por AgroIT 
        <br>2015 - 2017
    </div>
</footer>
</div>
</body>
</html>
<?php
function fnctContacto($mailrecibe,$nameenvia,$mailenvia,$asunto,$desc)
{
    $fchIng=date("Y-m-d H:i:s");
    $raiz = "http://www.agroit.co";
    $cuerpo = '<html><head>   </head>
	<body style="font-family:Verdana,Arial,Tahoma;font-size:13px;color:#333;">
	<div style="width:100%;overflow:hidden;background-color:#4285F4;padding:5px 2%;font-size:15px;font-weight:bold;color:#FFF;">Contacto AgroIT</div>
	<div style="width:100%;padding:5px 1% 0 1%;">
	<p>El día '.$fchIng.' se realizó una solicitud de contacto.</p>
	<p style="color:#8c2426;font-weight:bold;">	
	Pronto obtendrá respuesta<br><br>
	¡Si usted no realizó esta solicitud, por favor envíenos un correo informándonos sobre el caso!</p>
	<p>El texto recibido fué:</p>	
	<p>'.$desc.'</p>
	</div>
	</body>
	</html>';
    # Creo los headers del mensaje
    $headers="MIME-Version:1.0 \n";
    $headers.="Content-type: text/html; charset=UTF-8 \n";
    $headers.="From: ".$nameenvia." <".$mailenvia."> \n";
    $headers.="Reply-To: ".$nameenvia." <".$mailenvia."> \n";
    phpversion();
    $headers.="X-Mailer: PHP/" . phpversion() . "\r\n";
    # Envio el correo
    $retorno = mail($mailrecibe,$asunto,$cuerpo,$headers);
    return $retorno;
}
?>