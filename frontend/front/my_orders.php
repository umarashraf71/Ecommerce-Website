<?php include('../includes/header.php') ?>

<!-- Body main wrapper start -->
<div class="wrapper">


    <?php include('../includes/topbar.php') ?>

    <style>
        th,
        td {

            font-size: 14px !important;
            font-weight: 500 !important;
            text-transform: uppercase;
            border: 1px solid #252525 !important;
        }


        .view-btn {

            width: 8% !important;
        }

        .view-btn a i {


            /* padding: 8px 15px !important; */
            font-size: 20px;
            font-weight: 500 !important;
        }

        thead tr {
            background-color: #252525;
            border-color: #252525;
            color: white;
        }



        thead tr th {
            border-color: #252525;
            color: white !important;
        }
    </style>


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
                                <span class="breadcrumb-item active">My Orders</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- wishlist-area start -->
    <div class="wishlist-area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="wishlist-content">
                        <form action="#">
                            <div class="wishlist-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail" style="width:7% !important"># Id</th>
                                            <th class="product-thumbnail"> Date</th>
                                            <th class="product-name"><span class="nobr">Address</span></th>
                                            <th class="product-price"><span class="nobr"> Total Amount </span></th>
                                            <th class="product-price"><span class="nobr"> Payment Type </span></th>
                                            <th class="product-price"><span class="nobr"> Payment Status </span></th>
                                            <th class="product-add-to-cart"><span class="nobr">Order Status</span></th>
                                            <th class="product-add-to-cart">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php


                                        $uid = $_SESSION['USER_ID'];
                                        $query = "select orders.*, order_status.name as order_status_str  from orders inner join order_status on orders.order_status = order_status.id where user_id = '$uid' order by orders.id desc";
                                        $result = mysqli_query($con, $query);

                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td class="product-thumbnail"><?php echo $row['date'] ?></td>
                                                <td class="product-name"><?php echo $row['shipping_address'] ?></td>
                                                <td class="product-price"><span class="amount">$ <?php echo $row['total_price'] ?></span></td>
                                                <td class="product-price"><?php echo $row['payment_type'] ?></td>
                                                <td class="product-price"><?php echo $row['payment_status'] ?></td>
                                                <td class="product-add-to-cart"><?php echo $row['order_status_str'] ?></td>
                                                <td class="view-btn"><a href="order_details.php?id=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i> </a></td>
                                            </tr>

                                        <?php } ?>

                                    </tbody>

                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wishlist-area end -->


    <?php include('../includes/footer.php') ?>