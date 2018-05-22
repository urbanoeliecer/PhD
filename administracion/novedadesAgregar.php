<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//Vista.php";
include "$root//$SystemFolder//funciones//Menu.php";
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../loginForm.php");
}
?>
<html lang="en">
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
<script  src="../sistema/estilos/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<?php
include "$root//$SystemFolder//funciones//ComboInput.php"; //$AppName/
?>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!--<img src = "../images/appisSin.png" width="63">--><button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
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
        </div>
    </div>
</nav>
<div class="container">
    <div class="col-lg-offset-3 col-lg-6">
        <?php
        // 150618 In
        foreach($_POST as $nombre_campo => $valor){ 
            $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
            eval($asignacion); 
        }
        // 150618 Fin
        $tabla = "t_movimientos";
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            echo '<h1 style="text-align: center">Editar Novedad</h1>';
            generarTablaEditar($tabla, $id, $_SESSION['idorg']);
        } else {
            $accion = "";
            // 150618 In
            if (@$asignación == '')
                $accion = 'Compra';
            // 150618 Fin
            if (isset($_POST['Peso'])) {
                $accion = $_POST['Peso'];
            }
            if (isset($_POST['Palpacion'])) { //160524
                $accion = $_POST['Palpacion'];
                //160524 Debe quitar la tarea pendiente de la palpacion
                if (@$_POST['idanimalx'] != '') {
                    $sql = "update tareaspendientes set estado = 0 where idanimal = ".$_POST['idanimalx'];
                    $rrr = consultaSQL($sql, $_SESSION['idorg']);                
                }
            }            
            if (isset($_POST['Leche'])) {
                $accion = $_POST['Leche'];
            }
            if (isset($_POST['Parto'])) {
                $accion = $_POST['Parto'];
                //160524 Debe quitar la tarea pendiente del parto
                if (@$_POST['idanimalx'] != '') {
                    $sql = "update tareaspendientes set estado = 0 where idanimal = ".$_POST['idanimalx'];;
                    $rrr = consultaSQL($sql, $_SESSION['idorg']);
                }
            }
            if (isset($_POST['Compra'])) {
                $accion = $_POST['Compra'];
            }
            if (isset($_POST['Venta'])) {
                $accion = $_POST['Venta'];
            }
            if (isset($_POST['Traslado'])) {
                $accion = $_POST['Traslado'];
            }
            if (isset($_POST['Vacuna'])) {
                $accion = $_POST['Vacuna'];
            }
            if (isset($_POST['Purga'])) {
                $accion = $_POST['Purga'];
            }
            if (isset($_POST['Muerte'])) {
                $accion = $_POST['Muerte'];
            }
            echo '<br/><br/>';
            // 160130
            if (@$_GET['novedad'] != '') {
                if (@$_GET['rlz'] != '')
                    echo'<br><div align="center"><font color=red>Lote Igual</font></div>';
                else
                    echo'<br><div align="center"><font color=red>Listo, puede continuar</font></div>';
                $accion = $_GET['novedad'];
            } 
            echo '<h1 style="text-align: center">Nvd. (' . $accion . '):</h1>';
            //170519
            if ($accion == 'Traslado') {
                echo '<form method="POST" action="ControlInsert.php">'; // Crea el formulario pero si viene de afuera lo creó allá
                echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">';
                echo '<tr><td>Animal:</td><td>';
                
                echo '<input type="hidden" name="novedad" value="'.$accion.'">';
                echo '<input type="hidden" name="form" value="'.str_ireplace("Agregar","",basename($_SERVER['PHP_SELF'])).'">';
                echo '<input type="hidden" name="tabla" value="t_loteshistorico">';
                echo '<input type="hidden" name="idorg" value="'.$_SESSION['idorg'].'">';
                getComboValor("t_animales",$_SESSION['idorg'],"idanimal","");
                echo '<tr><td>Nuevo Lote:</td><td>';
                getCombo("t_lotes", "idlote","Traslado",'','',$_SESSION['idorg']);
                echo '<tr><td colspan="2">';
                echo '<div align=center><input type="submit" value="Enviar"></div>'; 
                echo '</table></div>';
                echo '</form>';
            }
            else
              generarTablaAgregar($tabla, $accion, $_SESSION['idorg'],'');
        }
        ?>
    </div>
</div>
</body>
</html>
