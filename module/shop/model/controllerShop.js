function loadShop() {
    //////
    var filters = localStorage.getItem('filters') || false;
    //////
    if ((filters != false)) {
        var url = 'module/shop/controller/controllerShop.php?op=filter&filters=' + filters;
        if ($('#remove-filters').length == 0) {
            $('<button></button>').attr({'class':'default-button fadeInLeftAnimation', 'id': 'remove-filters'}).appendTo('.filter-content').html('Remove filters');
        }
    }else {
        $('#remove-filters').remove();
        var url = 'module/shop/controller/controllerShop.php?op=sendInfo';
    }// end_else
    //////
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON'
    }).done(function(data) {
        $('.container-shop').empty();
        for (row in data) {
            brand = data[row].brand.replace(/ /g, "_");
            $('<div></div>').attr({'id': data[row].carPlate, 'class':'card-shop fadeInAnimation'}).appendTo('.container-shop');
            $('<div></div>').attr({'class':'inner'}).html('<h4 style = "padding-top: 25px">' + data[row].brand + " " + data[row].model + '</h4>').appendTo('#' + data[row].carPlate);
        }// end_for
    }).fail(function() {
        localStorage.removeItem('filters');
        location.reload();
    });// end_ajax
}// end_loadShop
//////

function loadFilters() {
    //////
    $.ajax({
        url: 'module/shop/controller/controllerShop.php?op=sendFilters',
        type: 'GET',
        dataType: 'JSON'
    }).done(function(data) {
        loadGMaps();
        for (row in data) {
            $('<h4 class = "filter-title"></h4>').html(row.toUpperCase()).appendTo('.container-filter');
            for (row_inner in data[row]) {
                let keys = Object.keys(data[row][row_inner]);
                $('<div></div>').attr({'class': 'filter-col', 'id': data[row][row_inner][row].replace(/ /g, "_") + keys + "-filter-div"})
                .appendTo('.container-filter')
                .html('<a style = "width: 100%" id="filter-btn" class = "' + row + '" name="' + data[row][row_inner][row]+ '">' + data[row][row_inner][row] + '</a>');
                //////                
            }// end_for
        }// end_for
        //////
        highlightFilters();
        //////
    }).fail(function() {
        //window.location.href = "index.php?page=error503";
    });// end_ajax
}// end_loadFilters
//////

function loadGMaps() {
    //////
    $.ajax({
        url: 'module/shop/controller/controllerShop.php?op=sendAllCon',
        type: 'POST',
        dataType: 'JSON'
    }).done(function(data) {
        $('<div></div>').attr({'id': 'container-map', 'style': 'margin: 5px 5px'}).prependTo('.container-filter');
        $('<div></div>').attr({'id': 'map', 'style': 'width: auto; height: 200px'}).appendTo('#container-map');
        //////
        var center = {lat: 39.9203365, lng: -3.511509};
        var map = new google.maps.Map(document.getElementById('map'),{
                    zoom: 4,
                    center: center});
        //////
        for (row in data) {
            var split = data[row].locationCon.split(",");
            var location = {lat: parseFloat(split[0]), lng: parseFloat(split[1])}
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: data[row].nameCon
            });
        }// end_for
    }).fail(function() {
        //window.location.href = 'index.php?page=error503';
    });// end_ajax
}// end_loadGMaps
//////

function highlightFilters() {
    //////
    $('.filter-col').removeClass('active-filter');
    if (localStorage.getItem('filters')) {
        let filters = JSON.parse(localStorage.getItem('filters'));
        for (row in filters) {
            for (row_inner in filters[row]) {
                let content = '#' + filters[row][row_inner].replace(/ /g, "_") + row + '-filter-div';
                $(content).addClass('active-filter');
            }// end_for
        }// end_for
    }// end_if
    //////
}// end_highlightFilters
//////

function showDetails() {
    //////
    ajaxPromise('module/shop/controller/controllerShop.php?op=read&carPlate=' + localStorage.getItem('carPlate'), 'GET', 'JSON').then(function(data) {
        $('.content').empty();
        $('<div></div>').attr({'class': 'top-details'}).appendTo('.content');
        $('<div><div>').attr({'class': 'top-photo'}).appendTo('.top-details');
        $('<div></div>').attr({'class': 'container separe-menu', 'id': 'container-shop-details'}).appendTo('.content');
        $('.top-photo').css({'background': 'url(view/img/allCarsImg/' + data.image + ')', 'background-size': 'cover', 'background-position': 'center'});
        //////
        $('<div></div>').attr({'class': 'container-brand'}).appendTo('#container-shop-details');
        $('<h3></h3>').html(data.brand + " " + data.model).appendTo('.container-brand');
        //////
        $('<div></div>').attr({'class': 'container-specs'}).appendTo('#container-shop-details');
        $('.container-specs').html('<h5>Seats: ' + data.seats + ' Doors: ' + data.doors + '</h5>');
        //////
        $('<div></div>').attr({'class': 'container-engine'}).appendTo('#container-shop-details');
        $('.container-engine').html('<h5>Gear Shift: ' + data.gearShift + ' Type Engine:' + data.typeEngine + ' CV: ' + data.cv + ' Max Speed: ' + data.maxSpeed + '</h5>');
        //////
        $('<div></div>').attr({'class': 'container-others'}).appendTo('#container-shop-details');
        $('.container-others').html('<h5>Roads: ' + data.roads + ' Extras: ' + data.extras + ' Start Date: ' + data.startDate + ' End Date: ' + data.endDate + '</h5>');
    }).catch(function() {
        //window.location.href = 'index.php?page=error503'
    }); // end_ajaxPromise
    //////
}// end_showModal
//////

function redirectDetails() {
    //////
    $(document).on("click", ".card-shop", function(){
        localStorage.setItem('currentPage', 'shop-details');
        localStorage.setItem('carPlate', this.getAttribute('id'))
        location.reload();
    });
}// end_redirectDetails
//////

function filter() {
    //////
    $(document).on('click', '#filter-btn', function() {
        let filterKey = this.getAttribute('class');
        let insFilter = this.getAttribute('name');
        //////
        if (localStorage.getItem('filters')) {
            var pastFilters = JSON.parse(localStorage.getItem('filters'));
            var obj = Object.keys(pastFilters);
            //////
            if (obj.includes(filterKey)) {
                //////
                if (pastFilters[filterKey].includes(insFilter)) {
                    var arrPosition = pastFilters[filterKey].indexOf(insFilter);
                    pastFilters[filterKey].splice(arrPosition, 1);
                    //////
                    if ($(pastFilters[filterKey]).size() == 0) {
                        //console.log((pastFilters[filterKey]).size());
                        delete pastFilters[filterKey];
                    }// end_if
                }else {
                    pastFilters[filterKey].push(insFilter);
                }// end_else
            }else {
                pastFilters[filterKey] = [insFilter];
            }// end_else
            //////
            if (Object.keys(pastFilters).length == 0) {
                localStorage.removeItem('filters');
            }else {
                localStorage.setItem('filters', JSON.stringify(pastFilters))
            }// end_else
        }else {
            var allFilters = {[filterKey] : [insFilter]};
            localStorage.setItem('filters', JSON.stringify(allFilters));
        }// end_else
        //////
        highlightFilters();
        loadShop();
    });
}// end_filter
//////

function removeFilters() {
    /////
    $(document).on('click', '#remove-filters', function() {
        localStorage.removeItem('filters');
        highlightFilters();
        loadShop();
    });
}// end_removeFilters
//////

function loadContent(){
    //////
    if (localStorage.getItem('currentPage') == 'shop-details') {
        showDetails();
    }else { 
        loadFilters();
        loadShop();
        filter();
        redirectDetails();
        removeFilters();
    }// end_else
}// end_loadContent
$(document).ready(function() {
    loadContent();
}); // end_ready