<!-- //////////( HEADER )////////// -->
<?php include('../includes/header.php') ?>


<?php

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'delete') {

        $delete_id = get_safe_value($con, $_GET['id']);

        $query2 = "delete from users where id='$delete_id'";
        $result2 = mysqli_query($con, $query2);

        $msg = "User Deleted Successfully !";
        $_SESSION['success_msg'] = $msg;

        header("refresh: 2; url=view-edit-user.php");
    }
}



$query = "select * from users order by id desc";
$result = mysqli_query($con, $query);

if ($result) {

    $count = mysqli_num_rows($result);
} else {

    die('Query Unsuccessfull' . mysqli_error($con));
}

?>


<title>Admin | View & Edit Users</title>


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
        <i class="icon ion-ios-people-outline"></i>
        <div>
            <h4>Users</h4>
            <p class="mg-b-0">You can view & edit all users here </p>
        </div>
    </div>

    <div class="br-pagebody" style="margin-top: 5px !important;">


        <div class="row mb-3 p-2">
            <div class="col-md-12">
                <form action="" method="post">

                    <div class="row" style="padding:0px 0px 0px 15px !important">
                        <div class="col-md-4 col-sm-8 col-xs-3 mt-1" style="padding:0 !important">
                            <input type="text" name="user" class="form-control" required placeholder="Search User Here ... ">
                        </div><!-- col-4 -->

                        <div class="col-md-8 col-sm-4 col-xs-9 mt-1" style="padding:0 !important">
                            <input type="submit" name="submit" value="Search" class="btn btn-search btn-sm ">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row row-sm pl-3 pr-3">
            <span>
                <?php

                if (isset($_SESSION['success_msg'])) {
                    echo "<h6 class='pl-1 pb-2 text-success'>" . htmlentities($_SESSION['success_msg']) . "</h6>";
                    echo htmlentities($_SESSION['success_msg'] = "");
                };

                if (isset($_SESSION['error_msg'])) {
                    echo "<h6 class='pl-1 pb-2 text-danger'>" . htmlentities($_SESSION['error_msg']) . "</h6>";
                    echo htmlentities($_SESSION['error_msg'] = "");
                };

                ?>
            </span>

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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $sr = 1;

                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>

                                <tr>
                                    <th scope="row"><?php echo $sr ?></th>
                                    <td><?php echo ucfirst($row['name']); ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td>
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
                                <h3 class='pt-5' style='color:#343a40'>No Users Exist !</h3>
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