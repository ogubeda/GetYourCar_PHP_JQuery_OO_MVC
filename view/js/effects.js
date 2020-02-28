function parallaxScroll() {
    //////
    $(window).on('scroll', function() {
        var scrollPos = $(window).scrollTop();
        //////
        $('.page-title').css({
            'background-position': 'center ' + (170 - (scrollPos * 0.35))  + '%'
        });

        $('.page-middle-title').css({
            'background-position': 'center ' + (100 - (scrollPos * 0.15))  + '%'
        });
    });
}// end_parallaxScroll
//////

function footerOnBottom() {
    //////
    $("footer").removeClass("fixed-footer");
    var windHeight = $(window).height();
    var x = $("header").height() + $(".content").height();
    if (($('.hero-slider').length) || ($('.list-cars').length) || ($('#userOrderList').length) || ($('.container-shop').length)) {
        x = windHeight + 1000;
    }
    if (windHeight > x) {
        $("footer").addClass("fixed-footer");
    }// end_if
}// end_footerOnBottom
//////

function lowCharge() {
    //////
    $('.page-title').Lazy();
    $('.single-slide').Lazy();
    $('.inner').Lazy();
}// end_lowCharge
//////

function addLSPage() {
    //////
    $('.menu-btn').on('click', function() {
        localStorage.setItem('currentPage', this.getAttribute('id'));
        if (localStorage.getItem('currentPage') != "shop") {
            localStorage.removeItem('filters');
        }// end_if
        if (localStorage.getItem('currentPage') != "shop-details") {
            localStorage.removeItem('carPlate');
        }// end_if
    });
}//end_addLSPage
//////

$(document).ready(function() {
    addLSPage();
    lowCharge();
    //footerOnBottom();
    parallaxScroll();
});