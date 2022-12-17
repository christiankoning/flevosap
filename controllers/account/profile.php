<?php

require 'models/Order.php';
require 'models/OrderedProduct.php';

function getOrders($id) {
    global $database;
    global $btw;

    $ORDER = new Order($database);
    $orders = $ORDER->showByUserId($id);

    if (!empty($orders['msg'])) {
        $ORDEREDPRODUCTS = new OrderedProduct($database);
        foreach ($orders['msg'] as $key => $order) {

            $orders['msg'][$key]['order_date'] = date("d-m-Y", strtotime($order['order_date']));

            if ($order['status'] === 'busy') {
                $orders['msg'][$key]['status'] = '<span class="badge bg-danger">In behandeling</span>';
            }
            else if ($order['status'] === 'send') {
                $orders['msg'][$key]['status'] = '<span class="badge bg-warning">Verstuurd</span>';
            }
            else if ($order['status'] === 'done') {
                $orders['msg'][$key]['status'] = '<span class="badge bg-success">Bezorgd</span>';
            }

            $total = 0;
            $products = $ORDEREDPRODUCTS->showByOrderId($order['id']);
            if (!empty($products['msg'])) {
                $orders['msg'][$key]['products'] = $products['msg'];
                $PRODUCTS = new Product($database);
                foreach ($products['msg'] as $key2 => $product) {
                    $productDetails = $PRODUCTS->safeShowOne($product['productId']);
                    if (!empty($productDetails['msg'])) {
                        $orders['msg'][$key]['products'][$key2]['productDetails'] = $productDetails['msg'];
                        $orders['msg'][$key]['products'][$key2]['productTotal'] = number_format((float)$productDetails['msg'][0]['price'] * (float)$product['quantity'], 2, '.', '');
                        $total = $total + (float)$productDetails['msg'][0]['price'] * (float)$product['quantity'];
                    }
                }
                $orders['msg'][$key]['subtotal'] = number_format($total, 2, '.', '');
                $orders['msg'][$key]['total'] = number_format($total * $btw, 2, '.', '');
            }
        }
    }

    return $orders;
}

if (empty($_SESSION['id'])) {
    header('location: '.Request::buildUri( '/login'));
}

$id = $_SESSION['id'];

$user['id'] = $id;

$USER = new Users($database);
$user = $USER->showOne($user);

if (empty($user['msg'])) {
    header('location: '.Request::buildUri( '/login'));
}

$user = $user['msg'][0];

if ($user['type'] === '1') {

    $customer['userId'] = $id;

    $CUSTOMER = new Customer($database);
    $customer = $CUSTOMER->showOne($customer)['msg'][0];

    $btw = 1.21;
    $btwDisplay = '21%';

    $orders = getOrders($id);

}
if ($user['type'] === '2') {

    $customer['userId'] = $id;

    $CUSTOMER = new CommercialCustomer($database);
    $customer = $CUSTOMER->showOne($customer)['msg'][0];

    $btw = 1;
    $btwDisplay = '0%';

    $orders = getOrders($id);
}

require("views/account/profile.view.php");