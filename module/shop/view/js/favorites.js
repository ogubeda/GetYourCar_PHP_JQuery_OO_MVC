function detectFav() {
    //////
    $('.card-shop').on('click', '#fav-btn', function() {
        const thisBtn = $(this);
        //////
        ajaxPromise('module/shop/controller/controllerShop.php?op=updateFavs', 'POST', 'JSON', {carPlate: $(this).closest('.card-shop').attr('name')})
        .then(function(data) {
            if (data === true) {
                thisBtn.addClass('active-fav-btn');
            }else {
                thisBtn.removeClass('active-fav-btn');
            }// end_else
        }).catch(function(error) {
            console.log(error);
        })
    });
}// end_detectFav
//////

function sendFavs() {
    //////
    ajaxPromise('module/shop/controller/controllerShop.php?op=sendFavs', 'POST', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('#' + data[row].carPlate).find('#fav-btn').addClass('active-fav-btn');
        }// end_for
    }).catch(function(error) {
        console.log(error);
    });
}// end_sendFavs