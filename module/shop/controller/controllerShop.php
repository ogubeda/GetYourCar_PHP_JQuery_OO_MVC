<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
//////
include ($path . 'module/shop/model/DAOShop.php');
//////
$querys = new QuerysShop();
switch ($_GET['op']) {
    case 'list';
        include ('module/shop/view/list.html');
        break;
        //////
    case 'sendInfo';
        $selShop = $querys -> selectCars();
        if (!empty($selShop)) {
            echo json_encode($selShop);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    case 'read';
        $selReadShop = $querys -> selectOne($_GET['carPlate']);
        //////
        if (!empty($selReadShop)) {
            echo json_encode($selReadShop);
        }else {
            echo "error";
        }// end_else
        break;
        //////
    case 'sendFilters';
        $selFilter = $querys -> selectFilter();
        if (!empty($selFilter)) {
            echo json_encode($selFilter);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    case 'sendAllCon';
        $selAllCon = $querys -> selectAllCon();
        if (!empty($selAllCon)) {
            echo json_encode($selAllCon);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    case 'filter';
        $selCarFilter = $querys -> filterCars(json_decode($_GET['filters'], true));
        if (!empty($selCarFilter)) {
            echo json_encode($selCarFilter);
        }else {
            echo "error";
        }// end_else
        break;
        //////
    default;
        include ('view/inc/error404.html');
        break;
}// end_switch