<?php

if (isset($_POST['addToCart'])  && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['amount']) && isset($_POST['price']) && isset($_POST['image']) &&isset($_POST['stock'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $stock = $_POST['stock'];

    $CART->create($id, $name, $desc, $amount, $price, $image, $stock);

}

if (!isset($_POST['productId']))
{
    return header('location: '.Request::buildUri( '/producten'));
}

$PRODUCTS = new Product($database);
$product = $PRODUCTS->showOne($_POST['productId']);
$nutrition = $PRODUCTS->showNutrition($_POST['productId']);

require 'views/product.detail.view.php';