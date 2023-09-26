<body class="container-fluid" id="idPacientes">
        

        <!-- Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Encabezado del modal -->
                  
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>

                    <div class=" text-center">
                        <h1 id="titulo"></h1>
                    </div>
                    <div class="row mt-3" style="margin-left:5px;">
                        <input type="hidden" id="idIngresoInput" name="idIngresoInput"></input>
                        <div class="col-md-4 text-center"><h6 id="nombreYapellido"></h6></div>
                        <div class="col-md-4 text-center"><h6 id="tituloFechaNacimiento"></h6></div>
                        <div class="col-md-4 text-center"><h6 id="generoPaciente"></h6></div>
                    </div>


                    <!-- Cuerpo del modal -->
                    <div class="modal-body">
                        <div class="col-12">
                                <select >
                                <option selected name="estadoIngreso" id="estadoIngreso"></option>
                                    <option value="1">Atendido</option>
                                    <option value="2">No Atendido</option>
                                </select>
                            </div>

                        <div class="col-12" id="inputModel">
                            <input type="text" class="form-control mt-3" name="legajoEnfermero" id="legajoEnfermero">
                        </div>
                        <div class="col-md-4">
                    <div class="input-group mb-3" id="tIngresobox">
                        <span class="input-group-text" id="basic-addon2">Zona</span>
                        <?php
                            $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                            mysqli_set_charset($mysqli, "utf8");
                            $consultaZona="SELECT SQL_CALC_FOUND_ROWS * FROM zona";
                            $selZona=mysqli_query($mysqli,$consultaZona);
                        ?>
                        <select class="form-select mx-auto text-center" name="zonaPaciente" id="zonaPaciente" >
                            <?php           
                                while ($row=mysqli_fetch_array($selZona, MYSQLI_ASSOC)): 
                            ?>
                            <option value="<?php echo $row['idZona']; ?>"><?php echo $row['nombreZona']; ?></option>
                                                                            
                            <?php
                                endwhile; 
                            ?>

                        </select>
                    </div>
                </div>
                        <div class="col-12 mt-4">

                        <div class="input-group">
                                <span class="input-group-text" >Diagnóstico</span>
                                <textarea class="form-control" aria-label="Diagnóstico" name="diagnosticoIngreso" id="diagnosticoIngreso"></textarea>
                            </div>
                        </div>

                        <div class="input-group mt-3">
                                <span class="input-group-text">Observación</span>
                                <textarea class="form-control" aria-label="Diagnóstico" name="observacionIngreso" id="observacionIngreso"></textarea>
                        </div>
                                    <h5> Historial de atenciones </h5>
                                    <hr>
                        <ul id="historial"></ul>
                        <hr>
                    </div>

                    <!-- Pie del modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="actualizarIngresoBtn" name="actualizarIngresoBtn">Guardar Cambios</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
<div id="idPacientesTabla">
<h1 class="container text-center">Tabla de Pacientes</h1>

<div id="table" class="table-responsive">
        <table class="table">

        <thead>
            <tr>
            <th scope="col">Paciente</th>
            <th scope="col">Documento</th>
            <th scope="col">Estado</th>
            <th scope="col">Tipo de Ingreso</th>
            <th scope="col">Fecha de ingreso</th>
            <th scope="col">Enfermero</th>
            <th scope="col">Opciones</th>
            </tr>
        </thead>

        <tbody>
        
        
            <?php
                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                mysqli_set_charset($mysqli, "utf8");
                $consultaIngreso="SELECT SQL_CALC_FOUND_ROWS * FROM ingreso WHERE estado = 'No Atendido'";
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
            <td class="text-center">
                <?php if (isset($_SESSION['idRol']) && ($_SESSION['idRol']==2)) { ?>
                    <a type="button" class="btn btn-primary btn-edit-paciente" data-toggle="modal" data-target="#myModal" data-id="<?php echo $rowIngreso['idIngreso']; ?>">
            <i class="bi bi-pencil-square"></i>
        </a>
                <?php } ?>
                <a href="" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                <a href="" class="btn btn-sm btn-success"><i class="bi bi-person-plus-fill"></i></a>
            </td>
        </tr>
            <?php
                $ct++;
                endwhile; 
            ?>
        
        </tbody>
        
        </table>
       
</div>
<script>
    $('#table').on('click', '.btn-edit-paciente', function() {
        var idIngreso = $(this).data('id');
        $('#idIngresoInput').val(idIngreso);
        $('#titulo').text("I - " + idIngreso);

        $.ajax({
            url: "./process/ingreso/obtenerDatos.php", // Archivo PHP para la consulta a la base de datos
            method: "POST",
            data: { idIngreso: idIngreso },
            dataType: "json",
            success: function(data) {
                if (data.success) {
                    //Obtener Nombre y Apellido
                    $('#nombrePaciente').val(data.nombre);
                    $('#apellidoPaciente').val(data.apellido);

                    $('#nombreYapellido').text(data.nombre +" "+ data.apellido);

                        // Calcular la edad a partir de la fecha de nacimiento
                        var fechaNacimiento = new Date(data.fechaNacimiento);
                                var fechaActual = new Date();
                                var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
                            
                                // Verificar si el cumpleaños ya ocurrió este año
                                var mesActual = fechaActual.getMonth();
                                var mesNacimiento = fechaNacimiento.getMonth();
                                if (mesActual < mesNacimiento || (mesActual === mesNacimiento && fechaActual.getDate() < fechaNacimiento.getDate())) {
                                    edad--;
                                }
                    // Agregar la edad al título
                    $('#tituloFechaNacimiento').text("Edad: " + edad + " años");
                    
                    //obtener Genero
                    $('#generoPaciente').text(data.genero);
                    $('#legajoEnfermero').val(data.empleadoIngresante); 
                    $('#estadoIngreso').text(data.estado);
                    $('#observacionIngreso').text(data.observacion);
                    $('#diagnosticoIngreso').text(data.diagnostico);
                    cargarHistorialDeCambios(idIngreso);

                }
            },
            error: function() {
                alert('Error en la solicitud AJAX');
            }
        });

        $('#myModal').modal('show');
    });

    $('#actualizarIngresoBtn').click(function(){

        var idIngreso = document.getElementById('idIngresoInput').value;
        var diagnostico = document.getElementById('diagnosticoIngreso').value;
        var observacion = document.getElementById('observacionIngreso').value;
        var idZona = document.getElementById('zonaPaciente').value;
        $.ajax({
            url: "./process/ingreso/actualizarDatos.php", // Archivo PHP para la consulta a la base de datos
            method: "POST",
            data: { idIngreso, diagnostico, observacion, idZona },
            dataType: "json",
            success: function(data) {
                Swal.fire(
                        {
                        icon: 'success',
                        title: 'Se actualizaron los datos con exito.',
                        showConfirmButton: false,
                        timer: 1500
                        }
                    )
            },
            error: function() {
                alert('Error en la solicitud AJAX');
            }
        });
    })

    setInterval(function() {
  $('#table').load(location.href + ' #table');
}, 10000);

const historialList = document.getElementById("historial");

    // Función para cargar el historial de cambios mediante una solicitud AJAX
    function cargarHistorialDeCambios(idIngreso) {
        $.ajax({
            url: "./process/ingreso/cargarHistorialDeCambios.php", // Cambia esto a la URL de tu script o API que obtiene los datos
            method: "GET", // Puedes usar GET o POST según tus necesidades
            data: { idIngreso: idIngreso }, // Pasa el ID del paciente como parámetro
            dataType: "json",
            success: function (data) {
                // Limpia el historial existente
                historialList.innerHTML = "";

                // Itera sobre los datos y agrega cada cambio al historial
                data.forEach(cambio => {
                    const listItem = document.createElement("li");
                    const fechaCambio = new Date(cambio.fecha);
                        const opcionesFormato = {
                        day: "2-digit",
                        month: "2-digit",
                        year: "numeric",
                        hour: "2-digit",
                        minute: "2-digit",
                        };
                        const fechaFormateada = fechaCambio.toLocaleDateString('es-ES', opcionesFormato);
                    listItem.textContent = `Actualización: ${fechaFormateada}`;
                    listItem.style.cursor = "pointer";
                   
                    
                    // Agrega un evento clic para mostrar los detalles del cambio al hacer clic en el elemento de la lista
                    listItem.addEventListener("click", () => {
                        // Aquí puedes mostrar los detalles del cambio como prefieras
                        

                        alert(`Detalles del Cambio:\nFecha: ${fechaFormateada}\nDescripción: ${cambio.descripcion}\nDetalles: ${cambio.detalles}`);
                    });

                    historialList.appendChild(listItem);
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

</script>


