<?php

session_start();

unset($_SESSION['USER_LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
unset($_SESSION['cart']);

header('location:index.php');
die();


?>