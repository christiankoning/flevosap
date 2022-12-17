<?php

require 'models/Category.php';

$CATEGORIES = new Category($database);
if($categories = $CATEGORIES->showAll()) {
    if (sizeof($categories) > 0) {
        $noCategories = false;
    }
    else{
        $noCategories = true;
    }
}

if (!empty($_POST))
{
    try
    {
        //check if product name, price, description, product image, stock and nutritional energy, fats, saturated, carbohydrates, sugars, protein, salt are not empty
        if (isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productDesc']) && isset($_FILES['productImg']['name']) && isset($_POST['productStock']) && isset($_POST['nutritionEnergy']) && isset($_POST['nutritionFats']) && isset($_POST['nutritionSaturated']) && isset($_POST['nutritionCarbs']) && isset($_POST['nutritionSugars']) && isset($_POST['nutritionProtein']) && isset($_POST['nutritionSalt']))
        {
            $productName = $_POST['productName'];
            $productPrice = number_format($_POST['productPrice'], 2, '.', '');
            $productDesc = $_POST['productDesc'];
            $productStock = $_POST['productStock'];
            $productFeature = $_POST['isFeatured'];
            $nutritionEnergy = number_format($_POST['nutritionEnergy'], 2, '.', '');
            $nutritionFats = number_format($_POST['nutritionFats'], 2, '.', '');
            $nutritionSaturated = number_format($_POST['nutritionSaturated'], 2, '.', '');
            $nutritionCarbs = number_format($_POST['nutritionCarbs'], 2, '.', '');
            $nutritionSugars = number_format($_POST['nutritionSugars'], 2, '.', '');
            $nutritionProtein = number_format($_POST['nutritionProtein'], 2, '.', '');
            $nutritionSalt = number_format($_POST['nutritionSalt'], 2, '.', '');
            $categoryId = $_POST['categoryId'];

            $targetDir = 'public/img/uploads/';
            $fileName = basename($_FILES['productImg']['name'][0]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));

            //validate the product name
            if (!preg_match('/^[A-Za-z0-9][A-Za-z0-9\s_ -]{1,31}$/', $productName))
            {
                //show error if the product name has less than 2 characters or more than 32 characters
                $error = "Naam van het product moet tussen de 2-32 karakters bevatten!";
            }
            //validate the product description
            else if (!preg_match('/^[A-Za-z0-9][A-Za-z0-9\s\W]{1,383}$/', $productDesc))
            {
                //show error if the product description has less than 2 characters or more than 384 characters
                $error = "Omschrijving van het product moet tussen de 2-384 karakters bevatten!";
            }
            //allow certain file formats
            else if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
                //show error if the product image uploaded is not a jpg, png or jpeg
                $error = "De afbeelding die je probeert te uploaden is geen .jpg, .png of .jpeg";
            }
            //check file size
            else if ($_FILES["productImg"]["size"][0] > 1048576) {
                //show error if the product image uploaded is too large
                $error = "De afbeelding die je probeert te uploaden is te groot";
            }
            else
            {
                //check if the file does not exist
                if(!file_exists($targetFilePath))
                {
                    //check if the product image can upload
                    if (move_uploaded_file($_FILES["productImg"]["tmp_name"][0], $targetFilePath)) {
                        $PRODUCTS = new Product($database);
                        $PRODUCTS->create($productName, $productPrice, $productDesc, $fileName, $categoryId, $productFeature, $productStock);
                        $productId = $PRODUCTS->lastId();
                        $PRODUCTS->createNutrition($productId[0], $nutritionEnergy, $nutritionFats, $nutritionSaturated, $nutritionCarbs, $nutritionSugars, $nutritionProtein, $nutritionSalt);
                        return header('location: '.Request::buildUri( '/admin/producten'));
                    }
                    else {
                        //show error if the product image has not been uploaded
                        $error = "Er is een fout opgetreden bij het uploaden van je afbeelding";
                    }
                }
                // if the file already exists skip the upload
                else
                {
                    $PRODUCTS = new Product($database);
                    $PRODUCTS->create($productName, $productPrice, $productDesc, $fileName, $categoryId, $productFeature, $productStock);
                    $productId = $PRODUCTS->lastId();
                    $PRODUCTS->createNutrition($productId[0], $nutritionEnergy, $nutritionFats, $nutritionSaturated, $nutritionCarbs, $nutritionSugars, $nutritionProtein, $nutritionSalt);
                    return header('location: '.Request::buildUri( '/admin/producten'));
                }
            }
        }
        //check which input is empty
        else
        {
            if(!isset($_POST['productName']))
            {
                //show error if product name is empty
                $error = "Naam van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['productPrice']))
            {
                //show error if product description is empty
                $error = "Prijs van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['productDesc']))
            {
                //show error if product description is empty
                $error = "Omschrijving van het product mag niet leeg zijn!";
            }
            else if(!isset($_FILES['productImg']['name']))
            {
                //show error if product image is empty
                $error = "Afbeelding van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['productStock']))
            {
                //show error if product stock is empty
                $error = "Voorraad van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['nutritionEnergy']))
            {
                //show error if product's nutritional energy is empty
                $error = "Energie van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['nutritionFats']))
            {
                //show error if product's nutritional fats is empty
                $error = "Vetten van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['nutritionSaturated']))
            {
                //show error if product's nutritional saturated is empty
                $error = "Waarvan verzadigd van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['nutritionCarbs']))
            {
                //show error if product's nutritional carbohydrates is empty
                $error = "Koolhydraten van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['nutritionSugars']))
            {
                //show error if product's nutritional sugars is empty
                $error = "Suikers van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['nutritionProtein']))
            {
                //show error if product's nutritional protein is empty
                $error = "Eiwitten van het product mag niet leeg zijn!";
            }
            else if(!isset($_POST['nutritionSalt']))
            {
                //show error if product's nutritional salt is empty
                $error = "Zout van het product mag niet leeg zijn!";
            }
        }
    }
    catch (Exception $exception)
    {
        //show error message if an exception happens for debugging
        die(var_dump($exception->getMessage()));
    }
}



require("views/admin/createProducts.view.php");