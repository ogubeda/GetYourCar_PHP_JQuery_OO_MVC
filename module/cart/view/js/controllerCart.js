function addToCart() {
    //////
    $(document).on('click', '#cart-btn', function() {
        cartSys($(this).closest('.card-shop').attr('name'));
    });
}// end_addToCart
//////

function cartSys(carPlate) {
    //////
    let data = [];
    let stop = false;
    if (localStorage.getItem('cart')) {
        data = JSON.parse(localStorage.getItem('cart'));
        if (data.includes(carPlate)) {
            data = removeCart(data, carPlate);
            stop = true;
        }// end_if
    }// end_if
    if (stop === false) {
        data.push(carPlate);
    }// end_if
    if ($(data).size() <= 0) {
        localStorage.removeItem('cart');
        return;
    }// end_if
    localStorage.setItem('cart', JSON.stringify(data));
}// end_cartSys
//////

function removeCart(cart, carPlate) {
    //////
    let position = cart.indexOf(carPlate);
    cart.splice(position, 1);
    ///////
    return cart;
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
}

function storeCart() {
    //////
    return ajaxPromise('module/cart/controller/controllerCart.php?op=storeCart', 'POST', 'JSON', {cart: JSON.parse(localStorage.getItem('cart'))});
}// end_storeCart