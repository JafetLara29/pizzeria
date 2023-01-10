function validateConfirmPassword(){
    var password = document.getElementById("password").value;
    var confirm = document.getElementById("confirm").value;
    var message = document.getElementById("confirm-message");
    if(password == confirm){
        message.innerHTML = "<p style='color:green'>Las contraseñas coinciden</p>"
    }else{
        message.innerHTML = "<p style='color:red'>Las contraseñas no coinciden</p>"
    }

}

function sendData(){
    var form = document.getElementById("form");
    var password = document.getElementById("password").value;
    var confirm = document.getElementById("confirm").value;
    var name = document.getElementById("name").value;
    var lastname = document.getElementById("lastname").value;
    var address = document.getElementById("address").value;
    var phonenumber = document.getElementById("phonenumber").value;
    var message = document.getElementById("confirm-message");

    if(name=="" || lastname=="" || address=="" || phonenumber=="" || password==""){
        message.innerHTML = "<p style='color:red'>Debe llenar todos los campos del formulario</p>"
    }else{
        if(password == confirm){
            form.action = "../../Bussiness/accountaction.php";
            form.submit();
        }else{
            message.innerHTML = "<p style='color:red'>Asegurese que las contraseñas coincidan</p>"
        }

    }
}