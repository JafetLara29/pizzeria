<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../JS/productform.js"></script>
    <title>Formulario de producto</title>
</head>
<body>
    <!-- Contenedor para formulario de productos -->
    <div id="order-form" class="container mb-5">
        <h3 id="form-title" class="display-1 text-center mb-5">Crear producto</h3>
        <div class="text-center" id="message">
            <?php 
                if(isset($_GET['e_m'])){
                    if($_GET['e_m'] == 'i'){
                        echo "<p style='color:red'>Si desea registrar una pizza o bebida debe agregar una imagen debido a que esto aparecerá en la vista pública</p>";
                    }
                }
            ?>
        </div>
        <form id="form" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="type" class="form-label" style="color:red">Tipo de producto</label>
                <select onchange="addPriceInput()" class="form-control" name="type" id="type">
                    <option value="Seleccionar">Seleccionar</option>
                    <option value="pizza">Pizza</option>
                    <option value="beverage">Refresco</option>
                    <option value="tamanio">tamaño</option>
                </select>
                <label class="form-label" for="title">Nombre</label>
                <input required class="form-control" type="text" name="name" id="name">
                <div id="price-container">
                    <!-- Donde agregamos input de price dinamicamente -->
                </div>
                
                <label class="form-label" for="description">Descripción</label>
                <textarea required class="form-control mb-3" name="description" id="description" style="height:100px"></textarea>
                
                <div id="img-container">
                    <!-- Donde aparecera el input de foto dinamicamente -->
                </div>
                
                <input type="hidden" name="action" value="save">
            </div>
           <div class="text-center">
               <!-- Boton de enviar -->
               <input class="btn btn-success" type="button" onclick="validate()" value="Registrar producto">
               <a href="../adminhome.php#inventary-row" class="btn btn-dark">Volver</a>
           </div>
        </form>
    </div>
     <!-- Script javascript de bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>