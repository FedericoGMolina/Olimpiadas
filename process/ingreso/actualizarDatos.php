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
$idZona = $_POST['idZona'];

$conn->begin_transaction();

try {
    $updateSql = "UPDATE ingreso SET diagnostico = ?, observacion = ? WHERE idIngreso = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssi", $diagnostico, $observacion, $idIngreso);

    if ($updateStmt->execute()) {
        $informeSql = "INSERT INTO informe (idIngreso, diagnostico, idZona) VALUES (?, ?, ?)";
        $informeStmt = $conn->prepare($informeSql);
        $informeStmt->bind_param("iss", $idIngreso, $diagnostico, $idZona);

        if ($informeStmt->execute()) {
            $conn->commit();
            $response = array('success' => true);
            echo json_encode($response);
        } else {
            $conn->rollback();
            $response = array('success' => false, 'message' => 'Error en la inserción en la tabla "informe"');
            echo json_encode($response);
        }
    } else {
        $conn->rollback();
        $response = array('success' => false, 'message' => 'Error en la actualización en la tabla "ingreso"');
        echo json_encode($response);
    }

    $updateStmt->close();
    $informeStmt->close();
} catch (Exception $e) {
    $conn->rollback();
    $response = array('success' => false, 'message' => 'Error: ' . $e->getMessage());
    echo json_encode($response);
}

$conn->close();
?>