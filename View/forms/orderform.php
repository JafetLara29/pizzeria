<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../Styles/navstyle.css">
    <link rel="stylesheet" href="../Styles/orderform.css">
    <script src="../JS/orderform.js"></script>
    <?php
        include "../../Bussiness/inventarybussiness.php";
    ?>
    <title>Realizar orden</title>
</head>
<body>

    <nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div id="nav-container" class="container">
            <a class="navbar-brand" href="../../#container-carousel">
                <img src="../../Images/facebook_cover_photo_1.png" alt="" width="120" height="40" class="d-inline-block align-text-top">
            </a>
            <!-- <a id="icon" href="#container-carousel" class="navbar-brand"></a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-center" style="width:100%"> 
                    <li class="nav-item">
                        <a id="a-navbar" class="nav-link" href="../../#container-carousel"><p>Inicio</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../#pizzas"><p>Menú</p></a>
                    </li>
                    <li class="nav-item">
                        <a style="color:rgb(0, 173, 181)" class="nav-link" href="./orderform.php"><p>Realizar orden</p></a>
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
                    <a href="../Public/login.php"><ion-icon style="color:rgb(0, 173, 181)" size="large" name="person-circle-outline"></ion-icon></a>
                    
                </div>
            </div>
        </div>
    </nav>
    <!-- Contenedor para formulario de ordenes -->
    <div id="order-form" class="container mb-5">
        <h3 id="form-title" class="display-1 text-center mb-5">Realice su orden</h3>
        
        <?php
        $bussiness = new InventaryBussiness();

        $pizzas = [];
        $sizes = [];
        $beverages = [];
        if(isset($_POST['pizzas'])){
            $pizzas = $_POST['pizzas'];
        }
        if (isset($_POST["sizes"])) {
            $sizes = $_POST["sizes"];
            
        }
        if (isset($_POST["beverages"])) {
            $beverages = $_POST["beverages"];   
        }
        ?>
        <form id="form" action="./orderform.php#order-title" method="post">
            <div class="mb-3">
                <h1 id="order-title" class="display-6">Datos de la orden</h1>
                <?php
                    if(isset($_GET['r_m'])){
                        if($_GET['r_m'] == 'r'){
                            echo "<p style='color:green' class='text-center'>Se envió la orden de manera exitosa</p>";
                        }else{
                            if($_GET['r_m'] == 'p'){
                                echo "<p style='color:red' class='text-center'>Ha ocurrido un error al procesar la orden. Por favor, revise que todas las pizzas tengan un tamaño seleccionado antes de enviar.</p>";
                            }else{
                                if($_GET['r_m'] == 'n'){
                                    echo "<p style='color:red' class='text-center'>Ha ocurrido un error al procesar la orden, si el problema persiste por favor contactenos</p>";
                                }
                            }
                            
                        }
                        
                    }
                    $accountand = 0;
                    // Obtenemos pizzas de la base de datos
                    $pizzas_ = $bussiness->getPizzas();
                    
                    foreach ($pizzas as $pizza) {
                        if(strcmp($pizza, "Seleccionar") != 0){
                ?>
                        <label for="pizza" class="form-label">Seleccione una pizza</label>
                        <select class="form-control" name="pizzas[]" id="pizza">
                            <option value="Seleccionar">Seleccionar</option>
                            <?php
                                foreach($pizzas_ as $pizza_){
                                    if($pizza == $pizza_->getID()){
                                        echo '<option selected value="'.$pizza_->getID().'">'.$pizza_->getName().'</option>';
                                    }else{
                                        echo '<option value="'.$pizza_->getID().'">'.$pizza_->getName().'</option>';

                                    }
                                }
                            ?>
                        </select>

                        <label for="size" class="form-label">Seleccione una tamaño</label>
                        <select class="form-control" name="sizes[]" id="size">
                            <option value="Seleccionar">Seleccionar</option>
                            <?php
                                $sizes_ = $bussiness->getSizes();
                                foreach($sizes_ as $size_){
                                    if(strcmp($sizes[$accountand], $size_->getID()) == 0){
                                        echo '<option selected value="'.$size_->getID().'">'.$size_->getName().'</option>';        
                                    }else{
                                        echo '<option value="'.$size_->getID().'">'.$size_->getName().'</option>';        

                                    }
                                }
                            ?>
                        </select><br>
                <?php
                        }
                        $accountand++; 
                    }
                    if(isset($_POST['add-pizza'])){                    
                ?>
                        <!-- Inputs que se agregan -->
                        <label for="pizza" class="form-label">Seleccione una pizza</label>
                        <select required class="form-control bg-dark text-light" name="pizzas[]" id="pizza">
                            <option value="Seleccionar">Seleccionar</option>
                            <?php
                                foreach($pizzas_ as $pizza){
                                    echo '<option value="'.$pizza->getID().'">'.$pizza->getName().'</option>';
                                }
                            ?>
                        </select>

                        <label for="size" class="form-label">Seleccione una tamaño</label>
                        <select required class="form-control bg-dark text-light" name="sizes[]" id="size">
                            <option value="Seleccionar">Seleccionar</option>
                            <?php
                                $sizes_ = $bussiness->getSizes();
                                foreach($sizes_ as $size_){
                                    echo '<option value="'.$size_->getID().'">'.$size_->getName().'</option>';        
                                    
                                }
                            ?>
                        </select>
                <?php }?>
                <div id="add-pizza">
                    Seleccione + para agregar pizza a la orden
                </div>
                <input class="btn btn-success" type="submit" name="add-pizza" value="+">
                <br>
                <?php
                    $beverages_ = $bussiness->getBeverage();

                    foreach ($beverages as $beverage) {
                        if(strcmp($beverage, "Seleccionar") != 0){
                            
                ?>
                        <label for="veberage" class="form-label">Seleccione un refresco</label>
                        <select required class="form-control" name="beverages[]" id="beverage">
                            <option value="Seleccionar">Seleccionar</option>
                            <?php
                                foreach($beverages_ as $beverage_){
                                    if($beverage == $beverage_->getID()){
                                        echo '<option selected value="'.$beverage_->getID().'">'.$beverage_->getName().'</option>';
                                    }else{
                                        echo '<option value="'.$beverage_->getID().'">'.$beverage_->getName().'</option>';
                                    } 
                                }
                            ?>
                            
                        </select><br>
                <?php
                        }
                    }
                    if(isset($_POST['add-beverage'])){
                ?>
                <label for="veberage" class="form-label">Seleccione un refresco</label>
                <select class="form-control bg-dark text-light" name="beverages[]" id="beverage">
                    <option value="Seleccionar">Seleccionar</option>
                    <?php
                        foreach($beverages_ as $beverage_){
                            echo '<option value="'.$beverage_->getID().'">'.$beverage_->getName().'</option>';
                        }
                    ?>
                </select>
                <?php } ?>
                <div id="add-beverage">
                    Seleccione + para agregar refresco a la orden
                </div>
                <input class="btn btn-success" type="submit" name="add-beverage" value="+">
                <br>
            </div>

            <div class="mb-3">
                <h1 class="display-6">Datos de domicilio y contacto</h1>
                <input class="form-control mb-3" id="name" name="name" type="text" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>" placeholder="Nombre de la persona que recibirá la orden">
                <input class="form-control mb-3" id="lastname" name="lastname" type="text" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'] ?>" placeholder="Ingrese los apellidos">
                <h1 class="display-6">¿Necesita servicio express?</h1>
                <select class="form-control mb-3" onchange="addInputAddress()" name="xpress" id="xpress">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
                <div id="address-container">
                    <!-- Direccion -->
                </div>
                <input class="form-control" id="phonenumber" name="phonenumber" type="number" value="<?php if(isset($_POST['phonenumber'])) echo $_POST['phonenumber'] ?>" placeholder="Ingrese su numero de telefono">
                <h1 class="display-6">¿Desea comentar, solicitar o especificar algo mas sobre su pedido?</h1>
                <textarea class="form-control" id="comment" name="comment"><?php if(isset($_POST['comment'])) echo $_POST['comment'] ?></textarea>
                        
            </div>
           <div class="text-center">
               <!-- Variables hidden -->
               <input type="hidden" name="action" value="save-public">
               
               <div id="message">
                </div>
               <!-- Boton de enviar -->
               <input class="btn btn-success" type="button" onclick="doOrder()" value="Realizar orden">
           </div>
        </form>
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