
<!-- //////////( HEADER )////////// -->
<?php include('../includes/header.php') ?>


<?php

    if(isset($_GET['editId']) && $_GET['editId'] !='')
    {
        
            $edit_id = get_safe_value($con, $_GET['editId']);

            $query = "select * from categories where id = '$edit_id'";
            $result = mysqli_query($con, $query);
        
            $count = mysqli_num_rows($result);
                
            if($count > 0)
            {
                $row = mysqli_fetch_assoc($result);
                $category_name = $row['categories'];
            }
            else {
        
                header('location:categories.php');
                die();
            }
    
    }


    if(isset($_POST['submit'])) {

        $edit_cat_name = get_safe_value($con, $_POST['editcategory']);
        $capital_edit_cat_name = ucfirst($edit_cat_name);

        $query4 = "select * from categories where categories = '$edit_cat_name' || categories = '$capital_edit_cat_name'";
        $result4 = mysqli_query($con, $query4);

        if($result4)
        {
            $count1 = mysqli_num_rows($result4);
        }

        if($count1 > 0)
        {        
            $msg = "Category Name Already Exists !";
            $_SESSION['error_msg'] = $msg;

            header("refresh: 2; url=edit-categories.php?editId='$edit_id'");

        }
        else
        {

            $query1 = "update categories set categories = '$edit_cat_name' where id = '$edit_id' ";
            $result1 = mysqli_query($con, $query1);
            
            if($result1) {

                $msg = "Category Name Updated Successfully !";
                $_SESSION['success_msg'] = $msg;

                header("refresh: 2; url=categories.php");
            }
        }
    }


?>


<title>Admin | Edit Category</title>


<!-- //////////( SIDE-BAR )////////// -->
<?php include('../includes/sidebar.php') ?>

   

<!-- //////////( TOP-BAR )////////// -->
<?php include('../includes/topbar.php') ?>



    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
        <i class="icon ion-ios-color-filter-outline"></i>
        <div>
          <h4>Edit Category</h4>
          <p class="mg-b-0">You can edit category name here </p>
        </div>
      </div>

      <div class="br-pagebody" style="margin-top: 5px !important;">
        
        <div class="row mb-4 p-2">
            <div class="col-md-12">
                <form action="" method="post">

                <div class="row" style="padding:0px 0px 0px 15px !important">
                    <div class="col-md-4 col-sm-8 col-xs-3" style="padding:0 !important">
                        <input type="text" name="editcategory" value="<?php echo $category_name; ?>" class="form-control" required placeholder="Enter Category Name ... ">
                    </div><!-- col-4 -->
                    
                    <div class="col-md-8 col-sm-4 col-xs-9" style="padding:0 !important">    
                        <input type="submit" name="submit" value="Edit Category" class="btn btn-search btn-sm ">    
                    </div>
                </div>    
                </form>
            </div>
        </div>
        
        <div class="row row-sm pl-3 pr-3">
            <span>
                <?php 

                        if(isset($_SESSION['success_msg']))
                        {
                            echo "<h6 class='pl-1 pb-2 text-success'>" . htmlentities( $_SESSION['success_msg'] ) . "</h6>"; 
                            echo htmlentities( $_SESSION['success_msg'] = "" );
                        };

                        if(isset($_SESSION['error_msg']))
                        {
                            echo "<h6 class='pl-1 pb-2 text-danger'>" . htmlentities( $_SESSION['error_msg'] ) . "</h6>"; 
                            echo htmlentities( $_SESSION['error_msg'] = "" );
                        };

                ?>
            </span>

        </div><!-- row -->

    </div><!-- br-pagebody -->

</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<!-- //////////( FOOTER )////////// -->
<?php include('../includes/footer.php') ?>
