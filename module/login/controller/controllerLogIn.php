<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'module/login/model/DAOLogin.php');
include ($path . 'module/login/model/activity/processingSession.php');
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
        $check = $querys -> checkKeys($_POST['username'], $_POST['email']);
        //////
        if (!$check) {
            $registerQuery = $querys -> booleanQuery($_POST['username'], $_POST['email'], $_POST['password']);
            //////
            if (!$registerQuery['error']) {
                echo json_encode('done');
            }else {
                echo $registerQuery['desc'];
            }// end_if
        }else { 
            echo 'Duplicated';
        }// end_else
        break;
        //////
    case 'logIn';
        $getUserData = $querys -> singleQuery("SELECT * FROM users WHERE username = '$_POST[username]'");
        if (!empty($getUserData)) {
            loadSession($getUserData['username'], $getUserData['type'], $getUserData['avatar']);
            echo json_encode('Log In Successfull');
        }else {
            echo "error";
        }// end_else
        break;
        //////
    case 'returnSession';
        echo returnUserSession();
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
    case 'reload';
        if (updateSession(true)) {
            echo json_encode('Updated.');
        }else {
            echo 'Something has ocurred';
        }// end_else
        break;
        //////
    default;
        include ("view/inc/error404.html");
        break;
}// end_switch