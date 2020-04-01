function loadDataCart() {
    //////
    let price = 0;
    ajaxPromise('module/cart/controller/controllerCart.php?op=loadDataCart', 'POST', 'JSON')
    .then(function(data) {
        console.log(data);
        for (row in data) {
            $('<div></div>').attr({'id': data[row].carPlate, 'class': 'product-element'}).html(data[row].brand + ' ' + data[row].model).appendTo('#container-details-cart');
            price = price + parseFloat(data[row].price);
        }
        console.log(price);
    }).catch(function(error) {
        $('<h3></h3>').attr({'id': 'error-cart-load'}).html('It seems your cart is empty :(').appendTo('#container-details-cart');
        console.log(error);
    });
}// end_loadDataCart
//////

$(document).ready(function() {
    setTimeout(function() {loadDataCart()}, 100);
});