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
        return $result;
        // end_if
    }// end_booleanQuery
    //////

    function singleQuery($query) {
        //////
        $result = DAOGeneral::query($query);
        $values = "";
        //////
        if (mysqli_num_rows($result['query']) > 0) {
            $values = mysqli_fetch_assoc($result['query']);
        }// end_if
        //////
        return $values;
    }// end_singleQuery
}// end_LogInQuerys
