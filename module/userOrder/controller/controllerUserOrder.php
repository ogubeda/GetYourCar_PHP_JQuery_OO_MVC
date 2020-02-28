<?php
//////
$path = $_SERVER['DOCUMENT_ROOT'] . "/frameworkCars.v.1.2/";

//////
include ($path . "module/userOrder/model/DAOUserOrder.php");

//////
$rdyQuery = new QuerysUser();
switch ($_GET['op']) {
    //////
    case 'list';
        include ("module/userOrder/view/listUserOrder.html");
        break;
    case 'userOrder';
        $userOrderSel = $rdyQuery -> selectUserOrder();
        if (!empty($userOrderSel)) {
            echo json_encode($userOrderSel);
            exit;
        }else {
            echo "error";
        }// end_else
        break;
    default;
        include ("view/inc/error404.html");
        break;
}// end_switch