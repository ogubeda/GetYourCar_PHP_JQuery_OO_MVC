<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/DAOGeneral.php');
//////
class DAOProfile {
    //////
    function selectFavs($username) {
        //////
        $typedQuery = "SELECT * FROM allCars a INNER JOIN userFav u ON a.carPlate = u.carPlate WHERE u.username = '$username'";
        $query = DAOGeneral::multipleQuery($typedQuery);
        //////
        return $query;
    }// end_selectFavs
    //////

    function selectUser($username) {
        //////
        $typedQuery = "SELECT username, email, registerDate FROM users WHERE username = '$username'";
        $query = DAOGeneral::singleQuery($typedQuery);
        //////
        return $query;
    }
}// end_DAOProfile