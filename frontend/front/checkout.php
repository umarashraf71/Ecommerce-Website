<?php include('../includes/header.php');


if (empty($_SESSION['cart'])) {

    header('location:index.php');
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
                                <a class="breadcrumb-item" href="index.html">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active">checkout</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- cart-main-area start -->
    <div class="checkout-wrap ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="checkout__inner">
                        <div class="accordion-list">
                            <div class="accordion">

                                <form action="checkout-payment.php" method="post">

                                    <div class="accordion__title">
                                        Address Information
                                    </div>
                                    <div class="accordion__body " style="padding:0px 10px 30px 10px !important">
                                        <div class="bilinfo">
                                            <!-- <form action="#"> -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="single-input">
                                                        <input type="text" name="name" placeholder="Full Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="single-input">
                                                        <input type="text" name="address" placeholder="Shipping Address" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" name="city" placeholder="City/State" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" name="zip_post_code" placeholder="Post code/ zip" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="email" name="email" placeholder="Email address" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" name="mobile" placeholder="Phone number" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                    <div class="accordion__title">
                                        payment information
                                    </div>
                                    <div class="accordion__body" style="padding:20px 10px 5px 10px !important">
                                        <div class="paymentinfo">
                                            <div class="single-method">
                                                <h3> <input type="radio" name="payment_type" value="cod" required> Cash on Delivery </h3>
                                            </div>
                                            <div class="single-method">
                                                <h3> <input type="radio" name="payment_type" value="card" required> Credit Card </h3>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="contact-btn" style="margin-top:30px; ">
                                        <input type="submit" name="csubmit" value="Place Order" class="fv-btn">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="order-details">
                        <h5 class="order-details__title">Your Order</h5>
                        <div class="order-details__item">

                            <?php

                            // $productArr = array();
                            $total = 0;
                            $totalItems = 0;

                            foreach ($_SESSION['cart'] as $key => $val) {

                                $productArr = get_product($con, '', '', $key);

                                $pname = $productArr[0]['name'];
                                $mrp = $productArr[0]['mrp'];
                                $price = $productArr[0]['price'];
                                $image = $productArr[0]['image'];

                                $quantity = $val['quantity'];

                                $subTotal = $quantity * $price;

                                $total = $total + $subTotal;

                                $totalItems = $totalItems + 1;
                            ?>

                                <div class="single-item">
                                    <div class="single-item__thumb">
                                        <img src="../../uploads/<?php echo $image; ?>" alt="ordered item">
                                    </div>
                                    <div class="single-item__content">
                                        <a href="#"><?php echo $pname; ?></a>
                                        <span class="price">$ <?php echo $price * $quantity; ?></span>
                                    </div>

                                    <input type="hidden" class="qty" readonly id="<?php echo $key; ?>qty" value="<?php echo $quantity; ?>" />

                                    <div class="single-item__remove">
                                        <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key; ?>', 'remove')">
                                            <i class="icon-trash icons"></i>
                                        </a>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                        </div>
                        <div class="order-details__count">
                            <div class="order-details__count__single">
                                <h5>Items</h5>
                                <span class="price"><?php echo $totalItems; ?></span>
                            </div>
                            <div class="order-details__count__single">
                                <h5>Grand Total</h5>
                                <span class="price">$ <?php echo $total; ?></span>
                            </div>
                        </div>
                        <div class="ordre-details__total">
                            <h5>Order total</h5>
                            <span class="price">$ <?php echo $total; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->

    <?php include('../includes/footer.php') ?>