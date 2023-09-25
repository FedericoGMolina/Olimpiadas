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

<div id="miplot" style="width:50%;"></div>
<div id="miplot2" style="width:50%;"></div>
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

    $.ajax({
            url: "./process/estadisticas/consultaGenero.php", // Archivo PHP para la consulta a la base de datos
            method: "POST",
            dataType: "json",
            success: function(data) {
                  //*** Gráficos (Plotly JS) ***// 
                    const arrayx = ["Mujeres", "Hombres", "No Binario"];
                    const arrayy = [data.Femenino, data.Masculino, data.NoBinario];

                    const datos = [{labels: arrayx, values: arrayy, type:"pie",}];
                    const layout = {
                                    title: "Estadistica de genero de personas",
                                    paper_bgcolor: "transparent", // Establece el fondo del gráfico como transparente
                                    plot_bgcolor: "transparent", // Establece el fondo del área de trazado como transparente
                                };

                    
            Plotly.newPlot("miplot", datos, layout);
            },
            error: function() {
                alert('Error en la solicitud AJAX');
            }
        });

        $.ajax({
            url: "./process/estadisticas/consultaGenero.php", // Archivo PHP para la consulta a la base de datos
            method: "POST",
            dataType: "json",
            success: function(data) {
                  //*** Gráficos (Plotly JS) ***// 
                    const arrayx = ["Mujeres", "Hombres", "No Binario"];
                    const arrayy = [data.Femenino, data.Masculino, data.NoBinario];

                    const datos = [{labels: arrayx, values: arrayy, type:"pie",}];
                    const layout = {
                                    title: "Estadistica de genero de personas",
                                    paper_bgcolor: "transparent", // Establece el fondo del gráfico como transparente
                                    plot_bgcolor: "transparent", // Establece el fondo del área de trazado como transparente
                                };

                    
            Plotly.newPlot("miplot2", datos, layout);
            },
            error: function() {
                alert('Error en la solicitud AJAX');
            }
        });


</script>
