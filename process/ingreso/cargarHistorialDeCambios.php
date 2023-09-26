<?php
// Conexión a la base de datos (debes configurar tus credenciales)
$conexion = new mysqli("localhost", "root", "", "mhs");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$idIngreso = $_GET['idIngreso']; // Obtén el ID del paciente desde la solicitud GET

// Consulta SQL para obtener el historial de cambios
$sql = "SELECT fecha, diagnostico, estado FROM informe WHERE idIngreso = $idIngreso ORDER BY fecha DESC";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $historial = array();
    while ($fila = $resultado->fetch_assoc()) {
        $historial[] = $fila;
    }
    echo json_encode($historial);
} else {
    echo json_encode(array()); // Devuelve un arreglo vacío si no hay datos
}

$conexion->close();
?>