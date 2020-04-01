function addToCart() {
    //////
    $(document).on('click', '#cart-btn', function() {
        cartSys($(this).closest('.card-shop').attr('name'));
    });
}// end_addToCart
//////

function cartSys(carPlate) {
    //////
    storeCart(carPlate)
    .then(function() {
        console.log('Saved.');
    }).catch(function() {
        insertCart(carPlate);
    });
}// end_cartSys
//////

function insertCart(carPlate) {
    //////
    let localCart = [];
    if (localStorage.getItem('cart')) {
        localCart = JSON.parse(localStorage.getItem('cart'));
    }// end_if
    if (!localCart.includes(carPlate)) {
        localCart.push(carPlate)
    }// end_if
    localStorage.setItem('cart', JSON.stringify(localCart));
    //////
}// end_insertCart

function removeCart(cart, carPlate) {
    //////
    let position = cart.indexOf(carPlate);
    cart.splice(position, 1);
    ///////
    if ($(cart).size() <= 0) {
        deleteCart();
        return;
    }// end_if
    localStorage.setItem('cart', JSON.stringify(cart));
    //////
}// end_removeCart
//////

function deleteCart() {
    //////
    localStorage.removeItem('cart');
}// end_deleteCart
//////

function getCart() {
    return ajaxPromise('module/cart/controller/controllerCart.php?op=getCart', 'POST', 'JSON');
}// end_getCart
//////

function storeCart(carPlate) {
    //////
    return ajaxPromise('module/cart/controller/controllerCart.php?op=storeCart', 'POST', 'JSON', {carPlate: carPlate});
}// end_storeCart
//////

function restoreCart(dbCart) {
    //////
    let values = [];
    let cart = Object.values(dbCart);
    //////
    if (localStorage.getItem('cart')) {
        values = JSON.parse(localStorage.getItem('cart'))
    }// end_if
    for (row in values) {
        if (!cart.includes(values[row])) {
            storeCart(values[row]);
        }// end_if
    }// end_for
    deleteCart();
}// end_storeCart
