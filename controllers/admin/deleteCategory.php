<?php

require 'models/Category.php';

$CATEGORIES = new Category($database);

//check if the post variable has been set
if (isset($_POST['categoryId'])) {
    try {
        //execute query
        $category = $CATEGORIES->showOne($_POST['categoryId']);
        echo json_encode($category);

    } catch (Exception $exception)
    {
        //show exception message
        die(var_dump($exception->getMessage()));
    }
}
