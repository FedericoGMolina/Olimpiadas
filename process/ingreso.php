<?php
include '../config/db.php';
include '../config/class_mysql.php';


// Datos del formulario
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$dni = $_POST["dni"];
$obraSocial = $_POST["obraSocial"];
$cp = $_POST["cp"];
$fechaNac = $_POST["fechaNac"];
$tel = $_POST["tel"];
$domicilio = $_POST["domicilio"];
$tipoIngreso = $_POST["tipoIngreso"];
$genero = $_POST["genero"];
$idZona = $_POST["idZona"];
$observacion = $_POST["observacion"];
$diagnostico = $_POST["diagnostico"];
$legajo = $_POST["legajo"];

$fecha = date("Y-m-d H:i:s");

    $sql=Mysql::consulta("SELECT * FROM persona WHERE dni= '$dni'");
    if(mysqli_num_rows($sql)>=1)
    {
        // Insertar nuevo registro en events
        $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
        $idPersona = $reg["idPersona"];
        if (!MysqlQuery::Actualizar("persona", "nombre='$nombre', apellido='$apellido', idObraSocial='$obraSocial', cp='$cp', fechaNac='$fechaNac', domicilio='$domicilio', genero='$genero'", "idPersona='$idPersona'"))
            {
            echo 'ERROR';
            exit;
        }
    }
    else
    {
        $sqlUltimaId = Mysql::consulta("SELECT MAX(idPersona) AS ultimaId FROM persona");
        $ultimaId = mysqli_fetch_assoc($sqlUltimaId)["ultimaId"];
        $idPersona = $ultimaId + 1;
        if (!MysqlQuery::Guardar("persona", "idPersona, dni, nombre, apellido, idObraSocial, cp, fechaNac, domicilio, genero", "'$idPersona', '$dni', '$nombre', '$apellido', '$obraSocial', '$cp', '$fechaNac', '$domicilio', '$geneSro'"))
        {
            echo 'ERROR';
            exit;
        }
    }
    
    if (!MysqlQuery::Guardar("ingreso", "idPersona, legajo, observacion, diagnostico, idZona, estado, emergencia, fecha", "$idPersona, $legajo, '$observacion', '$diagnostico', '$idZona', 'No Atendido', '$tipoIngreso', '$fecha'"))
    {
        echo 'ERROR';
        exit;
    }
?> 
