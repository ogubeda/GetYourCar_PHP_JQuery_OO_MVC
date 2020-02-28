<?php
//////
$path  = $_SERVER['DOCUMENT_ROOT'] . "/frameworkCars.v.1.2/";
//////
include ($path . "/model/Connect.php");
//////
class QuerysUser {
    //////
    function selectUserOrder() {
        //////
        $connection = Connect::enable();
        $select = "SELECT carPlate, brand, model, gearShift, typeEngine FROM allCars";
        $arrSelect = array();
        //////
        $query = mysqli_query($connection, $select);
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $arrSelect[] = $row;
            }// end_while
        }// end_if
        Connect::close($connection);
        //////
        return $arrSelect;
    }// end_selectUserOrder
}
