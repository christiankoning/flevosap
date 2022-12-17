<?php

require 'models/Category.php';

//check if there are categories
$CATEGORIES = new Category($database);


//get all the categories
if ($stmt = $CATEGORIES->showAll()) {
//check if there are categories
    if (sizeof($stmt) > 0 && !empty($CATEGORIES->showAll())) {
        $categories = $CATEGORIES->showAll();
        $noCategories = false;
    } else {
        $noCategories = true;
    }
}
require("views/categories.view.php");