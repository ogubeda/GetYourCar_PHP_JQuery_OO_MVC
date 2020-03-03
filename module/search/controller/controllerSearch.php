<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'module/search/model/DAOSearch.php');
//////
$searchQuerys = new QuerysSearch();
//////
switch ($_GET['op']) {
    case 'listProvinces';
        $selProvinces = $searchQuerys -> multiple('SELECT DISTINCT province FROM concessionaire ORDER BY province');
        //////
        if (!empty($selProvinces)) {
            echo json_encode($selProvinces);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    case 'listCon';
    //echo $_GET['province'];
        $selCon = $searchQuerys -> multiple('SELECT * FROM concessionaire WHERE province="' . $_GET['province'] . '"ORDER BY nameCon');
    //print_r ($selCon);
        //////
        if (!empty($selCon)) {
            echo json_encode($selCon);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    case 'autoComplete';
        //$selAutoComplete = $searchQuerys -> 
        break;
        //////
    default;
        break;
}// end_switch