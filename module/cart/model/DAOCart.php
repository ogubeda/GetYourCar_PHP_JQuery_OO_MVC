<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/DAOGeneral.php');
//////
class DAOCart {
    //////
    function addToPurchase($username) {
        //////
        $total = 0;
        $price = 0;
        //////
        $idPurchase = "$username" . date("Ymdhis");
        $checkMoney = "SELECT money FROM users WHERE username = '$username'";
        $cartValue = "SELECT a.price, c.days, d.discount FROM allCars a INNER JOIN carts c ON a.carPlate = c.carPlate LEFT JOIN discounts d ON c.code_name = d.code_name WHERE username = '$username'";
        $typedQuery = "INSERT INTO purchases (idpurchases, purchaseDate,carPlate, username, days, code_name) SELECT '$idPurchase', CURRENT_DATE, c.* FROM carts c WHERE username = '$username'";
        $deleteCart = "DELETE FROM carts WHERE username = '$username'";
        //////
        $valueMoney = DAOGeneral::singleQuery($checkMoney);
        $valueCart = DAOGeneral::multipleQuery($cartValue);
        //////
        foreach($valueCart['resolve'] as $row) {
            $price = $row['price'] * (1 + ($row['days'] / 10 - 0.1));
            $total = $total + $price;
            $disc = $row['discount'];
        }// end_for
        if ($disc > 0) {
            $total = $total - ($total * $disc / 100);
        }// end_if
        echo $total;
        if ($total <= $valueMoney['resolve']['money']) {
            $values = DAOGeneral::booleanQuery($typedQuery);
            if ($values['resolve']) {
                $credit = $valueMoney['resolve']['money'] - $total;
                $downMoney = "UPDATE users SET money = $credit WHERE username = '$username'";
                $updateMoney = DAOGeneral::booleanQuery($downMoney);
                $delete = DAOGeneral::booleanQuery($deleteCart);
            }// end_if
        }// end_if
        //////
        return $values;
    }// end_addToPurchase
    //////

    function saveCart($carPlate, $days, $username) {
        $typedQuery = "INSERT INTO carts VALUES ('$carPlate', '$username', $days, NULL)";
        $removeDisc = "UPDATE carts SET code_name = NULL WHERE username = '$username'";
        $values = DAOGeneral::booleanQuery($typedQuery);
        if ($values['resolve']) {
            DAOGeneral::booleanQuery($removeDisc);
        }// end_if
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

    function removeCart($carPlate, $username) {
        //////
        $typedQuery = "DELETE FROM carts WHERE carPlate = '$carPlate' AND username = '$username'";
        $values = DAOGeneral::booleanQuery($typedQuery);
        //////
        return $values;
    }// end_removeCart

    function deleteCart($username) {
        //////
        $typedQuery = "DELETE FROM carts WHERE username = '$username'";
        $values = DAOGeneral::booleanQuery($typedQuery);
        //////
        return $values;
    }// end_removeCart
    //////

    function getCheckOutData($username) {
        //////
        $typedQuery = "SELECT * FROM allCars a INNER JOIN carts c ON a.carPlate = c.carPlate LEFT JOIN discounts d ON c.code_name = d.code_name WHERE username = '$username'";
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
    //////

    function addDiscCode($username, $discCode) {
        //////
        $checkCode = "SELECT code_name FROM discounts WHERE code_name = '$discCode'";
        $typedQuery = "UPDATE carts SET code_name = '$discCode' WHERE username = '$username'";
        $valCode = DAOGeneral::singleQuery($checkCode);
        if (!empty($valCode['resolve'])) {
            $values = DAOGeneral::booleanQuery($typedQuery);
        }
        //////
        return $values;
    }// end_DiscCode
    //////

    function removeDiscCode($username) {
        //////
        $typedQuery = "UPDATE carts SET code_name = NULL WHERE username = '$username'";
        $value = DAOGeneral::booleanQuery($typedQuery);
        //////
        return $value;
    }// end_removeDiscCode
}// endDAOCart