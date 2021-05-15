<!-- //////////( HEADER )////////// -->
<?php include('../includes/header.php') ?>


<?php


$query = "select * from categories where status = 1 ";
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

  $file = $_FILES['file']['name'];

  $query0 = "select * from product where name = '$p_name'";
  $result0 = mysqli_query($con, $query0);

  if ($result0) {
    $count0 = mysqli_num_rows($result0);
  }

  if ($count0 > 0) {
    $msg = "Product Name Already Exists !";
    $_SESSION['error_msg'] = $msg;

    // header("refresh: 2; url=edit-categories.php?editId='$edit_id'");
  }
  if ($count0 == 0) {

    if ($_FILES['file']['type'] !== 'image/png' && $_FILES['file']['type'] !== 'image/jpg' && $_FILES['file']['type'] !== 'image/jpeg') {
      $msg = "Only jpg, png and jpeg Image Formats are allowed !";
      $_SESSION['error_msg'] = $msg;
    } else {

      $file = rand(1111111111, 9999999999) . '_' . $_FILES['file']['name']; //file name to save in database

      $tmp_name = $_FILES['file']['tmp_name'];
      $path = "../../uploads/" . $file;
      move_uploaded_file($tmp_name, $path);

      $query1 = "insert into product (categories_id, name, mrp, price, quantity, image, short_desc, description, meta_title, meta_description, meta_keyword, status) values ('$p_category', '$p_name', '$p_retail_price', '$p_sale_price', '$p_quantity', '$file', '$p_short_desc', '$p_long_desc', '$p_meta_title', '$p_meta_desc', '$p_meta_keyword', '$p_status')";
      $result1 = mysqli_query($con, $query1);

      if ($query1) {
        $msg = "Product Added Successfully !";
        $_SESSION['success_msg'] = $msg;

        header("location:view-edit-product.php");
      }
    }
  }
}


?>


<style>
  input[type="file"] {
    position: absolute;
    left: 0;
    opacity: 0;
    top: 0;
    bottom: 0;
    width: 100%;
    cursor: pointer !important;
  }

  .fileclick {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #d3d8de;
    border: 2px dotted #9aa3ad;
    border-radius: 0px;
    color: #6c757d;
    font-weight: 500;
    cursor: pointer !important;
  }

  .fileLabel {

    height: 60px;
    width: 100%;
    cursor: pointer !important;
  }

  .fileclick.dragover {
    background-color: #c9cfd6;
  }
</style>



<title>Admin | Add Product</title>


<!-- //////////( SIDE-BAR )////////// -->
<?php include('../includes/sidebar.php') ?>



<!-- //////////( TOP-BAR )////////// -->
<?php include('../includes/topbar.php') ?>



<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
  <div class="br-pagetitle">
    <i class="icon ion-ios-list-outline"></i>
    <div>
      <h4>Add Product</h4>
      <p class="mg-b-0">You can add product details here </p>
    </div>
  </div>

  <div class="br-pagebody" style="margin-top: -50px !important;">

    <div class="row p-2">
      <div class="col-md-12">

        <h6 class="br-section-label">Fill in the form with product details</h6>

        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-layout form-layout-2">

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

            <div class="row no-gutters">

              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pname" value="" placeholder="Enter Product Name" required>
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

                        <option value="<?php echo $row['id']; ?>"><?php echo $row['categories']; ?></option>

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
                  <input class="form-control" type="text" name="pRetailPrice" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="" placeholder="Enter Product Retail Price" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force ">
                  <label class="form-control-label">Sale Price: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pSalePrice" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="" placeholder="Enter Product Sale Price" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="number" name="pQuantity" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="" placeholder="Enter Product Quantity" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Meta Title: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pMetaTitle" value="" placeholder="Enter Product Meta Title" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force ">
                  <label class="form-control-label">Meta Keyword: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pMetaKeyword" value="" placeholder="Enter Product Meta Keyword" required>
                </div>
              </div>


              <div class="col-md-8">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Meta Description: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="pMetaDesc" value="" placeholder="Enter Product Meta Description" required>
                </div>
              </div>

              <div class="col-md-4 ">
                <div class="form-group bd-t-0-force ">
                  <label class="form-control-label">Short Description: <span class="tx-danger">*</span></label>
                  <!-- <input class="form-control" type="text" name="pShortDesc" value="" placeholder="Enter Product Short Description" required> -->
                  <textarea class="form-control" name="pShortDesc" id="" cols="30" rows="5" placeholder="Enter Product Short Description" required></textarea>
                </div>
              </div>

              <div class="col-md-8">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Long Description: <span class="tx-danger">*</span></label>
                  <textarea class="form-control" name="pLongDesc" id="" cols="30" rows="5" placeholder="Enter Product Long Description" required></textarea>
                </div>
              </div>

              <div class="col-md-12 bd-t-0-force">
                <div class="form-group bd-t-0-force">
                  <label class="fileLabel" for="test">
                    <div class="fileclick">Click or drop Image here to upload !</div>
                    <input type="file" name="file" id="file" id="test" required>
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

<script>
  setTimeout(function() {
    $('#message').fadeOut('fast');
  }, 2500); // <-- time in milliseconds


  var fileInput = document.querySelector('input[type=file]');
  var filenameContainer = document.querySelector('.fileclick');
  var dropzone = document.querySelector('.fileclick');

  fileInput.addEventListener('change', function() {
    filenameContainer.innerText = fileInput.value.split('\\').pop();
  });

  fileInput.addEventListener('dragenter', function() {
    dropzone.classList.add('dragover');
  });

  fileInput.addEventListener('dragleave', function() {
    dropzone.classList.remove('dragover');
  });
</script>