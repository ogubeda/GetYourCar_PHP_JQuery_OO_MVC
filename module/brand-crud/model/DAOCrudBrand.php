<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/DAOGeneral.php');
//////
class QuerysBrand {
    //////
    function selectSingle($select) {
        //////
        $query = DAOGeneral::query($select);
        //////
        if (mysqli_num_rows($query) > 0) {
            $value = mysqli_fetch_assoc($query);
        }// end_if
        //////
        return $value;
    }// end_selectSingle
    //////

    function selectMultiple($select) {
        //////
        $query = DAOGeneral::query($select);
        $values = array();
        //////
        if (mysqli_num_rows($query['query'])) {
            while ($row = mysqli_fetch_assoc($query['query'])) {
                $values[] = $row;
            }// end_while
        }// end_if
        //////
        return $values;
    }// end_selectMultiple
}// end_QuerysBrand