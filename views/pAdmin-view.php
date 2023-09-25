<?php
    if(isset($_SESSION['idRol']))
        {
            if ($_SESSION['idRol'] == "2"){
    ?>
            <br>
            <nav aria-label="">
                <ul class="pagination pagination-lg">

                    <li class="page-item active" aria-current="page">
                        <span class="page-link" onclick="mostrarFormulario('cargos')">Cargos</span>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#" onclick="mostrarFormulario('roles')">Roles</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#" onclick="mostrarFormulario('zonas')">Zonas</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#" onclick="mostrarFormulario('localidades')">Localidades</a>
                    </li>

                </ul>
            </nav>


                <div id="cargos" style="display:none;">
                <!--Contenido de cargos-->
                </div>

                <div id="roles" style="display:none;">
                <!--Contenido de roles-->
                </div>

                <form id="zonas" style="display:none;">
                <!--Contenido de zonas-->
                </form>

                <div id="localidades" style="display:none;">
                <!--Contenido de localidades-->
                </div>

<?php
            }

        }
?> 
<script>
    function mostrarFormulario(formularioId) {
    // Oculta todos los formularios
    document.getElementById('cargos').style.display = 'none';
    document.getElementById('roles').style.display = 'none';
    document.getElementById('zonas').style.display = 'none';
    document.getElementById('localidades').style.display = 'none';

    // Muestra el formulario seleccionado
    document.getElementById(formularioId).style.display = 'block';
}


</script>
