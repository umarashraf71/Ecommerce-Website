<?php include('../includes/header.php') ?>

<?php

$product_id = get_safe_value($con, $_GET['id']);

if ($product_id > 0) {

    $get_product = get_product($con, '', '', $product_id);
} else {

?>

    <script>
        window.location.href = 'index.php';
    </script>

<?php
}
?>


<!-- Body main wrapper start -->
<div class="wrapper">



    <?php include('../includes/topbar.php') ?>


    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(../assets/images/bg/header.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="index.php">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <a class="breadcrumb-item" href="categories.php?id=<?php echo $get_product['0']['categories_id'] ?>"><?php echo $get_product['0']['categories'] ?></a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active"><?php echo $get_product['0']['name'] ?></span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Product Details Area -->
    <section class="htc__product__details bg__white ptb--100">
        <!-- Start Product Details Top -->
        <div class="htc__product__details__top">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                        <div class="htc__product__details__tab__content">
                            <!-- Start Product Big Images -->
                            <div class="product__big__images">
                                <div class="portfolio-full-image tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                        <img src="../../uploads/<?php echo $get_product['0']['image'] ?>" alt="full-image">
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Big Images -->

                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                        <div class="ht__product__dtl">
                            <h2><?php echo $get_product['0']['name'] ?></h2>
                            <ul class="pro__prize">
                                <li class="old__prize"><strike><?php echo $get_product['0']['mrp'] ?></strike></li>
                                <li><?php echo $get_product['0']['price'] ?></li>
                            </ul>
                            <p class="pro__info"><?php echo $get_product['0']['short_desc'] ?></p>
                            <div class="ht__pro__desc">
                                <div class="sin__desc">
                                    <p><span>Availability:</span> In Stock</p>
                                </div>
                                <div class="sin__desc">
                                    <p><span>Quantity:</span>
                                        <select name="quantity" id="quantity">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </p>
                                </div>
                                <div class="sin__desc align--left">
                                    <p><span>Category:</span></p>
                                    <ul class="pro__cat__list">
                                        <li><a href="#"><?php echo $get_product['0']['categories'] ?></a></li>
                                    </ul>
                                </div>

                                <div class="fr__list__btn">

                                    <?php if (isset($_SESSION['USER_LOGIN'])) { ?>

                                        <a class="fr__btn" href="javascript:void(0)" onclick=" manage_cart('<?php echo $get_product['0']['id'] ?>', 'add') ">
                                            Add To Cart
                                        </a>
                                    <?php } else { ?>

                                        <h5 style="margin-top:30px; color:red;">Login to Add to Cart !</h5>

                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- End Product Details Top -->
</section>
<!-- End Product Details Area -->
<!-- Start Product Description -->
<section class="htc__produc__decription bg__white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- Start List And Grid View -->
                <ul class="pro__details__tab" role="tablist">
                    <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                </ul>
                <!-- End List And Grid View -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="ht__pro__details__content">
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                        <div class="pro__tab__content__inner">
                            <p>Formfitting clothing is all about a sweet spot. That elusive place where an item is tight but not clingy, sexy but not cloying, cool but not over the top. Alexandra Alvarez’s label, Alix, hits that mark with its range of comfortable, minimal, and neutral-hued bodysuits.</p>
                            <h4 class="ht__pro__title">Description</h4>
                            <p>
                                <?php echo $get_product['0']['description'] ?>
                            </p>

                            <h4 class="ht__pro__title">Standard Featured</h4>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in</p>
                        </div>
                    </div>
                    <!-- End Single Content -->

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Description -->
<!-- Start Product Area -->
<section class="htc__product__area--2 pb--100 product-details-res">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section__title--2 text-center">
                    <h2 class="title__line">New Arrivals</h2>
                    <p>But I must explain to you how all this mistaken idea</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product__wrap clearfix">
                <!-- Start Single Product -->
                <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                    <div class="category">
                        <div class="ht__cat__thumb">
                            <a href="product-details.html">
                                <img src="../assets/images/product/1.jpg" alt="product images">
                            </a>
                        </div>
                        <div class="fr__hover__info">
                            <ul class="product__action">
                                <li><a href="wishlist.html"><i class="icon-heart icons"></i></a></li>

                                <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>

                                <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                            </ul>
                        </div>
                        <div class="fr__product__inner">
                            <h4><a href="product-details.html">Product Title Here </a></h4>
                            <ul class="fr__pro__prize">
                                <li class="old__prize">$30.3</li>
                                <li>$25.9</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
                <!-- Start Single Product -->
                <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                    <div class="category">
                        <div class="ht__cat__thumb">
                            <a href="product-details.html">
                                <img src="../assets/images/product/2.jpg" alt="product images">
                            </a>
                        </div>
                        <div class="fr__hover__info">
                            <ul class="product__action">
                                <li><a href="wishlist.html"><i class="icon-heart icons"></i></a></li>

                                <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>

                                <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                            </ul>
                        </div>
                        <div class="fr__product__inner">
                            <h4><a href="product-details.html">Product Title Here </a></h4>
                            <ul class="fr__pro__prize">
                                <li class="old__prize">$30.3</li>
                                <li>$25.9</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
                <!-- Start Single Product -->
                <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                    <div class="category">
                        <div class="ht__cat__thumb">
                            <a href="product-details.html">
                                <img src="../assets/images/product/3.jpg" alt="product images">
                            </a>
                        </div>
                        <div class="fr__hover__info">
                            <ul class="product__action">
                                <li><a href="wishlist.html"><i class="icon-heart icons"></i></a></li>

                                <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>

                                <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                            </ul>
                        </div>
                        <div class="fr__product__inner">
                            <h4><a href="product-details.html">Product Title Here </a></h4>
                            <ul class="fr__pro__prize">
                                <li class="old__prize">$30.3</li>
                                <li>$25.9</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
                <!-- Start Single Product -->
                <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                    <div class="category">
                        <div class="ht__cat__thumb">
                            <a href="product-details.html">
                                <img src="../assets/images/product/4.jpg" alt="product images">
                            </a>
                        </div>
                        <div class="fr__hover__info">
                            <ul class="product__action">
                                <li><a href="wishlist.html"><i class="icon-heart icons"></i></a></li>

                                <li><a href="cart.html"><i class="icon-handbag icons"></i></a></li>

                                <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                            </ul>
                        </div>
                        <div class="fr__product__inner">
                            <h4><a href="product-details.html">Product Title Here </a></h4>
                            <ul class="fr__pro__prize">
                                <li class="old__prize">$30.3</li>
                                <li>$25.9</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
            </div>
        </div>
    </div>
</section>
<!-- End Product Area -->
<!-- End Banner Area -->


<?php include('../includes/footer.php') ?>