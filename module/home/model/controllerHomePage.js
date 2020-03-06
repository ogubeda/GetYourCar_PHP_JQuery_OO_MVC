function loadSlider() {
    //////
    $.ajax({
        url: 'module/home/controller/controllerHomePage.php?op=homePageSlide',
        type: 'GET',
        dataType: 'JSON'
    }).done(function(data) {
        //////
        for (row in data) {
            $('<div></div>').attr({'id': data[row].carPlate, "class": "single-slide", "style": "background-image: url(view/img/allCarsImg/" + data[row].image + ")"}).appendTo('.hero-slider')
            .html('<div class= "slide-content text-center"><h2>' + data[row].brand + " " + data[row].model + " " + data[row].carPlate + '</h2></div>');
        }// end_for

            $(".hero-slider").addClass('owl-carousel');
            $(".owl-carousel").owlCarousel({
                items: 1,
                autoplay: true,
                animateIn: 'fadeIn',
                animateOut: 'fadeOutLeft',
                loop: true,
                autoplayHoverPause: true,
                nav: true,
                autoHeight:true,
                navText: [
                    '<i class="fa fa-angle-left"></i>',
                    '<i class="fa fa-angle-right"></i>'
                ]
            });
    }).fail(function() {
        window.location.href = "index.php?page=error503";
    });
    //////
}// end_loadSlider
//////

function loadCatBrands() {
    //////
    ajaxPromise('module/home/controller/controllerHomePage.php?op=homePageCat', 'POST', 'JSON').then(function(data) {
        for (row in data) {
            let brand = data[row].brand.replace(/ /g, "_");
            $('<div></div>').attr({'id': brand, 'class':'col-md-4 single-service-2'}).appendTo('#containerCategories');
            $('<div></div>').attr({'class':'inner'}).html('<img src = "' + data[row].image + '" style = "max-width: 100%; height: 100px;"><h4 style = "padding-top: 25px">' + data[row].brand + '</h4></img>').appendTo('#' + brand);
        }// end_for
    })
    .catch(function() {
        //window.location.href = 'index.php?page=error503';
    });
}// end_loadCatBrands
//////

function loadDivs() {
    //////
    //////
    $('<h1></h1>').html('Our Most Visited Brands').appendTo('#homePage').attr("style", "padding-bottom: 50px");
    $('<div></div>').attr({'id': "containerCategories", 'class':'row'}).appendTo('#homePage');
    //////
    loadSlider();
    loadCatBrands();
}// end_loadDivs
//////

function redirectShop() {
    //////
    $(document).on('click', '.single-service-2', function() {
        var brand = this.getAttribute('id').replace("_", " ");
        //////
        $.ajax({
            url: 'module/home/controller/controllerHomePage.php?op=incrementView',
            type: 'POST',
            data: {brand: brand}
        }).done(function(data) {
            if (data == 1) {
                var filter = {'brand': [brand]};
                localStorage.setItem('filters', JSON.stringify(filter));
                localStorage.setItem('currentPage', 'shop');
                window.location.href = "index.php?page=shop&op=list";
            }else {
                console.log('Error when trying to find the brand.');
            }// end_else
        }); // end_done 
    });
    //////
    $(document).on('click', '.single-slide', function() {
        localStorage.setItem('carPlate', this.getAttribute('id'));
        localStorage.setItem('currentPage', 'shop-details');
        window.location.href = "index.php?page=shop&op=list"
    });
}// end_redirectShop

$(document).ready(function () {
    loadDivs();
    redirectShop();
});
