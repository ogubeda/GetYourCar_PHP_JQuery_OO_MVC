<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . '/frameworkCars.v.1.2/';
include ($path . 'model/DAOGeneral.php');
//////

class LogInQuerys {
    //////
    function booleanQuery($username, $email, $password) {
        //////
        $hashEmail = md5(strtolower(trim($email)));
        $selectedAvatar = "https://avatars.dicebear.com/v2/jdenticon/" . $hashEmail . ".svg";
        //////
        $query = "INSERT INTO users (username, email, password, registerDate, avatar, type, money) 
                    VALUES ('$username', '$email', '" . password_hash($password, PASSWORD_DEFAULT) . "', '". date("Y/m/d") . "', '$selectedAvatar', 'client', 10000)";
        //////
        $result = DAOGeneral::query($query);
        //////
        return $result;
        // end_if
    }// end_booleanQuery
    //////

    function checkKeys($username, $email) {
        //////
        $values = false;
        $queryUser = DAOGeneral::query('SELECT username FROM users WHERE username = "' . $username . '"');
        $queryEmail = DAOGeneral::query('SELECT email FROM users WHERE email = "' . $email . '"');
        //////
        if (mysqli_num_rows($queryUser['query']) > 0) {
            $values = true;
        }// end_if
        //////
        if (mysqli_num_rows($queryEmail['query']) > 0) {
            $values = true;
        }//end_if
        //////
        return $values;
    }// end_checkKeys

    function singleQuery($query) {
        //////
        $result = DAOGeneral::query($query);
        $values = "";
        //////
        if (mysqli_num_rows($result['query']) > 0) {
            $values = mysqli_fetch_assoc($result['query']);
            if (!password_verify($_POST['password'], $values['password'])) {
                $values = "";
            }// end_if
        }// end_if
        //////
        return $values;
    }// end_singleQuery
}// end_LogInQuerys
