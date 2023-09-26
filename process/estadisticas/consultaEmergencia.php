<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'mhs';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

$query = "
            SELECT
            SUM(CASE WHEN emergencia = 0 THEN 1 ELSE 0 END) AS ingresos_normales,
            SUM(CASE WHEN emergencia = 1 THEN 1 ELSE 0 END) AS ingresos_emergencia
            FROM ingreso;
";

$result = $mysqli->query($query);

if (!$result) {
    die('Error en la consulta: ' . $mysqli->error);
}

$row = $result->fetch_assoc();

$data = array(
    "normal" => $row['ingresos_normales'],
    "emergencia" => $row['ingresos_emergencia'],
);

$mysqli->close();

header('Content-Type: application/json');
echo json_encode($data);
?>