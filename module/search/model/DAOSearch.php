<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/DAOGeneral.php');
//////
class QuerysSearch {
    function multiple($query) {
        $query = DAOGeneral::query($query);
        $retrArr = array();
        //////
        if (mysqli_num_rows($query['query']) > 0) {
            while ($row = mysqli_fetch_assoc($query['query'])) {
                $retrArr[] = $row;
            }// end_while
        }// end_if
        //////
        return $retrArr;
    }// end_multiple
}// end_QuerysSearch