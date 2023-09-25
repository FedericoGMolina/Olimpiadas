<?php
    session_start(); // Iniciar la sesión
    include './config/class_mysql.php';
    include './config/db.php';
?>


<!DOCTYPE html> <!-- Declara el tipo de documento como HTML5 -->
<html lang="es"> <!-- Define el idioma de la página como español (es) -->
<head>
    <meta charset="UTF-8"> <!-- Configura la codificación de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Establece las propiedades de la ventana gráfica para dispositivos móviles -->
    <title>Login</title> <!-- Establece el título de la página en la barra de título del navegador -->

    <?php include "./config/links.php";?>

</head>


<body class="col-12">
<?php include "./inc/navbar.php";?>

<div id="content">

        <?php
            if(isset($_GET['view']))
            {
                $content=$_GET['view'];
                $WhiteList=["rpw", "inicio", "ingreso", "pAdmin", "reportes", "ingresos", "pacientes"];

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
                                <img src="./imagenes/corazonOffline.png" alt="Image" class="img-responsive"/><br>
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