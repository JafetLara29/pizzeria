
function inProcessMode(id){
    var card = document.getElementById(id);
    card.style.backgroundColor = "yellow";
    changeOrderState(id, 1);
}
function readyMode(id){
    var card = document.getElementById(id);
    card.style.backgroundColor = "green";
    changeOrderState(id, 2);
}

function changeOrderState(id, state){
    $.ajax({
        url: '../Bussiness/orderaction.php',
        type: 'POST',
        data: {action: "changestate", id: id, state:state}
        // success:function(data){
        //     $('#list').show();
        //     $('#list').html(data);
        // }
    });
		
}
function reloadPage(){
    location.reload();
}