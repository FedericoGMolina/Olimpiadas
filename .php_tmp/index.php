<?php
    session_start(); // Iniciar la sesión



    $message = ""; // Variable para almacenar mensajes de error o éxito

    if (isset($_POST['loginButton'])) 
    {
        $username = $_POST['usuario'];
        $password = $_POST['password'];
        
        $db = new mysqli('localhost', 'root', '', 'test');
        if ($db->connect_error) 
        {
            die("Error de conexión: " . $db->connect_error);
        }
    
        // Consulta SQL para buscar el usuario en la base de datos
        $query = "SELECT * FROM usuarios WHERE User='$username'";
        $result = $db->query($query);

        if ($result->num_rows == 1) {
            // Usuario encontrado, verificar la contraseña
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['Password'])) {
                // Contraseña válida, iniciar sesión
                $_SESSION['username'] = $username;
                header('Location: Inicio/inicio.php'); // Redirigir al usuario a la página de bienvenida
                exit();
            } else {
                // Contraseña incorrecta
                $message = "Contraseña incorrecta. Por favor, inténtalo de nuevo.";
            }
        } else {
            // Usuario no encontrado
            $message = "Usuario no encontrado. Por favor, regístrate.";
        }
    }
?>


<!DOCTYPE html> <!-- Declara el tipo de documento como HTML5 -->
<html lang="en"> <!-- Define el idioma de la página como inglés (en) -->

<head>
    <meta charset="UTF-8"> <!-- Configura la codificación de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Establece las propiedades de la ventana gráfica para dispositivos móviles -->
    <title>Login</title> <!-- Establece el título de la página en la barra de título del navegador -->

    <?php if (!empty($message)) : ?>
    <p class="message"><?= $message ?></p>
    <?php endif; ?>

    <!-- Incluye el archivo CSS de Bootstrap 5.3.2 desde un CDN (Content Delivery Network) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Archivo de estilos personalizado (Styles-Index.css) -->
    <link rel="stylesheet" href="styles-index.css"> <!-- Incluye tu archivo de hojas de estilo personalizado -->

</head>

<body>
    <div class="container-fluid text-center"> <!-- Crea un contenedor fluido que centra su contenido y se adapta al ancho de la pantalla -->
        <img src="Inicio/Imagenes/corazon.png" alt="" class="mt-2" id="corazon" height="190px"> <!-- Inserta una imagen -->
        <h1 class="mt-1" style="font-size:60px;">Login</h1> <!-- Agrega un título "Login" con un estilo de fuente personalizado -->

        <form id="loginForm" class="mt-4" method="post" action=""> <!-- Crea un formulario de inicio de sesión con un ID -->
            <div class="mb-3">
                <label for="Usuario" class="form-label">Usuario</label> <!-- Agrega una etiqueta para el campo de usuario -->
                <input type="text" class="form-control mt-3" name="usuario" id="usuario" placeholder="Ingresar Usuario"> <!-- Crea un campo de entrada de texto para el usuario -->
            </div>

            <div class="mb-4">
                <label for="password" class="form-label mt-1">Password</label> <!-- Agrega una etiqueta para el campo de contraseña -->
                <input type="password" class="form-control mt-3" id="password" name="password" placeholder="Ingresar Contraseña"> <!-- Crea un campo de entrada de contraseña -->
            </div>

            <input type="submit" name="loginButton" id="loginButton" class="btn btn-success form-control mt-2" value="Iniciar Sesión"> <!-- Crea un botón para iniciar sesión -->
        </form>
    </div>

    <!-- Incluye el archivo JavaScript de Bootstrap desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>