<?php
include '../config/class_mysql.php';
include '../config/db.php';

// Datos del formulario
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$dni = $_POST["dni"];
    $sql=Mysql::consulta("SELECT * FROM persona WHERE dni= '$dni'");
    if(mysqli_num_rows($sql)>=1)
    {
        // Insertar nuevo registro en events
        $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
        $idPersona = $reg["idPersona"];
        if (!MysqlQuery::Guardar("empleado", "usuario, password, idPersona", "'$nombre', '$apellido', '$idPersona'"))
            {
                echo 'ERROR';
                exit;
            }
    }
    else
    {
        if (!MysqlQuery::Guardar("persona", "dni", "'$dni'"))
        {
            echo 'ERROR';
            exit;
        }
        else
        {
            $sqlPersona=Mysql::consulta("SELECT * FROM persona WHERE dni= '$dni'");
            if(mysqli_num_rows($sqlPersona)>=1)
            {
                // Insertar nuevo registro en events
                $regPersona=mysqli_fetch_array($sqlPersona, MYSQLI_ASSOC);
                $idPersona = $regPersona["idPersona"];
                if (!MysqlQuery::Guardar("empleado", "usuario, password, idPersona, idRol, idZona, idCargo", "'$nombre', '$apellido', '$idPersona', 1, 1, 1"))
                {
                    echo 'ERROR';
                    exit;
                }
            }
        }

    }
?> 
