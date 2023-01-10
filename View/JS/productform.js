function validate(){
    var message = document.getElementById("message");
    var type = document.getElementById("type").value;
    var name = document.getElementById("name").value;
    var description = document.getElementById("description").value;
    // var img = document.getElementById("img").value;
    // var price = document.getElementById("price").value;

    if(name=="" || type=="" || type=="Seleccionar" || description==""){
        message.innerHTML = "<p style='color:red'>Asegurese de seleccionar y rellenar todos los datos solicitados</p>"
    }else{
        var form = document.getElementById("form");
        form.action = "../../Bussiness/inventaryaction.php";
        form.submit();
    }
}
function addPriceInput(){
    var div = document.getElementById("price-container");
    var div2 = document.getElementById("img-container");
    var select = document.getElementById("type").value;
    // alert(select);
    if(select == "beverage"){
        div.innerHTML = '<label class="form-label" for="price">Precio</label>'
                        +'<input required class="form-control" type="number" name="price" id="price">';
        div2.innerHTML = '<label for="file-img">Suba una fotografía de su producto:</label>'
                        +'<input required id="img" type="file" name="img" accept="image/*" class="form-control">';
                    }else{
        if(select == "tamanio"){
            div.innerHTML = '<label class="form-label" for="price">Precio</label>'
                        +'<input required class="form-control" type="number" name="price" id="price">';
            div2.innerHTML = ' ';
        }else{
            if(select == "pizza"){
                div.innerHTML = ' ';
                div2.innerHTML = '<label for="file-img">Suba una fotografía de su producto:</label>'
                        +'<input required id="img" type="file" name="img" accept="image/*" class="form-control">';
            }
        }
    }
    
}

function validateEdit(){
    var message = document.getElementById("message");
    var type = document.getElementById("type").value;
    var name = document.getElementById("name").value;
    var description = document.getElementById("description").value;
    // var img = document.getElementById("img").value;
    var price = document.getElementById("price").value;

    if(name=="" || type=="" || type=="Seleccionar" || description=="" || price==""){
        message.innerHTML = "<p style='color:red'>Asegurese de seleccionar y rellenar todos los datos solicitados</p>"
    }else{
        var form = document.getElementById("form");
        form.action = "../../Bussiness/inventaryaction.php";
        form.submit();
    }
}
function validateEditWithoutPrice(){
    var message = document.getElementById("message");
    var type = document.getElementById("type").value;
    var name = document.getElementById("name").value;
    var description = document.getElementById("description").value;
    // var img = document.getElementById("img").value;

    if(name=="" || type=="" || type=="Seleccionar" || description=="" ){
        message.innerHTML = "<p style='color:red'>Asegurese de seleccionar y rellenar todos los datos solicitados</p>"
    }else{
        var form = document.getElementById("form");
        form.action = "../../Bussiness/inventaryaction.php";
        form.submit();
    }
}