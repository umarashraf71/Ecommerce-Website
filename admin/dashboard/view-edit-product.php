<!-- //////////( HEADER )////////// -->
<?php include('../includes/header.php') ?>


<?php

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $prd_id = get_safe_value($con, $_GET['id']);

        if ($operation == 'enable') {

            $status = '1';
        } else {

            $status = '0';
        }

        $query1 = "update product set status = '$status' where id='$prd_id'";
        $result1 = mysqli_query($con, $query1);

        $msg = "Product Status Changed Successfully !";
        $_SESSION['success_msg'] = $msg;

        header("refresh: 2; url=view-edit-product.php");
    }

    if ($type == 'delete') {

        $delete_id = get_safe_value($con, $_GET['id']);

        $query2 = "delete from product where id='$delete_id'";
        $result2 = mysqli_query($con, $query2);

        $msg = "Product Deleted Successfully !";
        $_SESSION['success_msg'] = $msg;

        header("refresh: 2; url=view-edit-product.php");
    }
}



$query = "select product.*, categories.categories from product inner join categories on product.categories_id = categories.id order by product.id desc";
$result = mysqli_query($con, $query);

if ($result) {

    $count = mysqli_num_rows($result);
} else {

    die('Query Unsuccessfull' . mysqli_error($con));
}

?>


<title>Admin | View & Edit Products</title>


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
        <i class="icon ion-ios-list-outline"></i>
        <div>
            <h4>View & Edit Products</h4>
            <p class="mg-b-0">You can edit, delete and view products here </p>
        </div>
    </div>

    <div class="br-pagebody" style="margin-top: 5px !important;">

        <div class="row mb-3 p-2">
            <div class="col-md-12">
                <form action="" method="post">

                    <div class="row" style="padding:0px 0px 0px 15px !important">
                        <div class="col-md-4 col-sm-8 col-xs-3 mt-1" style="padding:0 !important">
                            <input type="text" name="product" class="form-control" required placeholder="Search Product Here ... ">
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
                                <th>S<small><b>r</b></small> #</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Retail Price</th>
                                <th>Sale Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th style="min-width:60% !important">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $sr = 1;

                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>

                                <tr>
                                    <th scope="row"><?php echo $sr ?></th>
                                    <th scope="row"><img src="../../uploads/<?php echo $row['image'] ?>" width="50" height="50" alt=""></th>
                                    <td><?php echo ucfirst($row['categories']); ?></td>
                                    <td><?php echo ucfirst($row['name']); ?></td>
                                    <td><?php echo ucfirst($row['mrp']); ?></td>
                                    <td><?php echo ucfirst($row['price']); ?></td>
                                    <td><?php echo ucfirst($row['quantity']); ?></td>

                                    <?php

                                    if ($row['status'] == 1) {
                                        echo "<th class='text-success' >Enabled</th>";
                                    } else {

                                        echo "<th class='text-warning' >Disabled</th>";
                                    }

                                    ?>

                                    <td>
                                        <?php

                                        if ($row['status'] == 1) {
                                        ?>
                                            <a class="btn btn-status mt-1" href="?type=status&operation=disable&id=<?php echo $row['id'] ?>">Disable</a>

                                        <?php
                                        } else {
                                        ?>
                                            <a class="btn btn-view mt-1" href="?type=status&operation=enable&id=<?php echo $row['id'] ?>"> Enable </a>
                                        <?php
                                        }
                                        ?>

                                        <a href="view-product.php?viewId=<?php echo $row['id'] ?>" class="btn btn-display mt-1">View</a>
                                        <a href="edit-product.php?editId=<?php echo $row['id'] ?>" class="btn btn-edit mt-1">Edit</a>
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
                                <h3 class='pt-5' style='color:#343a40'>No Products Exist !</h3>
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


<script>
    setTimeout(function() {
        $('#message').fadeOut('fast');
    }, 2500); // <-- time in milliseconds
</script>