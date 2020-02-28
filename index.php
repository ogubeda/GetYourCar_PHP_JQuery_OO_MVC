<?php
	if ((isset($_GET['page'])) && ($_GET['page'] === "our-cars")){
		include("view/inc/topPageCars.html");
	}else if ((isset($_GET['page'])) && ($_GET['page'] === "user-order")){
        include ("view/inc/topPageUserOrder.html");
    }else if((isset($_GET['page'])) && ($_GET['page'] === "shop")) {
        include ("view/inc/topPageShop.html");
    }else if ((isset($_GET['page']) && ($_GET['page'] === "contact"))) {
        include ('view/inc/topPageContact.html');
    }else if ((isset($_GET['page'])) && ($_GET['page'] === 'log-in')) {
        include ('view/inc/topPageLogIn.html');
	}else {
		include("view/inc/topPage.html");
	}
	session_start();
?>
<body>
    <div class="preloader">
        <span class="preloader-spin"></span>
    </div>
    <div class="site">
        <header>
            <?php include("view/inc/menu.html"); ?>
        </header>        
    </div>
    <div class = "content">
        <?php include ("view/inc/pages.php");?>
    </div>
    <footer>
        <div class="footer-top">
            <div class="container">
                
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                
            </div>
        </div>
    </footer> 
</body>

</html>
