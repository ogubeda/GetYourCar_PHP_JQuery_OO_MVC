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

function lowCharge() {
    //////
    $('.page-title').Lazy();
    $('.single-slide').Lazy();
    $('.inner').Lazy();
}// end_lowCharge
//////

function openSideNav() {
    //////
    $('#more-options').on('click', function() {
        $('#options-sideNav').show(150);
    });
    //////
    $('#close-options-sideNav').on('click', function() {
        $('#options-sideNav').hide(150);
    });
}// end_openSideNav
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
    openSideNav();
    lowCharge();
    parallaxScroll();
});