<!-- //////////( HEADER )////////// -->
<?php include('../includes/header.php') ?>

<?php


if (isset($_GET['editId']) && $_GET['editId'] != '') {

  $edit_id = get_safe_value($con, $_GET['editId']);

  $query2 = "select * from product where id = '$edit_id'";
  $result2 = mysqli_query($con, $query2);

  $count2 = mysqli_num_rows($result2);

  if ($count2 > 0) {
    $row2 = mysqli_fetch_assoc($result2);
  } else {

    header('location:view-edit-product.php');
    die();
  }
}

$query = "select * from categories ";
$result = mysqli_query($con, $query);

if ($result) {
  $count = mysqli_num_rows($result);
}


if (isset($_POST['submit'])) {

  $p_name = ucfirst(get_safe_value($con, $_POST['pname']));
  $p_category = get_safe_value($con, $_POST['pcategory']);
  $p_retail_price = get_safe_value($con, $_POST['pRetailPrice']);
  $p_sale_price = get_safe_value($con, $_POST['pSalePrice']);
  $p_quantity = get_safe_value($con, $_POST['pQuantity']);
  $p_meta_title = get_safe_value($con, $_POST['pMetaTitle']);
  $p_meta_keyword = get_safe_value($con, $_POST['pMetaKeyword']);
  $p_meta_desc = get_safe_value($con, $_POST['pMetaDesc']);
  $p_short_desc = ucfirst(get_safe_value($con, $_POST['pShortDesc']));
  $p_long_desc = ucfirst(get_safe_value($con, $_POST['pLongDesc']));
  $p_status = 1;

  //storing image name in database and image uploads folder
  $file = $_FILES['file']['name']; //file name to save in database

  // $query0 = "select * from product where name = '$p_name'";
  // $result0 = mysqli_query($con, $query0);

  // if($result0)
  // {
  //   $count0 = mysqli_num_rows($result0);
  // }

  // if($count0 > 0)
  // {
  //   $msg = "Product Name Already Exists !";
  //   $_SESSION['error_msg'] = $msg;

  //   // header("refresh: 2; url=edit-categories.php?editId='$edit_id'");
  // }
  // if($count0 == 0)
  // {

  if ($file === "") {
    $query1 = "update product set categories_id = '$p_category', name='$p_name', mrp='$p_retail_price', price='$p_sale_price', quantity='$p_quantity', short_desc='$p_short_desc', description='$p_long_desc', meta_title='$p_meta_title', meta_description='$p_meta_desc', meta_keyword='$p_meta_keyword' where id = '$edit_id'";
    $result1 = mysqli_query($con, $query1);

    if ($result1) {
      $msg = "Product Updated Successfully !";
      $_SESSION['success_msg'] = $msg;

      header("location:view-edit-product.php");
    }
  } else {

    if ($_FILES['file']['type'] !== 'image/png' && $_FILES['file']['type'] !== 'image/jpg' && $_FILES['file']['type'] !== 'image/jpeg') {
      $msg = "Only jpg, png and jpeg Image Formats are allowed !";
      $_SESSION['error_msg'] = $msg;
    } else {

      $file = rand(1111111111, 9999999999) . '_' . $_FILES['file']['name'];

      $tmp_name = $_FILES['file']['tmp_name'];
      $path = "../../uploads/" . $file;
      move_uploaded_file($tmp_name, $path);

      $query1 = "update product set categories_id = '$p_category', name='$p_name', mrp='$p_retail_price', price='$p_sale_price', quantity='$p_quantity', image='$file', short_desc='$p_short_desc', description='$p_long_desc', meta_title='$p_meta_title', meta_description='$p_meta_desc', meta_keyword='$p_meta_keyword' where id = '$edit_id'";
      $result1 = mysqli_query($con, $query1);

      if ($result1) {
        $msg = "Product Updated Successfully !";
        $_SESSION['success_msg'] = $msg;

        header("location:view-edit-product.php");
      }
    }
  }


  //        }

}


?>


<title>Admin | Edit Product</title>


<!-- //////////( SIDE-BAR )////////// -->
<?php include('../includes/sidebar.php') ?>



<!-- //////////( TOP-BAR )////////// -->
<?php include('../includes/topbar.php') ?>



<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
  <div class="br-pagetitle">
    <i class="icon ion-ios-list-outline"></i>
    <div>
      <h4>Edit Product</h4>
      <p class="mg-b-0">You can edit product details here </p>
    </div>
  </div>

  <div class="br-pagebody" style="margin-top: -50px !important;">

    <div class="row p-2">
      <div class="col-md-12">

        <h6 class="br-section-label">Edit the form with product details</h6>

        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-layout form-layout-2">

            <?php if (!empty($_SESSION['error_msg'])) { ?>
              <span>
                <?php
                if (isset($_SESSION['error_msg'])) {
                  echo "<h6 id = 'message' class='pl-1 pb-3 text-danger'>" . htmlentities($_SESSION['error_msg']) . "</h6>";
                  echo htmlentities($_SESSION['error_msg'] = "");
                };

                ?>
              </span>
            <?php } ?>

            <div class="row no-gutters">

              <div class="col-md-12">
                <div class="d-flex justify-content-center align-items-center mt-2 mb-4">
                  <img src="../../uploads/<?php echo $row2['image']; ?>" id="myImg" class="shadow-lg mb-2 bg-white rounded border-secondary" alt="" onerror='$(this).hide();'>
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pname" value="<?php echo $row2['name'] ?>" placeholder="Enter Product Name" required>
                </div>
              </div>

              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label mg-b-0-force">Product Category: <span class="tx-danger">*</span></label>
                  <select id="select2-a" class="form-control" data-placeholder="Choose category" name="pcategory" required>
                    <option value="">Choose Category</option>

                    <?php if ($count > 0) {

                      while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <?php if ($row['status'] == 0) { ?>

                          <option value="<?php echo $row['id']; ?>" <?php if ($row2['categories_id'] == $row['id']) echo 'selected="selected"'; ?>><?php echo $row['categories']; ?> (Currently Disabled)</option>

                        <?php } else { ?>

                          <option value="<?php echo $row['id']; ?>" <?php if ($row2['categories_id'] == $row['id']) echo 'selected="selected"'; ?>><?php echo $row['categories']; ?></option>

                        <?php } ?>

                    <?php
                      }
                    }
                    ?>

                  </select>
                </div>
              </div>

              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">Retail Price: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pRetailPrice" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $row2['mrp'] ?>" placeholder="Enter Product Retail Price" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force ">
                  <label class="form-control-label">Sale Price: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pSalePrice" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $row2['price'] ?>" placeholder="Enter Product Sale Price" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="number" name="pQuantity" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $row2['quantity'] ?>" placeholder="Enter Product Quantity" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Meta Title: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pMetaTitle" value="<?php echo $row2['meta_title'] ?>" placeholder="Enter Product Meta Title" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force ">
                  <label class="form-control-label">Meta Keyword: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pMetaKeyword" value="<?php echo $row2['meta_keyword'] ?>" placeholder="Enter Product Meta Keyword" required>
                </div>
              </div>


              <div class="col-md-8">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Meta Description: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pMetaDesc" value="<?php echo $row2['meta_description'] ?>" placeholder="Enter Product Meta Description" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force ">
                  <label class="form-control-label">Short Description: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="text" name="pShortDesc" value="" placeholder="Enter Product Short Description" required> -->
                  <textarea class="form-control" name="pShortDesc" cols="30" rows="5" placeholder="Enter Product Short Description" required><?php echo $row2['short_desc'] ?></textarea>
                </div>
              </div>

              <div class="col-md-8">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Long Description: <span class="tx-danger">*</span></label>
                  <textarea class="form-control" name="pLongDesc" cols="30" rows="5" placeholder="Enter Product Long Description" required><?php echo $row2['description'] ?></textarea>
                </div>
              </div>

              <div class="col-md-12 bd-t-0-force">
                <div class="form-group bd-t-0-force">
                  <label class="fileLabel" for="test">
                    <div class="fileclick">Click or drop Image here to upload !</div>
                    <input type="file" name="file" id="file" id="test">
                  </label>
                </div>
              </div><!-- col-12 -->

            </div><!-- row -->

            <div class="form-layout-footer bd pd-20 bd-t-0">

              <!-- <label class="form-control-label">Upload Image: <span class="tx-danger">*</span></label>
              
              <input type="file" name="file" id="file"  required> <br> -->
              <input type="submit" name="submit" value="submit" class="btn btn-search ">

            </div><!-- form-group -->
          </div><!-- form-layout -->

        </form>

      </div>
    </div>




  </div><!-- br-pagebody -->

</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->



<!-- //////////( FOOTER )////////// -->
<?php include('../includes/footer.php') ?>