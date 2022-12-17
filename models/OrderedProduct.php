<?php

class OrderedProduct
{

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //CREATE
    //create a new record in the database of a product that was ordered
    public function create($orderId, $productId, $quantity)
    {
        try {
            //executes the query
            $query = $this->conn->query('INSERT INTO OrderedProducts SET orderId = ?, productId=?, quantity = ?, createdAt = NOW(), updatedAt = NOW()', [$orderId, $productId, $quantity,]);
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //READ
    public function showByOrderId($id)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM OrderedProducts WHERE orderId = ?', [$id]);
            //returns the search query
            return $query;
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //UPDATE
    public function edit()
    {

    }

    //DELETE
    public function destroy()
    {

    }
}