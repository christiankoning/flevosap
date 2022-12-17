<?php

class Commercial_Customer
{

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //CREATE
    public function create()
    {

    }

    //READ
    //get a commercial customer by the userId
    public function getOneByUserId($userId)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Commercial_Customer WHERE userId = ?', [$userId]);
            //returns the search query
            return $query['msg'][0];
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