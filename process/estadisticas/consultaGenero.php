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
            SUM(CASE WHEN p.genero = 'Masculino' THEN 1 ELSE 0 END) as Masculino,
            SUM(CASE WHEN p.genero = 'Femenino' THEN 1 ELSE 0 END) as Femenino,
            SUM(CASE WHEN p.genero = 'No Binario' THEN 1 ELSE 0 END) as NoBinario
            FROM ingreso i
            INNER JOIN persona p ON i.idPersona = p.idPersona;
";

$result = $mysqli->query($query);

if (!$result) {
    die('Error en la consulta: ' . $mysqli->error);
}

$row = $result->fetch_assoc();

$data = array(
    "Masculino" => $row['Masculino'],
    "Femenino" => $row['Femenino'],
    "NoBinario" => $row['NoBinario']
);

$mysqli->close();

header('Content-Type: application/json');
echo json_encode($data);
?>