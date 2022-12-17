<?php

//check if the id for the shoppingCart has been set
if (isset($_POST['id']) )
{
    $id = $_POST['id'];
    //check if the amount has changed and the amount is set
    if (isset($_POST['amountChanged']) && isset($_POST['amount'])) {
        $amount = $_POST['amount'];
        //update the shopping cart
        $CART->edit($id, $amount);
    }
    //check if the delete action has been send
    else if (isset($_POST['deleteItem']))
    {
        //delete the item from the cart
        $CART->destroy($id);
    }

    //prevents Post from sending again (Post/Redirect/Get Principle)
    header('Location: '.Request::buildUri( '/winkelwagen'));
}



$subtotalPrice = $CART->showTotalPrice();
$totalPrice = $CART->showTotalPriceIncl();
$btwDisplay = "21%";

if (!empty($_SESSION['id'])) {
    $USER = new Users($database);
    $user['id'] = $_SESSION['id'];
    $user = $USER->showOne($user)['msg'][0];
    if ($user['type'] === '2') {
        $btwDisplay = "0%";
        $totalPrice = $subtotalPrice;
    }
}

$stmt = $CART->showCart();

    if (sizeof($stmt) > 0) {
        //if there are items return false
        $noItems = false;
    }
    else{
        //if there are no items return true
        $noItems = true;
    }

require("views/shoppingCart.view.php");

