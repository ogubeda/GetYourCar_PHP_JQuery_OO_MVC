function loadUserData() {
    //////
    ajaxPromise('module/profile/controller/controllerProfile.php?op=sendData', 'POST', 'JSON')
    .then(function(data) {
        console.log(data);
    }).catch(function(error) {
        console.log(error);
    });
}// end_loadUserData
//////

function loadContent() {
    //////
    $('.container-search').remove();
    //////
    
}//end_loadContent

$(document).ready(function() {
    loadContent();
    setTimeout(function() {
        loadUserData()}, 100);
});