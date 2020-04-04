<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/DAOGeneral.php');
//////
class DAOCart {
    //////
    function addToPurchase($username) {
        //////
        $idPurchase = "$username" . date("Ymdhis");
        $typedQuery = "INSERT INTO purchases (idpurchases, purchaseDate,carPlate, username, days, price) SELECT '$idPurchase', CURRENT_DATE, c.*, a.price FROM carts c INNER JOIN allCars a ON c.carPlate = a.carPlate WHERE username = '$username'";
        $deleteCart = "DELETE FROM carts WHERE username = '$username'";
        $values = DAOGeneral::booleanQuery($typedQuery);
        if ($values['resolve']) {
            $delete = DAOGeneral::booleanQuery($deleteCart);
        }// end_if
        //////
        return $values;
    }// end_addToPurchase
    //////

    function saveCart($carPlate, $days, $username) {
        $typedQuery = "INSERT INTO carts VALUES ('$carPlate', '$username', $days)";
        $values = DAOGeneral::booleanQuery($typedQuery);
        //////
        return $values;
        //////
    }// end_saveCart
    //////

    function getCart($cart) {
        //////
        $arrCart = array();
        foreach($cart as $row) {
            $arrCart[] = $row['carPlate'];
        }// end_foreach
        $strCart = implode("', '" ,$arrCart);
        $typedQuery = "SELECT * FROM allCars WHERE carPlate IN ('$strCart')";
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
        $typedQuery = "SELECT * FROM carts WHERE carPlate = '$carPlate' AND username = '$username'";
        $values = DAOGeneral::singleQuery($typedQuery);
        //////
        if (empty($values['resolve'])) {
            return false;
        }//
        return true;
    }// end_checkCartVal
    //////

    function updateDays($days, $carPlate, $username) {
        //////
        $typedQuery = "UPDATE carts SET days = $days WHERE carPlate = '$carPlate' AND username = '$username'";
        $values = DAOGeneral::booleanQuery($typedQuery);
        //////
        return $values;
    }// end_updateDays
    //////

    function printCart($username) {
        //////
        $typedQuery = "SELECT * FROM carts WHERE username = '$username'";
        $values = DAOGeneral::multipleQuery($typedQuery);
        //////
        return $values;
    }// end_printCart
}// endDAOCart