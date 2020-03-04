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
        $selCon = $searchQuerys -> multiple('SELECT * FROM concessionaire WHERE province="' . $_GET['province'] . '"ORDER BY nameCon');
        //////
        if (!empty($selCon)) {
            echo json_encode($selCon);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    case 'autoComplete';
        $select = 'SELECT DISTINCT brand FROM allCars';
        if (isset($_POST['dropCon'])) {
            $select = $select . ' WHERE idCon ="' . $_POST['dropCon'] . '" AND brand LIKE "' . $_POST['complete'] . '%"';
        }else {
            $select = $select . ' WHERE brand LIKE "' . $_POST['complete'] . '%"';
        }// end_else
        $selAutoComplete = $searchQuerys -> multiple($select);
        //////
        if (!empty($selAutoComplete)) {
            echo json_encode($selAutoComplete);
        }else {
            echo 'error';
        }// end_else
        break;
        //////
    default;
        break;
}// end_switch