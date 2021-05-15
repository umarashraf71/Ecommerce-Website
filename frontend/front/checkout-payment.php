<?php include('../includes/header.php');


if (empty($_SESSION['cart'])) {

    header('location:index.php');
}



if (isset($_POST['csubmit']) && ($_POST['payment_type'] == 'cod')) {

    $total = 0;

    foreach ($_SESSION['cart'] as $key => $val) {

        $productArr = get_product($con, '', '', $key);

        $price = $productArr[0]['price'];
        $quantity = $val['quantity'];
        $subTotal = $quantity * $price;
        $total = $total + $subTotal;
    }

    $name = get_safe_value($con, $_POST['name']);
    $address = get_safe_value($con, $_POST['address']);
    $city = get_safe_value($con, $_POST['city']);
    $post_zip_code = get_safe_value($con, $_POST['zip_post_code']);
    $email = get_safe_value($con, $_POST['email']);
    $mobile = get_safe_value($con, $_POST['mobile']);
    $payment_type = get_safe_value($con, $_POST['payment_type']);
    $total_price = $total;

    $user_id = $_SESSION['USER_ID'];

    if ($payment_type == 'cod') {

        $payment_status = "Success";
    } else {

        $payment_status = "Pending";
    }


    $order_status = 1;


    date_default_timezone_set("Asia/Karachi");
    $date = date('Y-m-d h:i:s');


    $query = "insert into orders (user_id, name, shipping_address, city, post_zip_code, email, mobile, payment_type, total_price, payment_status, order_status, date) values ('$user_id', '$name', '$address', '$city', '$post_zip_code', '$email', '$mobile', '$payment_type', '$total_price', '$payment_status', '$order_status', '$date')";
    $result = mysqli_query($con, $query);


    if ($result) {

        $order_id = mysqli_insert_id($con);


        foreach ($_SESSION['cart'] as $key => $val) {

            $productArr1 = get_product($con, '', '', $key);

            $product_id = $key;
            $product_price = $productArr1[0]['price'];
            $product_quantity = $val['quantity'];
            $product_subTotal = $product_quantity * $product_price;

            $query1 = "insert into order_details (order_id, product_id, quantity, sub_total_price, date) values ('$order_id', '$product_id', '$product_quantity', '$product_subTotal', '$date') ";
            $result1 = mysqli_query($con, $query1);
        }

        if ($result1) {

            unset($_SESSION['cart']);

            header('location:thankyou.php');
        }
    }
}



if (isset($_POST['csubmit']) && ($_POST['payment_type'] == 'card')) {

    $total = 0;

    foreach ($_SESSION['cart'] as $key => $val) {

        $productArr = get_product($con, '', '', $key);

        $price = $productArr[0]['price'];
        $quantity = $val['quantity'];
        $subTotal = $quantity * $price;
        $total = $total + $subTotal;
    }

    $name = get_safe_value($con, $_POST['name']);
    $address = get_safe_value($con, $_POST['address']);
    $city = get_safe_value($con, $_POST['city']);
    $post_zip_code = get_safe_value($con, $_POST['zip_post_code']);
    $email = get_safe_value($con, $_POST['email']);
    $mobile = get_safe_value($con, $_POST['mobile']);
    $payment_type = get_safe_value($con, $_POST['payment_type']);
    $total_price = $total;

    $user_id = $_SESSION['USER_ID'];

    if ($payment_type == 'cod') {

        $payment_status = "Success";
    } else {

        $payment_status = "Pending";
    }


    $order_status = 1;
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
                                <span class="breadcrumb-item active">payment</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->

    <style>
        .center {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: row;
        }

        form {
            border: 1px solid #bababa;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.4);
            width: 450px;
            padding: 20px 30px;
            background-color: #f2f2f2;
        }

        form h4 {

            font-size: 14px;
            color: #363636;
            font-weight: 500;
        }

        form h2 {

            font-size: 18px;
            text-transform: uppercase;
            color: #363636;
            font-weight: 600;
            padding: 5px 0px;
            text-align: center;
            margin-bottom: -5px;
        }

        .form-content {

            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
        }

        .form-content:nth-of-type(1) {
            padding-top: 0;
            margin-top: -5px;
        }

        .form-content:nth-of-type(8) {
            padding-top: 0;
            margin-bottom: -5px;
            margin-top: -5px;
        }

        .btn {

            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }
    </style>

    <!-- cart-main-area start -->
    <div class="checkout-wrap ptb--50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="center">
                        <form action="checkout-payment-submit.php" method="post">

                            <h2>Payment Invoice</h2>
                            <hr>
                            <div class="form-content">
                                <h4>Full Name : </h4>
                                <h4><?php echo $name;  ?></h4>
                                <input type="hidden" name="name" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-content">
                                <h4>Address : </h4>
                                <h4><?php echo $address;  ?></h4>
                                <input type="hidden" name="address" value="<?php echo $address; ?>">
                            </div>
                            <div class="form-content">
                                <h4>City : </h4>
                                <h4><?php echo $city;  ?></h4>
                                <input type="hidden" name="city" value="<?php echo $address; ?>">
                            </div>
                            <div class="form-content">
                                <h4>Post / Zip-code : </h4>
                                <h4><?php echo $post_zip_code;  ?></h4>
                                <input type="hidden" name="zip_post_code" value="<?php echo $post_zip_code; ?>">
                            </div>
                            <div class="form-content">
                                <h4>Email : </h4>
                                <h4><?php echo $email;  ?></h4>
                                <input type="hidden" name="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="form-content">
                                <h4>Mobile : </h4>
                                <h4><?php echo $mobile;  ?></h4>
                                <input type="hidden" name="mobile" value="<?php echo $mobile; ?>">
                            </div>
                            <div class="form-content">
                                <h4>Payment Type : </h4>
                                <h4><?php echo ucfirst($payment_type);  ?></h4>
                                <input type="hidden" name="payment_type" value="<?php echo $payment_type; ?>">
                            </div>
                            <hr>
                            <div class="form-content">
                                <h4>Payable Amount : </h4>
                                <h4>$ <?php echo $total_price;  ?></h4>
                                <input type="hidden" name="total" value="<?php echo $total_price; ?>">
                            </div>
                            <hr>
                            <div class="btn">
                                <script src="https://checkout.stripe.com/checkout.js" 
                                        class="stripe-button" 
                                        data-key="<?php echo $publishableKey; ?>" 
                                        data-amount="<?php echo $total_price * 100; ?>" 
                                        data-name="Asbab Furniture" 
                                        data-description="Asbab Furniture" 
                                        data-image="../assets/images/logo/4.png" 
                                        data-currency="USD" 
                                        data-email="<?php echo $email; ?>">
                                </script>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->

    <?php include('../includes/footer.php') ?>