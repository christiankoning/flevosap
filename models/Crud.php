<?php

class Crud
{

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function ShowUsers()
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM User');
            //returns the search query
            return $query["msg"];
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    public function createUser($email, $pwd, $isAdmin)
    {
        try {
            //executes the query
            $query = $this->conn->query('INSERT INTO User SET email=?, password=?, isAdmin=?, createdAt = NOW(), updatedAt = NOW()', [$email, $pwd, $isAdmin]);

        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //UPDATE
    public function edit($isAdmin, $id)
    {
        try {
            //executes the update query
            $query = $this->conn->query('UPDATE User SET isAdmin = ?,  updatedAt = NOW() WHERE id = ?', [$isAdmin, $id]);
        }
            //catches an exception
        catch (Exception $exception)
        {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    public function destroy($id)
    {
        try {
            //executes the update query
            $query = $this->conn->query('DELETE FROM User WHERE id = ?', [$id]);
        } //catches an exception
        catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }
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
}