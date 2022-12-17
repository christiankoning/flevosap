<?php

class User
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
    public function show()
    {

    }

    //Show one user
    public function showOne($id)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM User WHERE id = ?', [$id]);
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