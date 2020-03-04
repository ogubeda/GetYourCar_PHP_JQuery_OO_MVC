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
                $('#drop-con').append('<option value = "' + data[row].idCon + '">' + data[row].nameCon + '</option>');
            }
        }).fail(function() {
            console.log('F');
        });
    });
}// end_listDropCon
//////

function autoComplete() {
    //////
    $("#autocom").on('click keyup', function() {
        let sData = {complete: $(this).val()};
        if ($('#drop-con').val() != 0) {
            sData.dropCon = $('#drop-con').val();
        }// end_id
        //////
        $.ajax({
            url: 'module/search/controller/controllerSearch.php?op=autoComplete',
            type: 'POST',
            data: sData,
            dataType: 'JSON'
        }).done(function(data) {
            $('#searchAuto').empty();
            $('#searchAuto').fadeIn(1000);
            for (row in data) {
                $('<div></div>').appendTo('#searchAuto').html(data[row].brand).attr({'class': 'searchElement', 'id': data[row].brand});
            }// end_for
            //////
            $(document).on('click', '.searchElement', function() {
                $('#autocom').val(this.getAttribute('id'));
                $('#searchAuto').fadeOut(1000);
            });
            $(document).on('click scroll', function(event) {
                if (event.target.id !== 'autocom') {
                    $('#searchAuto').fadeOut(500);
                }
            })
            //////
        }).fail(function() {
            console.log('f');
        });// end_fail
    });
}// end_autoComplete
//////

function btnSearch() {
    //////
    $('#search-btn').on('click', function() {
        const obj = {'idCon': [$('#drop-con').val()], 'brand': [$('#autocom').val()]};
        localStorage.setItem('filters', JSON.stringify(obj));
        //////
        window.location.href = 'index.php?page=shop&op=list';
    });// end_search-btn
}// end_btnSearch
//////

$(document).ready(function() {
    listDropProvinces();
    listDropCon();
    autoComplete();
    btnSearch();
});// end_document.ready