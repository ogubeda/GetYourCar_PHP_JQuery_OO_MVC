<?php
//////
function updateSession($force = false) {
    //////
    if ((!isset($_SESSION['address'])) || ($force)) {
        $_SESSION['address']  = $_SERVER['REMOTE_ADDR'];
    }//end if
    if ((!isset($_SESSION['agent'])) || ($force)) {
        $_SESSION['agent'] = $_SERVER['userAgent'];
    }// end_if
    //////
    $oldID = session_id();
    session_regenerate_id(true);
    //////
    $updatedSession = session_id();
    session_write_close();
    //////
    session_id($updatedSession);
    session_start();
    $_SESSION['time'] = time();
    $_SESSION['old'] = $oldID;
}// end_updateSession

function loadSession($username, $type, $avatar) {
    //////
    updateSession(true);
    //////
    $_SESSION['user'] = $username;
    $_SESSION['type'] = $type;
    $_SESSION['avatar'] = $avatar;
}// end_loadSession

function checkSession() {
    //////
    try {
        if ($_SESSION['address'] != $_SERVER['REMOTE_ADDR']) {
            throw new Exception("The IP Addresses aren't the same.");
        }// end_if
        if ($_SESSION['agent'] != $_SERVER['userAgent']) {
            throw new Exception("The Browsers between session aren't the same.");
        }// end_if
        if ($_SESSION['old'] == session_id()) {
            throw new Exception("You're using an old ID");
        }// end_if
        return true;
    }catch(Exception $e) {
        return false;
    }// end_catch
}// end_checkSession

function returnUserSession() {
    //////
    if ($_SESSION['user'] && (checkSession())) {
        updateSession();
        return json_encode(array('user' => $_SESSION['user'], 'type' => $_SESSION['type'], 'avatar' => $_SESSION['avatar']));
    }else {
        return 'Something has ocurred.';
    }// end_else
}// end_returnUserSession