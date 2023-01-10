<?php
    include_once "../Domain/product.php";
    include_once "inventarybussiness.php";
    if(isset($_POST['action'])){
        $bussiness = new InventaryBussiness();
        if(strcmp($_POST['action'], "save") == 0){
            // Resibimos el archivo
            $file = $_FILES["img"];   
            $fileName = $file['name'];
            $price;
            if(empty($_POST['price'])){
                $price = "0";
            }else{
                $price = $_POST['price'];
            }
            if(empty($fileName)){
                $_POST['img'] = '-';
                $fileName = '-';
            }else{
                $provicionalRoute = $file['tmp_name'];
                //  Lo guardamos en una carpeta del proyecto
                 move_uploaded_file($provicionalRoute, "../Images/Pizzas/".$fileName);
            }
            if(strcmp($_POST['type'], "pizza") == 0 || strcmp($_POST['type'], "beverage") == 0){
                if(strcmp($fileName, "-") == 0){
                    header("Location: ../View/forms/productform.php?e_m=i");
                }else{
                    $result = $bussiness->save(new Product(0, $_POST['name'], $_POST['description'], $price, $fileName, $_POST['type']));
                    if($result == 1){
                        header("Location: ../View/adminhome.php#inventary-row");
                    }    
                }
            }else{
                $result = $bussiness->save(new Product(0, $_POST['name'], $_POST['description'], $price, $fileName, $_POST['type']));
                if($result == 1){
                    header("Location: ../View/adminhome.php#inventary-row");
                }
            }
        }else{
            if(strcmp($_POST['action'], "edit") == 0){
                // Resibimos el archivo
                $file = $_FILES['img'];
                $fileName = $file['name'];
                $provicionalRoute = $file['tmp_name'];
                $price;
                if(empty($_POST['price'])){
                    $price = "0";
                }else{
                    $price = $_POST['price'];
                }
                if(empty($fileName) == false){
                    
                    move_uploaded_file($provicionalRoute, "../Images/Pizzas/".$fileName);
                    $bussiness->edit(new Product($_POST['id'], $_POST['name'], $_POST['description'], $price, $fileName, $_POST['type']));
                    //  Lo guardamos en una carpeta del proyecto
                    
                }else{
                    $bussiness->editWhithoutImage(new Product($_POST['id'], $_POST['name'], $_POST['description'], $price, '-', $_POST['type']));

                }
                if(strcmp($_POST['type'], "tamanio") == 0){
                    header("Location: ../View/adminhome.php#pizza-size-title");
                }else{
                    header("Location: ../View/adminhome.php#inventary-row");
                }
            }
        }
    }else{
        if(strcmp($_GET['action'], "delete") == 0){
            $bussiness = new InventaryBussiness();
            $bussiness->delete($_GET['id']);
            
            header("Location: ../View/adminhome.php#inventary-row");
        }   
    }

?>