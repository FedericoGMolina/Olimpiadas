<?php
include '../../config/class_mysql.php';
include '../../config/db.php';

$user = $_POST['user'];
$pw = $_POST['pw'];

$sql = Mysql::consulta("SELECT * FROM empleado WHERE usuario= '$user'");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

if ($reg) {
    if (password_verify($pw, $reg['password'])) {
        session_start();
        $idPersona = $reg['idPersona'];
        $datos = Mysql::consulta("SELECT * FROM persona WHERE idPersona= $idPersona");
        $regPersona = mysqli_fetch_array($datos, MYSQLI_ASSOC);
        $_SESSION['usuario'] = $reg['usuario'];
        $_SESSION['idRol'] = $reg['idRol'];
        $_SESSION['nombre'] = $regPersona['nombre'];
        $_SESSION['legajo'] = intval($reg['legajo']);
        $status = 'OK';
    } else {
        $status = 'ERROR';
    }
} else {
    $status = 'ERROR';
}

$response = array('status' => $status);
echo json_encode($response);
?>