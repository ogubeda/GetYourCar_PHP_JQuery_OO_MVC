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
        $selShop = $querys -> selectMultiple('SELECT carPlate, brand, model, image FROM allCars ORDER BY views DESC LIMIT ' . $_POST['totalItems'] . ', ' . $_POST['itemsPage']);
        if (!empty($selShop)) {
            echo json_encode($selShop);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    case 'read';
        $selReadShop = $querys -> selectSingle('SELECT * FROM allCars WHERE carPlate ="'  . $_GET['carPlate'] . '"');
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
        $selAllCon = $querys -> selectMultiple('SELECT * FROM concessionaire');
        if (!empty($selAllCon)) {
            echo json_encode($selAllCon);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    case 'filter';
        $selCarFilter = $querys -> mountQuery(json_decode($_GET['filters'], true));
        //////
        $selMulti = $querys -> selectMultiple($selCarFilter);
        if (!empty($selMulti)) {
            echo json_encode($selMulti);
        }else {
            echo "error";
        }// end_else
        break;
        //////
    case 'viewUp';
        $viewUp = $querys -> selectBoolean('UPDATE allCars SET views = views + 1 WHERE carPlate = "' . $_POST['carPlate'] . '"');
        //////
        echo $viewUp;
        break;
        //////
    case 'countProd';
        $countProd = $querys -> selectSingle('SELECT count(*) prods FROM allCars');
        //////
        if (!empty($countProd)) {
            echo json_encode($countProd);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    default;
        include ('view/inc/error404.html');
        break;
}// end_switch