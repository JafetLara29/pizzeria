<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Agregar nota</title>
</head>
<body>
    <!-- Contenedor para formulario de ordenes -->
    <div id="order-form" class="container mb-5">
        <h3 id="form-title" class="display-1 text-center mb-5">Editar nota</h3>
        
        <form action="../../Bussiness/noteaction.php" method="post">
            <div class="mb-3">
                <label class="form-label" for="title">Título</label>
                <input required class="form-control" type="text" name="title" id="title" placeholder="Escriba el titulo de la nota aquí" value="<?php if(isset($_POST['title'])) echo $_POST['title'] ?>">
                <label class="form-label" for="note">Nota</label>
                <textarea required class="form-control" type="text" name="note" id="note" placeholder="Escriba su nota aquí"><?php if(isset($_POST['note'])) echo $_POST['note'] ?></textarea>
                <input type="hidden" name="action" value="save">
            </div>
           <div class="text-center">
               <!-- Variable hidden -->
               <input type="hidden" name="noteid" value="<?php if(isset($_POST['noteid'])) echo $_POST['noteid'] ?>">
               <input type="hidden" name="action" value="edit">
               
               <!-- Boton de enviar -->
               <input class="btn btn-success" type="submit" value="Guardar cambios">
               <a class="btn btn-dark" href="../adminhome.php">Volver</a>
           </div>
        </form>
    </div>
     <!-- Script javascript de bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
</html>