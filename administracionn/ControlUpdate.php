<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "";
$SystemFolder = $AppName."//sistema";
include "$root//$SystemFolder//funciones//basedatos.php";
$DBLINK = conectar();
session_start();
$id = $_SESSION['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tabla = $_POST['tabla'];
    switch ($tabla) {
        case "t_tipostercero": {
                $sql = "UPDATE t_tipostercero SET TipoTercero = '" . $_POST['TipoTercero'] . "' WHERE IdTiposTercero = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "t_lotes": {
                $sql = "UPDATE t_lotes SET Idfinca = " . $_POST['IdFinca'] . ", Lote = '" . $_POST['Lote'] . "' WHERE IdLote = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "t_municipios": {
                $sql = "UPDATE t_municipios SET Municipio = '" . $_POST['Municipio'] . "' WHERE IdMunicipio = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "t_razas": {
                $sql = "UPDATE t_razas SET Raza = '" . $_POST['Raza'] . "' WHERE IdRaza = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "t_terceros": {
                $sql = "UPDATE t_terceros SET Tercero = '" . $_POST['Tercero'] . "', Documento = '" . $_POST['Documento'] . "', Telefono = '" . $_POST['Telefono'] . "', IdTiposTercero = " . $_POST['IdTiposTercero'] . " WHERE IdTercero = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "t_tiposanimal": {
                $sql = "UPDATE t_tiposanimal SET TipoAnimal = '" . $_POST['TipoAnimal'] . "', Descripcion = '" . $_POST['Descripcion'] . "' WHERE IdTipoAnimal = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "t_fincas": {
                $sql = "UPDATE t_fincas SET IdMunicipio = " . $_POST['IdMunicipio'] . ", Finca = '" . $_POST['Finca'] . "', Descripcion = '" . $_POST['Descripcion'] . "' WHERE IdFinca= " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "t_animales": {
                // 150605 Al editar el estado agregar la novedad
                $sql = "select IdTipoAnimal from t_animales where idAnimal=".$id;
                $result = consultaSQL($sql, $_SESSION['idorg']);
                $f = mysqli_fetch_array($result);
                if ($f[0] != $_POST['IdTipoAnimal']){
                    $fec = date ( "Y-m-d"); 
                    $sql = 'INSERT INTO t_movimientos (IdTipoMovimiento, IdAnimal, Fecha) VALUES (9,' . $id . ',"' . $fec . '")';
                    consultaSQL($sql, $_SESSION['idorg']);
                }    
                $sql = "UPDATE t_animales SET IdLote = " . $_POST['IdLote'] . ",IdTipoAnimal = " . $_POST['IdTipoAnimal'] . ",IdRaza = " . $_POST['IdRaza'] . ", Numero = '" . $_POST['Numero'] . "', Nombre = '" . $_POST['Nombre'] . "', FechaNacimiento = '" . $_POST['FechaNacimiento'] . "' WHERE IdAnimal =" . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                // Debe asignar una tarea con observación
                $mov = 9;
                $aaa =  (int)($_POST['IdTipoAnimal']);
                switch ($aaa){
                    case 1: $t=30; $obs = 'Decidir venta';break;
                    case 2: $t=90; $obs = 'Criar'; break;
                    case 3: $t=180; $obs = 'Destetar'; break;
                    case 4: $t=360; $obs = 'Cebar';break;
                    case 5: $t=30; $obs = 'Palpar';break;   
                    case 6: $t=30; $obs = 'Palpar';break;
                    case 7: $t=30; $obs = 'Inseminar'; break;
                    case 8: $t=30; $obs = 'Inseminar'; break;
                    case 9: $t=90; $obs = 'Levantar'; break;
                    case 10: $t=90; $obs = 'Descansar'; break;
                    case 11: $t=180; $obs = 'Destetar'; break;
                    case 12: $t=90; $obs = 'Levantar'; break;;
                    case 13: $t=360; $obs = 'Cebar';break;
                    case 14: $obs = '';
                    case 15: $t=360; $obs = 'Pulir';break;
                }
                //prin $aaa.' - '.$mov.' - '.$obs; exit();
                $Fecha = date('Y-m-d H:i:s');
                $sql = "update tareaspendientes set fechater = '".$Fecha."', estado = 0 where idanimal = ".$id;
                $rrr = consultaSQL($sql, $_SESSION['idorg']);
                agregartarea($id,$mov,$obs,$t); //160524
                break;
            }
        case "t_usuarios": {
                // 150615 cambiar el password, quité: IdParametro = " . $_POST['IdParametro'] . ", IdLicencia = " . $_POST['IdLicencia'] . ",IdPerfil = " . $_POST['IdPerfil'] . ",
                if (strcmp($_POST['Pass'], "") == 0) {
                    $SQL = "UPDATE t_usuarios SET Usuario = '" . $_POST['Usuario'] . "', Nombre1 = '" . $_POST['Nombre1'] . "', Nombre2 = '" . $_POST['Nombre2'] . "', Apellido1 = '" . $_POST['Apellido1'] . "', Apellido2 = '" . $_POST['Apellido2'] . "', Documento = '" . $_POST['Documento'] . "' WHERE IdUsuario =" . $id;
                    consultaSQL($SQL,'appgrocntrl');
                } else {
                    $SQL = "UPDATE t_usuarios SET Usuario = '" . $_POST['Usuario'] . "', Nombre1 = '" . $_POST['Nombre1'] . "', Nombre2 = '" . $_POST['Nombre2'] . "', Apellido1 = '" . $_POST['Apellido1'] . "', Apellido2 = '" . $_POST['Apellido2'] . "', Documento = '" . $_POST['Documento'] . "', Pass = SHA2('" . $_POST['Pass'] . "',256) WHERE IdUsuario =" . $id;
                    consultaSQL($SQL,'appgrocntrl');
                }
                break;
            }
        case "t_movimientos": {
                $sql = "SELECT IdTipoMovimiento FROM t_movimientos WHERE IdMovimiento = " . $id;
                $result = consultaSQL($sql, $_SESSION['idorg']);
                $f = mysqli_fetch_array($result);
                updateMovimientos($f[0], $id);
                break;
            }
        case "t_animalesgen": {
                $sql = "UPDATE t_animalesgen SET IdAnimal = " . $_POST['IdAnimal'] . ",IdAnimalPadre = " . $_POST['IdAnimalPadre'] . ",IdAnimalMadre = " . $_POST['IdAnimalMadre'] . " WHERE IdAnimal =" . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
    }
}
unset($_SESSION['id']);
header('Location: ' . $_POST['form']);

function updateMovimientos($novedad, $id) {
    switch ($novedad) {
        case 1: {
                $sql = "UPDATE t_movimientos SET Fecha = '" . $_POST['Fecha'] . "', Cantidad = " . $_POST['Cantidad'] . ", Descripcion = '" . $_POST['Descripcion'] . "' WHERE IdMovimiento = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case 2: {
                $sql = "UPDATE t_movimientos SET  Fecha = '" . $_POST['Fecha'] . "', Cantidad = " . $_POST['Cantidad'] . ", Descripcion = '" . $_POST['Descripcion'] . "' WHERE IdMovimiento = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case 3: {
                $sql = "UPDATE t_movimientos SET Fecha = '" . $_POST['Fecha'] . "', Cantidad = " . $_POST['Cantidad'] . ", Descripcion = '" . $_POST['Descripcion'] . "', HembrasVivas = " . $_POST['HembrasVivas'] . ", MachosVivos = " . $_POST['MachosVivos'] . ", Muertos = " . $_POST['Muertos'] . " WHERE IdMovimiento = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case 4: {
                $sql = "UPDATE t_movimientos SET Fecha = '" . $_POST['Fecha'] . "', Cantidad = " . $_POST['Cantidad'] . ", Descripcion = '" . $_POST['Descripcion'] . "', IdTercero = " . $_POST['IdTercero'] . ", Precio = " . $_POST['Precio'] . " WHERE IdMovimiento = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case 5: {
                $sql = "UPDATE t_movimientos SET Fecha = '" . $_POST['Fecha'] . "', Cantidad = " . $_POST['Cantidad'] . ", Descripcion = '" . $_POST['Descripcion'] . "', IdTercero = " . $_POST['IdTercero'] . ", Precio = " . $_POST['Precio'] . " WHERE IdMovimiento = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case 6: {
                $sql = "UPDATE t_movimientos SET Fecha = '" . $_POST['Fecha'] . "', Cantidad = " . $_POST['Cantidad'] . ", Descripcion = '" . $_POST['Descripcion'] . "' WHERE IdMovimiento = " . $id;
                print $sql; exit();consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case 7: {
                // IdAnimal = " . $_POST['IdAnimal'] . ",
                $sql = "UPDATE t_movimientos SET  Fecha = '" . $_POST['Fecha'] . "', Cantidad = " . $_POST['Cantidad'] . ", Descripcion = '" . $_POST['Descripcion'] . "' WHERE IdMovimiento = " . $id;
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
    }
}
function agregartarea($idanm,$mov,$obs,$t){ // Es diferente al de insertar pues este por ser cambio de estado no puede buscar en la tabla, depende es de la observcion
    $Fecha = date('Y-m-d');
    //160523 Crea la tarea pendiente
    $sql = "select q.IdTipoMovimiento,q.Movimiento, q.Unidad,q.tiempo,q.idmovsig, t.Movimiento from t_tiposmovimiento as t left join t_tiposmovimiento as q on (t.IdTipoMovimiento=q.idmovsig) where q.IdTipoMovimiento =  ".$mov;
    $rrr = consultaSQL($sql, $_SESSION['idorg']);
    $f = mysqli_fetch_array($rrr);
    $idact = $f[4];
    //$dias = $f[3];
    $newfecha = dameFecha($Fecha,$t);
    $Fecha = date('Y-m-d H:i:s');
    $sql = "insert into tareaspendientes (idanimal,fechaasg,fecharea,fechater,idusuario,idmovimiento,observaciones) values ('".$idanm."','".$Fecha."','".$newfecha."','".$newfecha."','".$_SESSION["IdUsuario"]."','".$mov."','".$obs."')";
    consultaSQL($sql, $_SESSION['idorg']);
}
function dameFecha($fecha,$dia)
{   list($year,$mon,$day) = explode('-',$fecha);
    return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));        
}
  