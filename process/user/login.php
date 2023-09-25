<?php
   include '../../config/class_mysql.php';
   include '../../config/db.php';
   $user = $_POST['user'];
   $pw = $_POST['pw'];
    
   $sql=Mysql::consulta("SELECT * FROM empleado WHERE usuario= '$user' AND password='$pw'");

   if(mysqli_num_rows($sql)>=1)
    {
        session_start();
        $reg=mysqli_fetch_array($sql, MYSQLI_ASSOC);
        $idPersona = $reg['idPersona'];
        $datos=Mysql::consulta("SELECT * FROM persona WHERE idPersona= $idPersona");
        $regPersona=mysqli_fetch_array($datos, MYSQLI_ASSOC);
        $_SESSION['usuario'] = $reg['usuario'];
        $_SESSION['idRol'] = $reg['idRol'];
        $_SESSION['nombre'] = $regPersona['nombre'];
        $_SESSION['legajo'] = intval($reg['legajo']);
        $status='OK';
    }
    else
    {
        $status = 'ERROR';
    }
$response = array('status' => $status);
echo json_encode($response);
?>