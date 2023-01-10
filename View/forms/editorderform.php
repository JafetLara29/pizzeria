<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php
        include_once "../../Bussiness/inventarybussiness.php"; 
    ?>
    <title>Editar orden</title>
</head>
<body>
    <!-- Contenedor para formulario de ordenes -->
    <div id="order-form" class="container mb-5">
        <h3 id="form-title" class="display-1 text-center mb-5">Editar orden</h3>
        <p class="text-center" style="color:red">En caso de que el cliente requiera añadir o quitar un producto de la orden, solicite que la realice de nuevo y proceda a eliminar la orden desde el panel administrativo. O si lo tiene a bien, puede ingresar usted mismo al apartado de realizar la orden y realizar la orden a nombre del cliente.</p>
        <form action="../../Bussiness/orderaction.php" method="post">
            <h1 id="order-title" class="display-6">Pizzas</h1>
            
            <?php
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

                $iBussiness = new InventaryBussiness();
                $inventaryPizzas = $iBussiness->getPizzas();//Obtenemos todas las pizzas
                $inventarySizes = $iBussiness->getSizes();
                $inventaryBeverages = $iBussiness->getBeverage();

                // Generar inputs de seleccion de pizza para los productos que vienen en la orden
                // Pizzas
                $orderPizzasID = explode("-", $_POST['pizzas']);
                $orderSizesID = explode("-", $_POST['sizes']);
                $orderBeveragesID = explode("-", $_POST['beverages']);
            

                for($i = 0; $i < sizeof($orderPizzasID); $i++){//recorremos cada id de pizza
                    echo '<select class="form-control mb-3" name="pizzas[]">';
                        echo '<option value="Seleccionar">Seleccionar</option>';
                        foreach($inventaryPizzas as $pizza){
                            if($orderPizzasID[$i] == $pizza->getID()){
                                echo '<option selected value="'.$pizza->getID().'">'.$pizza->getName().'</option>';
                            }else{
                                echo '<option value="'.$pizza->getID().'">'.$pizza->getName().'</option>';
                            }
                        }
                    echo '</select>';
                    echo '<select class="form-control mb-3" name="sizes[]">';
                        echo '<option value="Seleccionar">Seleccionar</option>';
                        foreach($inventarySizes as $size){
                            if($orderSizesID[$i] == $size->getID()){
                                echo '<option selected value="'.$size->getID().'">'.$size->getName().'</option>';
                            }else{
                                echo '<option value="'.$size->getID().'">'.$size->getName().'</option>';
                            }
                        }
                    echo '</select>';
                }
                echo '<h1 id="order-title" class="display-6">Refrescos</h1>';
                
                for($i = 0; $i < sizeof($orderBeveragesID); $i++){
                    echo '<select class="form-control mb-3" name="beverages[]">';
                    echo '<option value="Seleccionar">Seleccionar</option>';
                        foreach($inventaryBeverages as $beverage){
                            if($orderBeveragesID[$i] == $beverage->getID()){
                                echo '<option selected value="'.$beverage->getID().'">'.$beverage->getName().'</option>';
                            }else{
                                echo '<option value="'.$beverage->getID().'">'.$beverage->getName().'</option>';
                            }
                        }
                    echo '</select>';
                }
                
            ?>
            <div class="mb-3">
                <h1 id="order-title" class="display-6">Comentario</h1>
                <input class="form-control mb-3" name="comment" type="text" value="<?php if(isset($_POST['comment'])) echo $_POST['comment'] ?>">
                <h1 id="order-title" class="display-6">Express</h1>
                
                <select class="form-control" name="xpress" id="xpress">
                    <option <?php if(strcmp($_POST['xpress'], "0") == 0) echo "selected" ?> value="0">No</option>
                    <option <?php if(strcmp($_POST['xpress'], "1") == 0) echo "selected" ?> value="1">Si</option>
                </select>
            </div>
           <div class="text-center">
               <!-- Variables hidden -->
               <input type="hidden" name="action" value="edit">
               <input type="hidden" name="id" value="<?php if(isset($_POST['id'])) echo $_POST['id'] ?>">
               <input type="hidden" name="clientid" value="<?php if(isset($_POST['clientid'])) echo $_POST['clientid'] ?>">
               <input type="hidden" name="clientname" value="<?php if(isset($_POST['clientname'])) echo $_POST['clientname'] ?>">
               <input type="hidden" name="state" value="<?php if(isset($_POST['state'])) echo $_POST['state'] ?>">
               
               <!-- Boton de enviar -->
               <input class="btn btn-success" type="submit" value="Guardar cambios">
               <a href="../adminhome.php#order-row" class="btn btn-dark">Volver</a>
           </div>
        </form>
    </div>

    <!-- ICONOS -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Script javascript de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
</body>
</html>