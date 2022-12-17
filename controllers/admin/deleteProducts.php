<?php

$PRODUCTS = new Product($database);

//check if the post variable has been set
if (isset($_POST['id'])) {
    try {
        //execute query
        $product = $PRODUCTS->showOne($_POST['id']);
        echo json_encode($product);

    } catch (Exception $exception)
    {
        //show exception message
        die(var_dump($exception->getMessage()));
    }
}
