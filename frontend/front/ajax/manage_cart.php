<?php

require('../../includes/connection.php');
require('../../includes/functions.php');
require('../../includes/add_to_cart.php');
date_default_timezone_set("Asia/Karachi");

if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_POST['type'])) {


    $product_id = get_safe_value($con, $_POST['product_id']);
    $quantity = get_safe_value($con, $_POST['quantity']);
    $type = get_safe_value($con, $_POST['type']);

    // echo $product_id . "/" . $quantity . "/" . $type;

    $cartObj = new add_to_cart();

    // echo $product_id . "/" . $quantity . "/" . $type;

    if ($type == 'add') {

        $cartObj->addProduct($product_id, $quantity);
    }


    if ($type == 'update') {

        $cartObj->updateProduct($product_id, $quantity);
    }


    if ($type == 'remove') {

        $cartObj->removeProduct($product_id, $quantity);
    }

    echo $cartObj->totalProduct();
}


?>