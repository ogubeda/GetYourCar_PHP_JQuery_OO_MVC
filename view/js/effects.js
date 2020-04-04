const cartBtn = '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-plus" class="svg-inline--fa fa-cart-plus fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z"></path></svg>';
const favBtn = '<svg viewBox="-5 -28 522.00002 512" xmlns="http://www.w3.org/2000/svg">' + 
                '<path d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 ' +
                '0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 ' + 
                '33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 ' + 
                '0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 ' + 
                '109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 ' + 
                '75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 ' + 
                '4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 ' + 
                '20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 ' + 
                '127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 ' + 
                '0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0"/></svg>';
                
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
    $(document).on('click', '#more-options',function() {
        $('#options-sideNav').show(150);
    });
    //////
    $(document).on('click', '#close-options-sideNav',function() {
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