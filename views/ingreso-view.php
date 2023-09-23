<form id="ingresoForm" action="" method="post">
    <div class="container" id="idIngreso">

        <h1 class="text-center mb-3">Ingresos</h1>
        <div class="col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Documento</span>
                    <input type="number" name="dni" id="dni" class="form-control" aria-label="Documento">
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
            <input type="text" name="apellido" id="apellido" class="form-control" aria-label="Domicilio">
        </div>
    </div>

    <div class="col-md-4 d-flex align-items-center" id="btnGenero">
        <label for="genero" class="mb-1 text-center">Género</label>
        <select class="form-select mx-auto text-center" name="genero" id="genero" style="width: 60%; margin-bottom:50px;">
            <option value="" selected>Seleccionar una opción</option>
            <option value="hombre">Hombre</option>
            <option value="mujer">Mujer</option>
            <option value="noBinario">No Binario</option>
        </select>
    </div>
</div>


        <div class="row">
            <div class="col-12 col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Fecha de Nacimiento</span>
                    <input type="date" name="fechaNac" id="fechaNac" class="form-control" aria-label="Fecha de Nacimiento" aria-describedby="basic-addon1">
                </div>
            </div>

            <div class="col-12 col-md-4 text-center">

                <div class="form-group">

                    <select class="form-control mx-auto text-center" name="genero" id="genero" style="width: 65%;">
                        <option value="" selected>Seleccionar una opción</option>
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                        <option value="noBinario">No Binario</option>
                    </select>

                </div>
            </div>

            
            <div class="col-12 col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Nacionalidad</span>
                    <input type="text" name="nacionalidad" id="nacionalidad" class="form-control"  aria-label="Nacionalidad">
                </div>
            </div>

    
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text">Domicilio</span>
                    <input type="text" name="nombre" id="nombre" class="form-control" aria-label="Documento">
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text">Codigo postal</span>
                    <input type="text" name="apellido" id="apellido" class="form-control" aria-label="Domicilio">
                </div>
            </div>

        </div>

        <div class="col-12 col-md-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon2">Teléfono</span>
                    <input type="tel" name="tel" id="tel" class="form-control" aria-label="Teléfono" aria-describedby="basic-addon2">
                </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-4 text-center">

                
            </div>

            <div class="col-12 col-md-4 mt-2 text-center">

                <div class="form-group">
                    <label for="tipoIngreso" class="mb-1 text-center">Tipo de ingreso</label>
                    <select class="form-control mx-auto text-center" name="tipoIngreso" id="tipoIngreso" style="width: 60%;">
                        <option value="" selected>Seleccionar una opción</option>
                        <option value="emergencia">Emergencia</option>
                        <option value="normal">Normal</option>
                    </select>
                </div>

            </div>
        </div>

        
        <div class="row mt-5" >
            
                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-text" >Diagnóstico</span>
                        <textarea class="form-control" aria-label="Diagnóstico" name="diagnositco" id="diagnositco"></textarea>
                    </div>
                </div>
            </div>

            <div class="input-group mt-3">
                        <span class="input-group-text">Observación</span>
                        <textarea class="form-control" aria-label="Diagnóstico" name="observacion" id="observacion"></textarea>
            </div>
        </div>
    
        <input type="button" name="btnIngresar" id="btnIngresar" class="btn btn-success form-control mt-2" value="Validar ingreso">
    </div>
</form>





<script>

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
        
        if (nombre.trim() === '') 
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
                    nombre,
                    apellido: $('#apellido').val(),
                    dni: $('#dni').val(),
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
