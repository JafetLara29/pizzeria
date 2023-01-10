function addInputAddress(){
    var div = document.getElementById("address-container");
    var select = document.getElementById("xpress").value;
    // alert(select);
    if(select == "1"){
        div.innerHTML = '<input class="form-control mb-3" id="address" name="address" type="text" placeholder="Ingrese su direccion de residencia">';
    }else{
        if(select == "0"){
            div.innerHTML = ' ';
        }   
    }
    
}
function doOrderClient(){
    
    var message = document.getElementById("message");
    try {
        var pizza = document.getElementById("pizza").value;
        var size = document.getElementById("size").value;
        if(pizza=="" || pizza=="Seleccionar" || size=="" || size=="Seleccionar"){
            message.innerHTML = "<p style='color:red'>Debe de seleccionar al menos una pizza y un tamaño de pizza para realizar la orden</p>"
        }else{
            var form = document.getElementById("form");
            form.action = "../Bussiness/orderaction.php";
            form.submit();
        }
    } catch (error) {
        message.innerHTML = "<p style='color:red'>Debe de seleccionar al menos una pizza y un tamaño de pizza para realizar la orden</p>"
        
    }
    
}
function doOrder(){
    
    var message = document.getElementById("message");
    try {
        var pizza = document.getElementById("pizza").value;
        var size = document.getElementById("size").value;
        var lastname = document.getElementById("lastname").value;
        var phonenumber = document.getElementById("phonenumber").value;
        var name = document.getElementById("name").value;
        if(name=="" || lastname =="" || pizza=="" || pizza=="Seleccionar" || size=="" || size=="Seleccionar" || phonenumber=="" || phonenumber=="Seleccionar"){
            message.innerHTML = "<p style='color:red'>Debe de seleccionar al menos una pizza, un tamaño de pizza, telefono, nombre y apellidos para poder realizar su orden</p>"
        }else{
            var form = document.getElementById("form");
            form.action = "../../Bussiness/orderaction.php";
            form.submit();
        }
    } catch (error) {
        message.innerHTML = "<p style='color:red'>Debe de seleccionar al menos una pizza, un tamaño de pizza, telefono, nombre y apellidos para poder realizar su orden</p>"
        
    }
    
}