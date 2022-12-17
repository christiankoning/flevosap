<?php

ini_set("display_errors", "1");

$prefix = "";

session_set_cookie_params(60*30, "/".$prefix);

session_start();

require "core/bootstrap.php";
$CART = new ShoppingCart();

$database = new db_connection();
$router = new Routes();

require 'routes.php';

require $router->direct(
    Request::uri()
);
