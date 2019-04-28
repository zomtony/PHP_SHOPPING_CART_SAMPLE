function addProduct(id){

    var quantity = document.getElementById(id).value;
    var cookValue = getCookie("cart" + id);
    if(cookValue != ""){
        var cookieV = "cart" + id + "=" + (parseInt(quantity) + parseInt(cookValue));
        document.cookie = cookieV;
    }else{
        var cookieV = "cart" + id + "=" + quantity;
        document.cookie = cookieV;
    }

    refresh_Cart();
}

function refresh_Cart(){
  $.ajax({
      url:"/myCart.php",
      method:"POST",
      success:function(data){
          $('#display_myCart').html(data);
      }
  })
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function removeProduct(id){
  var theId = "cart" + id;
  cookiename = theId + "= ;";
  document.cookie = cookiename +" expires = Thu, 01 Jan 1970 00:00:00 GMT";
  refresh_Cart();
}

function changeQuantity(id){
  var theId = "cart" + id;
  var inputValue =  document.getElementById(theId).value;
  var cookieV = theId + "=" + inputValue;
  document.cookie = cookieV;
  refresh_Cart();
}

$(document).ready(function(){
  $.ajax({
    url:"/myCart.php",
    method:"POST",
    success:function(data){
        $('#display_myCart').html(data);
    }
  })
});