<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/DAOGeneral.php');
//////
class DAOCart {
    //////
    function addToPurchase() {
        //////
    }// end_addToPurchase
    //////

    function removeToPurchase() {
        //////
    }// end_removeToPurchase
    //////

    function saveCart($carPlate, $username) {
        $typedQuery = "INSERT INTO carts VALUES ('$carPlate', '$username')";
        $values = DAOGeneral::booleanQuery($typedQuery);
        //////
        return $values;
        //////
    }// end_saveCart
    //////

    function getCart($username) {
        //////
        $typedQuery = "SELECT carPlate FROM carts WHERE username = '$username'";
        $values = DAOGeneral::multipleQuery($typedQuery);
        //////
        return $values;
    }// end_getCart
    //////

    function removeCart($username) {
        //////
        $typedQuery = "DELETE FROM carts WHERE username = '$username'";
        $values = DAOGeneral::booleanQuery($typedQuery);
        //////
        return $values;
    }// end_removeCart
    //////

    function getCheckOutData($username) {
        //////
        $typedQuery = "SELECT * FROM allCars a INNER JOIN carts c ON a.carPlate = c.carPlate WHERE username = '$username'";
        $values = DAOGeneral::multipleQuery($typedQuery);
        //////
        return $values;
    }// end_getCheckOutData
    //////

    function checkCartVal($carPlate, $username) {
        //////
        $typedQuery = "SELECT * FROM allCars WHERE carPlate = '$carPlate' AND username = '$username'";
        $values = DAOGeneral::singleQuery($typedQuery);
        //////
        if (empty($values['resolve'])) {
            return false;
        }//
        return true;
    }
}// endDAOCart