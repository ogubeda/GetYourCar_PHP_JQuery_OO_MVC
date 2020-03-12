<?php
//////
class Connect {
    //////
    public static function enable() {
        //////
        $connection = mysqli_connect("localhost", "project", "147853xLash.", "Project_Cars");
        //////
        if (!$connection) {
            echo mysqli_connect_error();
        }
        return $connection;
    }// end_enable
    //////
    /////

    public static function close($connection) {
        //////
        mysqli_close($connection);
    }// end_close
    //////
    /////

}// end_Connect
//////