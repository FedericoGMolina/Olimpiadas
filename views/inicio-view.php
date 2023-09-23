    <div class="container text-center p-3">
        <img src="Imagenes/cruz-azul.png" alt="" width="150px" height="150px"> <!-- Inserta una imagen -->
        <h1>Olimpiadas</h1> <!-- Agrega un título "Olimpiadas" -->
        <h2>¡Bienvenido <?php echo $_SESSION['nombre'];?>!</h2> <!-- Agrega un mensaje de bienvenida -->
    </div>

    <!-- Contenedor principal con margen superior -->
    <div class="container mt-4">
      
        <!-- Fila que contiene las cajas -->
        <div class="row">
            <!-- Caja 1 -->
            <div class="col-md-4 col-sm-12 mt-2">
                <!-- Enlace con URL de destino -->
                <a href="index.php?view=ingreso" class="text-decoration-none">
                    <!-- Caja con imagen y título -->
                    <div class="card text-center">
                        <!-- Imagen en la parte superior de la caja -->
                        <img src="Imagenes/Ingreso.png" class="card-img-top" alt="">
                        <p class="mt-2">Acceso a la gestión de ingresos</p>
                        <!-- Cuerpo de la caja con el título -->
                        <div class="card-body">
                            <h4 class="card-title">Ingresos</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Caja 2 -->
            <div class="col-md-4 col-sm-12 mt-2">
                <a href="Página-Pacientes/Pacientes.html" class="text-decoration-none">
                    <div class="card text-center">
                        <img src="Imagenes/Paciente.png" class="card-img-top" alt="Portada del juego 2">
                        <p class="mt-2">Acceso a la gestión de pacientes</p>
                        <div class="card-body">
                            <h4 class="card-title">Pacientes</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Caja 3 -->
            <div class="col-md-4 col-sm-12 mt-2">

                <a href="link_a_mas_informacion.html" class="text-decoration-none">
                    <div class="card text-center">
                        <img src="Imagenes/Report.png" class="card-img-top" alt="Portada del juego 3">
                        <p class="mt-2">Acceso a la gestión de ingresos</p>
                        <div class="card-body">
                            <h4 class="card-title">Reportes</h4>
                        </div>
                    </div>
                </a>
                
            </div>
            
        </div>
    </div>

    <div class="text-center">     
        <a href="./process/user/logout.php" name="logOut" id="logOut">
        <h1><i class="bi bi-box-arrow-right"></i></h1>
        </a>
    </div>
    <!-- Incluye el archivo JavaScript de Bootstrap desde un CDN -->
