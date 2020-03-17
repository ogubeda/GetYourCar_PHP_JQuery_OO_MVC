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
        $error = false;
        //////
        if (!$query) {
            $error = true;
            $errorDesc = mysqli_error($connection);
        }// end_if
        Connect::close($connection);
        //////
        return array('query' => $query, 'error' => $error, 'desc' => $errorDesc);
    }// end_select
}// end_DAOGeneral