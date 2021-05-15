<?php

class add_to_cart {


    function addProduct($product_id, $quantity) {

        $_SESSION['cart'][$product_id]['quantity'] = $quantity;

    }



    function updateProduct($product_id, $quantity) {

        if(isset($_SESSION['cart'][$product_id])) {

            $_SESSION['cart'][$product_id]['quantity'] = $quantity;

        }
        
    }



    function removeProduct($product_id) {

        if(isset($_SESSION['cart'][$product_id])) {

            unset($_SESSION['cart'][$product_id]);

        }
        
    }



    function emptyProduct() {

        unset($_SESSION['cart']);        
        
    }


    
    function totalProduct() {

    //if there is something in the cart
        if(isset($_SESSION['cart'])) {

            $count = count($_SESSION['cart']);
            return $count;
        }
        else {

            $count = 0;
            return $count;
        }
    }



}

?>