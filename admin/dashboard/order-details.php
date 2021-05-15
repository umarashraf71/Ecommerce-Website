<!-- //////////( HEADER )////////// -->
<?php include('../includes/header.php') ?>


<?php

if (isset($_GET['id'])) {

    $order_id = $_GET['id'];
}


if (isset($_POST['submit'])) {

    $order_status = $_POST['update_order_status'];

    $query4 = "update orders set order_status = '$order_status' where id = '$order_id' ";
    $result4 = mysqli_query($con, $query4);

    if ($result4) {

        header("location:order-details.php?id={$order_id}");
    }
}







date_default_timezone_set("Asia/Karachi");

$query3 = "select orders.*, order_status.name as order_status_str  from orders inner join order_status on orders.order_status = order_status.id where orders.id = '$order_id'";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_assoc($result3);

$date = date_create($row3['date']);
$time = date_format($date, "a");

if ($time == 'am') {

    $timeTag = 'pm';
} else {
    $timeTag = 'am';
}

$orderDate =  date_format($date, "l - F j, Y - g:i ");


?>


<title>Admin | Orders</title>


<!-- //////////( SIDE-BAR )////////// -->
<?php include('../includes/sidebar.php') ?>



<!-- //////////( TOP-BAR )////////// -->
<?php include('../includes/topbar.php') ?>


<style>
    thead tr th,
    tbody tr th,
    tbody tr td {

        text-align: center !important;
        vertical-align: middle !important;
    }
</style>



<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    <div class="br-pagetitle">
        <i class="icon ion-ios-cart-outline"></i>
        <div>
            <h4>Order Details</h4>
            <p class="mg-b-0">You can view & manage order here </p>
        </div>
    </div>

    <div class="br-pagebody" style="margin-top: 15px !important;">


        <div class="card bd-0 shadow-base">
            <div class="card-body pd-30 pd-md-60">
                <div class="d-md-flex justify-content-left ">
                    <h1 class="mg-b-0 tx-uppercase tx-pink tx-mont tx-bold">Asbab </h1>

                </div><!-- d-flex -->

                <div class="row mg-t-50">

                    <div class="col-md">
                        <div class="mg-t-25 mg-md-t-0">
                            <label class="tx-uppercase tx-13 tx-bold mg-b-20">Billed To</label>
                            <h6 class="tx-inverse"><?php echo $row3['name']; ?></h6>
                            <p class="lh-7"><?php echo ucfirst($row3['shipping_address']); ?><br>
                                City : <?php echo $row3['city'] ?><br>
                                Phone : <?php echo $row3['mobile'] ?><br>
                                Email : <?php echo $row3['email'] ?></p>
                        </div>
                    </div>


                    <div class="col-md ">
                        <label class="tx-uppercase tx-13 tx-bold mg-b-20">Order Information</label>
                        <p class="d-flex justify-content-between mg-b-5">
                            <span>Order Id :</span>
                            <span><?php echo $row3['id'] ?></span>
                        </p>
                        <p class="d-flex justify-content-between mg-b-5">
                            <span>Order Status :</span>

                            <?php

                            if ($row3['order_status_str'] == 'Processing') {

                                echo "<span class='text-info tx-medium'>" . ucfirst($row3['order_status_str']) . "</span>";
                            } else if ($row3['order_status_str'] == 'Shipped') {
                                echo "<span class='text-primary tx-medium'>" . ucfirst($row3['order_status_str']) . "</span>";
                            } else if ($row3['order_status_str'] == 'Completed') {
                                echo "<span class='text-success tx-medium'>" . ucfirst($row3['order_status_str']) . "</span>";
                            } else if ($row3['order_status_str'] == 'Cancelled') {
                                echo "<span class='text-danger tx-medium'>" . ucfirst($row3['order_status_str']) . "</span>";
                            } else {
                                echo "<span class='text-warning tx-medium'>" . ucfirst($row3['order_status_str']) . "</span>";
                            }

                            ?>

                        </p>
                        <p class="d-flex justify-content-between mg-b-5">
                            <span>Payment Status :</span>
                            <?php

                            if ($row3['payment_status'] == 'success') {
                                echo "<span class='text-success tx-medium'>" . ucfirst($row3['payment_status']) . "</span>";
                            } else {
                                echo "<span class='text-warning tx-medium'>" . ucfirst($row3['payment_status']) . "</span>";
                            }
                            ?>
                        </p>
                        <p class="d-flex justify-content-between mg-b-5">
                            <span>Payment Type :</span>
                            <span><?php echo $row3['payment_type'] ?></span>
                        </p>
                        <p class="d-flex justify-content-between mg-b-5">
                            <span>Order Date : </span>
                            <span><?php echo $orderDate . $timeTag;  ?></span>
                        </p>
                    </div><!-- col -->
                </div><!-- row -->

                <div class="row mg-t-20">
                    <div class="col-md-12">
                        <label class="tx-uppercase tx-13 tx-bold mg-b-20">Update Order Status</label>
                    </div>
                    <div class="col-md-6 ">
                        <form action="" method="post">
                            <div class="form-group ">
                                <select class="form-control select2 float-left w-75" name="update_order_status" data-placeholder="Choose Status" style="padding:0px 10px !important">
                                    <!-- <option label="Select Status"></option> -->

                                    <?php

                                    $query = "select * from order_status ";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {

                                        $count = mysqli_num_rows($result);
                                    }

                                    if ($count > 0) {

                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>

                                            <option value="<?php echo $row['id']; ?>" <?php if ($row3['order_status'] == $row['id']) echo 'selected="selected"'; ?>><?php echo $row['name']; ?></option>

                                    <?php
                                        }
                                    }
                                    ?>

                                </select>
                                <input type="submit" name="submit" value="Update" class="btn btn-search btn-sm float-left">
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="bd bd-gray-300 rounded table-responsive mg-t-40">
                    <table class="table table-hover mg-b-0">
                        <thead>
                            <tr>
                                <th class="wd-20p">Image</th>
                                <th class="wd-40p">Product Name</th>
                                <th class="tx-center">Quantity</th>
                                <th class="tx-right">Unit Price ($)</th>
                                <th class="tx-right">Amount ($)</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $itemCount = 0;
                            $query = "select orders.id, orders.total_price, order_details.*, product.name, product.mrp, product.price, product.image, product.description from orders inner join order_details on orders.id = order_details.order_id inner join product on order_details.product_id = product.id where order_details.order_id = '$order_id' ";
                            $result = mysqli_query($con, $query);


                            while ($row = mysqli_fetch_assoc($result)) {

                                $totalPrice = $row['total_price'];

                            ?>

                                <tr>
                                    <td><img width="140" src="../../uploads/<?php echo $row['image'] ?>" style="border:1px solid #dee2e6;" alt=""></td>
                                    <td class="tx-center"><?php echo ucfirst($row['name']) ?></td>
                                    <td class="tx-center"><?php echo $row['quantity'] ?></td>
                                    <td class="tx-right"><?php echo $row['price'] ?></td>
                                    <td class="tx-right"><?php echo $row['sub_total_price'] ?></td>
                                </tr>

                            <?php

                                $itemCount += 1;
                            }

                            ?>

                            <!-- <tr>
                                <td colspan="2" rowspan="4" class="valign-middle">
                                    <div class="mg-r-20">
                                        <label class="tx-uppercase tx-13 tx-bold mg-b-10">Notes</label>
                                        <p class="tx-13">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                                    </div>
                                </td>
                                <td class="tx-right">Sub-Total</td>
                                <td colspan="2" class="tx-right">$5,750.00</td>
                            </tr>
                            <tr>
                                <td class="tx-right">Tax (5%)</td>
                                <td colspan="2" class="tx-right">$287.50</td>
                            </tr>
                            <tr>
                                <td class="tx-right">Discount</td>
                                <td colspan="2" class="tx-right">-$50.00</td>
                            </tr>
                            <tr>
                                <td class="tx-right tx-uppercase tx-bold tx-inverse">Total Due</td>
                                <td colspan="2" class="tx-right">
                                    <h4 class="tx-teal tx-bold tx-lato">$5,987.50</h4>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div><!-- table-responsive -->

                <!-- <hr class="mg-b-60"> -->

                <div class="row mg-t-20">
                    <div class="col-md" style="letter-spacing:0.4px">
                        <p class="d-flex justify-content-between mg-b-4 mg-t-30" style="font-size:14px">
                            <span class="tx-right tx-uppercase tx-medium ">TOTAL ITEMS </span>
                            <span class="tx-right tx-uppercase tx-medium "><?php echo $itemCount; ?> </span>
                        </p>

                        <p class="d-flex justify-content-between mg-b-4 mg-t-0" style="font-size:14px;">
                            <span class="tx-right tx-uppercase tx-medium ">SUB TOTAL </span>
                            <span class="tx-right tx-uppercase tx-medium ">$ <?php echo $row3['total_price'] ?> </span>
                        </p>

                        <p class="d-flex justify-content-between mg-b-4 mg-t-0" style="font-size:14px;">
                            <span class="tx-right tx-uppercase tx-medium ">DISCOUNT </span>
                            <span class="tx-right tx-uppercase tx-medium ">$ 0 </span>
                        </p>

                        <hr class="mg-b-10">

                        <p class="d-flex justify-content-between mg-b-4 mg-t-0" style="font-size:14px;">
                            <span class="tx-right tx-uppercase tx-medium ">GRAND TOTAL </span>
                            <span class="tx-right tx-uppercase tx-medium ">$ <?php echo $row3['total_price'] ?> </span>
                        </p>

                    </div><!-- col -->
                </div><!-- row -->


            </div><!-- card-body -->
        </div><!-- card -->


    </div><!-- br-pagebody -->

</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<!-- //////////( FOOTER )////////// -->
<?php include('../includes/footer.php') ?>