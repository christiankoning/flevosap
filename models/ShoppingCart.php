<?php

class ShoppingCart
{
    protected $cart;
    protected $size;
    protected $price;

    //constructor
    public function __construct()
    {
        //create empty array
        $this->cart = [];
        //set size to 0
        $this->size = 0;
        //set the price  to 0
        $this->price = 0;

        //check if the sessions are set
        if (!isset($_SESSION['cart']) && !isset($_SESSION['cartSize']) && !isset($_SESSION['cartPrice'])) {
            //set cart session
            $_SESSION['cart'] = $this->showCart();
            //set cart size session
            $_SESSION['cartSize'] = $this->showSize();
            //set cart price session
            $_SESSION['cartPrice'] = $this->showTotalPrice();

        }
        //set instance variables to the session data
        $this->cart = $_SESSION['cart'];
        $this->size = $_SESSION['cartSize'];
        $this->price = $_SESSION['cartPrice'];

    }

    //CREATE
    //create an item in the shopping cart
    public function create($id, $name, $desc, $amount, $price, $image, $stock)
    {
        //get the index of the item (if it does not exists it returns false)
        $index = array_search($id, array_column($this->showCart(), 'id'));
        if ($index === false) {
            //add new item to array
            array_push($this->cart, ['id' => $id, 'name' => $name, 'desc' => $desc, 'amount' => $amount, 'price' => $price, 'image' => $image, 'stock' => $stock]);
            //change the session variable to the cart instance variable
            $_SESSION['cart'] = $this->showCart();
            //store the session variable inside the cart instance variable
            $this->cart = $_SESSION['cart'];

            //change the session variable to the size instance variable + 1
            $_SESSION['cartSize'] = $this->showSize() + 1;
            //store the session variable in the size instance variable
            $this->size = $_SESSION['cartSize'];

            //change the session variable to the price instance variable
            $_SESSION['cartPrice'] = $this->showTotalPrice() + $price;
            //store the session variable in the price instance variable
            $this->size = $_SESSION['cartSize'];


        } else {
            //if the index exists set the amount to the amount stored in the session + 1
            $amount = $_SESSION['cart'][$index]['amount'] + 1;
            //update the array item
            $this->edit($id, $amount);
        }

    }


    //READ

    //show the data in the current shoppingCart (an array)
    public function showCart()
    {
        return $this->cart;
    }

    //show the size of the shoppingCart (integer)
    public function showSize()
    {
        return $this->size;
    }

    //show the total price of the shoppingCart (this is a float)
    public function showTotalPrice()
    {
        return $this->price;
    }

    //show the total price of the shoppingCart (this is a float)
    public function showTotalPriceIncl()
    {
        return $this->price * 1.21;
    }

    //UPDATE
    //update an item inside the shoppingCart
    public function edit($id, $amount)
    {
        //get the index of the item
        $index = array_search($id, array_column($this->cart, 'id'));

        //the amount of an item can never be lower than 1, set to 1 if it is lower
        if ($amount < 1) {
            $amount = 1;
        }

        $database = new db_connection();
        $PRODUCT = new Product($database);
        $product = $PRODUCT->showOne($id);

        $stock = $product['stock'];

        if ($amount > $stock) {
            $amount = $stock;
        }

        //get the price from the item
        $price = $_SESSION['cart'][$index]['price'];
        //check if the amount given is lower than the amount of the item stored in the session
        if ($amount < $_SESSION['cart'][$index]['amount']) {
            //calculate the difference between the given amount and the amount of the item stored in the session
            $diffAmount = $this->calculateDifference($_SESSION['cart'][$index]['amount'], $amount);
            //set the amount in the session to the given amount
            $_SESSION['cart'][$index]['amount'] = $amount;
            //set the size from the session to the current size minus the difference of the amount
            $_SESSION['cartSize'] = $this->showSize() - $diffAmount;
            //set the price from the session to the current price minus the difference of the price multiplied with the amount
            $_SESSION['cartPrice'] = $this->showTotalPrice() - ($price * $diffAmount);
        } else {
            //calculate the difference between the given amount and the amount of the item stored in the session
            $diffAmount = $this->calculateDifference($_SESSION['cart'][$index]['amount'], $amount);
            //set the amount in the session to the given amount
            $_SESSION['cart'][$index]['amount'] = $amount;
            //set the size from the session to the current size plus the difference of the amount
            $_SESSION['cartSize'] = $this->showSize() + $diffAmount;
            //set the price from the session to the current price plus the difference of the price multiplied with the amount
            $_SESSION['cartPrice'] = $this->showTotalPrice() + ($price * $diffAmount);
        }
        //set instance variables to the session data
        $this->size = $_SESSION['cartSize'];
        $this->cart = $_SESSION['cart'];
        $this->price = $_SESSION['cartPrice'];


    }

    //function that calculates the difference between the given amount and the amount of the item stored in the session
    private function calculateDifference($sessionAmount, $amount)
    {
        //check if the given amount is lower than the amount of the item stored in the session
        if ($amount < $sessionAmount) {
            return $sessionAmount - $amount;
        } else {
            return $amount - $sessionAmount;
        }
    }

    //DELETE
    //delete an item inside the shopping cart
    public function destroy($id)
    {
        //get the index of the item
        $index = array_search($id, array_column($this->cart, 'id'));


        //get the amount of the item stored in the session
        if (empty($_SESSION['cart'][$index])) {
            return;
        }
        $amount = $_SESSION['cart'][$index]['amount'];
        $price = $_SESSION['cart'][$index]['price'];
        //set the cartSize variable stored in the session to the size minus the amount of the item
        $_SESSION['cartSize'] = $this->showSize() - $amount;
        //set the cartPrice variable stored in the session to the price minus the price multiplied with the amount of the item
        $_SESSION['cartPrice'] = $this->showTotalPrice() - ($price * $amount);
        //remove the item from the array
        array_splice($_SESSION['cart'], $index, 1);

        //set instance variables to the session data
        $this->size = $_SESSION['cartSize'];
        $this->cart = $_SESSION['cart'];
        $this->price = $_SESSION['cartPrice'];
    }

    //Clear the shoppingCart and the session
    public function clearCart()
    {
        //clear all the session data
        $_SESSION['cart'] = [];
        $_SESSION['cartSize'] = 0;
        $_SESSION['cartPrice']=0;

        //set instance variables to the session data
        $this->size = $_SESSION['cartSize'];
        $this->cart = $_SESSION['cart'];
        $this->price = $_SESSION['cartPrice'];
    }
}
