<?php

require('../includes/connection.php');
require('../includes/functions.php');


if (!empty($_SESSION['USER_LOGIN']) && !empty($_SESSION['cart']) ) {


$name = get_safe_value($con, $_POST['name']);
$address = get_safe_value($con, $_POST['address']);
$city = get_safe_value($con, $_POST['city']);
$post_zip_code = get_safe_value($con, $_POST['zip_post_code']);
$email = get_safe_value($con, $_POST['email']);
$mobile = get_safe_value($con, $_POST['mobile']);
$payment_type = get_safe_value($con, $_POST['payment_type']);
$total_price = get_safe_value($con, $_POST['total']);

$user_id = $_SESSION['USER_ID'];

$payment_status = "Pending";
$order_status = 1;

date_default_timezone_set("Asia/Karachi");
$date = date('Y-m-d h:i:s');


if(isset($_POST['stripeToken'])) {



    \Stripe\Stripe::setVerifySslCerts(false);
    $token = $_POST['stripeToken'];
    
    $data = \Stripe\Charge::create(array(

        "amount"=>$total_price * 100,
        "currency"=>"USD",
        "description"=>"Asbab Furniture",
        "source"=>$token    
    ));

    if($data)
    {

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
    else
    {
        header('location:payment-error.php');        
    }


}
else 
{

    header('location:payment-error.php');

}


}
else
{
    header('location:index.php');
}
?>
