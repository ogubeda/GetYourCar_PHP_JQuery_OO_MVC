<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/DAOGeneral.php');
//////
class DAOProfile {
    //////
    function selectFavs($username) {
        //////
        $typedQuery = "SELECT a.carPlate, a.brand, a.model, a.image FROM allCars a INNER JOIN userFav u ON a.carPlate = u.carPlate WHERE u.username = '$username'";
        $query = DAOGeneral::multipleQuery($typedQuery);
        //////
        return $query;
    }// end_selectFavs
    //////

    function selectUser($username) {
        //////
        $typedQuery = "SELECT username, email, registerDate, avatar FROM users WHERE username = '$username'";
        $query = DAOGeneral::singleQuery($typedQuery);
        //////
        return $query;
    }// end_selectUser
    //////

    function deleteUser($username) {
        //////
        $typedQuery = "DELETE FROM users WHERE username = '$username'";
        $query = DAOGeneral::booleanQuery($typedQuery);
        //////
        return $query;
    }// end_deleteUser
    //////
}// end_DAOProfile