function loadMap() {
    var location = {lat: 38.809893, lng: -0.604617}; 
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: location
    }); // end_map
    ////
    var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h4>Ontinyent</h4>'+
        '<div id="bodyContent">'+
        '<p><b>Get your Car</b></p>'+
        '<a href="index.php?page=controllerHomePage&op=list">Home</a>'+
        '</div>'+
        '</div>';
        //////
    var popWindow = new google.maps.InfoWindow({
        content: contentString
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: 'Get your Car'
    });
    //////
    marker.addListener('click', function() {
        popWindow.open(map, marker);
    });
}// end_loadMap
//////

$(document).ready(function() {
    localStorage.setItem('currentPage', 'contact');
    //loadMap();
});