<?php if (!isset($_SESSION['usuario']))
{ ?>
<div class="container-fluid text-center" id="idIndex"> <!-- Crea un contenedor fluido que centra su contenido y se adapta al ancho de la pantalla -->
        <img src="./imagenes/corazon.png" alt="" class="mt-2" id="corazon" height="190px"> <!-- Inserta una imagen -->
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

            <input type="button" name="loginButton" id="loginButton" class="btn btn-success form-control mt-2" value="Iniciar Sesión"> <!-- Crea un botón para iniciar sesión -->
        </form>
</div>
<?php } 
else 
{
    include "./views/inicio-view.php";
}
?>

<script>
    const btnLogin = document.getElementById('loginButton');   
    $('#usuario, #password').keyup(function(event) 
    {
        if (event.keyCode === 13) 
        { 
            Login();
        }
    });
    btnLogin.addEventListener('click', () => 
        {
            Login();
        }
            
    );


    function Login()
    {

        var user = document.getElementById('usuario').value;
            var pw = document.getElementById('password').value;
            if ((user.trim() === '')  || (pw.trim() === '') )
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
                        url: './process/user/login.php',

                        data: 
                        {
                            user,
                            pw,
                        },
                        success: function(response) 
                        {
                            var result = JSON.parse(response);
                            var status = result.status;
                            if (status === 'OK') 
                            {
                                Swal.fire
                                (
                                    {
                                        icon: 'success',
                                        title: 'Sesion iniciada con exito.',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }
                                )
                                .then(function() 
                                    {
                                        location.reload();
                                    }
                                );
                            }
                            else
                            {
                                Swal.fire(
                                {
                                    icon: 'error',
                                    title: 'No se ha podido iniciar sesion.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }
                            )
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) 
                        {
                            Swal.fire
                            (
                                {
                                    icon: 'error',
                                    title: 'No se ha podido iniciar sesion.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }
                            )
                        }
                    
                    }
                );
            }

    }
</script>