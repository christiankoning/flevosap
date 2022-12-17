<?php

//get connection to database
$PRODUCTS = new Product($database);

//get all the featured products
if ($stmt = $PRODUCTS->showFeaturedProducts()) {
    //check if the size is bigger than 0 and if the message parameter is not empty
    if (sizeof($stmt) > 0 && !empty($PRODUCTS->showFeaturedProducts()['msg'])) {
        //if there are featured products return false
        $noFeaturedProducts = false;
        //bind a variable to the array
        $featuredProducts = $PRODUCTS->showFeaturedProducts()['msg'];

    } else {
        //if there are no featured products return true
        $noFeaturedProducts= true;

    }
}

require("views/home.view.php");
