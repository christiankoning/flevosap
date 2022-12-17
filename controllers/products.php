<?php

require 'models/Category.php';
if (isset($_POST['addToCart'])  && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['amount']) && isset($_POST['price']) && isset($_POST['image']) && isset($_POST['stock'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $stock = $_POST['stock'];

    $CART->create($id, $name, $desc, $amount, $price, $image, $stock);
}

if (!isset($_POST['categoryId']))
{
    return header('location: '.Request::buildUri( '/categorie'));
}

$categoryId = $_POST['categoryId'];
$CATEGORIES = new Category($database);
$category = $CATEGORIES->showOne($categoryId);

$PRODUCTS = new Product($database);

//get all the categories
if ($stmt = $PRODUCTS->showAllFromCategory($categoryId)) {
//check if there are categories
    if (sizeof($stmt) > 0 && !empty($PRODUCTS->showAllFromCategory($categoryId)['msg'])) {
        $products = $PRODUCTS->showAllFromCategory($categoryId)['msg'];
        $noProducts = false;
    } else {
        $noProducts = true;
    }
}
if (isset($_POST['orderBy'])) {
    if ('ASC' === $_POST['orderBy']) {
        $products = $PRODUCTS->orderByName($categoryId, $_POST['orderBy']);
    } elseif ('DESC' === $_POST['orderBy']) {
        $products = $PRODUCTS->orderByName($categoryId, $_POST['orderBy']);
    } elseif ('priceHigh' === $_POST['orderBy']) {
        $products = $PRODUCTS->orderByPrice($categoryId, $_POST['orderBy']);
    } elseif ('priceLow' === $_POST['orderBy']) {
        $products = $PRODUCTS->orderByPrice($categoryId, $_POST['orderBy']);
    }
}

require 'views/products.view.php';