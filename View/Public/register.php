<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../Styles/registerstyle.css">
    <script src="../JS/register.js"></script>
    <title>Vista de registro</title>
</head>

<body>
    <!-- contenedor de formulario -->
    <div id="login-form" class="container mb-5">
        <h3 id="form title" class="display-1 text-center mb-5">Zona de registro</h3>
        <form id="form" action="../../Bussiness/accountaction.php" method="post">
            <div class="mb-3">
            <?php
                if(isset($_GET['r_m'])){
                    if($_GET['r_m'] == 'r'){
                        echo "<p style='color:green'>Registro exitoso :)</p>";
                    }else{
                        if($_GET['r_m'] == 'e'){
                            echo "<p style='color:red'>Lo sentimos, ya existe una cuenta con este nombre de usuario</p>";
                        }else{
                            echo "<p style='color:red'>Ha ocurrido un error, por favor asegurese de ingresar la informacion que se le solita correctamente.</p>";
                        }
                    }
                }
            ?>
                <div style="width:400px" class="container mb-3">
                <h1 class="display-6">Datos personales</h1>
                    <div class="mb-3">
                        <!-- Direccion y numero de telefono -->
                        <input required class="form-control mb-3" name="name" id="name" type="text" placeholder="Nombre">
                        <input required class="form-control mb-3" name="lastname" id="lastname" type="text" placeholder="Apellidos">
                        <input required class="form-control mb-3" name="address" id="address" type="text" placeholder="Dirección de residencia">
                        <input required class="form-control" name="phonenumber" id="phonenumber" type="number" placeholder="Ingrese su numero de telefono">
                    </div>

                    <h1 class="display-6">Usuario y contraseña</h1>
                    <label for="Username">Usuario:</label>
                    <input placeholder="Ingrese su usuario" class="form-control mb-3" type="text" name="user" id="Username" required>
                    <label for="password">Contraseña:</label>
                    <input placeholder="Ingrese su Contraseña" class="form-control mb-3" type="password" name="password" id="password" required>
                    <label for="password">Confirmar Contraseña:</label>
                    <input placeholder="Vuelva a ingresar su Contraseña" class="form-control mb-3" type="password" name="confirm" id="confirm" onkeyup="validateConfirmPassword()" required>
                    <div id="confirm-message">

                    </div>
                    <!-- Variables hidden -->
                    <input type="hidden" name="action" value="save">
                    
                    <div class="text-center">
                        <!-- Boton de enviar -->
                        <input class="btn btn-success" type="button" value="Registrarme" onclick="sendData()">
                        <a href="./login.php" class="btn btn-dark" type="submit">Volver</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Script javascript de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
</body>

</html>