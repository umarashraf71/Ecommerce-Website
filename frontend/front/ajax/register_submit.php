<?php

include('../../includes/connection.php');
include('../../includes/functions.php');
date_default_timezone_set("Asia/Karachi");

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['password'])) {

    $name = get_safe_value($con, $_POST['name']);
    $email = get_safe_value($con, $_POST['email']);
    $mobile = get_safe_value($con, $_POST['mobile']);
    $password = get_safe_value($con, $_POST['password']);
    $date = date('Y-m-d h:i:s');

    $query = "select * from users where email = '$email'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $count = mysqli_num_rows($result);
    }

    if ($count > 0) {

        echo "email_error";
    } else {


        $query1 = "insert into users (name, email, mobile, password, date) values ('$name', '$email', '$mobile', '$password', '$date')";
        $result1 = mysqli_query($con, $query1);

        if ($result1) {

            echo "success";
        }
    }
}
