<?php
//////
switch ($_GET['op']) {
    case 'list';
        include ('module/login/view/logIn.html');
        break;
        //////
    case 'register';
        break;
        //////
    default;
        include ("view/inc/error404.html");
        break;
}// end_switch-