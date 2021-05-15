<?php include('../includes/header.php') ?>

<?php

$str = get_safe_value($con, $_GET['str']);

if ($str != '') {

    $get_product = get_product($con, '', '', '', $str);
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
                                <span class="breadcrumb-item ">Search</span>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active"><?php echo $str; ?></span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Product Grid -->
    <section class="htc__product__grid bg__white ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-push-0 col-md-12 col-md-push-0 col-sm-12 col-xs-12">
                    <div class="htc__product__rightidebar">
                        <div class="htc__grid__top">



                        </div>
                        <!-- Start Product View -->
                        <div class="row">

                            <?php if (count($get_product) > 0) { ?>

                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">

                                        <?php

                                        foreach ($get_product as $list) {

                                        ?>

                                            <!-- Start Single Category -->
                                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                                <div class="category">
                                                    <div class="ht__cat__thumb">
                                                        <a href="product.php?id=<?php echo $list['id'] ?>">
                                                            <img src="../../uploads/<?php echo $list['image'] ?>" alt="product images">
                                                        </a>
                                                    </div>
                                                    <div class="fr__hover__info">
                                                        <ul class="product__action">
                                                            <li><a href="wishlist.php"><i class="icon-heart icons"></i></a></li>

                                                            <li><a href="cart.php"><i class="icon-handbag icons"></i></a></li>

                                                            <!-- <li><a href="#"><i class="icon-shuffle icons"></i></a></li> -->
                                                        </ul>
                                                    </div>
                                                    <div class="fr__product__inner">
                                                        <h4><a href="product.php?id=<?php echo $list['id'] ?>"><?php echo $list['name'] ?></a></h4>
                                                        <ul class="fr__pro__prize">
                                                            <li class="old__prize"><strike><?php echo $list['mrp'] ?></strike></li>
                                                            <li><?php echo $list['price'] ?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Category -->
                                        <?php

                                        }

                                        ?>

                                    </div>


                                    <!-- //////////////////////////////////////////////////////// -->

                                </div>

                            <?php } else { ?>

                                <h2 class="text-center">No Record Found</h2>

                            <?php } ?>
                        </div>
                        <!-- End Product View -->
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Product Grid -->



    <?php include('../includes/footer.php') ?>