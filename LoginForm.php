<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
// 160114 Recarga la páhina para enviar el ancho del navegador, ver hidden
if(!isset($_GET['r']))
{
echo "<script language=\"JavaScript\">
document.location=\"IniciarSesion.php?r=1&Ancho=\"+screen.width+\"&Alto=\"+screen.height;
</script>";
} 
$Ancho = $_GET['Ancho'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>AgroIT - appis</title>
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
                        <h2><span>Login Appis</span> </h2>(Sistema para el control bovino)</div><br>
                        <form method="POST" action="LogIn.php">
                            <table align="center" width="300"><tr><td>
                            <input type="hidden" name="txtancho" value="<?php echo $Ancho;?>">
                            Usuario: <input type="text" size= "30" class="form-control" placeholder="Usuario" name="usuario" required autofocus>
                            Contraseña: <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                            <br>
                            <input class="btn btn-sm btn-primary btn-block" type="submit" value="Enviar">
                            </table>
                        </form>
                        <div align="center">
                        Si ya tiene usuario y olvidó la clave de clic en <a href="RestauraClave.php">Reiniciar Clave</a>
                        </div>
                    </div>
           
        </div><br>
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