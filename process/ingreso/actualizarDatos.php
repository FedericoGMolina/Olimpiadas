<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "mhs";


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$idIngreso = $_POST['idIngreso'];
$diagnostico = $_POST['diagnostico'];
$observacion = $_POST['observacion'];


$sql = "UPDATE ingreso SET diagnostico = ?, observacion = ? WHERE idIngreso = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {

    $stmt->bind_param("sss", $diagnostico, $observacion, $idIngreso);

    // Ejecutar la sentencia SQL
    if ($stmt->execute()) {
        // La actualización fue exitosa
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        // Hubo un error en la actualización
        $response = array('success' => false, 'message' => 'Error en la actualización');
        echo json_encode($response);
    }

    // Cerrar la sentencia preparada
    $stmt->close();
} else {
    // Hubo un error en la preparación de la sentencia SQL
    $response = array('success' => false, 'message' => 'Error en la preparación de la sentencia SQL');
    echo json_encode($response);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>