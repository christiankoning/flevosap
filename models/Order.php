<?php

class Order
{

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //CREATE
    //create an order based on the data in the form (order.view.php)
    public function create($userId, $firstName, $insertion, $lastName, $email, $phoneNumber, $postalCode, $houseNumber, $addition, $streetName, $city)
    {
        try{
            //executes the query
            $query = $this->conn->query('INSERT INTO Orders SET order_date = NOW(), shipping_date = NOW(), status = ?, userId = ?, firstName=?, insertion = ?, lastName = ?, email = ?, phoneNumber = ?, postalCode = ?, houseNumber = ?, addition = ?, streetName = ?, city = ?, createdAt = NOW(), updatedAt = NOW()', ['busy', $userId, $firstName, $insertion, $lastName, $email, $phoneNumber, $postalCode, $houseNumber, $addition, $streetName, $city]);
        }
        catch (Exception $exception)
        {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    public function showAllBySorted($sort) {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Orders WHERE status = ?', [$sort]);
            //returns the search query
            return $query;
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //READ
    public function showByUserId($id)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Orders WHERE userId = ?', [$id]);
            //returns the search query
            return $query;
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }
    //show the latest order (this might be a problem if multiple users order at the same time)
    public function showLatest()
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Orders WHERE id = (SELECT max(id) FROM Orders)');
            //returns the search query
            return $query['msg'][0];
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }
    //UPDATE
    public function edit($id, $status)
    {
        try {
            $query = $this->conn->query('UPDATE Orders SET
                    status=?, 
                    updatedAt = NOW()
                    WHERE id = ?',
                [
                    $status,
                    $id
                ]);
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }
    //DELETE
    public function destroy()
    {

    }
}