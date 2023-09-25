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
        <nav >
            <ul class="pagination justify-content-center">
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

        <div id="cargos">
        <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">CREO</th>
                            <th scope="col">QUE</th>
                            <th scope="col">FUNCA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cuba</td>
                            <td>Bahia</td>
                            <td>Brasil (Decime que se siente)</td>
                        </tr>
                        <tr>
                            <td>Red Dragon</td>
                            <td>Shikibukai</td>
                            <td>Taladro</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="roles">
            <!-- Contenido de roles -->
        </div>

        <div id="zonas">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Zona</th>
                            <th scope="col">Enfermeros</th>
                            <th scope="col">Pacientes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ronaldiño</td>
                            <td>Messi</td>
                            <td>Papa</td>
                        </tr>
                        <tr>
                            <td>Red Dragon</td>
                            <td>Shikibukai</td>
                            <td>Taladro</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="localidades">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Localidades</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">Cp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Cuba</td>
                            <td>Bahia</td>
                            <td>Brasil (Decime que se siente)</td>
                        </tr>
                        <tr>
                            <td>Red Dragon</td>
                            <td>Shikibukai</td>
                            <td>Taladro</td>
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
    mostrarFormulario('cargos');

    function mostrarFormulario(formularioId) {
        // Oculta todos los divs
        document.getElementById('cargos').style.display = 'none';
        document.getElementById('roles').style.display = 'none';
        document.getElementById('zonas').style.display = 'none';
        document.getElementById('localidades').style.display = 'none';

        // Muestra el formulario seleccionado
        document.getElementById(formularioId).style.display = 'block';
    }
</script>
