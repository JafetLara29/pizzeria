<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./Styles/adminhomestyle.css">
    <link rel="stylesheet" href="./Styles/responsivehomestyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./JS/adminhomedinamic.js"></script>
    <?php
    include_once "../Bussiness/orderbussiness.php";
    include_once "../Bussiness/notebussiness.php";
    include_once "../Bussiness/inventarybussiness.php";
    include_once "../Bussiness/statisticsbussiness.php";
    include_once "../Bussiness/accountbussiness.php";
    ?>
    <title>Panel administrativo</title>
</head>

<body>
    <!-- Sidebar -->
    <div id="sidebar">
        <nav>
            <img src="../Images/newlogotransparent.png" alt="" width="90" height="90" class="d-inline-block align-text-top">

            <ul class="navbar-nav text-center">
                <li class="nav-item">
                    <a href="#note-row">
                        <ion-icon id="sidebar-icon" size="large" name="home-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#order-row">
                        <ion-icon id="sidebar-icon" size="large" name="notifications-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#inventary-row">
                        <ion-icon id="sidebar-icon" size="large" name="pizza-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#statistic-row">
                        <ion-icon id="sidebar-icon" size="large" name="bar-chart-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./Public/login.php">
                        <ion-icon id="sidebar-icon" size="large" name="exit-outline"></ion-icon>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Contenedor que hace funcion de columna a la par del sidebar. Aplica margin left-->
    <div id="content">
        
        <!-- Fila de cards para notas -->
        <div id="note-row" class="row">
            <!-- Titulo -->
            <h1 class="display-6">Bienvenido admin</h1>
            <?php 
            echo "<p>".date("Y-m-d")."</p>";
                $statisticBussiness = new StatisticBussiness();
                $numberOrders = $statisticBussiness->getNumberOrdersPerDay(date("Y-m-d"));
                $total = $statisticBussiness->getAmountPerDay(date("Y-m-d"));
                $numberBeverages = $statisticBussiness->getNumberBeveragesPerDay(date("Y-m-d"));
            ?>
            <!-- Estadisticas -->
            <div id="general-static-row">
                <!-- Ordenes tomadas en el dia -->
                <div class="card">
                    <div class="card-body text-center">
                        <ion-icon size="large" name="fast-food-outline"></ion-icon>
                        <span><?php echo $numberOrders; ?></span>
                    </div>
                </div>
                <!-- Cantidad de dinero generado en el dia -->
                <div class="card">
                    <div class="card-body text-center">
                        <ion-icon size="large" name="cash-outline"></ion-icon>
                        <span>₡<?php echo $total ?></span>
                    </div>
                </div>
                <!-- Cantidad de bebidas vendidas -->
                <div class="card">
                    <div class="card-body text-center">
                        <ion-icon size="large" name="wine-outline"></ion-icon>
                        <span><?php echo $numberBeverages ?></span>
                    </div>
                </div>
            </div>

            <!-- Cards -->
            <h3 class="display-1 text-center mb-5 mt-5">Notas</h3>
            <a href="./forms/noteform.php" class="btn btn-success"><ion-icon size="large" name="add-circle-outline"></ion-icon></a>
            <div id="cards-row" class="row">
                <!-- Columna 1 -->
                <?php
                $noteBussiness = new NoteBussiness();
                $notes = $noteBussiness->getNotes();
                if(empty($notes) == false){
                    foreach($notes as $note){
                ?>
                    <div class="card mt-3" id="note-card">
                        <div class="container text-center mt-3">
                            <ion-icon id="card-icon" size="large" name="alert-circle-outline"></ion-icon>

                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $note->getTitle() ?></h5>
                            <p class="card-text"><?php echo $note->getNote() ?></p>
                            <form action="./forms/editnoteform.php" method="post">
                            <input type="hidden" name="noteid" value="<?php echo $note->getID() ?>">
                                <input type="hidden" name="title" value="<?php echo $note->getTitle() ?>">
                                <input type="hidden" name="note" value="<?php echo $note->getNote() ?>">
                                <button type="submit" class="btn btn-info">editar</button>
                                <a href="../Bussiness/noteaction.php?action=delete&noteid=<?php echo $note->getID() ?>" class="btn btn-info">Eliminar</a>
                            </form>
                        </div>
                    </div>
                <?php 
                    }
                }else{
                    echo "<h1 style='color:white' class='display-6 text-center'>Aún no ha registrado ninguna nota</h1>";    
                } ?>
            </div><!-- Fin de contenedor row (cards) -->
        </div><!-- Fin de contenedor row (apartado de notas) -->

        <!-- Fila de cards para ordenes -->
        <div id="order-row" class="row">
            <!-- Cards -->
            <h3 class="display-1 text-center mb-5 mt-5">Pedidos</h3>
            <button class="btn btn-success" onclick="reloadPage()">Actualizar lista</button>

            <div id="cards-row" class="row">
                <!-- Columna 1 -->
                <?php 
                $orderBussiness = new OrderBussiness();
                $inventaryBussiness = new InventaryBussiness();
                $aBussiness = new AccountBussiness();

                $orders = $orderBussiness->getOrders();
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
                    // ---------------------------------------------------------------
                        
                        $color="";
                        //Logica para la seleccion de color del card deacuerdo al estado de este (listo, en proceso)
                        if($order->getState() == 1){
                            $color = "yellow";
                        }
                        if(strcmp($order->getClientName(), "-") == 0){
                            $client = $aBussiness->getClient($order->getClientID());
                        }else{
                            $client = new Client(0, $order->getClientName(), $order->getClientLastName(), $order->getClientPhoneNumber(), $order->getClientAddress());
                        }
                ?>
                <div class="card mt-2" style="<?php echo 'background-color:'.$color ?>" id="<?php echo $order->getID() ?>">
                    <div class="container text-center mt-3">
                        <ion-icon id="card-icon" size="large" name="pizza-outline"></ion-icon>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $pizzas ?></h5>
                        <!-- <p class="card-text"> -->
                        <!-- Etiqueta html para listas de concepto-definicion (Refresco: no) -->
                        <dl>
                            <dt>Cliente</dt>
                            <dd><?php echo $client->getName()." ".$client->getLastName(); ?></dd>
                            <dt>Refresco:</dt>
                            <dd><?php echo $beverages ?></dd>
                            <dt>Comentario:</dt>
                            <dd><?php echo $order->getComment() ?></dd>
                        </dl>
                        <!-- </p> -->
                        <form action="./forms/editorderform.php" method="post">
                            <button class="btn btn-info mb-1" type="button" onclick="inProcessMode('<?php echo $order->getID() ?>')">
                                <ion-icon size="large" name="hourglass-outline"></ion-icon>
                            </button>
                            <button class="btn btn-info mb-1" type="button" onclick="readyMode('<?php echo $order->getID() ?>')">
                                <ion-icon size="large" name="checkmark-outline"></ion-icon>
                            </button>
                            <!-- Variables hidden -->
                            <input type="hidden" name="id" value="<?php echo $order->getID() ?>">
                            <input type="hidden" name="pizzas" value="<?php echo $order->getPizza() ?>">
                            <input type="hidden" name="sizes" value="<?php echo $order->getSize() ?>">
                            <input type="hidden" name="beverages" value="<?php echo $order->getBeverage() ?>">
                            <input type="hidden" name="comment" value="<?php echo $order->getComment() ?>">
                            <input type="hidden" name="clientid" value="<?php echo $order->getClientID() ?>">
                            <input type="hidden" name="clientname" value="<?php echo $order->getClientName() ?>">
                            <input type="hidden" name="state" value="<?php echo $order->getState() ?>">
                            <input type="hidden" name="xpress" value="<?php echo $order->getXpress() ?>">
                            
                            <button class="btn btn-info mb-1" type="submit">
                                <ion-icon size="large" name="pencil-outline"></ion-icon>
                            </button>
                            <a href="../Bussiness/orderaction.php?action=delete&id=<?php echo $order->getID() ?>" id="delete-icon" class="btn btn-danger">
                                <ion-icon size="large" name="trash-outline"></ion-icon>
                            </a>
                        </form>

                    </div>
                </div>
                <?php 
                    }
                }else{
                    echo "<h1 style='color:white' class='display-6 text-center'>No hay ordenes para tomar</h1>";
                }
                ?>
            </div><!-- Fin de contenedor row (cards) -->
        </div><!-- Fin de contenedor row (apartado de ordenes) -->

        <!-- Fila de cards para inventario -->
        <div id="inventary-row" class="row">
            <!-- Cards -->
            <!-- Fila 1 -->
            <h3 class="display-1 text-center mb-5 mt-5">Inventario</h3>

            <a href="./forms/productform.php" class="btn btn-success"><ion-icon size="large" name="add-circle-outline"></ion-icon></a>
            <div id="cards-row" class="row">
                <?php
                    $inventaryBussiness = new InventaryBussiness();
                    $products = $inventaryBussiness->getInventary();
                    if(empty($products)){
                        echo "<p style='color:white' class='display-6 text-center'>No hay productos registrados</p>";
                    }else{
                        foreach($products as $product){
                    
                ?>
                    <div class="card mt-3" id="inventary-card">
                        <img src="../Images/Pizzas/<?php echo $product->getImagePath()?>" class="card-img-top">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $product->getName() ?></h5>
                            <p>
                              <?php echo $product->getDescription() ?>  
                            </p>
                            <p>
                              <?php echo $product->getPrice() ?>  
                            </p>
                            <!-- </p> -->
                            <form action="./forms/editproductform.php" method="post">
                                <!-- Variables hidden -->
                                <input type="hidden" name="id" value="<?php echo $product->getID() ?>">
                                <input type="hidden" name="name" value="<?php echo $product->getName() ?>">
                                <input type="hidden" name="description" value="<?php echo $product->getDescription() ?>">
                                <input type="hidden" name="price" value="<?php echo $product->getPrice() ?>">
                                <input type="hidden" name="type" value="<?php echo $product->getType() ?>">
                                <input type="hidden" name="img" value="<?php echo $product->getImagePath() ?>">
                                <input type="hidden" name="action" value="edit">

                                <button type="submit" class="btn btn-info mb-1">
                                    <ion-icon size="large" name="pencil-outline"></ion-icon>
                                </button>
                                <a href="../Bussiness/inventaryaction.php?action=delete&id=<?php echo $product->getID() ?>" id="delete-icon" class="btn btn-danger">
                                    <ion-icon size="large" name="trash-outline"></ion-icon>
                                </a>

                            </form>

                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>

                    <h3 id="pizza-size-title" class="display-1 text-center mb-5 mt-5">Tamaños de pizzas</h3>
                    <a href="./forms/productform.php" class="btn btn-success ml-1"><ion-icon size="large" name="add-circle-outline"></ion-icon></a>
                    

                        <?php
                            $products = $inventaryBussiness->getSizes();
                            if(empty($products)){
                                echo "<p style='color:white' class='display-6 text-center'>No hay tamaños de pizza registrados</p>";
                            }else{
                                foreach($products as $product){
                            
                        ?>
                            <div class="card mt-3" id="size-card">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $product->getName() ?></h5>
                                    <p>
                                    <?php echo $product->getDescription() ?>  
                                    </p>
                                    <p>
                                    <?php echo $product->getPrice() ?>  
                                    </p>
                                    <!-- </p> -->
                                    <form action="./forms/editproductform.php" method="post">
                                        <!-- Variables hidden -->
                                        <input type="hidden" name="id" value="<?php echo $product->getID() ?>">
                                        <input type="hidden" name="name" value="<?php echo $product->getName() ?>">
                                        <input type="hidden" name="description" value="<?php echo $product->getDescription() ?>">
                                        <input type="hidden" name="price" value="<?php echo $product->getPrice() ?>">
                                        <input type="hidden" name="type" value="<?php echo $product->getType() ?>">
                                        
                                        <input type="hidden" name="action" value="edit">

                                        <button type="submit" class="btn btn-info mb-1">
                                            <ion-icon size="large" name="pencil-outline"></ion-icon>
                                        </button>
                                        <a href="../Bussiness/inventaryaction.php?action=delete&id=<?php echo $product->getID() ?>" id="delete-icon" class="btn btn-danger">
                                            <ion-icon size="large" name="trash-outline"></ion-icon>
                                        </a>

                                    </form>

                                </div>
                            </div>
                            <?php
                                }
                            }
                            ?>
            </div><!-- Fin de contenedor row (cards) -->
        </div><!-- Fin de contenedor row (apartado de inventarios) -->
        
         <!-- Fila de cards para inventario -->
        <div id="statistic-row" class="row">
            <!-- Cards -->
            <!-- Fila 1 -->
            <h3 class="display-1 text-center mb-5 mt-5">Estadisticas</h3>
            <?php 
            echo "<p>".date("Y-m-d")."</p>";
                $statisticBussiness = new StatisticBussiness();
                $numberOrders = $statisticBussiness->getNumberOrdersPerDay(date("Y-m-d"));
                $total = $statisticBussiness->getAmountPerDay(date("Y-m-d"));
                $numberBeverages = $statisticBussiness->getNumberBeveragesPerDay(date("Y-m-d"));
            ?>
            <!-- Estadisticas -->
            <h1 class="display-6">Hoy</h1>
            <div id="card-row">
                <!-- Ordenes tomadas en el dia -->
                <div class="card mt-3">
                    <div id="statistic-card-header" class="card-header">
                        <h3 class="text-center">Numero de ordenes</h3>
                    </div>
                    <div class="card-body text-center">
                        <ion-icon size="large" name="fast-food-outline"></ion-icon>
                        <span><?php echo $numberOrders; ?></span>
                    </div>
                </div>
                <!-- Cantidad de dinero generado en el dia -->
                <div class="card mt-3">
                    <div id="statistic-card-header" class="card-header">
                        <h3 class="text-center">Dinero ganado</h3>
                    </div>
                    <div class="card-body text-center">
                        <ion-icon size="large" name="cash-outline"></ion-icon>
                        <span>₡<?php echo $total ?></span>
                    </div>
                </div>
                <!-- Cantidad de bebidas vendidas -->
                <div class="card mt-3">
                    <div id="statistic-card-header" class="card-header">
                        <h3 class="text-center">Cantidad de bebidas</h3>
                    </div>
                    <div class="card-body text-center">
                        <ion-icon size="large" name="wine-outline"></ion-icon>
                        <span><?php echo $numberBeverages ?></span>
                    </div>
                </div>
            </div>  
        </div><!-- Fin de contenedor row (apartado de estadisticas) -->
        
    </div> <!-- Fin de contenedor content -->

    <!-- ICONOS -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Script javascript de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>