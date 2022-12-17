<?php

class Customer
{

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //CREATE
    //Creates a customer in the database
    public function create($customer)
    {
        try {
            //executes the query
            $query = $this->conn->query('INSERT INTO Customer SET 
                userId=?, 
                salutation=?, 
                firstName=?,
                insertion=?,
                lastName=?,
                phoneNumber=?,
                postalCode=?,
                houseNumber=?,
                houseNumberAddition=?,
                streetName=?,
                place=?,
                birthDate=?,
                createdAt = NOW(), 
                updatedAt = NOW()',
                [
                    $customer['userId'],
                    $customer['salutation'],
                    $customer['firstName'],
                    $customer['insertion'],
                    $customer['lastName'],
                    $customer['phoneNumber'],
                    $customer['postalCode'],
                    $customer['houseNumber'],
                    $customer['houseNumberAddition'],
                    $customer['streetName'],
                    $customer['place'],
                    $customer['birthDate']
                ]);
            return $query;
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //READ
    //Gets a specific customer from the database by id
    public function showOne($customer)
    {
        try {
            //executes the search query

            if (!empty($customer['id'])) {
                $query = $this->conn->query('SELECT * FROM Customer WHERE id = ?', [$customer['id']]);
                //returns the search query
                return $query;
            } elseif (!empty($customer['userId'])) {
                $query = $this->conn->query('SELECT * FROM Customer WHERE userId = ?', [$customer['userId']]);
                //returns the search query
                return $query;
            }
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //READ
    //get a customer by the userId
    public function getOneByUserId($userId)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Customer WHERE userId = ?', [$userId]);
            //returns the search query
            return $query['msg'][0];
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //UPDATE

    //Updates customer data in database by userId
    public function update($customer) {
        try {

            if (!empty($customer['userId'])) {
                $query = $this->conn->query('UPDATE Customer SET
                    salutation=?, 
                    firstName=?,
                    insertion=?,
                    lastName=?,
                    phoneNumber=?,
                    postalCode=?,
                    houseNumber=?,
                    houseNumberAddition=?,
                    streetName=?,
                    place=?,
                    birthDate=?,
                    updatedAt = NOW()
                    WHERE userId = ?',
                    [
                        $customer['salutation'],
                        $customer['firstName'],
                        $customer['insertion'],
                        $customer['lastName'],
                        $customer['phoneNumber'],
                        $customer['postalCode'],
                        $customer['houseNumber'],
                        $customer['houseNumberAddition'],
                        $customer['streetName'],
                        $customer['place'],
                        $customer['birthDate'],
                        $customer['userId']
                    ]);
                //returns the search query
                return $query;
            }

        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }
}
