<?php

session_start();

Define('DB_SERVER',"localhost");
Define('DB_USER',"root");
Define('DB_PASSWORD',"");
Define('DB_NAME',"ecom");

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

if(!$con)
{
    die('Connection Unsuccessfull' . mysqli_connect_error());
}

?>