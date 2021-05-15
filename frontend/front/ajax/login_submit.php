<?php

include('../../includes/connection.php');
include('../../includes/functions.php');
date_default_timezone_set("Asia/Karachi");

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = get_safe_value($con, $_POST['email']);
    $password = get_safe_value($con, $_POST['password']);
    $date = date('Y-m-d h:i:s');

    $query = "select * from users where email = '$email' and password = '$password'";
    $result = mysqli_query($con, $query);

    if ($result) {

        $count = mysqli_num_rows($result);
    }

    if ($count > 0) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['USER_LOGIN'] = 'yes';
        $_SESSION['USER_ID'] = $row['id'];
        $_SESSION['USER_NAME'] = $row['name'];

        echo "success";
    } else {

        echo "error";
    }
}

?>