<?php

include 'SQL.php';
include 'basedatos.php';

function DibujarTabla($Tabla, $idorg = NULL, $Modal = NULL, $filtro= NULL) {
    if ($Modal != '') {
        $SQL = ConsultaModal($Tabla,$filtro, $idorg);
    } else {
        $SQL = ConsultaTabla($Tabla,$filtro, $idorg);
    }
    //print $SQL;
    $DatosTabla = consultaSQL($SQL);
    $NroCampos = mysqli_num_fields($DatosTabla);
    if ($NroCampos > 8) {
        echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered" style="font-size:11px">';
    } else {
        echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered" style="font-size:12px">';
    }
    echo '<tr>';
    generarEncabezadoTabla($DatosTabla, $NroCampos, '');
    while ($f = mysqli_fetch_array($DatosTabla)) {
        echo '<tr>';
        for ($i = 0; $i < $NroCampos; $i++) {
            $metadatos = mysqli_fetch_field_direct($DatosTabla, $i);
            $fieldName = $metadatos->name;
            if(($i==0) && ($Tabla == 'tareaspendientes')){ //160524 Llevar al usuario a la actividad que le corresponda
                echo '<td>';
                $img = '<img src="../sistema/estilos/img/drop.png" title="Reportar">';
                if ($f[5] == 'Parir') {
                    echo '<form action="novedadesagregar.php" method="POST">';
                    echo '<input type="hidden" name="Parto" value ="Parto">';
                    echo 'jjjj<input type="text" name="idanimalx" value ="'.$f[6].'">';
                    $img = '<img src="../sistema/estilos/img/edit.png" title="Registrar">';
                    echo '<button type="submit" value="inhabilitar" name="modo" style="border: none; background: none;">';
                }
                else {
                    if ($f[5] == 'Palpar') {
                    echo '<form action="novedadesagregar.php" method="POST">';
                    echo '<input type="hidden" name="Palpacion" value ="Palpacion">';
                    echo '<input type="hidden" name="idanimalx" value ="'.$f[6].'">';
                    $img = '<img src="../sistema/estilos/img/edit.png" title="Registrar">';
                    echo '<button type="submit" value="inhabilitar" name="modo" style="border: none; background: none;">';
                    }
                    else {
                      echo '<form action="ActionHandler.php" method="POST">';
                     echo '<input type="hidden" name="form" value="animales.php"/>';?>  
                     <button type="submit" value="inhabilitar" name="modo" style="border: none; background: none;" onclick="return confirm('Estas seguro de deshabilitar el registro?');">
                         <?php
                    }
                }
                
                  echo $img.'</button>';
//                $form = $_POST['form']; // A donde saltar
//                $id = $_POST['id'];  // Cual
//                $tabla = $_POST['tabla']; // Que hacerle
//                $modo = $_POST['modo']; // Que hacer
                echo '<input type="hidden" name="form" value="animales.php"/>';
                echo '<input type="hidden" name="id" value="' . $f[$i] . '"/>';
                echo '<input type="hidden" name="tabla" value="' . $Tabla . '"/>';                
                echo '</form>';
                echo '</td>';
                $i++;
            }
            if (strpos($fieldName, "Id") === FALSE) {
                echo '<td align="center">'.$f[$i].'</td>';
            } else {
                
                if ($NroCampos > 8) {
                    echo '<td align="center" width="8%">';
                } else {
                    echo '<td align="center" width="15%">';
                }
                echo '<form action="ActionHandler.php" method="POST">';
                echo '<input type="hidden" name="id" value="' . $f[$i] . '"/>';
                echo '<input type="hidden" name="form" value="' . basename($_SERVER['PHP_SELF']) . '"/>';
                echo '<input type="hidden" name="tabla" value="' . $Tabla . '"/>';
                if (($Tabla != "t_municipios") && ($Tabla != "t_razas") && ($Tabla != "t_tiposanimal")) { // 170419
                    //150527 Solo para ciertos perfiles
                    if ($_SESSION['IdPerfil'] != 3) {
                        if (substr(basename($_SERVER['PHP_SELF']),0,7) != 'Reporte'){
                            echo '<button type="submit" value="editar" name="modo" style="border: none; background: none;">';
                            // 150618 No dejar editar la novedad de Estado
                            if ($f[1]!='Estado')
                                echo '<img src="../sistema/estilos/img/edit.png" title="Editar"/>';
                            else
                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            echo '</button>';
                        }
                    }
                    if ($_SESSION['IdPerfil'] != 3) {
                        if (substr(basename($_SERVER['PHP_SELF']),0,7) != 'Reporte'){
                            //150618 No dejar inactivar hasta revisar lo que pasa al hacerlo
                            echo '<button type="submit" value="inhabilitar" name="modo" style="border: none; background: none;" onclick="return confirm(\'Estas seguro de deshabilitar el registro?\');">';
                            echo '<img src="../sistema/estilos/img/drop.png" title="Inhabilitar"/>';
                            echo '</button>';
                        }
                    }
                    if (strcmp($Tabla, "t_animales") == 0) {
                        echo '<button type="submit" value="historico" name="modo" style="border: none; background: none;">';
                        echo '<img src="../sistema/estilos/img/history.ico" title="Historico" height="16" width="16"/>';
                        echo '</button>';
                    }
                } // Fin 170419
                echo '</form>';
                echo '</td>';
            }
        }
        echo '</tr>';
    }
    echo '</table></div>';
}

function DibujarTablaHistorico($ID, $idorg) {
    //170224
    $SQL = "SELECT t.Tercero, tm.Movimiento, m.Fecha, m.Cantidad, tm.Unidad, m.Precio, m.Descripcion, m.Semana, m.HembrasVivas, m.MachosVivos, m.Muertos FROM t_movimientos m, t_terceros t, t_tiposmovimiento tm, t_animales a where (a.idorg = $idorg) and t.IdTercero = m.IdTercero and tm.IdTipoMovimiento = m.IdTipoMovimiento and m.IdAnimal = a.IdAnimal and m.Estado = 1 and m.IdAnimal =" . $ID . " ORDER BY Fecha DESC;";
    $DatosTabla = consultaSQL($SQL);
    $NroCampos = mysqli_num_fields($DatosTabla);
    $NroRegistros = mysqli_num_rows($DatosTabla);
    if ($NroRegistros > 0) {
        echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered" style="font-size:12px">';
        echo '<tr>';
        generarEncabezadoTabla($DatosTabla, $NroCampos, '');
        while ($f = mysqli_fetch_array($DatosTabla)) {
            echo '<tr>';
            for ($i = 0; $i < $NroCampos; $i++) {
                $metadatos = mysqli_fetch_field_direct($DatosTabla, $i);
                $fieldName = $metadatos->name;
                if (strpos($fieldName, "Id") === FALSE) {
                    echo '<td align="center">' . $f[$i] . '</td>';
                } else {
                    echo '<td align="center" width="14%">';
                    echo '<form action="ActionHandler.php" method="POST">';
                    echo '<input type="hidden" name="id" value="' . $f[$i] . '"/>';
                    echo '<input type="hidden" name="form" value="' . basename($_SERVER['PHP_SELF']) . '"/>';
                    echo '<input type="hidden" name="tabla" value="' . $Tabla . '"/>';
                    echo '<button type="submit" value="editar" name="modo" style="border: none; background: none;">';
                    echo '<img src="../sistema/estilos/img/edit.png" title="Editar"/>';
                    echo '</button>';
                    echo '<button type="submit" value="inhabilitar" name="modo" style="border: none; background: none;" onclick="return confirm(\'Estas seguro de deshabilitar el registro?\');">';
                    echo '<img src="../sistema/estilos/img/drop.png" title="Inhabilitar"/>';
                    echo '</button>';
                    if (strcmp($Tabla, "t_animales") == 0) {
                        echo '<button type="submit" value="historico" name="modo" style="border: none; background: none;">';
                        echo '<img src="../sistema/estilos/img/history.ico" title="Historico" height="16" width="16"/>';
                        echo '</button>';
                    }
                    echo '</form>';
                    echo '</td>';
                }
            }
            echo '</tr>';
        }
        echo '</table></div>';
    } else {
        echo "<p>No Existen Registros para Mostrar</p>";
    }
}

function generarEncabezadoTabla($p, $nmrcampos, $enlace) {
    for ($i = 0; $i < $nmrcampos; $i++) {
        $metadatos = mysqli_fetch_field_direct($p, $i);
        $fieldName = $metadatos->name;
        if (strpos($fieldName, "Id") === FALSE) {
            echo '<th class="text-center">' . arreglarNombreCampo($fieldName) . '</th>';
        } else {
            echo "<th></th>";
        }
    }
    if ($enlace != '') {
        echo '<th>fff</th>';
    }
}

function generarAgregar($pagina) {
    unset($_SESSION['id']);
    if (strcmp($pagina, "animales") == 0) {
        echo '<div align=center>';
        echo '<form action="ReporteAnimales.php" method="POST">';
        echo '<input type="submit" value="Agregar" formaction="animalesAgregar.php">';
        echo '<input type="submit" name = "Vendidos" value="Vendidos">';
        echo '<input type="submit" name = "Muertos" value="Muertos">';
        echo '</form>';
        echo '</div>';
    } else if (strcmp($pagina, "novedades") == 0) {
        echo '<div align=center><form action="' . $pagina . 'Agregar.php" method="POST">';
        echo '<input type="submit" name="Peso" value="Peso">';
        echo '<input type="submit" name="Leche" value="Leche">';
        echo '<input type="submit" name="Palpacion" value="Palpacion">'; //160524  Se agrega el botón para la palpacion
        echo '<input type="submit" name="Parto" value="Parto">';
        echo '<input type="submit" name="Compra" value="Compra">';
        echo '<input type="submit" name="Venta" value="Venta">';
        echo '<input type="submit" name="Vacuna" value="Vacuna">';
        echo '<input type="submit" name="Purga" value="Purga">';
        echo '<input type="submit" name="Muerte" value="Muerte">';
        echo '</form></div>';
    } else {
        if (($pagina != "municipios") && ($pagina != "razas") && ($pagina != "tiposAnimal")) { //170419 quitada
        echo '<div align=center><form action="' . $pagina . 'Agregar.php" method="POST">';
        echo '<input type="submit" value="Agregar">';
        echo '</form></div>';
        }
    }
}

function recortarId($nombreCampo) {
    return substr($nombreCampo, 2);
}

function arreglarNombreCampo($nombreCampo) {
    if (strpos($nombreCampo, "Id") !== FALSE) {
        $nombre = recortarId($nombreCampo);
    } else {
        $nombre = $nombreCampo;
    }
    return preg_replace('/[A-Z]/', ' $0', $nombre);
}

function nombreAnimal($ID, $idorg) {
    $SQL = "select IdAnimal, CONCAT(Numero,' ',Nombre) from t_animales WHERE idorg = $idorg and IdAnimal = " . $ID;
    $animal = consultaSQL($SQL);
    $nombreAnimal = mysqli_fetch_array($animal);
    echo $nombreAnimal[1];
}

function generarTablaEditar($tabla, $id, $idorg) {
    echo '<form method="POST" action="ControlUpdate.php">';
    echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">';
    //150615
    echo '<div align="center">'.$id.'</div>';
    $p = consultaSQL(ConsultaValorEditar($tabla, $id, '', $idorg));
    $nmrcampos = mysqli_num_fields($p);
    $f = mysqli_fetch_array($p);
    for ($index = 0; $index < $nmrcampos; $index++) {
        $metadatos = mysqli_fetch_field_direct($p, $index);
        generarFilaTablaEditar($metadatos, $f[$index]);
    }
    echo '</table></div>';
    echo '<input type="hidden" name="modo" value="editar">';
    if (isset($id)) {
        echo '<input type="hidden" name="id" value="' .$id.'">';
    }
    echo '<input type="hidden" name="form" value="' . str_ireplace("Agregar", "", basename($_SERVER['PHP_SELF'])) . '">';
    echo '<input type="hidden" name="tabla" value="' . $tabla . '">';
    echo '<div align=center><input type="submit" value="Actualizar"></div>';
    echo '</form>';
}

function generarTablaAgregar($tabla, $novedad = NULL, $idorg) {
    $idanimal = @$_SESSION['UltimoId'];
    $sentencia = ConsultaTablaAgregar($tabla, $idorg, $novedad);
    if ($idorg != '') 
       echo '<form method="POST" action="ControlInsert.php">'; // Crea el formulario pero si viene de afuera lo creó allá
    echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">';
    $p = consultaSQL($sentencia);
    $nmrcampos = mysqli_num_fields($p);
    // 150616 No Para que deje agregar bd al perfil 1
    //if (($tabla == 't_usuarios')) // && (@$_SESSION['IdPerfil'] == 2)) 
    //    $nmrcampos--;
    for ($index = 0; $index < $nmrcampos; $index++) {
        $metadatos = mysqli_fetch_field_direct($p, $index);
        generarFilaTablaAgregar($metadatos, $novedad, $idanimal,$idorg);
    }
    echo '</table></div>';
    echo '<input type="hidden" name="modo" value="agregar">';
    if (isset($novedad)) {
        echo '<input type="hidden" name="novedad" value="'.$novedad.'">';
    }
    echo '<input type="hidden" name="form" value="'.str_ireplace("Agregar","",basename($_SERVER['PHP_SELF'])).'">';
    echo '<input type="hidden" name="tabla" value="'.$tabla.'">';
    echo '<input type="hidden" name="idorg" value="'.$idorg.'">';
    echo '<div align=center><input type="submit" value="Enviar"></div>';
    echo '</form>';
}

function generarFilaTablaAgregar($campo, $novedad = null, $hijo = NULL,$idorg) {
    $columna = $campo->name;
    $tipo = $campo->type;
    echo '<tr>';
    echo '<td class="text-center">';
    echo arreglarNombreCampo($columna);
    $columna = $campo->orgname;
    echo '</td>';
    echo '<td>';
    switch ($tipo) {
        case MYSQLI_TYPE_DATE:
        case MYSQLI_TYPE_DATETIME: { //10
                date_default_timezone_set("America/Bogota");
                echo '<input type="date" name="' . $columna . '" value=' . date('Y-m-d') . ' width="100" required>';
                break;
            }
        case MYSQLI_TYPE_BIT: { //16
                echo '<input type="checkbox" name="' . $columna . '" width="100"  required>';
                break;
            }
        case MYSQLI_TYPE_DECIMAL:
        case MYSQLI_TYPE_NEWDECIMAL: { //0 246
                echo '<input type="number" name="' . $columna . '" step="0.01" min="0.00" width="100"  required>';
                break;
            }
        case MYSQLI_TYPE_VAR_STRING: { //253
                if (strcmp($columna, "Pass") == 0) {
                    echo '<input type="password" name="' . $columna . '" maxlenght="' . $campo->length . '" size="18"  required></input>';
                } else {
                    if (strcmp($columna, "email") == 0) {
                        echo '<input type="email" name="' . $columna . '" maxlenght="' . $campo->length . '" size="18"  required></input>';
                    } else {
                        echo '<input type="text" name="' . $columna . '" maxlenght="' . $campo->length . '" size="18"  required></input>';
                    }
                }
                break;
            }
        case MYSQLI_TYPE_LONG: { //3
                if (strpos($columna, "Id") !== FALSE) {
                    //if (strcmp($columna, "IdLicencia") == 0 || strcmp($columna, "IdPerfil") == 0 || strcmp($columna, "IdUsuario") == 0) {
                    //    $regtabla = mysqli_fetch_array(consultaSQL("select table_name from information_schema.columns where table_schema = 'appgrocntrl' and ORDINAL_POSITION = 1 and column_name='" . $columna . "';"));
                    //} else 
                    {
                        $sqll = "select table_name from information_schema.columns where table_schema = 'appgrognral' and ORDINAL_POSITION = 1 and column_name='" . $columna . "';";
                        $regtabla = mysqli_fetch_array(consultaSQL($sqll));
                    }
                    $tabla = $regtabla[0];
                    if (strcmp($columna, "IdAnimalPadre") == 0) {
                        $tabla = "t_animalespadre";
                    }
                    if (strcmp($columna, "IdAnimalMadre") == 0) {
                        $tabla = "t_animalesmadre";
                        if (isset($_SESSION['Madre'])) {
                            getComboValor($tabla, $_SESSION['idorg'], $columna, $_SESSION['Madre']);
                        } else {
                            getCombo($tabla, $columna, $novedad,'','',$_SESSION['idorg']);
                        }
                    } else if (strcmp($tabla, "t_animales") == 0 && isset($_SESSION['Genealogia']) && isset($_SESSION['Madre'])) {
                        getComboValor($tabla,$_SESSION['idorg'], $columna, $hijo);
                        //unset($_SESSION['Madre']); //160523
                    } else {
                         //160523 Dejar por defecto el combo de tipo de animal en TRO o TRA
                        if (($columna == 'IdTipoAnimal')&&((@$_SESSION['MachosVivos'] == '1') or (@$_SESSION['HembrasVivas'] == '1'))){
                          if (@$_SESSION['HembrasVivas'] == '1') getCombo($tabla, $columna, $novedad,'TRA','3',$_SESSION['idorg']);
                          if (@$_SESSION['MachosVivos'] == '1')  getCombo($tabla, $columna, $novedad,'TRO','11',$_SESSION['idorg']);
                        }
                        else
                           getCombo($tabla, $columna, $novedad,'','',$_SESSION['idorg']); 
                  }
                    generarModal($columna, $tabla);
                } else {
                    echo '<input type="number" name="' . $columna . '" maxlenght="' . $campo->length . '" min="0" step="1" width="12" size="15"';
                    if ($novedad != 'Palpacion' && $columna == 'Numero'){
                        //170322 Arreglar para que lleve automáticamente el registro 
                        //if (@$_SESSION['MachosVivos'] == '1') 
                           $SQL = "select max(Numero) from t_animales WHERE (numero mod 2) = 1 and idorg = $idorg";
                        if (@$_SESSION['HembrasVivas'] == '1') 
                           $SQL = "select max(Numero) from t_animales where (numero mod 2) = 0 and idorg = $idorg";
                        $rrr = consultaSQL($SQL);
                        $f = mysqli_fetch_array($rrr);
                        $x = $f[0]+2;
                        echo ' value="'.$x.'"';
                    }
                    echo '>';
                }
                break;
            }
        default : {
                echo '<input type="text" name="' . $columna . '" maxlenght="' . $campo->length . '" width="100"/';
                if ($campo == '') 
                    echo ' value="'.$x.'"';
                echo ' required>';
                break;
            }
    }
    echo '</td>';
    echo '</tr>';
}

function generarFilaTablaEditar($campo, $valor) {
    $columna = $campo->name;
    $tipo = $campo->type;
    echo '<tr>';
    echo '<td class="text-center">';
    echo arreglarNombreCampo($columna);
    $columna = $campo->orgname;
    echo '</td>';
    echo '<td>';
    switch ($tipo) {
        case MYSQLI_TYPE_DATE: { //10
                echo '<input type="date" name="' . $columna . '" width="100" value="' . $valor . '"/>';
                break;
            }
        case MYSQLI_TYPE_BIT: { //16
                echo '<input type="checkbox" name="' . $columna . '" width="100" value="' . $valor . '"/>';
                break;
            }
        case MYSQLI_TYPE_DECIMAL:
        case MYSQLI_TYPE_NEWDECIMAL: { //0 246
                echo '<input type="number" name="' . $columna . '" step="0.01" min="0.00" width="100" value="' . $valor . '"/>';
                break;
            }
        case MYSQLI_TYPE_VAR_STRING: { //253
                if (strcmp($columna, "Pass") == 0) {
                    echo '<input type="password" name="' . $columna . '" maxlenght="' . $campo->length . '" width="100"></input>';
                } else {
                    echo '<textarea name="' . $columna . '" maxlenght="' . $campo->length . '" width="100">' . $valor . '</textarea>';
                }
                break;
            }
        case MYSQLI_TYPE_LONG: { //3
                if (strpos($columna, "Id") !== FALSE) {
                    if (strcmp($columna, "IdLicencia") == 0 || strcmp($columna, "IdPerfil") == 0 || strcmp($columna, "IdUsuario") == 0) {
                        $regtabla = mysqli_fetch_array(consultaSQL("select table_name from information_schema.columns where table_schema = 'appgrognral' and ORDINAL_POSITION = 1 and column_name='" . $columna . "';"));
                    } else {
                        $regtabla = mysqli_fetch_array(consultaSQL("select table_name from information_schema.columns where table_schema = 'appgrognral' and ORDINAL_POSITION = 1 and column_name='" . $columna . "';"));
                    }
                    $tabla = $regtabla[0];
                    getComboValor($tabla,$_SESSION['idorg'], $columna, $valor);
                    generarModal($columna, $tabla);
                } else {
                    echo '<input type="number" name="' . $columna . '" maxlenght="' . $campo->length . '" min="0" step="1" width="100" value="' . $valor . '"/>';
                }
                break;
            }
        default : {
                echo $tipo;
                echo '<input type="text" name="' . $columna . '" maxlenght="' . $campo->length . '" width="100" value="' . $valor . '"/>';
                break;
            }
    }
    echo '</td>';
    echo '</tr>';
}

function getCombo($tabla, $nombre, $novedad = NULL, $default = Null, $defid = Null, $idorg) {
    $sql = ConsultaCombo($tabla, $idorg, $novedad);
    //print $tabla.'Dios';
    if ($novedad == 'Palpacion'){ 
        $sql = "select IdAnimal, CONCAT(Numero,' ',Nombre) from t_animales WHERE Estado = 1  and idtipoanimal = 5 and idorg = $idorg order by numero"; 
    }
    $r = consultaSQL($sql, $_SESSION['idorg']);
    if (strcmp($tabla, "t_usuarios") == 0) //170427 Pilas || strcmp($tabla, "t_licencias") == 0 || strcmp($tabla, "t_perfiles") == 0) 
    {
        $r = consultaSQL($sql, $_SESSION['idorg']);
    }
    //print $sql.'Dios';
    echo '<select name="' . $nombre . '" id="combobox">';
    if ($default != '') echo '<option value="'.$defid.'">'.$default.'</option>';
    while ($fila = mysqli_fetch_array($r)) {
        echo '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
    }
    echo '</select>';
}

function getComboValor($tabla, $idorg, $nombre, $valor) {
    $sql = ConsultaCombo($tabla,$idorg);
    $r = consultaSQL($sql,$_SESSION['idorg']);
    if (strcmp($tabla, "t_usuarios") == 0 || strcmp($tabla, "t_licencias") == 0 || strcmp($tabla, "t_perfiles") == 0) {
        $r = consultaSQL($sql,$_SESSION['idorg']);
    }
    echo '<select name="' . $nombre . '" id="combobox">';
    while ($fila = mysqli_fetch_array($r)) {
        if ($fila[0] == $valor) {
            echo '<option value="' . $fila[0] . '" selected>' . $fila[1] . '</option>';
        } else {
            echo '<option value="' . $fila[0] . '">' . $fila[1] . '</option>';
        }
    }
    echo '</select>';
}

function generarModal($columna, $tabla) {
    if (strpos($columna, "Id") !== FALSE) {
        //160104 echo '<button type = "button" class = "btn btn-primary" data-toggle = "modal" data-target = "#' . $columna . '">Consultar</button>';
        echo '<div class = "modal fade" id="' . $columna . '" tabindex = "-1" role = "dialog" aria-labelledby = "myLargeModalLabel" aria-hidden = "true">';
        echo '<div class = "modal-dialog modal-lg">';
        echo '<div class = "modal-content" >';
        DibujarTabla($tabla, $_SESSION['idorg'], '');
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

function getTablaEdicion($sentencia, $enlace) {
    echo '<div class="table-responsive"><table class="table table-striped table-hover table-bordered">';
    $p = consultaSQL($sentencia, $_SESSION['idorg']);
    echo '<tr>';
    $nmrcampos = mysqli_num_fields($p);
    generarEncabezadoTabla($p, $nmrcampos, $enlace);
    while ($f = mysqli_fetch_array($p)) {
        echo '<tr>';
        for ($i = 0; $i < $nmrcampos; $i++) {
            $metadatos = mysqli_fetch_field_direct($p, $i);
            $fieldName = $metadatos->name;
            if (strpos($fieldName, "Id") === FALSE) {
                echo '<td align="center">' . $f[$i] . '</td>';
            }
        }
        if ($enlace != '') {
            echo '<td align="center">';
            echo '<form action="' . $enlace . '.php" method="POST">';
            echo '<input type="hidden" name="id" value="' . $f[0] . '"/>';
            echo '<button type="submit" value="editar" name="modo" style="border: none; background: none;">';
            echo '<img src="../sistema/img/edit.png" title="Editar Datos de Animal"/>';
            echo '</button>';
            echo '<button type="submit" value="inhabilitar" name="modo" style="border: none; background: none;">';
            echo '<img src="../sistema/img/drop.png" title="Inhabilitar"/>';
            echo '</button>';
            echo '<button type="submit" value="leche" name="modo" style="border: none; background: none;">';
            echo '<img src="../sistema/img/leche.png" width=16 height=16 title="ProducciÃ³n de Leche"/>';
            echo '</button>';
            echo '<button type="submit" value="carne" name="modo" style="border: none; background: none;">';
            echo '<img src="../sistema/img/peso.png" width=16 height=16 title="ProducciÃ³n de Carne"/>';
            echo '</button>';
            echo '</form>';
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table></div>';
}
