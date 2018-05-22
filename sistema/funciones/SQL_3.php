<?php
function ConsultaCombo($tabla, $idorg, $novedad = NULL) {
    switch ($tabla) {
        case "t_animalespadre": {
                $sqlf = "SELECT IdAnimal, CONCAT(Numero,' ',Nombre) FROM t_animales WHERE IdTipoAnimal >= 11 and idorg = $idorg ";
                if (isset($filtro)){
                    $sqlf .= $filtro;
                }
                return $sqlf;
            }
        case "t_animalesmadre": {
                return "SELECT IdAnimal, CONCAT(Numero,' ',Nombre) FROM t_animales WHERE IdTipoAnimal < 11 and idorg = $idorg ";
            }
        case "t_fincas": {
                return "SELECT Idfinca, concat(Finca,' ',Municipio), Descripcion FROM t_fincas u, t_municipios m WHERE  u.idorg = $idorg and u.IdMunicipio = m.IdMunicipio AND u.Estado = 1;";
            }
        case "t_animales": {
                return ConsultaComboNovedad($novedad,$idorg);
            }
        case "t_terceros": {
                return "select IdTercero, Tercero from t_terceros where idorg = $idorg ";
            }
        case "t_tiposmovimiento": {
                return "select IdTipoMovimiento, Movimiento from t_tiposmovimiento;";
            }
        case "t_lotes": {
                return "SELECT IdLote, CONCAT(Lote,' ', Finca,',', Municipio) FROM t_lotes l, t_fincas u, t_municipios m WHERE  u.idorg = $idorg and l.Idfinca = u.Idfinca and u.IdMunicipio = m.IdMunicipio;";
            }
        case "t_municipios": {
                return "SELECT IdMunicipio, Municipio FROM t_municipios";
            }
        case "t_tipostercero": {
                return "SELECT IdTiposTercero, TipoTercero FROM t_tipostercero WHERE Estado = 1";
            }
        case "t_tiposanimal": {
                return "SELECT IdTipoAnimal, TipoAnimal FROM t_tiposanimal WHERE Estado = 1";
            }
        case "t_razas": {
                return "SELECT IdRaza, Raza FROM t_razas WHERE Estado = 1";
            }
        case "t_parametros": {
                return "SELECT IdParametro, MinimoProduccion FROM t_parametros";
            }
        case "t_licencias": {
                return "SELECT IdLicencia, FechaFinal FROM t_licencias;";
            }
        case "t_perfiles": {
                return "SELECT IdPerfil, Perfil FROM t_perfiles WHERE estado > 0 and IdPerfil >= " . $_SESSION['IdPerfil'];
            }
        case "t_generos": {
                return "SELECT IdGenero, Genero FROM t_generos;";
            }
        default : {
                return "select IdAnimal, CONCAT(Numero,' ',Nombre) from t_animales where idorg = $idorg";
            }
    }
}

function ConsultaComboNovedad($novedad,$idorg) {
    // 160104 ordenar por numero
    switch ($novedad) {
        case "Leche": {
                return "select IdAnimal, CONCAT(Numero,' ',Nombre) from t_animales where idorg = $idorg and IdTipoAnimal in (6,7,10) AND Estado = 1 order by numero";
            }
        case "Parto": {
                return "select IdAnimal, CONCAT(Numero,' ',Nombre) from t_animales where IdTipoAnimal in (5) AND idorg = $idorg and Estado = 1 order by numero";
            }
        case "Compra": {
                return "select IdAnimal, CONCAT(Numero,' ',Nombre) from t_animales WHERE idorg = $idorg and Estado = 0 order by numero";
            }
        default: {
                return "select IdAnimal, CONCAT(Numero,' ',Nombre) from t_animales WHERE idorg = $idorg and Estado = 1 order by numero";
            }
    }
}

function ConsultaModal($tabla,$filtro) {
    switch ($tabla) {
        case "t_fincas": {
                return "SELECT u.Idfinca as 'Valor', m.Municipio, u.finca, u.Descripcion FROM t_fincas u, t_municipios m WHERE u.Estado = 1 AND u.IdMunicipio = m.IdMunicipio";
            }
        case "t_generos": {
                return "SELECT IdGenero as 'Valor', Genero FROM t_generos;";
            }
        case "t_animales": {
                return"Select IdAnimal as 'Valor', TipoAnimal, Raza, Numero, Nombre, FechaNacimiento, FechaRegistro, NumPartos from v_animales;";
            }
        case "t_terceros": {
                return "select IdTercero as 'Valor', Tercero, Documento, Telefono from t_terceros t where Estado = 1";
            }
        case "t_movimientos": {
        // m.idorg =
                $sqlf =  "SELECT m.IdMovimiento, t.Tercero, tm.Movimiento, a.Nombre, m.Fecha, m.Cantidad, tm.Unidad, m.Precio, m.Descripcion, m.Semana, m.HembrasVivas, m.MachosVivos, m.Muertos FROM t_movimientos m, t_terceros t, t_tiposmovimiento tm, t_animales a where a.idorg = $idorg and  t.IdTercero = m.IdTercero and  tm.IdTipoMovimiento = m.IdTipoMovimiento and m.IdAnimal = a.IdAnimal and m.Estado = 1";
                if (isset($filtro)){
                    $sqlf .= $filtro;
                }
                return $sqlf;
            }
        case "t_tiposmovimiento": {
                return "select IdTipoMovimiento as 'Valor', Movimiento, Unidad from t_tiposmovimiento";
            }
        case "t_municipios": {
                return "select IdMunicipio as 'Valor', Municipio from t_municipios";
            }
        case "t_tiposanimal": {
                return "SELECT IdTipoAnimal as 'Valor', TipoAnimal, Descripcion FROM t_tiposanimal WHERE Estado = 1";
            }
        case "t_lotes": {
                return "SELECT IdLote as 'Valor', Lote, Municipio, Ubicacion FROM t_lotes l, t_fincas u, t_municipios m WHERE l.idfinca = u.Idfinca and u.IdMunicipio = m.IdMunicipio;";
            }
        case "t_razas": {
                return "SELECT IdRaza as 'Valor', Raza FROM t_razas WHERE Estado = 1";
            }
        case "t_tipostercero": {
                return "SELECT IdTiposTercero as 'Valor', TipoTercero FROM t_tipostercero WHERE Estado = 1;";
            }
        case "t_parametros": {
                return "SELECT IdParametro as 'Valor', MinimoProduccion FROM t_parametros";
            }
        case "t_licencias": {
                return "SELECT IdLicencia as 'Valor', FechaInicio, FechaFinal, NumeroUbicaciones, NumeroAnimales, FechaActivacion FROM t_licencias;";
            }
        case "t_perfiles": {
                return "SELECT IdPerfil as 'Valor', Perfil, Obervacion FROM t_perfiles WHERE  estado > 0 and IdPerfil >= " . $_SESSION['IdPerfil'];
            }
    }
}

function ConsultaTablaAgregar($tabla, $idorg, $novedad = NULL) {
    switch ($tabla) {
        case "t_tipostercero": {
                return "SELECT TipoTercero FROM t_tipostercero";
            }
        case "t_lotes": {
                return "SELECT Idfinca, Lote FROM t_lotes  where idorg = $idorg ";
            }
        case "t_animales": {
                return "SELECT IdLote, IdTipoAnimal, IdRaza, Numero, Nombre, FechaNacimiento FROM t_animales where idorg = $idorg ";
            }
        case "t_municipios": {
                return "SELECT Municipio FROM t_municipios;";
            }
        case "t_movimientos": {
                return ConsultaNovedadAgregar($novedad);
            }
        case "t_razas": {
                return "SELECT Raza FROM t_razas";
            }
        case "t_terceros": {
                return "SELECT IdTiposTercero, Tercero, Documento, Telefono FROM t_terceros";
            }
        case "t_tiposanimal": {
                return "SELECT TipoAnimal, Descripcion FROM t_tiposanimal";
            }
        case "t_fincas": {
                return "SELECT IdMunicipio, Finca, Descripcion FROM t_fincas where idorg = $idorg ";
            }
        case "t_usuarios": {
            // 150615 Agregar campo base de datos en el informe
            $sql = "SELECT OrgNmb as 'Organización', Usuario, Nombre1 as 'PrimerNombre', Apellido1 as 'PrimerApellido', Documento, Email FROM t_usuarios u, t_organizaciones o where u.idorg = o.idorg ";
            if ($idorg != "")     
                $sql = "SELECT IdPerfil, Usuario, Pass as 'Contraseña', Nombre1 as 'PrimerNombre', Nombre2 as 'SegundoNombre', Apellido1 as 'PrimerApellido', Apellido2 as 'SegundoApellido', Documento, Email FROM t_usuarios where idorg = $idorg ";
            return $sql;
            }
        case "t_animalesgen": {
                $sqlf = "SELECT IdAnimal, IdAnimalPadre, IdAnimalMadre FROM t_animalesgen";// where idorg = $idorg 
                return $sqlf;
            }
    }
}

function ConsultaNovedadAgregar($novedad) {
    switch ($novedad) {
        case "Peso": {
                return "SELECT IdAnimal, Fecha, Cantidad, Descripcion FROM t_movimientos;";
            }
        case "Leche": {
                return "SELECT IdAnimal, Fecha, Cantidad, Descripcion FROM t_movimientos;";
            }
        case "Parto": {
                return "SELECT IdAnimal, Fecha, Cantidad, HembrasVivas, MachosVivos, Muertos, Descripcion FROM t_movimientos;";
            }
        case "Compra": {
                return "SELECT IdTercero, IdAnimal, Fecha, Cantidad, Precio, Descripcion FROM t_movimientos;";
            }
        case "Venta": {
                return "SELECT IdTercero, IdAnimal, Fecha, Cantidad, Precio, Descripcion FROM t_movimientos;";
            }
        case "Vacuna": {
                return "SELECT IdAnimal, Fecha, Cantidad, Descripcion FROM t_movimientos;";
            }
        case "Purga": {
                return "SELECT IdAnimal, Fecha, Cantidad, Descripcion FROM t_movimientos;";
            }
        case "Muerte": {
                return "SELECT IdAnimal, Fecha, Descripcion FROM t_movimientos;";
            }
        case "Palpacion": {
                return "SELECT IdAnimal, numero FROM t_animales where idorg = $idorg and idtipoanimal = 5";
            }
    }
}

function ConsultaValorEditar($tabla, $id, $novedad = NULL, $idorg) {
    switch ($tabla) {
        case "t_tipostercero": {
                return "SELECT TipoTercero FROM t_tipostercero WHERE IdTiposTercero = " . $id;
            }
        case "t_animalesgen": {
                $sqlf = "SELECT IdAnimal, IdAnimalPadre, IdAnimalMadre FROM t_animalesgen WHERE IdAnimalGen = " . $id;
                return $sqlf;
            }
        case "t_lotes": {
                return "SELECT Idfinca, Lote FROM t_lotes WHERE IdLote = " . $id;
            }
        case "t_animales": {
                $sqlf = "SELECT IdLote, IdTipoAnimal, IdRaza, Numero, Nombre, FechaNacimiento FROM t_animales WHERE idorg = $idorg and IdAnimal = " . $id;
                return $sqlf;
            }
        case "t_municipios": {
                return"SELECT Municipio FROM t_municipios WHERE IdMunicipio = " . $id;
            }
        case "t_razas": {
                return "SELECT Raza FROM t_razas WHERE IdRaza = " . $id;
            }
        case "t_terceros": {
                return "SELECT IdTiposTercero, Tercero, Documento, Telefono FROM t_terceros WHERE IdTercero = " . $id;
            }
        case "t_tiposanimal": {
                return "SELECT TipoAnimal, Descripcion FROM t_tiposanimal WHERE IdTipoAnimal = " . $id;
            }
        case "t_fincas": {
                return "SELECT IdMunicipio, Finca, Descripcion FROM t_fincas WHERE Idfinca = " . $id;
            }
        case "t_usuarios": {
                return "SELECT IdPerfil, Usuario, Pass as 'Contraseña', Nombre1 as 'PrimerNombre', Nombre2 as 'SegundoNombre', Apellido1 as 'PrimerApellido', Apellido2 as 'SegundoApellido', Documento FROM appgrocntrl.t_usuarios WHERE IdUsuario = " . $id;
            }
        case "t_movimientos": {
                $sql = "SELECT IdTipoMovimiento FROM t_movimientos WHERE IdMovimiento = $id";
                $result = consultaSQL($sql, $_SESSION['idorg']);
                $f = mysqli_fetch_array($result);
                return ConsultaNovedadEditar($f[0], $id);
            }
    }
}

function ConsultaNovedadEditar($novedad, $id) {
    switch ($novedad) {
        case 1: {
                return "SELECT Fecha, Cantidad, Descripcion FROM t_movimientos WHERE IdMovimiento = " . $id;
            }
        case 2: {
                return "SELECT Fecha, Cantidad, Descripcion FROM t_movimientos WHERE IdMovimiento = " . $id;
            }
        case 3: {
                return "SELECT Fecha, Cantidad, HembrasVivas, MachosVivos, Muertos, Descripcion FROM t_movimientos WHERE IdMovimiento = " . $id;
            }
        case 4: {
                return "SELECT IdTercero, Fecha, Cantidad, Precio, Descripcion FROM t_movimientos WHERE IdMovimiento = " . $id;
            }
        case 5: {
                return "SELECT IdTercero, Fecha, Cantidad, Precio, Descripcion FROM t_movimientos WHERE IdMovimiento = " . $id;
            }
        case 6: {
                return "SELECT Fecha, Cantidad, Descripcion FROM t_movimientos WHERE IdMovimiento = " . $id;
            }
        case 7: {
                return "SELECT Fecha, Cantidad, Descripcion FROM t_movimientos WHERE IdMovimiento = " . $id;
            }
    }
}

function ConsultaTabla($tabla,$filtro,$idorg) {
    switch ($tabla) {
        case "t_animalesgen": {
                // 150605 Mostrar la fecha
                $sqlf =  "SELECT IdAnimalGen, concat(a.Numero,' ', a.Nombre) as Animal, concat(a2.Numero,' ', a2.Nombre) as Padre, concat(a3.Numero,' ', a3.Nombre) as Madre, Fecha FROM t_animalesgen ag, t_animales a, t_animales a2, t_animales a3 WHERE  a.idorg = $idorg and ag.IdAnimal = a.IdAnimal AND ag.IdAnimalPadre = a2.IdAnimal AND ag.IdAnimalMadre = a3.IdAnimal AND ag.Estado = 1";
                return $sqlf;
            }
        case "t_lotes": {
                return "SELECT l.IdLote, t.Finca, m.Municipio, l.Lote FROM t_fincas t, t_municipios m, t_lotes l WHERE l.Estado = 1 AND m.IdMunicipio = t.IdMunicipio AND l.Idfinca = t.Idfinca and t.idorg = $idorg";
            }
        case "t_animales": {
                return "select * from v_animales where idorg = $idorg";
            }
        case "t_animalesvend": {
                return "select * from v_animalesvend ";
            }
        case "t_animalesmuert": {
                return "select * from v_animalesmuert ";
            }
        case "t_movimientos": {
                //160108 filtro
                $sqlf = "SELECT m.IdMovimiento, tm.Movimiento,a.Numero, m.Fecha, m.Cantidad, tm.Unidad, m.Precio, m.Descripcion, m.Semana, t.Tercero, m.HembrasVivas, m.MachosVivos, m.Muertos FROM v_ultimosmov m, t_terceros t, t_tiposmovimiento tm, t_animales a where a.idorg = $idorg and t.IdTercero = m.IdTercero and tm.IdTipoMovimiento = m.IdTipoMovimiento and m.IdAnimal = a.IdAnimal and m.Estado = 1 ORDER BY Fecha DESC;";
                if (isset($filtro)){
                    $sqlf .= $filtro;
                }
                return $sqlf;
            }
        case "t_municipios": {
                return "SELECT IdMunicipio, Municipio FROM t_municipios WHERE Estado = 1";
            }
        case "t_razas": {
                return "SELECT IdRaza, Raza FROM t_razas WHERE Estado = 1";
            }
        case "t_terceros": {
                return "SELECT IdTercero, Tercero, Documento, Telefono FROM t_terceros WHERE Estado = 1 and idorg = $idorg";
            }
        case "t_tiposanimal": {
                return "SELECT IdTipoAnimal, TipoAnimal, Descripcion FROM t_tiposanimal WHERE Estado = 1";
            }
        case "t_fincas": {
                return "SELECT t.Idfinca, t.finca, m.Municipio, t.Descripcion FROM t_fincas t, t_municipios m WHERE t.idorg = $idorg and t.Estado = 1 AND m.IdMunicipio = t.IdMunicipio";
            }
        case "t_animales": {
                return "SELECT * FROM v_animales";
            }
        case "t_usuarios": {
            //if ($_SESSION['IdPerfil'] == 1) 
            $SQL = "SELECT IdUsuario, Usuario, Nombre1 as 'PrimerNombre', Nombre2 as'SegundoNombre', Apellido1 as'PrimerApellido', Apellido2 as 'SegundoApellido' FROM t_usuarios where idorg = $idorg";
            return $SQL;
            }
        case "t_tipostercero": {
                return "SELECT IdTiposTercero, TipoTercero FROM t_tipostercero WHERE Estado = 1;";
            }
        case "tareaspendientes": { //160524
                return "SELECT t.idtarea as '',t.idtarea, m.movimiento, a.numero, t.fecharea as fecha, t.observaciones, t.idanimal FROM tareaspendientes t, t_animales a, t_tiposmovimiento m where a.idorg = $idorg and t.estado = 1 and m.idtipomovimiento = t.idmovimiento and a.idanimal = t.idanimal";
                //idanimal,fechaasg,fechater,fechaasg,idusuario,estado
            }            
    }
}
