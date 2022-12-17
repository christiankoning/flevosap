<?php
require 'models/Order.php';
require 'models/OrderedProduct.php';

function getOrders($type) {
    global $database;

    $ORDER = new Order($database);
    $orders = $ORDER->showAllBySorted($type);

    if (!empty($orders['msg'])) {
        $ORDEREDPRODUCTS = new OrderedProduct($database);
        foreach ($orders['msg'] as $key => $order) {

            $btw = 1.21;
            $btwDisplay = '21%';

            if (!empty($order['userId'])) {
                $USER = new Users($database);
                $user['id'] = $order['userId'];
                $user = $USER->showOne($user);
                if (!empty($user['msg'])) {
                    if ($user['msg'][0]['type'] === '2') {
                        $btw = 1;
                        $btwDisplay = '0%';
                    }
                }
            }

            $orders['msg'][$key]['btwDisplay'] = $btwDisplay;

            $orders['msg'][$key]['order_date'] = date("d-m-Y", strtotime($order['order_date']));

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

if (!empty($_POST)) {

    if (!empty($_POST['id'])) {
        if (!empty($_POST['status'])) {
            if ($_POST['status'] === 'busy' || 'send' || 'done') {
                $ORDER = new Order($database);
                $ORDER->edit($_POST['id'], $_POST['status']);
            }
        }
    }
}

$ordersBusy = getOrders('busy');
$ordersSend = getOrders('send');
$ordersDone = getOrders('done');

require 'views/admin/viewOrders.view.php';
?>

