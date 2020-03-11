<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . '/module/brand-crud/model/DAOCrudBrand.php');
//////
$querys = new QuerysBrand();
switch ($_GET['op']) {
    case 'list';
        include ('module/brand-crud/view/list.html');
        break;
        //////
    case 'sendInfo';
        $infoBrand = $querys -> selectMultiple('SELECT * FROM brandCars');
        //////
        if (!empty($infoBrand)) {
            echo json_encode($infoBrand);
        }else {
            echo 'error';
        }// end_else
        break;
    case 'create';
        break;
        //////
    case 'read';
        break;
        //////
    case 'update';
        break;
        //////
    case 'delete';
        break;
        //////
    default;
        include ('view/inc/error404.html');
        break;
        //////
}// end_switch
