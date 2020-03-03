function listDropProvinces() {
    //////
    $.ajax({
        url: 'module/search/controller/controllerSearch.php?op=listProvinces',
        type: 'POST',
        dataType: 'JSON'
    }).done(function(data) {
        for (row in data) {
            $('#drop-province').append('<option value = "' + data[row].province + '">' + data[row].province + '</option>');
        }// end_for
    }).fail(function() {
    });// end_fail
}// end_listDropBrands
//////

function listDropCon() {
    //////
    $('#drop-province').on('change', function() {
        let prov = $(this).val();
        $.ajax({
            url: 'module/search/controller/controllerSearch.php?op=listCon&province=' + prov,
            type: 'GET',
            dataType: 'JSON'
        }).done(function(data) {
            $('#drop-con').empty();
            $('#drop-con').append('<option value = "0">Select the Concessionaire</option>');
            for (row in data) {
                $('#drop-con').append('<option value = "' + data[row].nameCon + '">' + data[row].nameCon + '</option>');
            }
        }).fail(function() {
            console.log('F');
        });
    });
}// end_listDropCon
$(document).ready(function() {
    listDropProvinces();
    listDropCon();
});// end_document.ready