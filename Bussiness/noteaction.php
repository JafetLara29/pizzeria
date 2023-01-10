<?php
    include_once "../Domain/note.php";
    include_once "notebussiness.php";
    if(isset($_POST['action'])){
        $bussiness = new NoteBussiness();
        if(strcmp($_POST['action'], "save") == 0){
            $date = date("Y-m-d");
            $result = $bussiness->save(new Note(0,$date , $_POST['title'], $_POST['note']));
            if($result == 1){
                // n_r = note ready
                header("Location: ../View/adminhome.php?n_r=r");
            }else{
                header("Location: ../View/adminhome.php?n_r=n");
            }
        }else{
            if(strcmp($_POST['action'], "edit") == 0){
                $bussiness->edit(new Note($_POST['noteid'], date("Y-m-d"), $_POST['title'], $_POST['note']));
                header("Location: ../View/adminhome.php");
            }
        }
    }else{
        if(strcmp($_GET['action'], "delete") == 0){
            $bussiness = new NoteBussiness();
            $bussiness->delete($_GET['noteid']);
            
            header("Location: ../View/adminhome.php");
        }   
    }

?>