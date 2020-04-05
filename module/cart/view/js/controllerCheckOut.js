function addCartEvents() {
    //////
    $(document).on('change', '.select-drop-days', function() {
        if ($(this).val() > 0 && $(this).val() <= 10) {
            updateDays($(this).val(), $(this).closest('.product-element').attr('id'));
        }else {
            console.log('Invalid quantity of days.');
        }// end_else
    });//
    //////
    $(document).on('click', '#checkout-btn', function() {
        checkOutCart();
    });
    $(document).on('click', '#delete-btn', function() {
        const thisBtn = $(this);
        removeDBCart(thisBtn.closest('.product-element').attr('id'))
        .then(function(data) {
            if (data === false) {
                if (localStorage.getItem('cart')) {
                    removeCart(thisBtn.closest('.product-element').attr('id'));
                }// end_if
            }// end_if
            getDataCart();
        }).catch(function(error) {
            console.log(error);
        });
        
    });
}// end_addCartEvents
//////

function checkOutCart() {
    //////
    ajaxPromise('module/cart/controller/controllerCart.php?op=checkOut')
    .then(function(data) {
        if (data === "false") {
            localStorage.setItem('purchase', true);
            window.location.href = 'index.php?page=log-in&op=list';
        }// end_if
    }).catch(function(error){
        console.log(error);
    });
}// end_checkOutCart

function updateDays(days, carPlate) {
    //////
    ajaxPromise('module/cart/controller/controllerCart.php?op=updateDays', 'POST', 'JSON', {days: days, carPlate: carPlate})
    .then(function() {
        getDataCart();
    }).catch(function(error) {
       if (localStorage.getItem('cart')) {
           updateDaysLocal(carPlate, days);
           getDataCart();
       }else {
           console.log(error);
       }
    })
}// end_updateDays
//////

function getDataCart() {
    //////
    ajaxPromise('module/cart/controller/controllerCart.php?op=loadDataCart', 'POST', 'JSON')
    .then(function(data) {
        printDataCart(data);
    }).catch(function(error) {
        if (!localStorage.getItem('cart')) {
            $('#container-details-cart').empty();
            $('#price-cart-calc').empty();
            $('#checkout-btn').remove();
            $('<h3></h3>').attr({'id': 'error-cart-load'}).html('It seems your cart is empty :(').appendTo('#container-details-cart');
        }else {
            getCart()
            .then(function(data) {
                printDataCart(data, JSON.parse(localStorage.getItem('cart')));
            }).catch(function() {
                $('#container-details-cart').empty();
                $('#price-cart-calc').empty();
                $('#container-price-cart').empty();
                $('<h3></h3>').attr({'id': 'error-cart-load'}).html('It seems your cart is empty :(').appendTo('#container-details-cart');
            });
        }// end_else
        console.log(error);
    });
}// end_getDataCart
//////

function printDataCart(cart, localCart = null) {
    //////
    let totalPrice = 0;
    let price = 0;
    let days = 0;
    $('#container-details-cart').empty();
    $('#price-cart-calc').empty();
    $('#checkout-btn').remove();
    //////
    for (row in cart) {
        days = parseFloat(cart[row].days) || parseFloat(localCart[row].days) || 1;
        price = parseFloat(cart[row].price) * (1 + (days / 10 - 0.1));
        totalPrice = totalPrice + price;
        //////
        $('<div></div>').attr({'id': cart[row].carPlate, 'class': 'product-element'}).appendTo('#container-details-cart');
        $('<span></span>').attr({'id': 'info-cont'}).html(cart[row].brand + ' ' + cart[row].model).appendTo('#' + cart[row].carPlate);
        $('<span></span>').attr({'id': 'select-days' + cart[row].carPlate}).html('Days ').appendTo('#' + cart[row].carPlate);
        $('<select></select>').attr({'class': 'select-drop-days', 'name': 'quantity-days', 'autocomplete': 'off', 'id': 'select-daysI-' + cart[row].carPlate}).appendTo('#select-days' + cart[row].carPlate);
        for (let i = 0; i < 10; i++) {
            $('<option></option>').attr({'value': i + 1, 'selected':function() {
                if ((i + 1 ) === days) {
                    return true
                }// end_if
                return false;
            } }).html(i + 1).appendTo('#select-daysI-' + cart[row].carPlate);

        }// end_for
        $('<a></a>').attr({'style': 'margin-left: 15px', 'id': 'delete-btn'}).html('Delete').appendTo('#' + cart[row].carPlate)
        $('<span></span>').attr({'id': 'info-price'}).html(price + '€').appendTo('#' + cart[row].carPlate);
    }
    $('<span></span>').attr({'id': 'i'}).html(totalPrice + '€').appendTo('#price-cart-calc');
    $('<a></a>').attr({'id': 'checkout-btn'}).html('Check out').appendTo('#container-price-cart');
}// end_printDataCart
//////

$(document).ready(function() {
    setTimeout(function() {getDataCart()}, 100);
    addCartEvents();
});