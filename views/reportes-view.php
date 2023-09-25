<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "mhs";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para seleccionar el valor del campo "idIngreso" de la tabla "ingreso"
$consulta = "SELECT * FROM ingreso";

$resultado = $conn->query($consulta);

$IngresoArray = array();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $IngresoArray[] = $fila["estado"];
    }
} else {
    echo "No se encontraron registros en la tabla 'ingreso'.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<div id="miplot" style="width:100%;"></div>

<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="bi bi-pencil-square"></i></a>
<div id="idPersonaValue"></div>
<div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Encabezado del modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Tabla Editable</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Cuerpo del modal -->
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td contenteditable="true" id="idPaciente">a</td>
                                    <td contenteditable="true" id="nombrePaciente">b</td>
                                    <td contenteditable="true" id="apellidoPaciente">c</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pie del modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary"  id="saveChanges" name="saveChanges">Guardar Cambios</button>
                    </div>

                </div>
            </div>
        </div>



<!-- Resto de tu HTML y modal -->
<script>
    document.getElementById("saveChanges").addEventListener("click", function () {
        var Ingreso = <?php echo json_encode($IngresoArray); ?>;
        var mensaje = "Los valores de Ingreso son: " + Ingreso.join(", ");
        
        // Mostrar el mensaje en el elemento HTML
        document.getElementById("idPersonaValue").textContent = mensaje;
    });

    //*** Gráficos (Plotly JS) ***// 
    const arrayx = ["Emergencia", "Normales", "Mujeres", "Hombres", "x"];
    const arrayy = ["12", "12", "15", "20", "24"];

    const titulo = {title: "Stock de Productos"};

    const datos = [{labels: arrayx, values: arrayy, type:"pie"}];

    Plotly.newPlot("miplot", datos, titulo);
</script>
