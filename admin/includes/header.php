<?php

date_default_timezone_set("Asia/Karachi");

include('connection.php');

include('check_login.php');

check_login();

include('functions.php');



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- vendor css -->
  <link href="../assets/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="../assets/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
  <link href="../assets/lib/select2/css/select2.min.css" rel="stylesheet">

  <!-- Bracket CSS -->
  <link rel="stylesheet" href="../assets/css/bracket.css">
</head>

<body>

  <div id="myModal" class="modal">
    <span class="closeImage">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
  </div>