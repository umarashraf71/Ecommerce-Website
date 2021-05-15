<?php include('../includes/header.php');


//prx($_SESSION['cart']);

?>

<style>
    .btn-qty-minus {

        position: relative !important;
        font-size: 24px;
        width: 20px;
        height: 10px !important;
        font-weight: 600;
        padding: 13px !important;
        border: 1px solid black;
        border-radius: 50%;
        margin: 5px -50px 0px 37px;
        background-color: #313131;
        float: left;
    }
    .btn-qty-plus {
        position: relative !important;
        font-size: 24px;
        width: 20px;
        height: 10px !important;
        font-weight: 600;
        padding: 13px !important;
        border: 1px solid black;
        border-radius: 50%;
        margin: 5px 40px 0px -54px;
        background-color: #313131;
        float: right;
    }

    .btn-qty-minus:hover, .btn-qty-plus:hover {

        background-color: #c43b68 !important;
        border: 1px solid #c43b68 !important;
        transition: 0.4s ease-in-out;
    }

    .btn-qty-plus a{
        position: absolute !important;
        top: 1.55px;
        left: 5.3px;
        color: white;
    }

    .btn-qty-minus a {
        position: absolute !important;
        top: 1.50px;
        left: 6.5px;
        color: white;
    }

    .grand-total {
        font-size: 17px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 40px;
        float:right;
    }
    .total-items {
        font-size: 17px;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 10px;
        float: right;
    }
    .qty {

        padding: 0 5px 0 15px !important;
        width: 60px !important;
        text-align: center !important; 
        font-weight: 500 !important;
        color: #313131 !important;
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
                                <a class="breadcrumb-item" href="index.html">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active">shopping cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- cart-main-area start -->
    <div class="cart-main-area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="#">
                    <?php
                        if(isset($_SESSION['cart']) && !empty($_SESSION['cart']) )
                        {                            
                    ?>  
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">products</th>
                                        <th class="product-name">name of products</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity" style="width:180px; min-width:178px !important; max-width:180px !important">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>

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

                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="../../uploads/<?php echo $image; ?>" alt="product img" /></a></td>
                                            <td class="product-name"><a href="#"><?php echo $pname; ?></a>
                                                <ul class="pro__prize">
                                                    <li class="old__prize"><strike>$<?php echo $mrp; ?></strike></li>
                                                    <li>$<?php echo $price; ?></li>
                                                </ul>
                                            </td>

                                            
                                            <td class="product-price" >
                                                $
                                                <span   
                                                        id="<?php echo $key; ?>-price" 
                                                >
                                                <?php echo $price; ?>
                                                </span>
                                                
                                            </td>


                                            <td class="" style="width:180px; min-width:178px !important; max-width:180px !important">

                                            <div class="btn-qty-minus">
                                                <a  href="javascript:void(0)"
                                                    id="<?php echo $key; ?>minus" 
                                                    name="minus"  
                                                    onclick="minus_cart('<?php echo $key ?>')"
                                                > 
                                                    -
                                                </a>
                                            </div>

                                                <input  type="number" 
                                                        class="qty" 
                                                        readonly 
                                                        id="<?php echo $key; ?>qty" 
                                                        value="<?php echo $quantity; ?>" 
                                                />
                                                
                                            <div class="btn-qty-plus">    
                                                <a  href="javascript:void(0)" 
                                                    id="<?php echo $key; ?>plus" 
                                                    name="plus" 
                                                    onclick= "plus_cart('<?php echo $key ?>')"
                                                > 
                                                    +
                                                </a>
                                            </div>
                                            
                                        </td>


                                            <td class="product-subtotal" 
                                            >
                                                $
                                                <span id="<?php echo $key; ?>-subtotal" ><?php echo $quantity * $price; ?></span>
                                            </td>
                                            
                                            
                                            <td class="product-remove">
                                                <a  href="javascript:void(0)" 
                                                    onclick= "manage_cart('<?php echo $key; ?>', 'remove')"
                                                >
                                                    <i class="icon-trash icons"></i>
                                                </a>
                                            </td>

                                            
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                              
                        </div>
                        <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <h3 class="total-items">Total Items : <span><?php echo $totalItems; ?></span></h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <h3 class="grand-total">Grand Total : $ <span id="grandTotal"><?php echo $total; ?></span></h3>
                        </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="buttons-cart--inner">
                                    <div class="buttons-cart">
                                        <a href="index.php">Continue Shopping</a>
                                    </div>
                                    <div class="buttons-cart checkout--btn">
                                        <!-- <a href="#">update</a> -->
                                        <a href="checkout.php">checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <?php 
                            }else{
                                ?>    
                                    <h1 class="text-center" >Shopping Cart is Empty !</h1>
                                <?php
                                }
                                ?>            

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->
    <!-- End Banner Area -->


    <?php include('../includes/footer.php') ?>