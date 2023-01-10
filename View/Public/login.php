<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../Styles/navstyle.css">
    <link rel="stylesheet" href="../Styles/loginstyle.css">
    
    <title>Pizzeria Pentagon</title>
</head>
<body>

    <nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div id="nav-container" class="container">
            <a class="navbar-brand" href="../../">
                <img src="../../Images/facebook_cover_photo_1.png" alt="" width="120" height="40" class="d-inline-block align-text-top">
            </a>
            <!-- <a id="icon" href="#container-carousel" class="navbar-brand"></a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-center" style="width:100%"> 
                    <li class="nav-item">
                        <a id="a-navbar" class="nav-link" href="../../"><p>Inicio</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../#pizzas"><p>Menú</p></a>
                    </li>
                    <li class="nav-item">
                        <a style="color:rgb(0, 173, 181)" class="nav-link" href="../forms/orderform.php"><p>Realizar orden</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../#staff-container"><p>Nuestro staff</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../#ubication-title"><p>Ubíquenos</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Public/about.php"><p>Sobre nosotros</p></a>
                    </li>
                </ul>
                <div class="text-center">
                    <a href="./login.php"><ion-icon style="color:rgb(0, 173, 181)" size="large" name="person-circle-outline"></ion-icon></a>
                    
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenedor para Login -->
    <div id="container-login" class="container">
        <form action="../../Bussiness/accountaction.php" method="post">
            <div class="mb-3 text-center">
                <h1 class="display-6">Usuario</h1>
                <input class="form-control mb-3" name="user" type="text" placeholder="Ingrese su nombre de usuario">
                
                <h1 class="display-6">Contraseña</h1>
                <input class="form-control mb-3" name="password" type="password" placeholder="Ingrese su contraseña">
            </div>
            <div class="text-center">
                <!-- Variables ocultas -->
                <input type="hidden" name="action" value="validate">
                <!-- Boton de enviar -->
                <input class="btn" id="btn" type="submit" value="Ingresar">
                <a class="btn btn-dark" role="button" href="../../">Volver</a>
            </div>
        </form>
    </div>
    <div id="register-link" class="container text-center">
        <?php
        // Si viene la variable con algo
            if(isset($_GET['e_m'])){
                // Si la variable trae una 'u'
                if($_GET['e_m'] == 'u'){
                    echo "<p style='color:red'>No existe una cuenta registrada con los datos indicados. Por favor asegurese de ingresarlos correctamente</p>";
                }
            }
        ?>
        ¿No tienes una cuenta? <a href="./register.php">Registrate</a>

    </div>

    <footer class="container-fluid bg-dark">
        <div class="row">
            
            <div class="col text-center">
                <h1 class="lead">Contáctanos</h1>
                <span><ion-icon name="call-outline"></ion-icon>+506 61051138</span>
                
            </div>
            <div class="col text-center">
                <h1 class="lead">Síguenos</h1>
                <a href=""><ion-icon size="large" name="logo-facebook"></ion-icon></a>

            </div>
            <div class="col text-center">
                <h1 class="lead">Página creada por:</h1>

                <a class="navbar-brand" href="#">
                    <img src="../../Images/facebook_cover_photo_1.png" alt="" width="150" height="50" class="d-inline-block align-text-top">
                </a>    
            </div>
        </div>
        <div class="row">
            ©2022
        </div>
    </footer>
    <!-- ICONOS -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Script javascript de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
</body>
</html>