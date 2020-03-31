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

    function saveCart($cart, $username) {
        foreach ($cart as $row) {
            $typedQuery = "INSERT INTO carts VALUES ('$row', '$username')";
            $values = DAOGeneral::booleanQuery($typedQuery);
        }// end_foreach
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
}// endDAOCart