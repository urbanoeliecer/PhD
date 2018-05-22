<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "";
$SystemFolder = $AppName."//sistema";
include "$root//$SystemFolder//funciones//basedatos.php";

session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../loginForm.php");
}

$form = $_POST['form'];
$id = $_POST['id'];
$tabla = $_POST['tabla'];
$modo = $_POST['modo'];
switch ($modo) {
    case "inhabilitar": {
            $sql = "select COLUMN_NAME from information_schema.columns where table_schema = 'appgrognral' and ORDINAL_POSITION = 1 and TABLE_NAME = '" . $tabla . "'";
            $regcolumna = mysqli_fetch_array(consultaSQL($sql));
            $columna = $regcolumna[0];
            $Fecha = date('Y-m-d H:i:s');
            $sql = "UPDATE " . $tabla . " SET Estado = 0 ";
            if ($tabla == 'tareaspendientes') $sql .= ", fechater ='".$Fecha."'"; // 160524
            $sql .= " WHERE " . $columna . "=" . $id;
            consultaSQL($sql,$_SESSION['BD']);
            header('Location: ' . $form);
            break;
        }
    case "editar": {
            $form = str_ireplace(".php", "Agregar.php", $form);
            $_SESSION['id'] = $id;
            header('Location: ' . $form);
            break;
        }
    case "historico": {
            $_SESSION['IdAnimal'] = $id;
            header('Location: historicoAnimal.php');
            break;
        }
    default:
        break;
}
