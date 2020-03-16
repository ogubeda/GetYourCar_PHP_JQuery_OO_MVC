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
        $registerQuery = $querys -> booleanQuery("INSERT INTO users (username, email, password, registerDate) VALUES ('$_POST[username]', '$_POST[email]', '$_POST[password]', 0)");
        if ($registerQuery) {
            echo json_encode($registerQuery);
        }else {
            echo 'error';
        }// end_if
        break;
        //////
    default;
        include ("view/inc/error404.html");
        break;
}// end_switch-