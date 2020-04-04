function addToCart() {
    //////
    $('.card-shop').on('click', '#cart-btn', function() {
        $(this).addClass('active-cart-btn');
        cartSys($(this).closest('.card-shop').attr('name'));
    });
    $('.container-others').on('click', '#cart-btn', function() {
        cartSys(localStorage.getItem('carPlate'));
    });
}// end_addToCart
//////

function paintCart() {
    //////
    ajaxPromise('module/cart/controller/controllerCart.php?op=selectCart', 'POST', 'JSON')
    .then(function(data) {
        if (data === 'false') {
            if (localStorage.getItem('cart')) {
                data = JSON.parse(localStorage.getItem('cart'));
            }else {
                return;
            }// end_else
        }// end_if
        for (row in data) {
            $('#' + data[row].carPlate).find('#cart-btn').addClass('active-cart-btn');
        }// end_for
    }).catch(function(error) {
        console.log(error);
    });
}// end_paintCart   

function cartSys(carPlate) {
    //////
    storeCart(carPlate, 1)
    .then(function() {
        console.log('Saved.');
    }).catch(function(error) {
        console.log(error);
        insertCart(carPlate);
    });
}// end_cartSys
//////

function insertCart(carPlate) {
    //////
    let localCart = [];
    let objCart = {carPlate: "", days: ""};
    if (localStorage.getItem('cart')) {
        localCart = JSON.parse(localStorage.getItem('cart'));
    }// end_if
    if (!localCart.some(e => e.carPlate === carPlate)) {
        objCart.carPlate = carPlate;
        objCart.days = 1;
        localCart.push(objCart);
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
    return ajaxPromise('module/cart/controller/controllerCart.php?op=getCart', 'POST', 'JSON', {cart: JSON.parse(localStorage.getItem('cart'))});
}// end_getCart
//////

function storeCart(carPlate, days) {
    //////
    return ajaxPromise('module/cart/controller/controllerCart.php?op=storeCart', 'POST', 'JSON', {carPlate: carPlate, days: days});
}// end_storeCart
//////

function restoreCart() {
    //////
    let values = [];
    //////
    if (localStorage.getItem('cart')) {
        values = JSON.parse(localStorage.getItem('cart'))
    }// end_if
    for (row in values) {
        storeCart(values[row].carPlate, values[row].days).then(function() {
            console.log('Stored.');
        }).catch(function(error) {
            console.log(error);
        });
    }// end_for
    deleteCart();
}// end_storeCart
//////

function updateDaysLocal(carPlate, days) {
    //////
    let localCart = JSON.parse(localStorage.getItem('cart'));
    let index = 0;
    if (localCart.some(e => e.carPlate === carPlate)) {
        index = localCart.findIndex(obj => obj.carPlate === carPlate);
        localCart[index].days = days;
        //////
        localStorage.setItem('cart', JSON.stringify(localCart));
    }// end_updateDays
}// end_updateDays
