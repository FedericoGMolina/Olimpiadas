<?php
    session_start(); // Iniciar la sesión
    include "./config/bd.php";


    $message = ""; // Variable para almacenar mensajes de error o éxito

    if (isset($_POST['loginButton'])) 
    {
        $username = $_POST['usuario'];
        $password = $_POST['password'];
        
        $db = new mysqli(SERVER, USER, PASS, BD);
        if ($db->connect_error) 
        {
            die("Error de conexión: " . $db->connect_error);
        }
    
        // Consulta SQL para buscar el usuario en la base de datos
        $query = "SELECT * FROM empleado WHERE usuario='$username'";
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
        } 
        else 
        {
            // Usuario no encontrado

            $message = "Usuario no encontrado. Por favor, regístrate.";
        }
    }
?>


<!DOCTYPE html> <!-- Declara el tipo de documento como HTML5 -->
<html lang="es"> <!-- Define el idioma de la página como español (es) -->
<head>
    <meta charset="UTF-8"> <!-- Configura la codificación de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Establece las propiedades de la ventana gráfica para dispositivos móviles -->
    <title>Login</title> <!-- Establece el título de la página en la barra de título del navegador -->
    <?php include "./config/links.php"; ?>
    <?php if (!empty($message)) : ?>
    <p class="message"></p>
    <?php echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: '".$message."',
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>";
                ?>
    <?php endif; ?>

</head>

<body>

<div id="content">
        <?php
            if(isset($_GET['view']))
            {
                $content=$_GET['view'];
                $WhiteList=["rpw, inicio"];

                if(in_array($content, $WhiteList) && is_file("./views/".$content."-view.php"))
                {
                    include "./views/".$content."-view.php";
                }
                else
                {
                    ?>
                    <div class="container">
                        <div class="row">
                        <div class="text-center">
                                <h1 class="text-danger">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h1>
                                <h3 class="text-info">Por favor intente nuevamente</h3>
                            </div>
                                <img src="./Inicio/Imagenes/corazonOffline.png" alt="Image" class="img-responsive"/><br>

                 
                            <div class="col-sm-1">&nbsp;</div>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                include "./views/index-view.php";
            }
        ?>
</div>
  
</body>

</html>