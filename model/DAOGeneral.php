<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/Connect.php');

class DAOGeneral {
    //////
    public static function query($values) {
        //////
        $connection = Connect::enable();
        $query = mysqli_query($connection, $values);
        Connect::close($connection);
        //////
        return $query;
    }// end_select
}// end_DAOGeneral