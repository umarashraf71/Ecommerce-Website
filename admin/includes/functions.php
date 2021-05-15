<?php

// Functions to get the structure of any array

function pr($arr) {

    echo "<pre>";
    print_r($arr);
}

function prx($arr) {

    echo "<pre>";
    print_r($arr);
    die();
}

//function to escape any special characters from string
function get_safe_value($con, $string) {

    if($string !== '')
    {
        
        $string = trim($string);
        return mysqli_real_escape_string($con, $string);
    }
}



?>