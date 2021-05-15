<!-- //////////( HEADER )////////// -->
<?php include('../includes/header.php') ?>


<?php

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $cat_id = get_safe_value($con, $_GET['id']);

        if ($operation == 'enable') {

            $status = '1';
        } else {

            $status = '0';
        }

        $query1 = "update categories set status = '$status' where id='$cat_id'";
        $result1 = mysqli_query($con, $query1);

        $msg = "Category Status Changed Successfully !";
        $_SESSION['success_msg'] = $msg;

        header("refresh: 2; url=categories.php");
    }

    if ($type == 'delete') {

        $delete_id = get_safe_value($con, $_GET['id']);

        $query2 = "delete from categories where id='$delete_id'";
        $result2 = mysqli_query($con, $query2);

        $msg = "Category Deleted Successfully !";
        $_SESSION['success_msg'] = $msg;

        header("refresh: 2; url=categories.php");
    }
}


if (isset($_POST['submit'])) {

    $category_name = get_safe_value($con, $_POST['category']);
    $capital_category_name = ucfirst($category_name);

    $query4 = "select * from categories where categories = '$category_name' || categories = '$capital_category_name'";
    $result4 = mysqli_query($con, $query4);

    if ($result4) {
        $count1 = mysqli_num_rows($result4);
    }

    if ($count1 > 0) {
        $msg = "Category Name Already Exists !";
        $_SESSION['error_msg'] = $msg;

        header("refresh: 2; url=categories.php");
    } else {

        $query3 = "insert into categories (categories, status) values ('$category_name', 1)";
        $result3 = mysqli_query($con, $query3);

        if ($result3) {

            $msg = "Category added Successfully !";
            $_SESSION['success_msg'] = $msg;

            header("refresh: 2; url=categories.php");
        }
    }
}








$query = "select orders.*, order_status.name as order_status_str  from orders inner join order_status on orders.order_status = order_status.id order by orders.id desc";
$result = mysqli_query($con, $query);

if ($result) {

    $count = mysqli_num_rows($result);
} else {

    die('Query Unsuccessfull' . mysqli_error($con));
}

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
            <h4>Orders</h4>
            <p class="mg-b-0">You can manage all the orders here </p>
        </div>
    </div>

    <div class="br-pagebody" style="margin-top: 5px !important;">

        <div class="row mb-3 p-2">
            <div class="col-md-12">
                <form action="" method="post">

                    <div class="row" style="padding:0px 0px 0px 15px !important">
                        <div class="col-md-4 col-sm-8 col-xs-3 mt-1" style="padding:0 !important">
                            <input type="text" name="order" class="form-control" required placeholder="Search Order Here ... ">
                        </div><!-- col-4 -->

                        <div class="col-md-8 col-sm-4 col-xs-9 mt-1" style="padding:0 !important">
                            <input type="submit" name="submit" value="Search" class="btn btn-search btn-sm ">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row row-sm pt-2 pl-3 pr-3">

            <?php if (!empty($_SESSION['success_msg'])) { ?>
                <span>
                    <?php

                    echo "<h6 id = 'message' class='pl-1 pb-2 text-success'>" . htmlentities($_SESSION['success_msg']) . "</h6>";
                    echo htmlentities($_SESSION['success_msg'] = "");
                    ?>
                </span>
            <?php } ?>

            <?php if (!empty($_SESSION['error_msg'])) { ?>
                <span>
                    <?php
                    if (isset($_SESSION['error_msg'])) {
                        echo "<h6 id = 'message' class='pl-1 pb-2 text-danger'>" . htmlentities($_SESSION['error_msg']) . "</h6>";
                        echo htmlentities($_SESSION['error_msg'] = "");
                    };

                    ?>
                </span>
            <?php } ?>

            <!-- <h6 class="tx-inverse tx-uppercase tx-bold tx-14 mg-t-80 mg-b-10">Hoverable Rows</h6> -->
            <!-- <p class="br-section-text">To enable a hover state on table rows.</p> -->

            <?php

            if ($count > 0) {

            ?>

                <div class="bd bd-gray-300 rounded table-responsive">
                    <table class="table table-hover mg-b-0">
                        <thead>
                            <tr>
                                <th>ID # </th>
                                <th>Date</th>
                                <th style="width:15% !important">Address</th>
                                <th>Total ($)</th>
                                <th>Payment Type</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th style="min-width:60% !important">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $sr = 1;

                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>

                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['date'] ?></td>
                                    <td><?php echo $row['shipping_address'] ?></td>
                                    <td> <?php echo $row['total_price'] ?></td>
                                    <td><?php echo $row['payment_type'] ?></td>
                                    <td><?php

                                        if ($row['payment_status'] == 'success') {
                                            echo "<span class='text-success tx-medium'>" . ucfirst($row['payment_status']) . "</span>";
                                        } else {
                                            echo "<span class='text-warning tx-medium'>" . ucfirst($row['payment_status']) . "</span>";
                                        }

                                        ?>
                                    </td>
                                    <td><?php

                                        if ($row['order_status_str'] == 'Processing') {

                                            echo "<span class='text-info tx-medium'>" . ucfirst($row['order_status_str']) . "</span>";
                                        } else if ($row['order_status_str'] == 'Shipped') {
                                            echo "<span class='text-primary tx-medium'>" . ucfirst($row['order_status_str']) . "</span>";
                                        } else if ($row['order_status_str'] == 'Completed') {
                                            echo "<span class='text-success tx-medium'>" . ucfirst($row['order_status_str']) . "</span>";
                                        } else if ($row['order_status_str'] == 'Cancelled') {
                                            echo "<span class='text-danger tx-medium'>" . ucfirst($row['order_status_str']) . "</span>";
                                        } else {
                                            echo "<span class='text-warning tx-medium'>" . ucfirst($row['order_status_str']) . "</span>";
                                        }

                                        ?>
                                    </td>
                                    <?php

                                    // if ($row['status'] == 1) {
                                    //     echo "<th class='text-success' >Enabled</th>";
                                    // } else {

                                    //     echo "<th class='text-warning' >Disabled</th>";
                                    // }

                                    ?>

                                    <td>
                                        <a href="order-details.php?id=<?php echo $row['id'] ?>" class="btn btn-edit mt-1">View & Manage</a>
                                        <a onclick="return confirm('Are you sure you want to delete ?')" href="?type=delete&id=<?php echo $row['id'] ?>" class="btn btn-delete mt-1">Delete</a>
                                    </td>
                                </tr>

                            <?php

                                $sr = $sr + 1;
                            }

                            ?>

                        </tbody>
                    </table>
                </div><!-- bd -->

            <?php

            } else {

                echo "  <div class='w-100 row pt-5'>
                            <div class='col-md-12 text-center text-uppercase pt-5'>
                                <h3 class='pt-5' style='color:#343a40'>No Orders Exist !</h3>
                            </div>
                        </div>";
            }

            ?>

        </div><!-- row -->

    </div><!-- br-pagebody -->

</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<!-- //////////( FOOTER )////////// -->
<?php include('../includes/footer.php') ?>