<?php

if ( ! isset( $_SESSION ) ) {
	try {
		session_start();
	} catch ( Exception $error ) {

	}
}
include dirname( __FILE__ ) . '/../ti.php';
include dirname( __FILE__ ) . '/../../entity/User.php';
include dirname( __FILE__ ) . '/../../entity/RequestFidelity.php';
include dirname( __FILE__ ) . '/../../entity/Fidelity.php';
include dirname( __FILE__ ) . '/../../core/Config.php';
include dirname( __FILE__ ) . '/../../core/UserController.php';
include dirname( __FILE__ ) . '/../../core/FidelityRequestController.php';
include dirname( __FILE__ ) . '/../../core/FidelityController.php';

$userController            = new UserController();
$fidelityController        = new FidelityController();
$fidelityRequestController = new FidelityRequestController();
if ( $user = Config::getUserSession()!= null && $user = Config::getUserSession()->getRole() == "admin" ) {
	?>
    <script>
        window.location.replace("<?php echo curPageURL() . '/views/admin' ?>");
    </script>
	<?php
}
function checkLoggedIn() {
	$user = Config::getUserSession();
	if ( $user == null ) {
		?>
        <script>
            window.location.replace("<?php echo curPageURL() . '/views/front' ?>");
        </script>
		<?php
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Amado - Furniture Ecommerce Template | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="<?php echo curPageURL() ?>/views/front/assets/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="<?php echo curPageURL() ?>/views/front/assets/css/core-style.css">
    <link rel="stylesheet" href="<?php echo curPageURL() ?>/views/front/assets/style.scss">
    <style>
        .amado-nav li a {
            color: white !important;
        }

        .cart-fav-search a {
            color: white !important;
        }
    </style>
</head>

<body>
<!-- Search Wrapper Area Start -->
<div class="search-wrapper section-padding-100">
    <div class="search-close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="search-content">
                    <form action="#" method="get">
                        <input type="search" name="search" id="search" placeholder="Type your keyword...">
                        <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Search Wrapper Area End -->

<!-- ##### Main Content Wrapper Start ##### -->
<div class="main-content-wrapper d-flex clearfix">

    <!-- Mobile Nav (max width 767px)-->
    <div class="mobile-nav">
        <!-- Navbar Brand -->
        <div class="amado-navbar-brand">
            <a href="<?php echo curPageURL() ?>/views/front"><img src="<?php echo curPageURL() ?>/views/front/assets/img/core-img/logo.png" alt=""></a>
        </div>
        <!-- Navbar Toggler -->
        <div class="amado-navbar-toggler">
            <span></span><span></span><span></span>
        </div>
    </div>

    <!-- Header Area Start -->
    <header style="background: #252525" class="header-area clearfix">
        <!-- Close Icon -->
        <div class="nav-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <!-- Logo -->
        <div class="">
            <a href="<?php echo curPageURL() ?>/views/front"><img src="<?php echo curPageURL() ?>/views/front/assets/img/core-img/logo.png" alt=""></a>
            <div>
                <ul>
					<?php
					if ( Config::getUserSession() == null ) {
						echo '<li><a href="' . curPageURL() . '/views/front/signup.php"><i class="fa fa-user"></i> SignUp</a></li>';
						echo '<li><a href="' . curPageURL() . '/views/front/login.php"><i class="fa fa-user"></i> Login</a></li>';
					} else {
						echo '<li><a href="' . curPageURL() . '/views/front/profile"><i class="fa fa-user"></i>' . Config::getUserSession()->getUsername() . '</a></li>';
						echo '<li><a href="' . curPageURL() . '/views/front/profile/fidelities.php"><i class="fa fa-user"></i> My requests</a></li>';
						echo '<li><a href="' . curPageURL() . '/views/front/logout.php"><i class="fa fa-user"></i> logout</a></li>';
					}
					?>
                </ul>
            </div>
        </div>
        <!-- Amado Nav -->
        <nav class="amado-nav">
            <ul>
                <li class="active"><a href="<?php echo curPageURL() ?>/views/front">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="product-details.html">Product</a></li>
                <li><a href="cart.html">Cart</a></li>
                <li><a href="checkout.html">Checkout</a></li>
				<?php
				if ( Config::getUserSession() ) {
					?>
                    <li><a href="<?php echo curPageURL() ?>/views/front/fidelity">Fidelity Cards</a></li>
					<?php
				}
				?>
            </ul>
        </nav>
        <!-- Button Group -->
        <div class="amado-btn-group mt-30 mb-100">
            <a href="#" class="btn amado-btn mb-15">%Discount%</a>
            <a href="#" class="btn amado-btn active">New this week</a>
        </div>
        <!-- Cart Menu -->
        <div class="cart-fav-search mb-100">
            <a href="cart.html" class="cart-nav"><img
                        src="<?php echo curPageURL() ?>/views/front/assets/img/core-img/cart.png" alt=""> Cart
                <span>(0)</span></a>
            <a href="#" class="fav-nav"><img
                        src="<?php echo curPageURL() ?>/views/front/assets/img/core-img/favorites.png" alt=""> Favourite</a>
            <a href="#" class="search-nav"><img
                        src="<?php echo curPageURL() ?>/views/front/assets/img/core-img/search.png" alt=""> Search</a>
        </div>
        <!-- Social Button -->
        <div class="social-info d-flex justify-content-between">
            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        </div>
    </header>
    <!-- Header Area End -->


    <div class="products-catagories-area">
		<?php startblock( 'content' ) ?>
		<?php endblock() ?>
    </div>
</div>
<!-- ##### Main Content Wrapper End ##### -->


<!-- ##### Footer Area Start ##### -->
<footer class="footer_area clearfix">
    <div class="container">
        <div class="row align-items-center">
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-4">
                <div class="single_widget_area">
                    <!-- Logo -->
                    <div class="footer-logo mr-50">
                        <a href="<?php echo curPageURL() ?>/views/front"><img src="img/core-img/logo2.png" alt=""></a>
                    </div>
                    <!-- Copywrite Text -->
                    <p class="copywrite">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                        All rights reserved | This template is made with <i class="fa fa-heart-o"
                                                                            aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">Colorlib</a> & Re-distributed by <a
                                href="https://themewagon.com/" target="_blank">Themewagon</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
            <!-- Single Widget Area -->
            <div class="col-12 col-lg-8">
                <div class="single_widget_area">
                    <!-- Footer Menu -->
                    <div class="footer_menu">
                        <nav class="navbar navbar-expand-lg justify-content-end">
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#footerNavContent" aria-controls="footerNavContent"
                                    aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i>
                            </button>
                            <div class="collapse navbar-collapse" id="footerNavContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="<?php echo curPageURL() ?>/views/front">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="shop.html">Shop</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="product-details.html">Product</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="cart.html">Cart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="checkout.html">Checkout</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ##### Footer Area End ##### -->

<!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
<script src="<?php echo curPageURL() ?>/views/front/assets/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="<?php echo curPageURL() ?>/views/front/assets/js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="<?php echo curPageURL() ?>/views/front/assets/js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="<?php echo curPageURL() ?>/views/front/assets/js/plugins.js"></script>
<!-- Active js -->
<script src="<?php echo curPageURL() ?>/views/front/assets/js/active.js"></script>

</body>

</html>