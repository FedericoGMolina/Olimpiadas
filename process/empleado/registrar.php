<?php
include '../../config/db.php';
include '../../config/class_mysql.php';


// Datos del formulario
$nombre = $_POST["nombreEmpleado"];
$apellido = $_POST["apellidoEmpleado"];
$dni = $_POST["dniEmpleado"];
$obraSocial = $_POST["obraSocialEmpleado"];
$cp = $_POST["cpEmpleado"];
$fechaNac = $_POST["fechaNacEmpleado"];
$tel = $_POST["telEmpleado"];
$domicilio = $_POST["domicilioEmpleado"];
$genero = $_POST["generoEmpleado"];
$legajo = $_POST["legajoEmpleado"];
$usuario = $_POST["usuarioEmpleado"];
$contraseña = $_POST["contraseñaEmpleado"];
$contraseñaHash = password_hash($contraseña, PASSWORD_BCRYPT);
$idRol = $_POST["rolEmpleado"];
$idCargo = $_POST["cargoEmpleado"];
$idZona = $_POST["zonaEmpleado"];

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
        if (!MysqlQuery::Guardar("persona", "idPersona, dni, nombre, apellido, idObraSocial, cp, fechaNac, domicilio, genero", "'$idPersona', '$dni', '$nombre', '$apellido', '$obraSocial', '$cp', '$fechaNac', '$domicilio', '$genero'"))
        {
            echo 'ERROR';
            exit;
        }
        else{
            if (!MysqlQuery::Guardar("empleado", "idPersona, legajo, usuario, password, idCargo, idRol, idZona", "'$idPersona', '$legajo', '$usuario', '$contraseñaHash', '$idCargo', '$idRol', '$idZona'"))
        {
            echo 'ERROR';
            exit;
        }

        }
    }
    
    
?> 
