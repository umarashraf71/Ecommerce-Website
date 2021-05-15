<?php

// Functions to get the structure of any array

function pr($arr)
{

    echo "<pre>";
    print_r($arr);
}

function prx($arr)
{

    echo "<pre>";
    print_r($arr);
    die();
}

//function to escape any special characters from string
function get_safe_value($con, $string)
{

    if ($string !== '') {

        $string = trim($string);
        return mysqli_real_escape_string($con, $string);
    }
}




//FUNCTION TO GET ALL THE PRODUCTS
function get_product($con, $limit = '', $cat_id = '', $product_id = '', $search_str='', $sort_order='')
{

    $query = "select product.*, categories.categories from product inner join categories on product.categories_id = categories.id where product.status = 1 ";

    if ($cat_id != '') {

        $query .= " and product.categories_id = $cat_id ";
    }

    if ($product_id != '') {

        $query .= " and product.id = $product_id ";
    }

    if ($search_str != '') {

        $query .= " and (product.name like '%$search_str%' or product.description like '%$search_str%') ";
    }

    if($sort_order != '')
    {
        $query .= $sort_order;
    }
    else 
    {
        $query .= " order by product.id desc ";
    }

    if ($limit != '') {

        $query .= " limit $limit ";
    }

    $result = mysqli_query($con, $query);
    $data = array();

    if ($result) {

        while ($row = mysqli_fetch_assoc($result)) {

            $data[] = $row;
        }

        return $data;
    }
}
