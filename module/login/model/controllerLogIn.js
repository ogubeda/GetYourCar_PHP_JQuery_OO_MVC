function loadLogIn() {
    //////
    $('#register-btn').on('click', function() {
        localStorage.setItem('currentPage', 'register')
        location.reload();
    });
    $('#login-btn').on('click', function() {
        checkLogIn();
    });
}// end_loadLogIn

function checkLogIn() {
    //////
    var error = false;
    var user = {'username': document.getElementById('username').value,
                'password': document.getElementById('password').value}
    //////
    var result = regExData(user);
    $('#error').remove();
    for (row in result) {
        if (result[row] == false) {
            error = true;
            $('<span></span>').attr({'id': 'error', 'style': 'position: relative; float: right', 'class': 'error'}).html('Invalid username/password').appendTo('#top-form');
            break;
        }// end_if
    }// end_for
}// end_checkLogIn

function loadRegister() {
    //////
    $('.container-login').empty();
    $('<form></form>').attr({'method': 'POST', 'name': 'registerForm', 'id': 'registerForm', 'class': 'separe-menu', 'autocomplete': 'off'}).html('<h2>Register</h2>').appendTo('.container-login');
    $('<div></div>').attr({'class': 'input', 'autocomplete': 'off'}).html('<h6 id = "input-username">Username</h6><input type="text" name="username" id="username" placeholder = "Username"/>').appendTo('#registerForm');
    $('<div></div>').attr({'class': 'input', 'autocomplete': 'off'}).html('<h6 id="input-email">Email</h6><input type="text" name="email" id="email" placeholder = "example@domain.com"/>').appendTo('#registerForm');
    $('<div></div>').attr({'class': 'input', 'autocomplete': 'off'}).html('<h6 id="input-password">Password</h6><input type="password" name="password" id="password" placeholder = "Password"/>').appendTo('#registerForm');
    $('<div></div>').attr({'class': 'input', 'id': 'container-re_password', 'autocomplete': 'off'}).html('<h6 id="input-re_password">Re-type Password</h6><input type="password" name="re-password" id="re-password" placeholder = "Password"/>').appendTo('#registerForm');
    $('<div></div>').attr({'class': 'input', 'autocomplete': 'off'}).html('<input type="button" value = "Register" class = "reg-check-btn" style = "color: #0ca3e9"/>').appendTo('#registerForm');
    $('<div></div>').attr({'class': 'input', 'autocomplete': 'off'}).html('<input type="button" value = "Back" class = "reg-back-btn" style = "color: #ff5722"/>').appendTo('#registerForm');
}// end_loadRegister

function btnsRegister() {
    //////
    $(document).on('click', '.reg-check-btn', function() {
        checkRegister();
    });
    $(document).on('click', '.reg-back-btn', function() {
        localStorage.setItem('currentPage', 'logIn')
        location.reload();
    });
}// end_btnsRegister

function checkRegister() {
    //////
    var user = {'username': document.getElementById('username').value, 
                'email': document.getElementById('email').value, 
                'password': document.getElementById('password').value, 
                're_password': document.getElementById('re-password').value};
    //////
    var results = regExData(user);
    var error = false;
    //////
    $('.error').remove();
    for (row in results) {
        if (results[row] == false) {
            error = true;
            $('<span></span>').attr({'id': 'error-' + row, 'style': 'position: relative; float: right', 'class': 'error'}).html('Invalid value').appendTo('#input-' + row);
            if (row == 'ePass') {
                $('<span></span>').attr({'id': 'error-' + row, 'style': 'position: relative; float: right', 'class':'error'}).html("Password don't match").appendTo('#container-re_password');
            }// end_if
        }// end_if
    }// end_for
    //////
    if (error == false) {
        user.password = CryptoJS.AES.encrypt(user.password, passPhrase).toString(CryptoJS.enc.Utf8);
        console.log(user.password);
        console.log(CryptoJS.AES.decrypt(user.password, passPhrase).toString(CryptoJS.enc.Utf8));
        $.ajax({
            url: 'module/login/controller/controllerLogIn.php?op=register',
            type: 'POST',
            dataType: 'JSON',
            data: user
        }).done(function(data) {
            console.log(data);
        }).fail(function() {
            console.log('Fail when trying to register.');
        });// end_fail
    }// end_if
}// end_checkRegister

function regExData(user) {
    //////
    var regEx = "";
    var results = {};
    for (row in user) {
        if (row == 'email') {
            regEx = /^[A-Za-z0-9._-]{5,20}@[a-z]{3,6}.[a-z]{2,4}$/;
        }else if (row == 'username') {
            regEx = /^[A-Za-z._-]{5,15}$/;
        }else {
            regEx = /^[A-Za-z0-9._-]{5,20}$/;
        }// end_else
        results[row] = regExContent(user[row], regEx);
    }// end_for
    if ((user.password != user.re_password) && ('re_password' in user)) {
        results.ePass = false;
    }// end_if
    //////
    return results;
}// end_regExData

function regExContent(value, regEx) {
    //////
    if (value.length > 0) {
        return regEx.test(value);
    }// end_if
    //////
    return false;
}// end_checkContent

function loadContent() {
    //////
    $('.container-search').remove();
    //////
    if (localStorage.getItem('currentPage') == 'register') {
       loadRegister();
       btnsRegister();
    }else{
        loadLogIn();
    }// end_else
}// end_loadContent
$(document).ready(function() {
    //////
    loadContent();
});// end_document.ready