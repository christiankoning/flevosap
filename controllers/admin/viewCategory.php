<?php

require 'models/Category.php';

$CATEGORIES = new Category($database);

//check if there are categories
if($stmt = $CATEGORIES->showAll()) {
    if (sizeof($stmt) > 0) {
        //if there are categories return false
        $noCategories = false;
    }
    else{
        //if there are no categories return true
        $noCategories = true;

    }

}
//Check if categoryStatus exists
if(isset($_POST['categoryStatus']))
{
    try {
        // Check if categoryStatus has the correct value
        if($_POST['categoryStatus'] === "create")
        {
            // Check if categoryName is not empty
            if(!empty($_POST['categoryName']))
            {
                //execute query
                $CATEGORIES->create($_POST['categoryName']);
                return header('location: '.Request::buildUri( '/admin/categorieen'));
            } else {
                $error = "Categorie naam mag niet leeg zijn!";
            }
        }
        // Check if categoryStatus has the correct value
        else if($_POST['categoryStatus'] === "edit")
        {
            // Check if categoryId exists
            if(isset($_POST['categoryId']))
            {
                try {
                    // Check if categoryName is not empty
                    if(!empty($_POST['categoryName']))
                    {
                        //execute query
                        $CATEGORIES->edit($_POST['categoryName'], $_POST['categoryId']);
                        return header('location: '.Request::buildUri( '/admin/categorieen'));
                    }
                    // if categoryName is empty throw error
                    else
                    {
                        $error = "Categorie naam mag niet leeg zijn!";
                    }
                } catch (Exception $exception)
                {
                    //show exception message
                    die(var_dump($exception->getMessage()));
                }
            }
        }
        // Check if categoryStatus has the correct value
        else if($_POST['categoryStatus'] === "delete")
        {
            if(isset($_POST['confirmDelete']))
            {
                try {
                    // Check if categoryId exists
                    if (!empty($_POST['categoryId'])) {

                        if($_POST['confirmDelete'] === "1")
                        {
                            //execute query
                            $CATEGORIES->destroy($_POST['categoryId']);
                            return header('location: '.Request::buildUri( '/admin/categorieen'));
                        } else {
                            return header('location: '.Request::buildUri( '/admin/categorieen'));
                        }
                    }
                } catch (Exception $exception)
                {
                    die(var_dump($exception->getMessage()));
                }
            }
        }
    } catch (Exception $exception)
    {
        //show exception message
        die(var_dump($exception->getMessage()));

    }

}

require("views/admin/categories.view.php");
