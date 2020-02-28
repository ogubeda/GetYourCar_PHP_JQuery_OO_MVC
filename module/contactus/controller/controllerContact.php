<?php
//////
switch($_GET['op']) {
    case 'list';
        include ("module/contactus/view/contactus.html");
        break;
    default;
        include ("view/inc/error404.html");
        break;
}// end_switch