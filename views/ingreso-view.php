
<form id="ingresoForm" action="" method="post">
    <div class="container" id="idIngreso">

        <h1 class="text-center mb-3">Ingresos</h1>

        <div class="row">
            <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" >Documento</span>
                        <input type="number" name="dni" id="dni" class="form-control" aria-label="Documento">
                    </div>
            </div>
        </div>
   
        <div class="row">

            <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nombre</span>
                    <input type="text" name="nombre" id="nombre" class="form-control" aria-describedby="basic-addon1">
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Apellido</span>
                    <input type="text" name="apellido" id="apellido" class="form-control" aria-label="Apellido">
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Genero</span>
                    <select class="form-select mx-auto text-center" name="genero" id="genero">
                        <option value="" selected>Seleccionar una opción</option>
                        <option value="hombre">Masculino</option>
                        <option value="mujer">Femenino</option>
                        <option value="noBinario">No Binario</option>
                    </select>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">

                <div class="input-group mb-3" id="fNacbox">
                        <span class="input-group-text" id="basic-addon1">Fecha de Nacimiento</span>
                        <input type="date" name="fechaNac" id="fechaNac" class="form-control" aria-describedby="basic-addon1">
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
                        <select class="form-select mx-auto text-center" name="obraSocial" id="obraSocial" >
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
                    <input type="text" name="cp" id="cp" class="form-control" aria-label="cp">
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Domicilio</span>
                    <input type="text" name="domicilio" id="domicilio" class="form-control" aria-label="Domicilio">
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Telefono</span>
                    <input type="text" name="tel" id="tel" class="form-control" aria-label="tel">
                </div>
            </div>
            
        </div>

        <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3" id="tIngresobox">
                            <span class="input-group-text" id="basic-addon2">Tipo de Ingreso</span>
                            <select class="form-select mx-auto text-center" name="tipoIngreso" id="tipoIngreso" >
                                <option value="" selected>Seleccionar una opción</option>
                                <option value="1">Emergencia</option>
                                <option value="0">Normal</option>
                            </select>
                        </div>
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
                        <select class="form-select mx-auto text-center" name="zona" id="zona" >
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
        </div>
     
        
        <div class="row mt-5" >
            
            <div class="col-12">
                <div class="input-group">
                    <span class="input-group-text" >Diagnóstico</span>
                    <textarea class="form-control" aria-label="Diagnóstico" name="diagnostico" id="diagnostico"></textarea>
                </div>
            </div>

            <div class="input-group mt-3">
                    <span class="input-group-text">Observación</span>
                    <textarea class="form-control" aria-label="Diagnóstico" name="observacion" id="observacion"></textarea>
            </div>

        </div>
    
        <input type="button" name="btnIngresar" id="btnIngresar" class="btn btn-success form-control mt-4" value="Validar ingreso">
    </div>

</form>





<script>
$("#dni").on("input", function() {
        var dni = $(this).val();
        
        $.ajax({
            url: "./process/paciente/consultaDNI.php", // Archivo PHP para la consulta a la base de datos
            method: "POST",
            data: { dni: dni },
            dataType: "json",
            success: function(data) {
                if (data.success) {
                    $("#nombre").val(data.nombre);
                    $("#apellido").val(data.apellido);
                    $("#obraSocial").val(data.idObraSocial);
                    $("#fechaNac").val(data.fechaNac);
                    $("#cp").val(data.cp);
                    $("#domicilio").val(data.domicilio);
                    $("#genero").val(data.genero);
                    // Completa otros campos aquí si es necesario
                } else {
                    $("#nombre").val("");
                    $("#apellido").val("");
                    $("#obraSocial").val("");
                    $("#fechaNac").val("");
                    $("#cp").val("");
                    $("#domicilio").val("");
                    $("#genero").val("");
                    // Limpia otros campos aquí si es necesario
                }
            },
            error: function() {
                console.error("Error en la solicitud Ajax.");
            }
        });
    });



 const btnIngresar = document.getElementById('btnIngresar');   
 btnIngresar.addEventListener('click', () => 
    {
        var nombre = document.getElementById('nombre').value;
        var apellido = document.getElementById('apellido').value;
        var dni = document.getElementById('dni').value;
        var cp = document.getElementById('cp').value;
        var fechaNac = document.getElementById('fechaNac').value;
        var tel = document.getElementById('tel').value;
        var obraSocial = document.getElementById('obraSocial').value;
        var genero = document.getElementById('genero').value;
        var domicilio = document.getElementById('domicilio').value;
        var tipoIngreso = document.getElementById('tipoIngreso').value;
        var idZona = document.getElementById('zona').value;
        var observacion = document.getElementById('observacion').value;
        var diagnostico = document.getElementById('diagnostico').value;
        var legajo = <?php echo $_SESSION['legajo'];?>;

        if (nombre.trim() === '' || apellido.trim() === '')
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
                url: './process/ingreso.php',

                data: 
                {
                    nombre, apellido, dni, cp, fechaNac, tel, obraSocial, domicilio, tipoIngreso, genero, idZona, observacion, diagnostico, legajo
                },

                success: function(response) 
                {
                    

                    Swal.fire(
                        {
                        icon: 'success',
                        title: 'Se registro el ingreso con exito.',
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
                            title: 'No se ha podido realizar el ingreso.',
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

</script>
