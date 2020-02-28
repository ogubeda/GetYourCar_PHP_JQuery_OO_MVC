<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . "/frameworkCars.v.1.2/";
//////
include ($path . 'module/home/model/DAOHomePage.php');
//////
$homeQuery = new QuerysHomePage();
switch ($_GET['op']) {
    case 'list';
        include ('module/home/view/homepage.html');
        break;
    case 'homePageSlide';
        $selSlide = $homeQuery -> selectSlide();
        if (!empty($selSlide)) {
            echo json_encode($selSlide);
        }else {
            echo "error";
        }// end_else
        break;
    case 'homePageCat';
        $selCatBrand = $homeQuery -> selectCatBrands();
        if (!empty($selCatBrand)) {
            echo json_encode($selCatBrand);
        }else{
            echo "error";
        }// end_else
        break;
    default;
        include ('view/inc/error404.html');
        break;
}// end_switch