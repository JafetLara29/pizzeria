<?php
    include_once "../Domain/account.php";
    include_once "../Domain/client.php";
    include_once "accountbussiness.php";

    if(isset($_POST['action'])){
        $bussiness = new AccountBussiness();
        if(strcmp($_POST['action'], "validate") == 0){
            $type = $bussiness->validateAccount(new Account(0, $_POST['user'], $_POST['password'], ""));
            if(isset($type)){
                if($type == 'a'){
                    header("location: ../View/adminhome.php");
                }else{
                    if($type == 'c'){
                        $id = $bussiness->getUserID($_POST['user']);
                        header("location: ../View/clienthome.php?u_i=".$id);
                    }else{
                        if($type == 'd'){
                            header("location: ../View/delivery.php");
                        }
                    }
                }       
            }else{
                // En caso de no contar con una cuenta registrada entonces se devuelve al login con una variable 'e_m' (error message) con valor 'u' (unregistered) 
                header("location: ../View/Public/login.php?e_m=u");
            }
        }else{
            if(strcmp($_POST['action'], "save") == 0){
                $result = $bussiness->validateUserExist($_POST['user']);
                if($result == 1){
                    $result = $bussiness->save(new Account(0,$_POST['user'], $_POST['password'], 'c'), new Client(0, $_POST['name'], $_POST['lastname'], $_POST['phonenumber'], $_POST['address']));
                    if($result == 1){
                        // r_m = ready message
                        header("Location: ../View/Public/register.php?r_m=r"); 
                    }else{
                        // n = no ready
                        header("Location: ../View/Public/register.php?r_m=n"); 
                    }
                }else{
                    header("Location: ../View/Public/register.php?r_m=e"); 
                }
            }
        }
    }
?>