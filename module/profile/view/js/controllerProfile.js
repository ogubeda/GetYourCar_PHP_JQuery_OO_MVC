function addBTNEvents() {
    //////
    $(document).on('click', '#show-favs', function() {
        if ($('#container-fav').length <= 0) {
            showUserFavs();
        }//end_if
    });//
    //////
    $(document).on('click', '#back-btn', function() {
        loadContent();
        loadUserData(true);
    });
}

function loadUserData(again = false) {
    //////
    ajaxPromise('module/profile/controller/controllerProfile.php?op=sendData', 'POST', 'JSON')
    .then(function(data) {
        console.log(data);
        document.title = data.username;
        if (again === false) {
            $('<img></img>').attr({'src': data.avatar}).appendTo('#container-avatar');
        }// end_if
        $('<span></span>').html(data.username).appendTo('#container-username');
        $('<span></span>').html(data.email).appendTo('#container-email');
        $('<span></span>').html(data.registerDate).appendTo('#container-date');
    }).catch(function(error) {
        console.log(error);
    });// end_catch
    //////
}// end_loadUserData
//////

function showUserFavs() {
    //////
    ajaxPromise('module/profile/controller/controllerProfile.php?op=sendUserFavs', 'POST', 'JSON')
    .then(function(data) {
        console.log(data);
        $('#profile-right').empty();
        $('<div></div>').attr({'id': 'header-favs', 'style': 'display: flex; margin-bottom: 40px'}).appendTo('#profile-right');
        $('<a></a>').attr({'id': 'back-btn', 'class': 'neumorph-btn', 'style': 'flex: 50%; max-width: 50px; margin-right: 50px'}).html('Back').appendTo('#header-favs');
        $('<h2></h2>').attr({'style': 'flex: 50%'}).html('Favorites').appendTo('#header-favs');
        $('<div></div>').attr({'id': 'container-fav', 'class': 'neumorph-sec'}).appendTo('#profile-right');
        for (row in data) {
            $('<a></a>').attr({'id': data[row].carPlate, 'class': 'fav-cars', 'style': 'display:block'}).appendTo('#container-fav');
            $('<img></img>').attr({'src': 'view/img/allCarsImg/' + data[row].image, 'style': 'max-width: 35%; max-height: 35%'}).appendTo('#' +  data[row].carPlate);
            $('<div></div>').attr({'style': 'font-weight: bold; font-size: 18px'}).html(data[row].brand + ' ' + data[row].model + ' ' + data[row].carPlate).appendTo('#' + data[row].carPlate);
        }// end_for
    }).catch(function (error) {
        console.log(error);
    }); // end_ajax
    //////
}//

function loadContent() {
    //////
    $('.container-search').remove();
    $('#profile-right').empty();
    $('<div></div>').attr({'id': 'container-data'}).appendTo('#profile-right');
    $('<div></div>').attr({'id': 'container-username', 'class': 'neumorph-child'}).html('<a>Username</a>').appendTo('#container-data');
    $('<div></div>').attr({'id': 'container-email', 'class': 'neumorph-child', 'style': 'margin-top: 20px'}).html('<a>Email</a>').appendTo('#container-data');
    $('<div></div>').attr({'id': 'container-date', 'class': 'neumorph-child', 'style': 'margin-top: 20px'}).html('<a>Register Date</a>').appendTo('#container-data');
    $('<div></div>').attr({'id': 'modify-profile'}).appendTo('#profile-right').html('<a class = "neumorph-btn" style = "margin-top: 100px;">Delete Account</a>');
    //////
    
}//end_loadContent

$(document).ready(function() {
    loadContent();
    setTimeout(function() { loadUserData()}, 100);
    addBTNEvents();
});