<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'module/login/model/DAOLogin.php');
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
        $registerQuery = $querys -> booleanQuery("INSERT INTO users (username, email, password, registerDate, avatar) 
                                                VALUES ('$_POST[username]', '$_POST[email]', '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "', 0, '$selectedAvatar')");
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
            echo json_encode('funsiona');
        }else {
            echo "error";
        }// end_else
        break;
        //////
    default;
        include ("view/inc/error404.html");
        break;
}// end_switch-