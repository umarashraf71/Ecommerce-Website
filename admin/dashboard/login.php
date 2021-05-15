
<?php

    include('../includes/connection.php');
    include('../includes/functions.php');

    if(isset($_POST['submit'])) {

      $username = get_safe_value($con, $_POST['username']);
      $password = get_safe_value($con, $_POST['password']);

      $query = "select * from admin_users where username = '$username' and password = '$password'";
      $result = mysqli_query($con, $query);
      $count = mysqli_num_rows($result);
      
      if($count > 0) {
        
        $row = mysqli_fetch_array($result);
        $username = $row['username'];

        $_SESSION['admin_login'] = 'yes';
        $_SESSION['admin_username'] = $username;

        header('location:index.php');
      }
      else {

        $msg = "Invalid Login Details !";
        $_SESSION['error_msg'] = $msg;
      }

    }

?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../assets/css/login.css">

	</head>
	<body class="img js-fullheight" style="background-image: linear-gradient(rgba(33, 2, 83, 0.9), rgba(34, 27, 44, 0.9)), url(../assets/img/bg1.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap text-center">
					<h2 class="heading-section">LOGIN</h2>

                    <span style="color:red;" >
                <?php 

                        if(isset($_SESSION['error_msg']))
                        {
                            echo htmlentities( $_SESSION['error_msg'] ); 
                            echo htmlentities( $_SESSION['error_msg'] = "" );
                        };

                ?>
                    </span>
                    
		      	<form action="" method="post"  class="signin-form pt-3">
		      		<div class="form-group">
		      			<input type="text" class="form-control" name="username" placeholder="Username" required>
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" name="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>

	            <div class="form-group">
	            	<input type="submit" name="submit" value="Login" class="form-control btn btn-primary submit px-3" />
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-100 text-center mt-2">
                        Dont Have Account ? <a href="#" style="color: #fff">Sign Up</a>
                    </div>
                </div>   
                <div class="form-group d-md-flex" style="margin-top:-15px !important;">
                    <div class="w-100 text-center">
                        <a href="#" style="color: #fff">Forgot Password !</a>
                    </div>
                </div>   
	          </form>

	          <!-- <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
	          	<a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
	          </div> -->
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/popper.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/main.js"></script>

	</body>
</html>

