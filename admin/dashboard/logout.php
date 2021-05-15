<?php

    session_destroy();
    session_unset();

    session_start();
    $_SESSION['admin_username'] = "";
    $_SESSION['admin_login'] = "";

    header("location:login.php");
?>