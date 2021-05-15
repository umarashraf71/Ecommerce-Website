<?php

$query = "select * from categories where status = 1 order by categories asc";
$result = mysqli_query($con, $query);
$cat_arr = array();

while ($row = mysqli_fetch_assoc($result)) {

    $cat_arr[] = $row;
}


$cart_obj = new add_to_cart();
$totalProduct = $cart_obj->totalProduct();

?>

<style>
    .meanmenu-reveal {

        margin-right: 15px !important;
    }
</style>

<!-- Start Header Style -->
<header id="htc__header" class="htc__header__area header--one">
    <!-- Start Mainmenu Area -->
    <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
        <div class="container" style="padding-left: 0px !important;padding-right: 0px !important;">
            <div class="row" style="padding-left: 20px !important;padding-right: 20px !important;">
                <div class="menumenu__container clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                        <div class="logo">
                            <a href="index.php"><img src="../assets/images/logo/4.png" alt="logo images"></a>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3">
                        <nav class="main__menu__nav hidden-xs hidden-sm">
                            <ul class="main__menu">
                                <li class="drop"><a href="index.php">Home</a></li>

                                <li class="drop"><a href="#">Categories</a>
                                    <ul class="dropdown">

                                        <?php

                                        foreach ($cat_arr as $list) {

                                        ?>

                                            <li>
                                                <a href="categories.php?id=<?php echo $list['id'] ?>">
                                                    <?php echo $list['categories'] ?>
                                                </a>
                                            </li>

                                        <?php

                                        }

                                        ?>
                                    </ul>
                                </li>


                                <li class="drop"><a href="#">Pages</a>
                                    <ul class="dropdown">
                                        <li><a href="blog.php">Blog</a></li>
                                        <li><a href="blog-details.php">Blog Details</a></li>
                                        <li><a href="cart.php">Cart page</a></li>
                                        <li><a href="checkout.php">checkout</a></li>
                                        <li><a href="contact.php">contact</a></li>
                                        <li><a href="product-grid.php">product grid</a></li>
                                        <li><a href="product-details.php">product details</a></li>
                                        <li><a href="wishlist.php">wishlist</a></li>
                                    </ul>
                                </li>

                                <li><a href="contact.php">contact</a></li>

                            </ul>
                        </nav>

                        <div class="mobile-menu clearfix visible-xs visible-sm">
                            <nav id="mobile_dropdown">
                                <ul style="height:auto !important;">
                                    <li><a href="index.php">Home</a></li>

                                    <li><a href="#">categories</a>
                                        <ul style="height:auto !important; background-color: rgb(212, 212, 212) !important;">
                                            <?php

                                            foreach ($cat_arr as $list) {

                                            ?>

                                                <li>
                                                    <a href="categories.php?id=<?php echo $list['id'] ?>">
                                                        <?php echo $list['categories'] ?>
                                                    </a>
                                                </li>

                                            <?php

                                            }

                                            ?>
                                        </ul>
                                    </li>

                                    <li><a href="contact.php">contact</a></li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                        <div class="header__right">

                            <div class="header__account">
                                <!-- <a href="#"><i class="icon-user icons"></i></a> -->

                                <?php if (isset($_SESSION['USER_LOGIN'])) { ?>

                                    <a style="margin-right:-16px; font-size:15px !important" href="logout.php">Logout </a>
                                    <a style="margin-left:3px; font-size:15px !important " href="my_orders.php"> | My Orders</a>

                                <?php } else { ?>

                                    <a href="login.php">Login | Register</a>

                                <?php } ?>

                            </div>
                            <div class="header__search search search__open">
                                <a style="margin-right:-5px; " href="#"><i class="icon-magnifier icons"></i></a>
                            </div>
                            <div class="htc__shopping__cart">
                                <a class="" href="cart.php"><i class="icon-handbag icons"></i></a>
                                <a href="cart.php"><span class="htc__qua"><?php echo $totalProduct ?></span></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area"></div>
        </div>
    </div>
    <!-- End Mainmenu Area -->
</header>
<!-- End Header Area -->

<div class="body__overlay"></div>
<!-- Start Offset Wrapper -->
<div class="offset__wrapper">
    <!-- Start Search Popap -->
    <div class="search__area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search__inner">
                        <form action="search.php" method="get">
                            <input placeholder="Search here... " type="text" name="str" required>
                            <button type="submit"></button>
                        </form>
                        <div class="search__close__btn">
                            <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Popap -->
    <!-- Start Cart Panel -->
    <!-- <div class="shopping__cart">
        <div class="shopping__cart__inner">
            <div class="offsetmenu__close__btn">
                <a href="#"><i class="zmdi zmdi-close"></i></a>
            </div>
            <div class="shp__cart__wrap">
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="#">
                            <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                        </a>
                    </div>
                    <div class="shp__pro__details">
                        <h2><a href="product-details.php">BO&Play Wireless Speaker</a></h2>
                        <span class="quantity">QTY: 1</span>
                        <span class="shp__price">$105.00</span>
                    </div>
                    <div class="remove__btn">
                        <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="shp__single__product">
                    <div class="shp__pro__thumb">
                        <a href="#">
                            <img src="../assets/images/product-2/sm-smg/2.jpg" alt="product images">
                        </a>
                    </div>
                    <div class="shp__pro__details">
                        <h2><a href="product-details.php">Brone Candle</a></h2>
                        <span class="quantity">QTY: 1</span>
                        <span class="shp__price">$25.00</span>
                    </div>
                    <div class="remove__btn">
                        <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
            </div>
            <ul class="shoping__total">
                <li class="subtotal">Subtotal:</li>
                <li class="total__price">$130.00</li>
            </ul>
            <ul class="shopping__btn">
                <li><a href="cart.php">View Cart</a></li>
                <li class="shp__checkout"><a href="checkout.php">Checkout</a></li>
            </ul>
        </div>
    </div> -->
    <!-- End Cart Panel -->
</div>
<!-- End Offset Wrapper -->