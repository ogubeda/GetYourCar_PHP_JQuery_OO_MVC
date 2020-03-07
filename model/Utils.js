function easyAjax(sUrl, sType, sTData, sData = undefined) {
    //////
    $.ajax({
        url: sUrl,
        type: sType,
        dataType: sTData,
        data: sData
    }).done(function(data) {
        return data;
    }).fail(function() {
        return false;
    }); //end_ajax
}// end_easyAjax
//////

function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData
        }).done((data) => {
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            reject(errorThrow);
        }); // end_ajax
    });
}