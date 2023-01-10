<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./Styles/navstyle.css">
    <link rel="stylesheet" href="./Styles/clienthomestyle.css">

    <script src="./JS/orderform.js"></script>

    <title>Inicio de cliente</title>
    <?php
    include_once "../Bussiness/accountbussiness.php";
    include_once "../Bussiness/orderbussiness.php";
    include_once "../Bussiness/inventarybussiness.php";
    ?>
</head>

<body>
    <?php
    $accountBussiness = new AccountBussiness();


    ?>
    <nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div id="nav-container" class="container">
            <a class="navbar-brand" href="#container-carousel">
                <img src="../Images/facebook_cover_photo_1.png" alt="" width="120" height="40" class="d-inline-block align-text-top">
            </a>
            <!-- <a id="icon" href="#container-carousel" class="navbar-brand"></a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-center" style="width:100%">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#order-row">
                            <p>Historial de ordenes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Public/login.php">
                            <p>Salir</p>
                        </a>
                    </li>
                </ul>
                <div class="text-center">
                    <div style="color:green; width:100px;"><?php echo $accountBussiness->getUserName($_GET['u_i']) ?></div>

                </div>
            </div>
        </div>
    </nav>
    <!-- Carousel a mano -->
    <div class="slider-container">
        <h1 class="display-6 text-center">Lo que te ofrecemos</h1>
        <div class="slider">
            <div class="slide-track">
                <?php
                $inventaryBussiness = new InventaryBussiness();
                $products = $inventaryBussiness->getInventary();
                $accountand = 0;
                foreach ($products as $product) {
                ?>
                <div class="slide">
                    <img src="../Images/Pizzas/<?php echo $product->getImagePath() ?>"/>
                    <div class="text">
                        <p class="display-6">
                            <?php echo $product->getName() ?>
                        </p>
                    </div>
                </div>
                <?php 
                }
                ?>
            </div>
        </div>
    </div>

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
        <form id="form" action="./clienthome.php?u_i=<?php echo $_GET['u_i'] ?>#order-title" method="post">
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
                        <select class="form-control" name="pizzas[]" id="pizza">
                            <option value="Seleccionar">Seleccionar</option>
                            <?php
                                foreach($pizzas_ as $pizza){
                                    echo '<option value="'.$pizza->getID().'">'.$pizza->getName().'</option>';
                                }
                            ?>
                        </select>

                        <label for="size" class="form-label">Seleccione una tamaño</label>
                        <select class="form-control" name="sizes[]" id="size">
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
                        <select class="form-control" name="beverages[]" id="beverage">
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
                <select class="form-control" name="beverages[]" id="beverage">
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
                <h1 class="display-6">¿Necesita servicio express?</h1>
                <select class="form-control mb-3" name="xpress" id="xpress">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
               <h1 class="display-6">¿Desea comentar, solicitar o especificar algo mas sobre su pedido?</h1>
                <textarea class="form-control" id="comment" name="comment"><?php if(isset($_POST['comment'])) echo $_POST['comment'] ?></textarea>
            
            </div>
           <div class="text-center">
               <!-- Variables hidden -->
               <input type="hidden" name="action" value="save">
               <input type="hidden" name="clientid" value="<?php echo $_GET['u_i'] ?>">
               <div id="message">
                </div>
               <!-- Boton de enviar -->
               <input class="btn btn-success" type="button" onclick="doOrderClient()" value="Realizar orden">
           </div>
        </form>
    </div>
   <!-- Fila de cards para ordenes -->
   <div id="order-row" class="row mb-5">
            <!-- Cards -->
            <h3 class="display-1 text-center mb-5 mt-5">Historial de ordenes</h3>
            
            <div id="cards-row" class="row">
                <!-- Columna 1 -->
                <?php
                $orderBussiness = new OrderBussiness();
                $inventaryBussiness = new InventaryBussiness();

                $orders = $orderBussiness->getOrdersByClient($_GET['u_i']);
                $pizzas = "";
                $beverages="";
                $pizza;
                $size;
                $beverage;
                if(empty($orders) == false){
                    // For para recorrer cada orden-------------------------------------
                    foreach($orders as $order){
                        $pizzas = "";
                        // Obtenemos id de pizzas
                        $pizzasID = explode("-", $order->getPizza());
                        // Obtenemos id de los tamaños de la pizza
                        $sizesID = explode("-", $order->getSize());
                        
                        // Recibimos el objeto pizza
                        $pizza = $inventaryBussiness->getProduct($pizzasID[0]);
                        $pizzas .= $pizza->getName();//Extraemos nombre de la pizza

                        // Recibimos el objeto size
                        $size = $inventaryBussiness->getProduct($sizesID[0]);//Extraemos size
                        $pizzas .= "(".$size->getName().")<br>";//Extraemos nombre de tamanio
                        
                        // Concatenamos el resto de nombres de pizza con su tamanio especifico
                        for($i=1; $i<sizeof($pizzasID); $i++){
                            $pizza = $inventaryBussiness->getProduct($pizzasID[$i]);
                            $size = $inventaryBussiness->getProduct($sizesID[$i]);//Extraemos size
                                
                            $pizzas .= $pizza->getName()."(".$size->getName().")<br>";
                            
                        } 
                        
                        // Alistamos las bebidas
                        $beverages = "";
                        // Obtenemos id de bebidas
                        $beveragesID = explode("-", $order->getBeverage());
                        // Recibimos el objeto bebida
                        if(strcmp($beveragesID[0], "Ninguno") != 0){
                            $beverage = $inventaryBussiness->getProduct($beveragesID[0]);
                            $beverages .= $beverage->getName()."<br>";//Extraemos nombre de la bebida
                             // Concatenamos el resto de nombres de pizza con su tamanio especifico
                             for($i=1; $i<sizeof($beveragesID); $i++){
                                $beverage = $inventaryBussiness->getProduct($beveragesID[$i]);
                                    
                                $beverages .= $beverage->getName()."<br>";
                                
                            }
                        }
                    // ---------------------------------------------------------------
                        
                ?>
                <div class="card mt-2 mb-3" style="<?php echo 'background-color:'.$color ?>" id="<?php echo $order->getID() ?>">
                    <div class="container text-center mt-3">
                        <ion-icon id="card-icon" size="large" name="pizza-outline"></ion-icon>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $pizzas ?></h5>
                        <!-- Etiqueta html para listas de concepto-definicion (Refresco: no) -->
                        <dl>
                            <dt>Refresco:</dt>
                            <dd><?php echo $beverages ?></dd>
                            <dt>Comentario:</dt>
                            <dd><?php echo $order->getComment() ?></dd>
                        </dl>
                    </div>
                </div>
                <?php 
                    }
                }else{
                    echo "<h1 style='color:green' class='display-6 text-center'>Su ordenes realizadas aparecerán aquí</h1>";
                }
                ?>
            </div><!-- Fin de contenedor row (cards) -->
    </div><!-- Fin de contenedor row (apartado de ordenes) -->

    <footer class="container-fluid bg-dark">
        <div class="row">

            <div style="color:white" class="col text-center">
                <h1 class="lead">Contáctanos</h1>
                <span>
                    <ion-icon name="call-outline"></ion-icon>+506 61051138
                </span>

            </div>
            <div style="color:white" class="col text-center">
                <h1 class="lead">Síguenos</h1>
                <a href="">
                    <ion-icon size="large" name="logo-facebook"></ion-icon>
                </a>

            </div>
            <div style="color:white" class="col text-center">
                <h1 class="lead">Página creada por:</h1>

                <a class="navbar-brand" href="#">
                    <img src="../Images/facebook_cover_photo_1.png" alt="" width="150" height="50" class="d-inline-block align-text-top">
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