<?php
require 'models/Order.php';
require 'models/OrderedProduct.php';

$email = isset($_SESSION['sentEmail']) ? $_SESSION['sentEmail'] : '';
$orderConfirmed = isset($_SESSION['orderConfirmed']) ? $_SESSION['orderConfirmed'] : '';
if (isset($_POST['orderConfirmed']) || !empty($orderConfirmed)) {
    //check if there is post data specific for the order
    if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['postalCode']) && isset($_POST['houseNumber']) && isset($_POST['streetName']) && isset($_POST['residence']) && isset($_POST['insertion']) && isset($_POST['tel']) && isset($_POST['addition'])) {
        $_SESSION['sentEmail'] = $_POST['email'];
        $_SESSION['orderConfirmed'] = $_POST['orderConfirmed'];
        $ORDER = $CART->showCart();
        //create new order
        $ORDERS = new Order($database);
        //set the userId to null (default)
        $userId = null;

        //bind the post variables
        $firstName = $_POST['firstName'];
        $insertion = $_POST['insertion'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $postalCode = $_POST['postalCode'];
        $houseNumber = $_POST['houseNumber'];
        $addition = $_POST['addition'];
        $streetName = $_POST['streetName'];
        $residence = $_POST['residence'];

        //check if user is logged in
        if (Auth::isLoggedIn()) {
            //set the user id to the id of the logged in user
            $userId = $_SESSION['id'];
        }
        //add data to order
        $ORDERS->create($userId, $firstName, $insertion, $lastName, $email, $tel, $postalCode, $houseNumber, $addition, $streetName, $residence);

        //get latest order (should be the order created above)
        $LATESTORDER = $ORDERS->showLatest();

        //loop through the shopping cart and get the products in it
        foreach ($ORDER as $item) {
            //get data required for the ordered product
            $orderId = $LATESTORDER['id'];
            $productId = $item['id'];
            $quantity = $item['amount'];
            $ORDEREDPRODUCT = new OrderedProduct($database);
            $ORDEREDPRODUCT->create($orderId, $productId, $quantity);

            $PRODUCT = new Product($database);
            $product = $PRODUCT->showOne($productId);
            $stock = $product['stock'];
            $product = $PRODUCT->editStock((float)$stock - (float)$quantity, $productId);

        }
        //if all the ordered products are added to the database reset the shopping cart
        $CART->clearCart();

        //prevents Post from sending again (Post/Redirect/Get Principle)
        header('Location: '.Request::buildUri( '/betalen/succes'));
    }
} else {
    die('401 error: Unauthorized access');
}

require 'views/orderSuccess.view.php';

