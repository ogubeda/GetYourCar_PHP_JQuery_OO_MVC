<?php
$path = $_SERVER['DOCUMENT_ROOT'] . "/frameworkCars.v.1.2/";
//////
switch ($_GET['page']) {
	case "home";
		include ("module/home/controller/controllerHomePage.php");
		break;
	case "shop";
		include ("module/shop/controller/controllerShop.php");
		break;
	case "our-cars";
		include ("module/cars/controller/controllerCars.php");
		break;
	case "services";
		include ("module/services/services.html");
		break;
	case "contact";
		include ("module/contactus/controller/controllerContact.php");
		break;
	case "user-order";
		include ("module/userOrder/controller/controllerUserOrder.php");
		break;
	case "log-in";
		include ("module/login/controller/controllerLogIn.php");
		break;
	case "error404";
		include ("view/inc/" . $_GET['page'] . ".html");
		break;
	case "error503";
		include ("view/inc/" . $_GET['page'] . ".html");
		break;
	default;
		$_GET['op'] = "list";
		include ("module/home/controller/controllerHomePage.php");
		break;
}
?>