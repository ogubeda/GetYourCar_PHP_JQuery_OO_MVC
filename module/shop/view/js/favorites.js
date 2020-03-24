function detectFav() {
    //////
    $('.card-shop').on('click', '#fav-btn', function() {
        const thisBtn = $(this);
        ajaxPromise('module/shop/controller/controllerShop.php?op=updateFavs', 'POST', 'JSON', {carPlate: $(this).closest('.card-shop').attr('name')})
        .then(function(data) {
            if (data === true) {
                console.log('Added');
                thisBtn.addClass('active-fav-btn');
            }else {
                thisBtn.removeClass('active-fav-btn');
                console.log('Removed');
            }
        });
    });
}// end_detectFav