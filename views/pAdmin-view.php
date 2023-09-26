<style>
    /* Estilo para los enlaces de la paginación */
    .page-link {
        font-size: 20px; /* Cambia el tamaño del texto a 20px (o el valor que prefieras) */
        font-weight: bold; /* Hace que el texto sea más grueso */
    }
</style>

<?php
if (isset($_SESSION['idRol'])) {
    if ($_SESSION['idRol'] == "2") {
?>
    <div class="container">
        <br>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item active" aria-current="page" id="liusuarios" name="liusuarios">
                    <span class="page-link" onclick="mostrarFormulario('usuarios')">Usuarios</span>
                </li>

                <li class="page-item" id="lizonas" name="lizonas">
                    <a class="page-link" href="#" onclick="mostrarFormulario('zonas')">Zonas</a>
                </li>
                <li class="page-item" id="lilocalidades" name="lilocalidades">
                    <a class="page-link" href="#" onclick="mostrarFormulario('localidades')">Localidades</a>
                </li>
            </ul>
        </nav>

        <div id="usuarios">
        <div class="row">
                        <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" >Documento</span>
                                    <input type="number" name="dniEmpleado" id="dniEmpleado" class="form-control" aria-label="Documento">
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" >Legajo</span>
                                    <input type="number" name="legajo" id="legajo" class="form-control" aria-label="Documento">
                                </div>
                        </div>
                    </div>
            
                    <div class="row">

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nombre</span>
                                <input type="text" name="nombreEmpleado" id="nombreEmpleado" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Apellido</span>
                                <input type="text" name="apellidoEmpleado" id="apellidoEmpleado" class="form-control" aria-label="Apellido">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Genero</span>
                                <select class="form-select mx-auto text-center" name="generoEmpleado" id="generoEmpleado">
                                    <option value="" selected>Seleccionar una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="No Binario">No Binario</option>
                                </select>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="input-group mb-3" id="fNacbox">
                                    <span class="input-group-text" id="basic-addon1">Fecha de Nacimiento</span>
                                    <input type="date" name="fechaNacEmpleado" id="fechaNacEmpleado" class="form-control" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-md-4" >
                                <div class="input-group mb-3" id="oSbox">
                                    <span class="input-group-text" id="basic-addon1">Obra Social</span>
                                    <?php
                                        $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                        mysqli_set_charset($mysqli, "utf8");
                                        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM obrasocial";
                                        $selObrasocial=mysqli_query($mysqli,$consulta);
                                    ?>
                                    <select class="form-select mx-auto text-center" name="obraSocialEmpleado" id="obraSocialEmpleado" >
                                        <?php           
                                            while ($row=mysqli_fetch_array($selObrasocial, MYSQLI_ASSOC)): 
                                        ?>
                                        <option value="<?php echo $row['idObraSocial']; ?>"><?php echo $row['obraSocial']; ?></option>
                                                                                        
                                        <?php
                                                        
                                            endwhile; 
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Codigo postal</span>
                                <input type="text" name="cpEmpleado" id="cpEmpleado" class="form-control" aria-label="cp">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Domicilio</span>
                                <input type="text" name="domicilioEmpleado" id="domicilioEmpleado" class="form-control" aria-label="Domicilio">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Telefono</span>
                                <input type="text" name="telEmpleado" id="telEmpleado" class="form-control" aria-label="tel">
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">

                            <div class="col-md-4">
                                <div class="input-group mb-3" id="tIngresobox">
                                    <span class="input-group-text" id="basic-addon2">Zona</span>
                                    <?php
                                        $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                        mysqli_set_charset($mysqli, "utf8");
                                        $consultaZona="SELECT SQL_CALC_FOUND_ROWS * FROM zona";
                                        $selZona=mysqli_query($mysqli,$consultaZona);
                                    ?>
                                    <select class="form-select mx-auto text-center" name="zonaEmpleado" id="zonaEmpleado" >
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
                  

                            <div class="col-md-4">
                                <div class="input-group mb-3" id="tIngresobox">
                                    <span class="input-group-text" id="basic-addon2">Cargo</span>
                                    <?php
                                        $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                        mysqli_set_charset($mysqli, "utf8");
                                        $consultaZona="SELECT SQL_CALC_FOUND_ROWS * FROM cargo";
                                        $selZona=mysqli_query($mysqli,$consultaZona);
                                    ?>
                                    <select class="form-select mx-auto text-center" name="cargoEmpleado" id="cargoEmpleado" >
                                        <?php           
                                            while ($row=mysqli_fetch_array($selZona, MYSQLI_ASSOC)): 
                                        ?>
                                        <option value="<?php echo $row['idCargo']; ?>"><?php echo $row['nombreCargo']; ?></option>
                                                                                        
                                        <?php
                                                        
                                            endwhile; 
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group mb-3" id="tIngresobox">
                                    <span class="input-group-text" id="basic-addon2">Rol</span>
                                    <?php
                                        $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                        mysqli_set_charset($mysqli, "utf8");
                                        $consultaZona="SELECT SQL_CALC_FOUND_ROWS * FROM rol";
                                        $selZona=mysqli_query($mysqli,$consultaZona);
                                    ?>
                                    <select class="form-select mx-auto text-center" name="rolEmpleado" id="rolEmpleado" >
                                        <?php           
                                            while ($row=mysqli_fetch_array($selZona, MYSQLI_ASSOC)): 
                                        ?>
                                        <option value="<?php echo $row['idRol']; ?>"><?php echo $row['rol']; ?></option>
                                                                                        
                                        <?php
                                                        
                                            endwhile; 
                                        ?>

                                    </select>
                                </div>
                            </div>
                    </div>


                    <div class="col-md-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Usuario</span>
                                <input type="text" name="usuarioEmpleado" id="usuarioEmpleado" class="form-control" aria-label="user">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Contraseña</span>
                                <input type="text" name="contraseñaEmpleado" id="contraseñaEmpleado" class="form-control" aria-label="pass">
                            </div>
                    </div>
                
                    <input type="button" name="btnRegistrar" id="btnRegistrar" class="btn btn-success form-control mt-4" value="Registrar usuario">
                    <br><br>
                        <div id="empleadosTabla">
                        <h1 class="container text-center">Tabla de Empleados</h1>

                        <div id="table" class="table-responsive" >
                                <table class="table text-center" id="tablaEmpleados" name="tablaEmpleados">

                                <thead>
                                    <tr>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Nombre y Apellido</th>
                                    <th scope="col">Cargo</th>
                                    </tr>
                                </thead>

                                <tbody>
                                
                                
                                    <?php
                                        $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                                        mysqli_set_charset($mysqli, "utf8");
                                        $consultaIngreso="SELECT SQL_CALC_FOUND_ROWS * FROM empleado";
                                        $selIngreso=mysqli_query($mysqli,$consultaIngreso);

                                        $ct= 1;
                                        while ($rowIngreso=mysqli_fetch_array($selIngreso, MYSQLI_ASSOC)): 
                                    ?>
                                <tr>
                                    <?php 
                                    $consultaPersona = "SELECT SQL_CALC_FOUND_ROWS * FROM persona WHERE idPersona = '" . $rowIngreso["idPersona"] . "'";
                                    $selPersona = mysqli_query($mysqli, $consultaPersona);
                                    $rowPaciente = mysqli_fetch_array($selPersona, MYSQLI_ASSOC);
                                        
                                    $consultaEnfermero = "SELECT e.*, p.nombre, p.apellido, p.dni, c.nombreCargo
                                    FROM empleado e
                                    INNER JOIN persona p ON e.idPersona = p.idPersona
                                    INNER JOIN cargo c ON e.idCargo = c.idCargo
                                    WHERE e.legajo = '" . $rowIngreso["legajo"] . "'";

                                    $selEnfermero = mysqli_query($mysqli, $consultaEnfermero);
                                    $rowEnfermero = mysqli_fetch_array($selEnfermero, MYSQLI_ASSOC);
                                    
                                    ?>
                                    <td class="text-center"><?php echo $rowPaciente['dni']; ?></td>
                                    <td class="text-center"><?php echo $rowEnfermero['nombre'] . " " . $rowEnfermero['apellido']; ?></td>
                                    <td class="text-center"><?php echo $rowEnfermero['nombreCargo']; ?></td>
                            
                                </tr>
                                    <?php
                                        $ct++;
                                        endwhile; 
                                    ?>
                                
                                </tbody>
                                
                                </table>
                            
                        </div>
                </div>
        </div>

        <div id="zonas">
            <div class="table-responsive">
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Agregar Zona</span>
                            <input type="text" class="input-group-text"name="zona" id="zona" class="zona" aria-label="zona">
                        </div>
                    </div>
                    <input type="button" name="btnAgregarZona" id="btnAgregarZona" class="btn btn-success mb-2" value="Agregar Zona">

                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Zonas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Testeando..."Zonas"</td>
    
                            </tr>
                            <tr>
                                <td>Testeando..."Zonas"</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="localidades">
                <div class="table-responsive">
                <div class="col-md-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Agregar Localidad</span>
                            <input type="text" class="input-group-text"name="zona" id="zona" class="localidad" aria-label="localidad">
                            <span class="input-group-text" id="basic-addon1">Código Postal</span>
                            <input type="text" class="input-group-text"name="cp" id="cp" class="cp" aria-label="localidad">
                        </div>
                    </div>
                    <input type="button" name="btnAgregarLocalidad" id="btnAgregarLocalidad" class="btn btn-success mb-2" value="Agregar Localidad">

                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Localidades</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Testeando..."Localidades"</td>
    
                            </tr>
                            <tr>
                                <td>Testeando..."Localidades"</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

<?php
    }
}
?>
<script>
    mostrarFormulario('usuarios');

    function mostrarFormulario(formularioId) {
        // Oculta todos los divs
        document.getElementById('usuarios').style.display = 'none';
        document.getElementById('zonas').style.display = 'none';
        document.getElementById('localidades').style.display = 'none';

        // Muestra el formulario seleccionado
        document.getElementById(formularioId).style.display = 'block';
        var elementosNavegacion = document.querySelectorAll('.page-item');
        elementosNavegacion.forEach(function(elemento) {
            elemento.classList.remove('active');
        });
        document.getElementById('li' + formularioId).classList.add('active');
    }
    
    const btnAgregarZona = document.getElementById('btnAgregarZona');
    btnAgregarZona.addEventListener('click', () =>
        {
           var zona = document.getElementBydId
        }    
    );

    //----------------------------------------Registrar empleado-------------------------------------------------\\
    const btnRegistrar= document.getElementById('btnRegistrar');   
    btnRegistrar.addEventListener('click', () => 
    {
        var nombreEmpleado = document.getElementById('nombreEmpleado').value;
        var apellidoEmpleado = document.getElementById('apellidoEmpleado').value;
        var dniEmpleado = document.getElementById('dniEmpleado').value;
        var cpEmpleado = document.getElementById('cpEmpleado').value;
        var fechaNacEmpleado = document.getElementById('fechaNacEmpleado').value;
        var telEmpleado = document.getElementById('telEmpleado').value;
        var obraSocialEmpleado = document.getElementById('obraSocialEmpleado').value;
        var generoEmpleado = document.getElementById('generoEmpleado').value;
        var domicilioEmpleado = document.getElementById('domicilioEmpleado').value;
        var legajoEmpleado = document.getElementById('legajo').value;
        var usuarioEmpleado = document.getElementById('usuarioEmpleado').value;
        var contraseñaEmpleado = document.getElementById('contraseñaEmpleado').value;
        var rolEmpleado = document.getElementById('rolEmpleado').value;
        var cargoEmpleado = document.getElementById('cargoEmpleado').value;
        var zonaEmpleado = document.getElementById('zonaEmpleado').value;

        if (nombreEmpleado.trim() === '' || apellidoEmpleado.trim() === '' || dniEmpleado.trim() === '' || domicilioEmpleado.trim() === '' || legajoEmpleado.trim() === '' || usuarioEmpleado.trim() === '' || contraseñaEmpleado.trim() === '')
        { 
            Swal.fire(
                {
                    icon: 'error',
                    title: 'Debe completar los datos',
                    showConfirmButton: false,
                    timer: 1500
                }
            )
        } 
        else
        {
            $.ajax(
            {
                type: 'POST',
                url: './process/empleado/registrar.php',

                data: 
                {
                    nombreEmpleado, apellidoEmpleado, dniEmpleado, cpEmpleado, fechaNacEmpleado, telEmpleado, obraSocialEmpleado, domicilioEmpleado, generoEmpleado, legajoEmpleado, usuarioEmpleado, contraseñaEmpleado, rolEmpleado, cargoEmpleado, zonaEmpleado
                },

                success: function(response) 
                {
                    

                    Swal.fire(
                        {
                        icon: 'success',
                        title: 'Se registro el usuario con exito.',
                        showConfirmButton: false,
                        timer: 1500
                        }
                    )
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    Swal.fire(
                        {
                            icon: 'error',
                            title: 'No se ha podido registrar al usuar.',
                            showConfirmButton: false,
                            timer: 1500
                        }
                    )
                }
            
            }
            );
        }
    }
);


$("#dniEmpleado").on("input", function() {
        var dni = $(this).val();
        
        $.ajax({
            url: "./process/paciente/consultaDNI.php", // Archivo PHP para la consulta a la base de datos
            method: "POST",
            data: { dni: dni },
            dataType: "json",
            success: function(data) {
                if (data.success) {
                    $("#nombreEmpleado").val(data.nombre);
                    $("#apellidoEmpleado").val(data.apellido);
                    $("#obraSocialEmpleado").val(data.idObraSocial);
                    $("#fechaNacEmpleado").val(data.fechaNac);
                    $("#cpEmpleado").val(data.cp);
                    $("#domicilioEmpleado").val(data.domicilio);
                    $("#generoEmpleado").val(data.genero);
                    // Completa otros campos aquí si es necesario
                } else {
                    $("#nombreEmpleado").val("");
                    $("#apellidoEmpleado").val("");
                    $("#obraSocialEmpleado").val("");
                    $("#fechaNacEmpleado").val("");
                    $("#cpEmpleado").val("");
                    $("#domicilioEmpleado").val("");
                    $("#generoEmpleado").val("");
                    // Limpia otros campos aquí si es necesario
                }
            },
            error: function() {
                console.error("Error en la solicitud Ajax.");
            }
        });
    });

    let table = new DataTable('#tablaEmpleados', {
            responsive: true,
            language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    },
        });
</script>
