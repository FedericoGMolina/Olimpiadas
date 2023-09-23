<?php
    if(isset($_SESSION['idRol']))
        {
            if ($_SESSION['idRol'] == "2"){
                ?>
                <br>
                <nav aria-label="">
                <ul class="pagination pagination-lg">
                    <li class="page-item active" aria-current="page" href="#cargos">
                    <span class="page-link">Cargos</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#roles">Roles</a></li>
                    <li class="page-item"><a class="page-link" href="#zonas">Zonas</a></li>
                    <li class="page-item"><a class="page-link" href="#">Localidades</a></li>
                </ul>
                </nav>
<?php
            }

        }
?> 

