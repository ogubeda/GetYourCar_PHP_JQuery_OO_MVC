<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'module/login/model/DAOLogin.php');
@session_start();
//////
$querys = new LogInQuerys();
//////
switch ($_GET['op']) {
    case 'list';
        include ('module/login/view/logIn.html');
        break;
        //////
    case 'register';
        $hashEmail = md5(strtolower(trim($_POST['email'])));
        $selectedAvatar = "https://avatars.dicebear.com/v2/jdenticon/" . $hashEmail . ".svg";
        $registerQuery = $querys -> booleanQuery("INSERT INTO users (username, email, password, registerDate, avatar, type) 
                                                VALUES ('$_POST[username]', '$_POST[email]', '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "', 0, '$selectedAvatar', 'client')");
        //////
        if (!$registerQuery['error']) {
            echo json_encode('done');
        }else {
            echo $registerQuery['desc'];
        }// end_if
        break;
        //////
    case 'logIn';
        $getUserData = $querys -> singleQuery("SELECT * FROM users WHERE username = '$_POST[username]'");
        if ((!empty($getUserData)) && (password_verify($_POST['password'], $getUserData['password']))) {
            echo json_encode('Log In Successfull');
            $_SESSION['user'] = $getUserData['username'];
            $_SESSION['type'] = $getUserData['type'];
            $_SESSION['avatar'] = $getUserData['avatar'];
            $_SESSION['time'] = time();
        }else {
            echo "error";
        }// end_else
        break;
        //////
    case 'returnSession';
        if ($_SESSION) {
            echo json_encode($_SESSION);
        }else {
            echo "Empty";
        }// end_else
        break;
        //////
    case 'logOut';
        if (session_destroy()) {
            echo json_encode('Done');
        }else {
            echo 'Error';
        }// end_else
        break;
        //////
    default;
        include ("view/inc/error404.html");
        break;
}// end_switch