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
        if (!empty($_POST['cart'])) {
            $data = $querys -> saveCart($_POST['cart'], $_SESSION['user']);
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
        //////
        if (!empty($data['resolve'])) {
            echo json_encode($data['resolve']);
        }else {
            echo 'error';
        }
        break;
        //////
    default;
        include ('view/inc/error404.html');
        break;
}// end_switch