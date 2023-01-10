<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./View/Styles/navstyle.css">
    <link rel="stylesheet" href="./View/Styles/homestyle.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <script src="./View/JS/scrollreveal.js"></script> -->
    
    <?php 
        include_once "./Bussiness/inventarybussiness.php";
    ?>
    <title>Pizzeria team code</title>
</head>
<body>

    <nav data-aos="fade-left" data-aos-duration="3000" id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div id="nav-container" class="container">
            <a class="navbar-brand" href="#container-carousel">
                <img src="./Images/facebook_cover_photo_1.png" alt="" width="120" height="40" class="d-inline-block align-text-top">
            </a>
            <!-- <a id="icon" href="#container-carousel" class="navbar-brand"></a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-center" style="width:100%"> 
                    <li class="nav-item">
                        <a id="a-navbar" class="nav-link" href="#container-carousel"><p>Inicio</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu-title"><p>Menú</p></a>
                    </li>
                    <li class="nav-item">
                        <a style="color:rgb(0, 173, 181)" class="nav-link" href="./View/forms/orderform.php"><p>Realizar orden</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#staff-title"><p>Nuestro staff</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ubication-title"><p>Ubíquenos</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./View/Public/about.php"><p>Sobre nosotros</p></a>
                    </li>
                </ul>
                <div class="text-center">
                    <a href="./View/Public/login.php"><ion-icon style="color:rgb(0, 173, 181)" size="large" name="person-circle-outline"></ion-icon></a>
                    
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenedor para carousel -->
    <div data-aos="fade-right" data-aos-duration="3000" id="container-carousel" class="container-fluid">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div id="carousel-item" class="carousel-item active">
                    <p class="display-4">Registrese para enviar sus ordenes más rápido</p>
                </div>
                <div id="carousel-item2" class="carousel-item">
                    <p class="display-4">Lleve registro de sus ordenes realizadas</p>
                </div>
                <div id="carousel-item3" class="carousel-item">
                    <p class="display-4">Esté al tanto de nuestras ofertas y noticias</p>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Contenedor para productos -->
    <h3 data-aos="fade-right" data-aos-duration="1000" id="menu-title" class="display-1 text-center mb-5 mt-5">Nuestro menú</h3>
    <div data-aos="fade-right" data-aos-duration="1000" id="pizzas" class="container-fluid">
        <?php
            $bussiness = new InventaryBussiness();
            $products = $bussiness->getInventary();
            foreach($products as $product){
        ?>
        <div class="card mt-3" style="width: 18rem;">
                <img src="./Images/Pizzas/<?php echo $product->getImagePath() ?>" class="card-img-top">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo $product->getName() ?></h5>
                    <p class="card-text"><?php echo $product->getDescription() ?></p>
                    <form action="././View/forms/orderform.php"" method="post">
                        <input type="hidden" name="pizzas[]" value="<?php echo $product->getID() ?>">
                        <!--<input type="hidden" name="add-pizza" value="add-pizza">-->
                        <input class="btn btn-info" type="submit" value="Ordenar">
                    </form>
                </div>
        </div>
        <?php
            }
        ?>
    </div>

    <!-- Contenedor para el staff -->
    <h3 data-aos="fade-right" data-aos-duration="3000" id="staff-title" class="display-1 text-center mb-5">Staff</h3>
    <div data-aos="fade-right" data-aos-duration="3000" id="staff-container" class="container mt-1">
        <div class="row">
            <div id="staff" class="col">
                <!--<img id="staff" src="./Images/Staff/Jafet.jpg" width="210" height="200" alt="">-->
                <ion-icon style="width:150px;height:150px" size="large" name="people-circle-outline"></ion-icon>
                Jafet Lara
            </div>
            <div class="col">
                <!--<img id="staff" src="./Images/Staff/Luis.jpeg" width="200" height="200" alt="">-->
                <ion-icon style="width:150px;height:150px" size="large" name="people-circle-outline"></ion-icon>
                Luis Valerio
            </div>
            <div class="col">
                <!--<img id="staff" src="./Images/Staff/Yimy.jpeg" width="210" height="200" alt="">-->
                <ion-icon style="width:150px;height:150px" size="large" name="people-circle-outline"></ion-icon>
                Yimy Gutierrez
            </div>
        </div>
    </div>

    <!-- Contenedor para la ubicacion -->
    <h1 data-aos="fade-right" data-aos-duration="2000" id="ubication-title" class="display-1 text-center">Ubíquenos</h1>
    <div data-aos="fade-right" data-aos-duration="2000" id="ubication-container" class="container">
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1962.2092509991094!2d-83.97205648370027!3d10.388297217173438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7f58f9613b2ddbe7!2zMTDCsDIzJzE3LjkiTiA4M8KwNTgnMTYuMSJX!5e0!3m2!1ses-419!2scr!4v1644174870006!5m2!1ses-419!2scr" style="border:0;width:100%;height:100%;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div id="ubication-text">
                <p>
                   Nos ubicamos en la chavez, horquetas de sarapiquí 
                </p>
        </div>
    </div>

    <footer id="footer" class="container-fluid bg-dark">
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
                    <img src="./Images/facebook_cover_photo_1.png" alt="" width="150" height="50" class="d-inline-block align-text-top">
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
    <!-- JS para animaciones local Scroll reveal -->
    <!-- <script src="./View/JS/index.js"></script> -->
    <!-- Script para animaciones de aos js -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>