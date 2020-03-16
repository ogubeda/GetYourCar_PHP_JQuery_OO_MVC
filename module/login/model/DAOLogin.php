<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/DAOGeneral.php');
//////

class LogInQuerys {
    //////
    function booleanQuery($query) {
        //////
        $result = DAOGeneral::query($query);
        //////
        if ($result) {
            return true;
        }//end_if
        return false;
        // end_if
    }// end_booleanQuery
}// end_LogInQuerys
