<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . "model/DAOGeneral.php");
//////
class QuerysHomePage {
    //////
    function selectMultiple($select) {
        //////
        $query = DAOGeneral::query($select);
        $retrArray = array();
        //////
        if (mysqli_num_rows($query['query']) > 0) {
            while ($row = mysqli_fetch_assoc($query['query'])) {
                $retrArray[] = $row;
            }// end_while
        }// end_if
        //////
        return $retrArray;
    }// end_selectMultiple
    //////
    function selectBoolean($select) {
        //////
        $query = DAOGeneral::query($select);
        //////
        if (!$query['error']) {
            return true;
        }else {
            return false;
        }// end_if
    }// end_selectBoolean
}// end_QuerysHomePage