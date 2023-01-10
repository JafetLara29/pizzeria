<?php
    include_once "../Domain/order.php";
    include_once "orderbussiness.php";
    include_once "inventarybussiness.php";

    if(isset($_POST['action'])){
        $bussiness = new OrderBussiness();
        $iBussiness= new InventaryBussiness();

        if(strcmp($_POST['action'], "save") == 0){
            $pizzasID = $_POST['pizzas'];
            $sizesID = $_POST['sizes'];
            $total = 0;
            $problemP = false;
            $problemS = false;
            if(isset($_POST['beverages'])){
                $beveragesID = $_POST['beverages'];
                $beverages = $beveragesID[0];
            }
            // Obtenemos el primer valor del array
            $pizzas = $pizzasID[0];
            $sizes = $sizesID[0];
            if(strcmp($pizzasID[0], "Seleccionar") == 0){
                $problemP = true;
            }
            if(strcmp($sizesID[0], "Seleccionar") == 0){
                $problemS = true;
            }
            //Concatenamos todos en una cadena separada por un caracter especial
            for($i = 1;$i < sizeof($pizzasID); $i++){
                if(strcmp($pizzasID[$i], "Seleccionar") != 0){
                    $pizzas .= "-".$pizzasID[$i];
                }
                if(strcmp($sizesID[$i], "Seleccionar") != 0){
                    $sizes .= "-".$sizesID[$i];
                }
            }
            if($problemP == true || $problemS == true){
                header("Location: ../View/clienthome.php?r_m=p&u_i=".$_POST['clientid']);
            }else{
                 if(isset($_POST['beverages'])){
                    for($i = 1;$i < sizeof($beveragesID); $i++){
                        if(strcmp($beveragesID[$i], "Seleccionar") != 0){
                            $beverages .= "-".$beveragesID[$i];
                            // Calculamos monto a pagar por bebidas
                        }
                    }
                    // Sumamos valor de las bebidas
                    for($i = 0;$i < sizeof($beveragesID); $i++){
                        if(strcmp($beveragesID[$i], "Seleccionar") != 0){
                            $total = $total + $iBussiness->getProductPrice($beveragesID[$i]);
                        }
                    }
                 }
                // Calculamos el valor total de la compra
                for($i = 0;$i < sizeof($sizesID); $i++){
                    if(strcmp($sizesID[$i], "Seleccionar") != 0){
                        // Vamos sumando el monto de las pizzas por medio de los tamaños de cada una
                        $total = $total + $iBussiness->getProductPrice($sizesID[$i]);
                    }
                }
                if(isset($beverages)){$number = sizeof($beveragesID);}
                if(empty($beverages) || strcmp($beverages, "Seleccionar") == 0){
                    $beverages = "Ninguno";
                    $number = 0;
                }
    
                $result = $bussiness->save(new Order(0, $_POST['clientid'], "-", "-", "-", "-", $pizzas, $sizes, $beverages, $_POST['comment'], 0, date("Y-m-d"), $total, $_POST['xpress']), $number);
                
                if($result == 1){
                    // r_m = ready message
                    header("Location: ../View/clienthome.php?r_m=r&u_i=".$_POST['clientid']);
                }else{
                    header("Location: ../View/clienthome.php?r_m=n&u_i=".$_POST['clientid']);
                }
            }
        }else{
            if(strcmp($_POST['action'], "save-public") == 0){
                $pizzasID = $_POST['pizzas'];
                $sizesID = $_POST['sizes'];
                $beveragesID;
                $total = 0;
                $problemP = false;
                $problemS = false;
                // Obtenemos el primer valor del array
                $pizzas = $pizzasID[0];
                $sizes = $sizesID[0];
                if(isset($_POST['beverages'])){
                    $beveragesID = $_POST['beverages'];
                    $beverages = $beveragesID[0];
                }
                if(strcmp($pizzasID[0], "Seleccionar") == 0){
                    $problemP = true;
                }
                if(strcmp($sizesID[0], "Seleccionar") == 0){
                    $problemS = true;
                }
                //Concatenamos todos en una cadena separada por un caracter especial
            for($i = 1;$i < sizeof($pizzasID); $i++){
                if(strcmp($pizzasID[$i], "Seleccionar") != 0){
                    $pizzas .= "-".$pizzasID[$i];
                }else{
                    $problemP = true;
                }
                if(strcmp($sizesID[$i], "Seleccionar") != 0){
                    $sizes .= "-".$sizesID[$i];
                }else{
                    $problemS = true;
                }
            }
            if($problemP == true || $problemS == true){
                header("Location: ../View/forms/orderform.php?r_m=p");
            }else{
                 if(isset($_POST['beverages'])){
                    for($i = 1;$i < sizeof($beveragesID); $i++){
                        if(strcmp($beveragesID[$i], "Seleccionar") != 0){
                            $beverages .= "-".$beveragesID[$i];
                            // Calculamos monto a pagar por bebidas
                        }
                    }
                    // Sumamos valor de las bebidas
                    for($i = 0;$i < sizeof($beveragesID); $i++){
                        if(strcmp($beveragesID[$i], "Seleccionar") != 0){
                            $total = $total + $iBussiness->getProductPrice($beveragesID[$i]);
                        }
                    }
                 }
                // Calculamos el valor total de la compra
                for($i = 0;$i < sizeof($sizesID); $i++){
                    if(strcmp($sizesID[$i], "Seleccionar") != 0){
                        // Vamos sumando el monto de las pizzas por medio de los tamaños de cada una
                        $total = $total + $iBussiness->getProductPrice($sizesID[$i]);
                    }
                }
                if(isset($beverages)){$number = sizeof($beveragesID);}
                if(empty($beverages) || strcmp($beverages, "Seleccionar") == 0){
                    $beverages = "Ninguno";
                    $number = 0;
                }
                // Guardamos en base de datos
                if(strcmp($_POST['xpress'], "1") == 0){
                    $result = $bussiness->save(new Order(0, 0, $_POST['name'], $_POST['lastname'], $_POST['phonenumber'], $_POST['address'], $pizzas, $sizes, $beverages, $_POST['comment'], 0, date("Y-m-d"), $total, $_POST['xpress']), $number);
                }else{
                    $result = $bussiness->save(new Order(0, 0, $_POST['name'], $_POST['lastname'], $_POST['phonenumber'], "-", $pizzas, $sizes, $beverages, $_POST['comment'], 0, date("Y-m-d"), $total, $_POST['xpress']), $number);
                }
                if($result == 1){
                    // r_m = ready message
                    header("Location: ../View/forms/orderform.php?r_m=r");
                }else{
                    header("Location: ../View/forms/orderform.php?r_m=n");
                }
            }
            }else{
                if(strcmp($_POST['action'], "changestate") == 0){
                    $bussiness->changeOrderState($_POST['id'], $_POST['state']);
                    if(strcmp($_POST['v'], "delivery") == 0){
                        header("Location: ../View/delivery.php");
                    }else{
                        header("Location: ../View/adminhome.php");
                    }
                }else{
                    if(strcmp($_POST['action'], "edit") == 0){
                        $pizzasID = $_POST['pizzas'];
                        $sizesID = $_POST['sizes'];
                        $beveragesID = $_POST['beverages'];
                        $total = 0;
                        $problemP = false;
                        $problemS = false;
                        // Obtenemos el primer valor del array
                        $pizzas = $pizzasID[0];
                        $sizes = $sizesID[0];
                        $beverages = $beveragesID[0];
                        if(strcmp($pizzasID[0], "Seleccionar") == 0){
                            $problemP = true;
                        }
                        if(strcmp($sizesID[0], "Seleccionar") == 0){
                            $problemS = true;
                        }
                        //Concatenamos todos en una cadena separada por un caracter especial
                        for($i = 1;$i < sizeof($pizzasID); $i++){
                            if(strcmp($pizzasID[$i], "Seleccionar") != 0){
                                $pizzas .= "-".$pizzasID[$i];
                            }else{
                                $problemP = true;
                            }
                            if(strcmp($sizesID[$i], "Seleccionar") != 0){
                                $sizes .= "-".$sizesID[$i];
                            }else{
                                $problemS = true;
                            }
                        }
                        if($problemP == true || $problemS == true){
                            header("Location: ../View/adminhome.php#order-row");
                        }else{
                            for($i = 1;$i < sizeof($beveragesID); $i++){
                                if(strcmp($beveragesID[$i], "Seleccionar") != 0){
                                    $beverages .= "-".$beveragesID[$i];
                                    // Calculamos monto a pagar por bebidas
                                    $total = $total + $iBussiness->getProductPrice($beveragesID[$i]);
                                }
                            }
                            // Sumamos valor de las bebidas
                            for($i = 0;$i < sizeof($beveragesID); $i++){
                                if(strcmp($beveragesID[$i], "Seleccionar") != 0){
                                    $total = $total + $iBussiness->getProductPrice($beveragesID[$i]);
                                }
                            }
                
                            // Calculamos el valor total de la compra
                            for($i = 0;$i < sizeof($sizesID); $i++){
                                if(strcmp($sizesID[$i], "Seleccionar") != 0){
                                    // Vamos sumando el monto de las pizzas por medio de los tamaños de cada una
                                    $total = $total + $iBussiness->getProductPrice($sizesID[$i]);
                                }
                            }
                            $number = sizeof($beveragesID);
                            if(empty($beverages) || strcmp($beverages, "Seleccionar") == 0){
                                $beverages = "Ninguno";
                                $number = 0;
                            }
                            // Hay que actualizar formulario para editar orden de manera que sea mas exacto_________________________
                            $bussiness->edit(new Order($_POST['id'], $_POST['clientid'], $_POST['clientname'], "", "", "", $pizzas, $sizes, $beverages, $_POST['comment'], $_POST['state'], "", $total, $_POST['xpress']));
                            header("Location: ../View/adminhome.php#order-row");
                        }   
                    }
                }
            }
        }
    }else{
        if(strcmp($_GET['action'], "delete") == 0){
            $bussiness = new OrderBussiness();
            $bussiness->delete($_GET['id']);
            header("Location: ../View/adminhome.php#order-row");
        }
    }
