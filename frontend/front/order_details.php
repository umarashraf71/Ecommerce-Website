<?php

include('../includes/header.php');

$order_id = get_safe_value($con, $_GET['id']);



?>


<style>
    .total h2 {

        margin-top: 10px;
        text-transform: uppercase;
        font-size: 22px !important;
        font-weight: 500;
    }

    .totalItem h3 {

        margin-top: 60px;
        text-transform: uppercase;
        font-size: 22px !important;
        font-weight: 500;
    }
</style>

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
                                <span class="breadcrumb-item active">Order Details</span>
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

                        <!-- Start Product View -->
                        <div class="row">

                            <div class="shop__grid__view__wrap">

                                <div role="" id="" class="single-grid-view clearfix">
                                    <div class="col-xs-12">
                                        <div class="ht__list__wrap">


                                            <?php

                                            $itemCount = 0; 
                                            $uid = $_SESSION['USER_ID'];
                                            $query = "select orders.id, orders.total_price, order_details.*, product.name, product.mrp, product.price, product.image, product.description from orders inner join order_details on orders.id = order_details.order_id inner join product on order_details.product_id = product.id where order_details.order_id = '$order_id' and orders.user_id = '$uid' ";
                                            $result = mysqli_query($con, $query);


                                            while ($row = mysqli_fetch_assoc($result)) {

                                                $totalPrice = $row['total_price'];
                                            ?>

                                                <!-- Start List Product -->
                                                <div class="ht__list__product">
                                                    <div class="ht__list__thumb">
                                                        <a href="product-details.html"><img src="../../uploads/<?php echo $row['image'] ?>" alt="product images"></a>
                                                    </div>
                                                    <div class="htc__list__details" style="padding-top:10px">
                                                        <h2><a href="product-details.html"><?php echo $row['name'] ?></a></h2>
                                                        <ul class="pro__prize">
                                                            <li class="old__prize"><strike>$ <?php echo $row['mrp'] ?></strike></li>
                                                            <li>$ <?php echo $row['price'] ?></li>
                                                        </ul>
                                                        <ul class="pro__prize">
                                                            <li>Quantity : <?php echo $row['quantity'] ?></li><br>
                                                        </ul>
                                                        <ul class="pro__prize">
                                                            <li>Total Price : $ <?php echo $row['sub_total_price'] ?></li>
                                                        </ul>
                                                        <p><?php echo $row['description'] ?></p>

                                                    </div>
                                                </div>
                                                <!-- End List Product -->

                                            <?php

                                                $itemCount = $itemCount + 1;
                                            }
                                            ?>

                                            <div class="totalItem">
                                                <h3>Total Items : <?php echo $itemCount; ?></h3>
                                            </div>
                                            <div class="total">
                                                <h2>Order Grand Total : $ <?php echo $totalPrice; ?></h2>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <!-- End Product View -->
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Product Grid -->



    <?php include('../includes/footer.php') ?>