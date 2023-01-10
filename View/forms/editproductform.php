<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../JS/productform.js"></script>
    <title>Editar producto</title>
</head>
<body>
    <!-- Contenedor para formulario de productos -->
    <div id="order-form" class="container mb-5">
        <h3 id="form-title" class="display-1 text-center mb-5">Editar producto</h3>
        <div class="text-center" id="message">
            
        </div>
        <form id="form" action="../../Bussiness/inventaryaction.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
               
                <label class="form-label" for="title">Nombre</label>
                <input required class="form-control" type="text" name="name" id="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>">
                <div id="price-container">
                    <?php
                        if(strcmp($_POST['type'], "beverage") == 0 || strcmp($_POST['type'], "tamanio") == 0){
                    ?>
                        <label class="form-label" for="price">Precio</label>
                        <input required class="form-control" type="number" name="price" id="price" value="<?php if(isset($_POST['price'])) echo $_POST['price'] ?>">
                    <?php
                        }
                    ?>
                </div>
                <label class="form-label" for="description">Descripción</label>
                <textarea required class="form-control mb-3" name="description" id="description" style="height:100px"><?php if(isset($_POST['description'])) echo $_POST['description'] ?></textarea>
                <div id="img-container">
                    <?php 
                        if(strcmp($_POST['type'], "tamanio") != 0){
                            echo $_POST['img'];
                    ?>
                            <img src="../../Images/Pizzas/<?php if(isset($_POST['img'])) echo $_POST['img'] ?>" class="img-thumbnail">
                            <p class="display-6">Seleccione "Elegir archivo" si desea cambiar la actual:</p>
                            <input id="img" type="file" name="img" accept="image/*" class="form-control">
                    <?php
                        }
                    ?>
                </div>
                <!-- Hidden -->
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?php if(isset($_POST['id'])) echo $_POST['id'] ?>">
                <input type="hidden" id="type" name="type" value="<?php echo $_POST['type'] ?>">

            </div>
           <div class="text-center">
               <!-- Boton de enviar -->
               <?php
                    if(strcmp($_POST['type'], "beverage") == 0 || strcmp($_POST['type'], "size") == 0){
                        echo '<input class="btn btn-success" type="button" onclick="validateEdit()" value="Guardar cambios">';
                    }else{
                        echo '<input class="btn btn-success" type="button" onclick="validateEditWithoutPrice()" value="Guardar cambios">';
                    }
               ?>
               <a href="../adminhome.php#inventary-row" class="btn btn-dark">Volver</a>
           </div>
        </form>
    </div>
     <!-- Script javascript de bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>