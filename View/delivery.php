<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../View/Styles/navstyle.css">
    <link rel="stylesheet" href="../View/Styles/delivery.css">
    <?php
    include_once "../Bussiness/orderbussiness.php";
    include_once "../Bussiness/accountbussiness.php";
    include_once "../Bussiness/inventarybussiness.php";
    include_once "../Domain/client.php";
    ?>
    <title>Delivery</title>
</head>

<body>
    <!-- Navbar -->
    <nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div id="nav-container" class="container">
            <a class="navbar-brand" href="#">
                <img src="../Images/facebook_cover_photo_1.png" alt="" width="120" height="40" class="d-inline-block align-text-top">
            </a>
            <!-- <a id="icon" href="#container-carousel" class="navbar-brand"></a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-center" style="width:100%">
                    <li class="nav-item">
                        <a class="nav-link" href="#current-deliveries">
                            <p>Pendientes</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#finished-deliveries">
                            <p>Entregados</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="a-navbar" class="nav-link" href="./Public/login.php">
                            <p>Salir</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    $bussiness = new OrderBussiness();
    $aBussiness = new AccountBussiness();
    $inventaryBussiness = new InventaryBussiness(); 

    $orders = $bussiness->getOrderForDelivery();
    ?>
    <!-- Current Deliveries -->
    <div id="current-deliveries" class="container-fluid">
        <!-- Fila 1 -->
        <div id="row-1" class="row">
            <h3 class="display-1 text-center mb-5">Pendientes</h3>
            
            <!-- Columna 1 -->
            <div class="col mt-5">
                <?php
                if(empty($orders) == false){
                 $date = date("Y-m-d");
                 echo "<p class='display-6'>".$date."</p>";
                 $beverages="";
                 $pizza;
                 $size;
                 $beverage;
                foreach ($orders as $order) {
                    if(strcmp($order->getClientName(), "-") == 0){
                        $client = $aBussiness->getClient($order->getClientID());
                    }else{
                        $client = new Client(0, $order->getClientName(), $order->getClientLastName(), $order->getClientPhoneNumber(), $order->getClientAddress());
                    }
                ?>
                    <div class="card mb-3">
                        <div id="card-header" class="text-center">
                            <ion-icon name="bicycle"></ion-icon>
                        </div>
                        <div class="card-body text-center">
                            <dl>
                                <dt>Cliente:</dt>
                                <dd><?php echo $client->getName()." ".$client->getLastName(); ?></dd>
                                <dt>Dirección:</dt>
                                <dd><?php echo $client->getAddress(); ?></dd>
                                <dt>Telefono:</dt>
                                <dd><?php echo $client->getPhoneNumber(); ?></dd>
                                <dt>Orden:</dt>
                                <?php 
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
                                    if(strcmp($beveragesID[0], "Ninguno") != 0){
                                        // Recibimos el objeto bebida
                                        $beverage = $inventaryBussiness->getProduct($beveragesID[0]);
                                        $beverages .= $beverage->getName()."<br>";//Extraemos nombre de la bebida
                                        // Concatenamos el resto de nombres de pizza con su tamanio especifico
                                        for($i=1; $i<sizeof($beveragesID); $i++){
                                            $beverage = $inventaryBussiness->getProduct($beveragesID[$i]);
                                                
                                            $beverages .= $beverage->getName()."<br>";
                                            
                                        } 
                                    }
                                ?>
                                <dd><?php echo $pizzas ?></dd>
                                
                                <dd><?php echo $beverages ?></dd>

                            </dl>

                        </div>
                        <div id="card-footer">
                            <form action="../Bussiness/orderaction.php" method="post">
                                <input type="hidden" name="action" value="changestate">
                                <input type="hidden" name="v" value="delivery">
                                <input type="hidden" name="state" value="3">

                                <input type="hidden" name="id" value="<?php echo $order->getID() ?>">
                                <button class="btn text-center form-control" type="submit">
                                    <ion-icon name="checkmark-circle-outline"></ion-icon>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php
                }
            }else{
                echo "<p class='display-6 text-center'>No tienes ordenes para entregar</p>";
            }
                ?>
            </div>
        </div>

    </div>

    <!-- Finished Deliveries -->
    <div id="finished-deliveries" class="container-fluid">
        <!-- Fila 1 -->
        <div id="row-1" class="row">
            <h3 class="display-1 text-center mb-5">Entregados</h3>
            <?php
                $orders = $bussiness->getReadyOrderForDelivery();
                if(empty($orders) == false){
                 $beverages="";
                 $pizza;
                 $size;
                 $beverage;
                foreach ($orders as $order) {
                    if(strcmp($order->getClientName(), "-") == 0){
                        $client = $aBussiness->getClient($order->getClientID());
                    }else{
                        $client = new Client(0, $order->getClientName(), $order->getClientLastName(), $order->getClientPhoneNumber(), $order->getClientAddress());
                    }
                ?>
                    <div class="card mb-3">
                        <div id="card-header" class="text-center">
                            <ion-icon name="bicycle"></ion-icon>
                        </div>
                        <div class="card-body text-center">
                            <dl>
                                <dt>Cliente:</dt>
                                <dd><?php echo $client->getName()." ".$client->getLastName(); ?></dd>
                                <dt>Dirección:</dt>
                                <dd><?php echo $client->getAddress(); ?></dd>
                                <dt>Telefono:</dt>
                                <dd><?php echo $client->getPhoneNumber(); ?></dd>
                                <dt>Orden:</dt>
                                <?php 
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
                                    if(strcmp($beveragesID[0], "Ninguno") != 0){
                                        // Recibimos el objeto bebida
                                        $beverage = $inventaryBussiness->getProduct($beveragesID[0]);
                                        $beverages .= $beverage->getName()."<br>";//Extraemos nombre de la bebida
                                        // Concatenamos el resto de nombres de pizza con su tamanio especifico
                                        for($i=1; $i<sizeof($beveragesID); $i++){
                                            $beverage = $inventaryBussiness->getProduct($beveragesID[$i]);
                                                
                                            $beverages .= $beverage->getName()."<br>";
                                            
                                        } 
                                    }
                                ?>
                                <dd><?php echo $pizzas ?></dd>
                                
                                <dd><?php echo $beverages ?></dd>

                            </dl>

                        </div>
                    </div><!-- Fin de card -->
                <?php
                }
            }else{
                echo "<p class='display-6 text-center'>Aún no tienes pedidos entregados</p>";
            }
            ?>
        </div>
    </div>

    <!-- ICONOS -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Script javascript de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>