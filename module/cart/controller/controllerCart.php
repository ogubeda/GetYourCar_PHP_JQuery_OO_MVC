<?php
//////
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'module/cart/model/DAOCart.php');
//////
$querys = new DAOCart();
switch ($_GET['op']) {
    case 'list';
        include ('module/cart/view/list.html');
        break;
        //////
    case 'storeCart';
        
        if (!empty($_POST['carPlate']) && isset($_SESSION['user'])) {
            $check = $querys -> checkCartVal($carPlate, $username);
            if (!$check) {
                $data = $querys -> saveCart($_POST['carPlate'], $_SESSION['user']);
            }
        }// end_if
        //////
        if ($data['resolve']) {
            echo json_encode('Done.');
        }else {
            echo 'Error.';
        }// end_else
        break;
        //////
    case 'getCart';
        $data = $querys -> getCart($_SESSION['user']);
        $remove = false;
        //////
        if (!empty($data['resolve'])) {
            //$remove = $querys -> removeCart($_SESSION['user']);
                echo json_encode($data['resolve']);
                break;
        }// end_if
        echo 'error';
        break;
        //////
    case 'loadDataCart';
        $data = $querys -> getCheckOutData($_SESSION['user']);
        if (!empty($data['resolve'])) {
            echo json_encode($data['resolve']);
        }else {
            echo 'error';
        }// end_if
        break;
        //////
    default;
        include ('view/inc/error404.html');
        break;
}// end_switch