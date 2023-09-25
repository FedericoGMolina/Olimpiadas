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
$idIngreso = $_POST["idIngreso"];

// Consulta la base de datos para verificar si existe una persona con ese DNI
$sql = "SELECT * FROM ingreso WHERE idIngreso = '$idIngreso'";
$resultado = $conn->query($sql);

if (!$resultado) {
    die("Error en la consulta: " . $conn->error);
}

// Prepara un array para almacenar los resultados
$response = array();

if ($resultado->num_rows > 0) {
    // Persona encontrada, obtén los datos
    $row = $resultado->fetch_assoc();
    $idPersona = $row['idPersona'];
    
    // Realiza una consulta adicional para obtener información de la tabla persona
    $sqlPersona = "SELECT * FROM persona WHERE idPersona = '$idPersona'";
    $resultadoPersona = $conn->query($sqlPersona);
    
    if (!$resultadoPersona) {
        die("Error en la consulta de persona: " . $conn->error);
    }

    $legajo = $row['legajo'];
    // Consulta la base de datos para verificar si ya existe un enfermero con ese legajo
    $sqlEmpleado = "SELECT e.*, p.nombre, p.apellido, p.dni 
    FROM empleado e 
    INNER JOIN persona p ON e.idPersona = p.idPersona 
    WHERE e.legajo = '" . $row["legajo"] . "'";
    $resultadoEmpleado = $conn->query($sqlEmpleado);

    if(!$resultadoEmpleado)
    {
        die("Error en la consulta: " . $conn->error);
    }
    
    // Verifica si se encontraron resultados en la tabla persona
    if ($resultadoPersona->num_rows > 0) {
        // Persona encontrada, obtén los datos
        $rowPersona = $resultadoPersona->fetch_assoc();
        $rowEmpleado = $resultadoEmpleado->fetch_assoc();

    $response["success"] = true;
    $response["nombre"] = $rowPersona["nombre"];
    $response["apellido"] = $rowPersona["apellido"];
    $response["idObraSocial"] = $rowPersona["idObraSocial"];
    $response["genero"] = $rowPersona["genero"];
    $response["observacion"] = $row["observacion"];
    $response["diagnostico"] = $row["diagnostico"];
    $response["estado"] = $row["estado"];
    $response["tipoIngreso"] = $row["emergencia"];
    $response["fecha"] = $row["fecha"];
    $response["fechaNacimiento"] = $rowPersona["fechaNac"]; // Agrega la fecha de nacimiento
    $response["empleadoIngresante"] = $rowEmpleado["nombre"];
    
    // Agrega otros campos si es necesario
}} else {
    // Persona no encontrada
    $response["success"] = false;
}

// Devuelve la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cierra la conexión a la base de datos
$conn->close();
?>