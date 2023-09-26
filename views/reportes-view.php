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

<div id="miplot" style="width:90%;"></div>
<div id="miplot2" style="width:90%;"></div>



<div id="idPacientesTabla">
<h1 class="container text-center">Tabla de Ingresos Totales</h1>

<div id="table" class="table-responsive" >
        <table class="table" id="tablaIngresosReporte" name="tablaIngresosReporte">

        <thead>
            <tr>
            <th scope="col">Paciente</th>
            <th scope="col">Documento</th>
            <th scope="col">Estado</th>
            <th scope="col">Tipo de Ingreso</th>
            <th scope="col">Fecha de ingreso</th>
            <th scope="col">Enfermero</th>
            </tr>
        </thead>

        <tbody>
        
        
            <?php
                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                mysqli_set_charset($mysqli, "utf8");
                $consultaIngreso="SELECT SQL_CALC_FOUND_ROWS * FROM ingreso ORDER BY fecha DESC";
                $selIngreso=mysqli_query($mysqli,$consultaIngreso);

                $ct= 1;
                while ($rowIngreso=mysqli_fetch_array($selIngreso, MYSQLI_ASSOC)): 
            ?>
        <tr>
            <?php 
            $consultaPersona = "SELECT SQL_CALC_FOUND_ROWS * FROM persona WHERE idPersona = '" . $rowIngreso["idPersona"] . "'";
            $selPersona = mysqli_query($mysqli, $consultaPersona);
            $rowPaciente = mysqli_fetch_array($selPersona, MYSQLI_ASSOC);
                
            $consultaEnfermero = "SELECT e.*, p.nombre, p.apellido, p.dni 
            FROM empleado e 
            INNER JOIN persona p ON e.idPersona = p.idPersona 
            WHERE e.legajo = '" . $rowIngreso["legajo"] . "'";

            $selEnfermero = mysqli_query($mysqli, $consultaEnfermero);
            $rowEnfermero = mysqli_fetch_array($selEnfermero, MYSQLI_ASSOC);
            
            ?>
            <td class="text-center"><?php echo $rowPaciente['nombre'] . " " . $rowPaciente['apellido']; ?></td>
            <td class="text-center"><?php echo $rowPaciente['dni']; ?></td>
            <td class="text-center"><span class="<?php if ($rowIngreso['estado'] == "No Atendido"){?>badge rounded-pill text-bg-warning<?php } else {?>badge rounded-pill text-bg-success<?php } ?>"><?php echo $rowIngreso['estado']; ?></span></td>
            <td class="text-center"><span class="<?php if ($rowIngreso['emergencia'] == "0"){?>badge rounded-pill text-bg-secondary<?php } else {?>badge rounded-pill text-bg-danger<?php } ?>"><?php if ($rowIngreso['emergencia'] == 0) { echo "Normal"; } else { echo "Emergencia"; } ?></span></td>
            <td class="text-center"><?php echo date("d/m/Y H:i:s", strtotime($rowIngreso['fecha'])); ?></td>
            <td class="text-center"><?php echo $rowEnfermero['nombre']; ?></td>
      
        </tr>
            <?php
                $ct++;
                endwhile; 
            ?>
        
        </tbody>
        
        </table>
       
</div>

<!-- Resto de tu HTML y modal -->
<script>


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
            url: "./process/estadisticas/consultaEmergencia.php", // Archivo PHP para la consulta a la base de datos
            method: "POST",
            dataType: "json",
            success: function(data) {
                  //*** Gráficos (Plotly JS) ***// 
                    const arrayx = ["Emergencia", "Normal"];
                    const arrayy = [data.emergencia, data.normal];

                    const datos = [{
                    x: arrayx,
                    y: arrayy,
                    type: "bar",
                    marker: {
                        color: ["red", "blue"],
                    },
                    }];

                    const layout = {
                    title: "Estadistica de tipos de ingreso",
                    xaxis: {
                        title: "Tipo de Ingreso",
                    },
                    yaxis: {
                        title: "Cantidad",
                    },
                    paper_bgcolor: "transparent",
                    plot_bgcolor: "transparent",
                    };

                    Plotly.newPlot("miplot2", datos, layout);
            },
            error: function() {
                alert('Error en la solicitud AJAX');
            }
        });

        let table = new DataTable('#tablaIngresosReporte', {
            responsive: true,
            language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    },
        });
</script>
