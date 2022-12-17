<?php

require 'models/Category.php';

$PRODUCTS = new Product($database);
$CATEGORIES = new Category($database);

//check if there are products
if($stmt = $PRODUCTS->showAll()) {
    if (sizeof($stmt) > 0) {
        //if there are products return false
        $noProducts = false;
    }
    else{
        //if there are no products return true
        $noProducts = true;
    }
}
if(isset($_POST['productStatus']))
{
    try {
        // Check if productStatus has the correct value
        if($_POST['productStatus'] === "delete")
        {
            if(isset($_POST['confirmDelete']))
            {
                try {
                    // Check if productId exists
                    if (!empty($_POST['id'])) {

                        if($_POST['confirmDelete'] === "1")
                        {
                            //execute query
                            $PRODUCTS->destroyNutrition($_POST['id']);
                            $PRODUCTS->destroy($_POST['id']);
                            return header('location: '.Request::buildUri( '/admin/producten'));
                        } else {
                            return header('location: '.Request::buildUri( '/admin/producten'));
                        }
                    }
                }
                catch (Exception $exception)
                {
                    die(var_dump($exception->getMessage()));
                }
            }
        }
    }
    catch (Exception $exception)
    {
        die(var_dump($exception->getMessage()));
    }
}

require("views/admin/viewProducts.view.php");