<?php
//////
class QuerysFav {
    //////
    function checkCar($carPlate) {
        //////
        $select = "SELECT * FROM userFav WHERE username = '$_SESSION[user]' AND carPlate = '$carPlate'";
        $query = DAOGeneral::singleQuery($select);
        //////
        if (mysqli_num_rows($query['query']) > 0) {
            return true;
        }// end_if
        return false;
    }// end_checkCar
    //////

    function processFav($carPlate, $check = false) {
        //////
        $typedQuery = "INSERT INTO userFav VALUES ('$carPlate', '$_SESSION[user]')";
        $funcFav = true;
        //////
        if ($check) {
            $typedQuery = "DELETE FROM userFav WHERE carPlate = '$carPlate' AND username = '$_SESSION[user]'";
            $funcFav = false;
        }// end_if
        //////
        if (isset($_SESSION['user'])) {
            $query = DAOGeneral::booleanQuery($typedQuery);
        }// end_if
        $query['func'] = $funcFav;
        //////
        return $query;
    }// end_processFav
    //////

    function selectFavs() {
        //////
        $typedQuery = "SELECT * FROM userFav WHERE username = '$_SESSION[user]'";
        //////
        $query = DAOGeneral::multipleQuery($typedQuery);
        //////
        return $query;
    }// end_selectFavs
}// end_QuerysFav