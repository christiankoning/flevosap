<?php

class CommercialCustomer
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
            $query = $this->conn->query('INSERT INTO Commercial_Customer SET 
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
                kvkNumber=?,
                companyName=?,
                btwNumber=?,
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
                    $customer['kvkNumber'],
                    $customer['companyName'],
                    $customer['btwNumber']
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
                $query = $this->conn->query('SELECT * FROM Commercial_Customer WHERE id = ?', [$customer['id']]);
                //returns the search query
                return $query;
            } elseif (!empty($customer['userId'])) {
                $query = $this->conn->query('SELECT * FROM Commercial_Customer WHERE userId = ?', [$customer['userId']]);
                //returns the search query
                return $query;
            }

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
                $query = $this->conn->query('UPDATE Commercial_Customer SET
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
                    kvkNumber=?,
                    companyName=?,
                    btwNumber=?,
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
                        $customer['kvkNumber'],
                        $customer['companyName'],
                        $customer['btwNumber'],
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
