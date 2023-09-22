
<!DOCTYPE html> <!-- Declaración del tipo de documento como HTML5 -->

<html lang="en"> <!-- Inicio del elemento HTML con el atributo "lang" para el idioma (inglés) -->

<head>
    <meta charset="utf-8"> <!-- Configura la codificación de caracteres a UTF-8 -->
    <title>Olimpiadas</title> <!-- Establece el título de la página en la barra de título del navegador -->  
    <!-- Configuración de la vista en dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Incluye el archivo CSS de Bootstrap 5.3.2 desde un CDN (Content Delivery Network) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Incluye un archivo de hojas de estilo personalizado (styles-inicio.css) -->
    <link rel="stylesheet" href="styles-inicio.css">
    <!-- Define un icono para la pestaña del navegador -->
    <link rel="shortcut icon" href="Imagenes/cruz-azul.png" type="image/x-icon">
</head>

<body>

    <div class="container text-center p-3">
        <img src="Imagenes/cruz-azul.png" alt="" width="150px" height="150px"> <!-- Inserta una imagen -->
        <h1>Olimpiadas</h1> <!-- Agrega un título "Olimpiadas" -->
        <h2>¡Bienvenido Federico!</h2> <!-- Agrega un mensaje de bienvenida -->
    </div>

    <!-- Contenedor principal con margen superior -->
    <div class="container mt-4">
      
        <!-- Fila que contiene las cajas -->
        <div class="row">
            <!-- Caja 1 -->
            <div class="col-md-4 col-sm-12 mt-2">
                <!-- Enlace con URL de destino -->
                <a href="../index.html" class="text-decoration-none">
                    <!-- Caja con imagen y título -->
                    <div class="card text-center">
                        <!-- Imagen en la parte superior de la caja -->
                        <img src="Imagenes/Hospital.jpg" class="card-img-top" alt="">
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
                        <img src="Imagenes/Hospital.jpg" class="card-img-top" alt="Portada del juego 2">
                        <p class="mt-2">Acceso a la gestión de pacientes</p>
                        <div class="card-body">
                            <h4 class="card-title">Pacientes</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Caja 3 -->
            <div class="col-md-4 col-sm-12 ">
                <a href="link_a_mas_informacion.html" class="text-decoration-none">
                    <div class="card text-center">
                        <img src="Imagenes/Hospital.jpg" class="card-img-top" alt="Portada del juego 3">
                        <p>Acceso a la gestión de ingresos</p>
                        <div class="card-body">
                            <h4 class="card-title">Reportes</h4>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
    </div>

    <div class="text-center">     
        <a href="../index.php">Cerrar Sesión</a>
    </div>
    <!-- Incluye el archivo JavaScript de Bootstrap desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
