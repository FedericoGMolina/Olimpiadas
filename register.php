<?php
if (isset($_POST['registerButton'])) 
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Conectar a la base de datos (reemplaza con tus propias credenciales)
    $db = new mysqli('localhost', 'root', '', 'test');
    if ($db->connect_error) {
        die("Error de conexión: " . $db->connect_error);
    }
    // Verificar si el usuario ya existe
    $query = "SELECT * FROM empleados WHERE usuario='$username'";
    $result = $db->query($query);

    if ($result->num_rows > 0)
    {
        echo " <script> alert('El usuario ya existe.')</script>";

    } else {
        // Insertar el nuevo usuario en la base de datos
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertQuery = "INSERT INTO usuarios (User, Password) VALUES ('$username', '$hashedPassword')";
        
        if ($db->query($insertQuery)) {
            echo " <script> alert('Registro exitoso.')</script>";
        } else {
            echo "<script> alert('Error en el registro.')</script>";
        }
    }
    // Cerrar la conexión a la base de datos
    $db->close();
}
?>

<!DOCTYPE html> <!-- Declara el tipo de documento como HTML5 -->
<html lang="en"> <!-- Define el idioma de la página como inglés (en) -->

<head>
    
    <meta charset="UTF-8"> <!-- Configura la codificación de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Establece las propiedades de la ventana gráfica para dispositivos móviles -->
    <title>Register</title> <!-- Establece el título de la página en la barra de título del navegador -->
    <?php if (!empty($message)) : ?>
        <p class="message"><?= $message?></p>
    <?php endif;?>
    <!-- Incluye el archivo CSS de Bootstrap 5.3.2 desde un CDN (Content Delivery Network) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <div class="container text-center"> <!-- Crea un contenedor centrado en el centro de la página -->

        <img src="Inicio/Imagenes/cruz-azul.png" alt="" class="mt-3" width="180px" height="180px"> <!-- Inserta una imagen -->
        <h1 class="mt-4">Register</h1> <!-- Agrega un título "Register" -->

        <form id="registerForm" class="mt-4" method="post" action="">

            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Ingresar Usuario">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresar Contraseña">
            </div>
        
            <input type="submit" class="btn btn-success form-control mt-2" id="registerButton" name="registerButton" value="Registrarse">
            <a href="index.php" class="btn btn-link form-control mt-2">¿Ya tienes una cuenta? Iniciar Sesión.</a>

        </form>

    </div>

    <!-- Incluye el archivo JavaScript de Bootstrap desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

