<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . "model/Connect.php");
//////
class QuerysHomePage {
    //////
    function selectSlide() {
        //////
        $connect = Connect::enable();
        $select = "SELECT carPlate, brand, model, image FROM allCars ORDER BY cv DESC LIMIT 5";
        $query = mysqli_query($connect, $select);
        $retrArray = array();
        //////
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $retrArray[] = $row;
            }// end_while
        }// end_if
        //////
        Connect::close($connect);
        return $retrArray;
    }// end_selectSlide
    //////

    function selectCatBrands() {
        //////
        $connection = Connect::enable();
        $select = "SELECT * FROM brandCars";
        $query = mysqli_query($connection, $select);
        $retrArray = array();
        //////
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $retrArray[] = $row;
            }// end_while
        }// end_if
        //////
        Connect::close($connection);
        return $retrArray;
    }// end_selectRelevant
}// end_QuerysHomePage