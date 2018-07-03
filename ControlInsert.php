<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$AppName = "samii/";
$SystemFolder = $AppName."sistema";
include "$root//$SystemFolder//funciones//basedatos.php";
$DBLINK = conectar();
session_start();
$novedad;
if (isset($_POST['novedad'])) {
    $novedad = $_POST['novedad'];
} else {
    $novedad = "";
}
$idorg = @$_POST['idorg'];
/*
if (!isset($_SESSION["usuario"])) {
    header("Location: ../loginForm.php");
}
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tabla = @$_POST['tabla'];
    $varSalto = 0;
    //prin $tabla;
    switch ($tabla) {
    
        case "t_tipostercero": {
                $sql = 'INSERT INTO ' . $tabla . ' (TipoTercero) VALUES ("' . $_POST['TipoTercero'] . '");';
                consultaSQL($sql);
                break;
            }
        case "t_animalesgen": {
                // 150605 Agregar la fecha del parto
                //$fec = date ( "Y-m-d");
                $sql = 'INSERT INTO ' . $tabla . ' (IdAnimal,IdAnimalPadre,IdAnimalMadre,fecha) VALUES (' . $_POST['IdAnimal'] . ',' . $_POST['IdAnimalPadre'] . ',' . $_POST['IdAnimalMadre'] . ',"'.$_POST['FechaNacimiento'].'");';
                consultaSQL($sql);
                unset($_SESSION['Genealogia']);
                break;
            }
        case "t_municipios": {
                $sql = 'INSERT INTO ' . $tabla . ' (Municipio) VALUES ("' . $_POST['Municipio'] . '");';
                consultaSQL($sql);
                break;
            }
        case "t_movimientos": {
                insertarNovedad($novedad);
                break;
            }
        case "t_razas": {
                $sql = 'INSERT INTO ' . $tabla . ' (Raza) VALUES ("' . $_POST['Raza'] . '");';
                consultaSQL($sql);
                break;
            }
        case "t_terceros": {
                $sql = 'INSERT INTO ' . $tabla . ' (IdTiposTercero, Tercero, Documento, Telefono, idorg) VALUES (' . $_POST['IdTiposTercero'] . ',"' . $_POST['Tercero'] . '","' . $_POST['Documento'] . '","' . $_POST['Telefono'] . '","' . $_POST['idorg'] . '");';
                consultaSQL($sql);
                break;
            }
        case "t_tiposanimal": {
                $sql = 'INSERT INTO ' . $tabla . ' (TipoAnimal, Descripcion) VALUES ("' . $_POST['TipoAnimal'] . '","' . $_POST['Descripcion'] . '");';
                consultaSQL($sql);
                break;
            }
        case "t_fincas": {
                $sql = 'INSERT INTO ' . $tabla . ' (IdMunicipio, Finca, Descripcion,idorg) VALUES (' . $_POST['IdMunicipio'] . ',"' . $_POST['Finca'] . '","' . $_POST['Descripcion'] . '","' . $_POST['idorg'] . '");';
                consultaSQL($sql);
                break;
            }
        case "t_animales": {
                if (isset($_SESSION['Genealogia'])) {
                    $sql = 'INSERT INTO ' . $tabla . ' (IdLote, IdTipoAnimal, IdRaza, Numero, Nombre, FechaNacimiento, Estado, IdOrg) VALUES (' . $_POST['IdLote'] . ',' . $_POST['IdTipoAnimal'] . ',' . $_POST['IdRaza'] . ',"'.$_POST['idorg'].$_POST['Numero'] . '","' . $_POST['Nombre'] . '","' . $_POST['FechaNacimiento'] . '",1,"' . $_POST['idorg'] . '");';
                    consultaSQL($sql);
                    //160523 Crea la tarea pendiente
                    $sql = "select max(idanimal) from t_animales";
                    $rrr = consultaSQL($sql);
                    $f = mysqli_fetch_array($rrr);
                    $IdNewAnimal = $f[0];
                    $_SESSION['UltimoAnm'] = $IdNewAnimal; //170602
                    agregartarea($IdNewAnimal,20,'Destetar',''); //160524
                } 
                else {
                    $sql = 'INSERT INTO ' . $tabla . ' (IdLote, IdTipoAnimal, IdRaza, Numero, Nombre, FechaNacimiento, IdOrg) VALUES (' . $_POST['IdLote'] . ',' . $_POST['IdTipoAnimal'] . ',' . $_POST['IdRaza'] . ',"'.$_POST['idorg'].$_POST['Numero'].'","' . $_POST['Nombre'] . '","' . $_POST['FechaNacimiento'] . '","' . $_POST['idorg'] . '");';
                    //prin $sql;
                    //exit();
                    consultaSQLUnique($sql);
                    //160523 Crea la tarea pendiente
                    $sql = "select max(idanimal) from t_animales";
                    $rrr = consultaSQL($sql);
                    $f = mysqli_fetch_array($rrr);
                    $IdNewAnimal = $f[0];                    
                    agregartarea($IdNewAnimal,4,'Decidir','');
                    // 150618 Saltar a la compra
                    header('Location: novedadesAgregar.php');
                    
                    exit();
                }
                break;
            }
        case "t_usuarios": {
                // 170411 Si No trae ide perfil, es que está guardando desde afuera, debe poner estado 1 y crear la Organización 
                $IdPerfil = @$_POST['IdPerfil'];
                if ($IdPerfil == '') {
                    //prin $_POST['txtcpc'];
                    if ($_POST['txtcpc'] != $_SESSION['captcha']['code']) {
                        $varSalto = 2;
                    }
                    else {
                        $varSalto = 1;
                        //170517 Revisa que la organización no exista
                        $sql = 'select count(idorg) from t_organizaciones where orgNmb = "'.$_POST['orgNmb'].'"';
                        $rrr = consultaSQLUnique($sql);
                        $f = mysqli_fetch_array($rrr);
                        if ($f[0] > 0) 
                            $varSalto = 3;
                        else {
                            $sql = 'select count(idusuario) from t_usuarios where email = "'.$_POST['email'].'"';
                            $rrr = consultaSQLUnique($sql);
                            $f = mysqli_fetch_array($rrr);
                            if ($f[0] > 0)
                                $varSalto = 5;
                            else {
                                $sql = 'INSERT INTO t_organizaciones (orgNmb) values ("'.$_POST['orgNmb'].'")'; 
                                consultaSQL($sql);
                                $IdPerfil = 1;
                                $rrr = consultaSQLUnique('select max(idOrg) from t_organizaciones');
                                $f = mysqli_fetch_array($rrr);
                                $idOrgNew = $f[0];
                                $pass = 'bovAgro';
                                $sql = 'INSERT INTO ' . $tabla . ' (IdLicencia, IdPerfil, Usuario, Pass, Nombre1, Nombre2, Apellido1, Apellido2, Documento, email, IdOrg) VALUES (1,' .$IdPerfil. ',"' . $_POST['Usuario'] . '", sha2("' . $pass . '",256),"' . $_POST['Nombre1'] . '","' . $_POST['Nombre2'] . '","' . $_POST['Apellido1'] . '","' . $_POST['Apellido2'] . '","' . $_POST['Documento'] . '","'.$_POST['email'].'","'.$idOrgNew.'");';//$varSalto
                                consultaSQL($sql);
                                $fchIng=date("Y-m-d H:i:s");
                                // Revisa si puede enviar el email
                                $txtNmb = strtoupper($_POST["Nombre1"]);
                                $txtApl = strtoupper($_POST["Apellido1"]);
                                $txtCrr = strtoupper($_POST["email"]);
                                $txtUsr = $_POST["Usuario"];
                                $mailrecibe = $txtCrr;
                                $nameenvia = 'Urbano E. Gómez Prada';
                                $mailenvia = 'co.agroit@gmail.com';
                                $asunto = 'Acceso a Appis';
                                $user = $txtUsr;
                                $newpass = $pass; 
                                $ss = fnctnrestaurarpass($mailrecibe,$nameenvia,$mailenvia,$asunto,$user,$newpass);
                                $usrNmb = $txtNmb;
                            }
                        }
                    }
                }
                else {
                    $sql = 'select count(idusuario) from t_usuarios where email = "'.$_POST['email'].'"';
                    $rrr = consultaSQLUnique($sql);
                    $f = mysqli_fetch_array($rrr);
                    if ($f[0] > 0)
                        $varSalto = 5;
                    else {                    
                        // 150616 Agregar la bd a pérfiles superiores a 1
                        $sql = 'INSERT INTO ' . $tabla . ' (IdLicencia, IdPerfil, Usuario, Pass, Nombre1, Nombre2, Apellido1, Apellido2, Documento, email, IdOrg) VALUES (' . $_SESSION['IdLicencia'] . ',' .$IdPerfil. ',"' . $_POST['Usuario'] . '", sha2("' . $_POST['Pass'] . '",256),"' . $_POST['Nombre1'] . '","' . $_POST['Nombre2'] . '","' . $_POST['Apellido1'] . '","' . $_POST['Apellido2'] . '","' . $_POST['Documento'] . '","'.$_POST['email'].'","'.$_SESSION['idorg'].'");';
                        consultaSQL($sql);
                    }
                }
                break;
            }
            case "t_usuarios_fuecla": {
                    // 170411 Si No trae ide perfil, es que está guardando desde afuera, debe poner estado 1 y crear la Organización 
                    $_POST['txtcpc'];
                    if ($_POST['txtcpc'] != $_SESSION['captcha']['code']) {
                        $varSalto = 2;
                    }
                    else {
                        $varSalto = 1;
                        $sql = 'select count(idusuario) from t_usuarios where email = "'.$_POST['email'].'"';
                        $rrr = consultaSQLUnique($sql);
                        $f = mysqli_fetch_array($rrr);
                        if ($f[0] == 0) 
                            $varSalto = 6;
                        else {                        
                            $pass = 'bovAgro';
                            $sql = 'select idusuario from t_usuarios where email = "'.$_POST['email'].'"';
                            $rrr = consultaSQLUnique($sql);
                            $f = mysqli_fetch_array($rrr);
                            $sql = 'update t_usuarios set pass = sha2("' .$pass.'",256) where Ididusuario = '.$f[0];
                            consultaSQL($sql);
                            $fchIng=date("Y-m-d H:i:s");
                            // Revisa si puede enviar el email
                            $sql = 'select usuario, nombre1, Apellido1 from t_usuarios where email = "'.$_POST['email'].'"';
                            $rrr = consultaSQLUnique($sql);
                            $f = mysqli_fetch_array($rrr);
                            $txtNmb = $f[1];
                            $txtApl = $f[2];
                            $txtCrr = strtoupper($_POST["email"]);
                            $txtUsr = $f[0];
                            $mailrecibe = $txtCrr;
                            
                            $nameenvia = 'Urbano E. Gómez Prada';
                            $mailenvia = 'co.agroit@gmail.com';
                            $asunto = 'Acceso a Appis';
                            $user = $txtUsr;
                            $newpass = $pass; 
                            $ss = fnctnrestaurarpass($mailrecibe,$nameenvia,$mailenvia,$asunto,$user,$newpass);
                            $usrNmb = $txtNmb;   
                        }
                    }
                break;
            }
        case "t_usuarios_dntclv": {
                $varSalto = 4;
                $sql = 'update t_usuarios set pass = sha2("' . $_POST['pass'] . '",256) where idusuario = '.$_SESSION["IdUsuario"];
                consultaSQL($sql);
                break;
            }            
        case "t_lotes": {
                $sql = 'INSERT INTO ' . $tabla . ' (Idfinca, Lote, IdOrg) VALUES (' . $_POST['IdFinca'] . ',"' . $_POST['Lote'] . '","'.$_SESSION['idorg'].'");';
                consultaSQL($sql);
                break;
            }
        //170519
            case "t_loteshistorico": {
                $todayh = getdate();
               $fecha = $todayh['year'].'-'.str_pad($todayh['mon'],2, '0', STR_PAD_LEFT).'-'.str_pad($todayh['mday'],2, '0', STR_PAD_LEFT);
                 $_POST['idanimal'].'<br>';
                $_POST['idlote'].'<br>';
                $sql = 'select idlote from t_animales where idanimal = "'.$_POST['idanimal'].'"';
                $rrr = consultaSQLUnique($sql);
                $f = mysqli_fetch_array($rrr);
                $xx = $f[0];
                $xx.' '.$_POST['idlote'];
                if($xx == $_POST['idlote']){
                    //echo 'son iguales'; No muestra el cambio
                    $rlz = 0;
                }            
                else {
                    $sql = 'INSERT INTO t_loteshistorico (IdAnimal, Idloteant,Idlotenue, Fecha) values('. $_POST['idanimal'] . ',"'.$xx.'","' . $_POST['idlote'] . '","' .$fecha. '")';
                    consultaSQL($sql, $_SESSION['idorg']);
                    $sql = "update t_animales set idlote = ".$_POST['idlote']." where IdAnimal =".$_POST['idanimal'];
                    consultaSQL($sql, $_SESSION['idorg']);
                    $sql = "UPDATE t_animales SET Estado = 2 WHERE IdAnimal = " . $_POST['IdAnimal'];
                    consultaSQL($sql, $_SESSION['idorg']);
                }
                break;
            }    
            
    }
}
//prin strcmp($novedad, "Parto").'-';
//prin $varSalto.'$novedad-'.$novedad.'-Genealogia $novedad '.$novedad;

if (strcmp($novedad,"Parto") == 0) {
    header('Location: animalesAgregar.php?FechaNacimiento='.$_POST['Fecha']); //170602
    
    exit();
} 
else { 
    if (isset($_SESSION['Genealogia'])) {
            header('Location: genealogiaAgregar.php?FechaNacimiento='.$_POST['FechaNacimiento']);
    }
    else{
        if ($novedad != ''){
            header('Location:novedadesAgregar.php?novedad='.$novedad.'&rlz='.$rlz);
        }
        else {
            if ($idorg != '')
                header('Location: '.$_POST['form'].'?salto='.$varSalto);
            else
                if ($varSalto > 0) 
                    header('Location:../RegistroRes.php?salto='.$varSalto);
        }        
    }
}

function insertarNovedad($novedad) {
    switch ($novedad) {
        case "Peso": {
                $sql = 'INSERT INTO t_movimientos (IdTipoMovimiento, IdAnimal, Fecha,FechaRegistro, Cantidad, Descripcion, idorg) VALUES (1,' . $_POST['IdAnimal'] . ',"' . $_POST['Fecha'] . '","' . $_POST['Fecha'] . '",' . $_POST['Cantidad'] . ',"' . $_POST['Descripcion'] . '",'.$_SESSION['idorg'].')';
                //print $sql;
                consultaSQL($sql, $_SESSION['idorg']);
                //exit();
				break;
            }
        case "Leche": {
                $sql = 'INSERT INTO t_movimientos (IdTipoMovimiento, IdAnimal, Fecha,FechaRegistro, Cantidad, Descripcion,idorg) VALUES (2,' . $_POST['IdAnimal'] . ',"' . $_POST['Fecha'] . '","' . $_POST['Fecha'] . '",' . $_POST['Cantidad'] . ',"' . $_POST['Descripcion'] . '",'.$_SESSION['idorg'].')'; 
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "Palpacion": { //160524
                //fecha cant desc
                $Fecha = date('Y-m-d');
                $sql = "INSERT INTO t_movimientos (IdTipoMovimiento, IdAnimal, Fecha, Cantidad,idorg) VALUES (11,'".$_POST['IdAnimal']."','" . $Fecha."','".$_POST['Numero']."',".$_SESSION['idorg'].")"; //,"' . $_POST['Descripcion'] . '")';
                consultaSQL($sql, $_SESSION['idorg']);
                //160523 Crea la tarea pendiente
                agregartarea($_POST['IdAnimal'],10,'Parir',$_POST['Numero']); //160524
                unset($_SESSION['Genealogia']);
            }
            break;
        case "Parto": {
                $sql = 'INSERT INTO t_movimientos (IdTipoMovimiento, IdAnimal, Fecha, Cantidad, HembrasVivas, MachosVivos, Muertos, Descripcion,idorg) VALUES (3,' . $_POST['IdAnimal'] . ',"' . $_POST['Fecha'] . '",' . $_POST['Cantidad'] . ',' . $_POST['HembrasVivas'] . ',' . $_POST['MachosVivos'] . ',' . $_POST['Muertos'] . ',"' . $_POST['Descripcion'] . '",'.$_SESSION['idorg'].')';
                consultaSQL($sql, $_SESSION['idorg']);
                $sql = 'UPDATE t_animales SET IdTipoAnimal = 10 WHERE IdAnimal = ' . $_POST['IdAnimal'];
                consultaSQL($sql, $_SESSION['idorg']);
                $_SESSION['Genealogia'] = "SI";
                $_SESSION['Madre'] = $_POST['IdAnimal'];
                $_SESSION['HembrasVivas'] = $_POST['HembrasVivas'];//160523
                $_SESSION['MachosVivos']  = $_POST['MachosVivos'];
                // 150605 Aumentar el numero de partos
                $sql = "select numPartos from t_animales where idAnimal=". $_POST['IdAnimal'];
                $result = consultaSQL($sql, $_SESSION['idorg']);
                $f = mysqli_fetch_array($result);
                $np = $f[0]+1;
                $sql = 'UPDATE t_animales SET numPartos = '.$np.' WHERE IdAnimal = ' . $_POST['IdAnimal'];
                consultaSQL($sql, $_SESSION['idorg']);
                //160523 Crea la tarea pendiente
                agregartarea($_POST['IdAnimal'],3,'Descansar','');
                break;
            }
        case "Compra": {
                $sql = 'INSERT INTO t_movimientos (IdTipoMovimiento, IdTercero, IdAnimal, Fecha, Cantidad, Precio, Descripcion,idorg) VALUES (4,' . $_POST['IdTercero'] . ',' . $_POST['IdAnimal'] . ',"' . $_POST['Fecha'] . '",' . $_POST['Cantidad'] . ',' . $_POST['Precio'] . ',"' . $_POST['Descripcion'] . '",'.$_SESSION['idorg'].')';
                consultaSQL($sql, $_SESSION['idorg']);
                $sql = "UPDATE t_animales SET Estado = 1 WHERE IdAnimal = " . $_POST['IdAnimal'];
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "Venta": {
                $sql = 'INSERT INTO t_movimientos (IdTipoMovimiento, IdTercero, IdAnimal, Fecha, Cantidad, Precio, Descripcion,idorg) VALUES (5,' . $_POST['IdTercero'] . ',' . $_POST['IdAnimal'] . ',"' . $_POST['Fecha'] . '",' . $_POST['Cantidad'] . ',' . $_POST['Precio'] . ',"' . $_POST['Descripcion'] . '",'.$_SESSION['idorg'].')';
                consultaSQL($sql, $_SESSION['idorg']);
                $sql = "UPDATE t_animales SET Estado = 2 WHERE IdAnimal = " . $_POST['IdAnimal'];
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
            
        case "Vacuna": {
                $sql = 'INSERT INTO t_movimientos (IdTipoMovimiento, IdAnimal, Fecha, Cantidad, Descripcion,idorg) VALUES (6,' . $_POST['IdAnimal'] . ',"' . $_POST['Fecha'] . '",' . $_POST['Cantidad'] . ',"' . $_POST['Descripcion'] . '",'.$_SESSION['idorg'].')';
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "Purga": {
                $sql = 'INSERT INTO t_movimientos (IdTipoMovimiento, IdAnimal, Fecha, Cantidad, Descripcion,idorg) VALUES (7,' . $_POST['IdAnimal'] . ',"' . $_POST['Fecha'] . '",' . $_POST['Cantidad'] . ',"' . $_POST['Descripcion'] . '",'.$_SESSION['idorg'].')';
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
        case "Muerte": {
                $sql = 'INSERT INTO t_movimientos (IdTipoMovimiento, IdAnimal, Fecha, Descripcion,idorg) VALUES (8,' . $_POST['IdAnimal'] . ',"' . $_POST['Fecha'] . '","' . $_POST['Descripcion'] . '",'.$_SESSION['idorg'].')';
                consultaSQL($sql, $_SESSION['idorg']);
                $sql = "UPDATE t_animales SET Estado = 3 WHERE IdAnimal = " . $_POST['IdAnimal'];
                consultaSQL($sql, $_SESSION['idorg']);
                break;
            }
     }
}
function agregartarea($idanm,$mov,$obs,$mes){
    $fechac = date('Y-m-d');
    //160523 Crea la tarea pendiente
    $sql = "select q.IdTipoMovimiento,q.Movimiento, q.Unidad,q.tiempo,q.idmovsig, t.Movimiento from t_tiposmovimiento as t left join t_tiposmovimiento as q on (t.IdTipoMovimiento=q.idmovsig) where q.IdTipoMovimiento =  ".$mov;
    $rrr = consultaSQL($sql, $_SESSION['idorg']);
    $f = mysqli_fetch_array($rrr);
    $idact = $f[4];
    $dias = $f[3];
    $Fecha = date('Y-m-d H:i:s');
    if ($mov == 10) {
       $sql = "update tareaspendientes set fechater = '".$Fecha."', estado = 2 where idanimal = ".$idanm;
       $rrr = consultaSQL($sql, $_SESSION['idorg']);
       $dias = 30*(9-((int)($mes)));
    }
    $newfecha = dameFecha($fechac,$dias);
    
    $sql = "insert into tareaspendientes (idanimal,fechaasg,fecharea,fechater,idusuario,idmovimiento,observaciones) values ('".$idanm."','".$Fecha."','".$newfecha."','".$newfecha."','".$_SESSION["IdUsuario"]."','".$mov."','".$obs."')";
    consultaSQL($sql, $_SESSION['idorg']);
}
function dameFecha($fecha,$dia)
{   list($year,$mon,$day) = explode('-',$fecha);
    return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));        
}
function fnctnrestaurarpass($mailrecibe,$nameenvia,$mailenvia,$asunto,$user,$newpass)
{
    $raiz = "http://intelec.bucaramanga.upb.edu.co/samii/";
     $fchIng=date("Y-m-d H:i:s");
    $cuerpo = '<html><head>   </head>
	<body style="font-family:Verdana,Arial,Tahoma;font-size:13px;color:#333;">
	<div style="width:100%;overflow:hidden;background-color:#4285F4;padding:5px 2%;font-size:15px;font-weight:bold;color:#FFF;">Registro en SAMII-DSS</div>
	<div style="width:100%;padding:5px 1% 0 1%;">
	<p>El día '.$fchIng.' se realizó una solicitud en SAMII-DSS</p>
	<p style="color:#8c2426;font-weight:bold;">¡Si usted no realizó esta solicitud Registro, por favor enviénos un correo informandonos sobre el caso!</p>
	<p>Para ingresar  al sistema por favor utilice los datos dados a continuación en la dirección: <a href="'.$raiz.'/IniciarSesion.php">'.$raiz.'</a></p>
	<div style="margin-left:20px;color:#888;font-size:18px;font-weight:bold;"><span style="color:#444;">Su Usuario es: </span>'.$user.'<br><span style="color:#444;">Su Contraseña es: </span>'.$newpass.'</div>
	</div>

	</body>
	</html>';
    # Creo los headers del mensaje
    $headers="MIME-Version:1.0 \n";
    $headers.="Content-type: text/html; charset=UTF-8 \n";
    $headers.="From: ".$nameenvia." <".$mailenvia."> \n";
    $headers.="Reply-To: ".$nameenvia." <".$mailenvia."> \n";
    $headers.="X-Mailer: PHP/" . phpversion() . "\r\n";
    # Envio el correo  
    $retorno = mail($mailrecibe,$asunto,$cuerpo,$headers);
    return $retorno;
}

