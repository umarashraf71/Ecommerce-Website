<?php

include('../../includes/connection.php');
include('../../includes/functions.php');
date_default_timezone_set("Asia/Karachi");

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['message'])) {

    $name = get_safe_value($con, $_POST['name']);
    $email = get_safe_value($con, $_POST['email']);
    $mobile = get_safe_value($con, $_POST['mobile']);
    $comment = get_safe_value($con, $_POST['message']);
    $date = date('Y-m-d h:i:s');

    $query = "insert into contact_us (name, email, mobile, comment, date) values ('$name', '$email', '$mobile', '$comment', '$date')";
    $result = mysqli_query($con, $query);

    if($result) {

        echo "Message Sent Successfully !";
    }

}
?>