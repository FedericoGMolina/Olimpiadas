<?php
// Configura la conexión a tu base de datos (reemplaza con tus propios detalles de conexión)
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "mhs";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtiene el DNI proporcionado desde la solicitud POST
$dni = $_POST["dni"];

// Consulta la base de datos para verificar si existe una persona con ese DNI
$sql = "SELECT * FROM persona WHERE dni = '$dni'";
$resultado = $conn->query($sql);

if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
}

// Prepara un array para almacenar los resultados
$response = array();

if ($resultado->num_rows > 0) {
    // Persona encontrada, obtén los datos
    $row = $resultado->fetch_assoc();
    $response["success"] = true;
    $response["nombre"] = $row["nombre"];
    $response["apellido"] = $row["apellido"];
    $response["fechaNac"] = $row["fechaNac"];
    $response["idObraSocial"] = $row["idObraSocial"];
    $response["cp"] = $row["cp"];
    $response["domicilio"] = $row["domicilio"];
    $response["genero"] = $row["genero"];
    // Agrega otros campos si es necesario
} else {
    // Persona no encontrada
    $response["success"] = false;
}

// Devuelve la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cierra la conexión a la base de datos
$conn->close();
?>