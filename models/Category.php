<?php

class Category
{

    protected $conn;

    //constructor
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //CREATE
    public function create($name)
    {
        try{
            //executes the query
            $query = $this->conn->query('INSERT INTO Categories SET name = ?, createdAt = NOW(), updatedAt = NOW()', [$name]);
        }
        catch (Exception $exception)
        {
            //return exception message
            die(var_dump($exception->getMessage()));
        }

    }

    //READ
    public function showAll()
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Categories');
            //returns the search query
            return $query['msg'];
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    public function showOne($categoryId)
    {
        try {
            //executes the search query
            $query = $this->conn->query('SELECT * FROM Categories WHERE id = ?', [$categoryId]);
            //returns the search query
            return $query['msg'][0];
            //catches an exception
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //UPDATE
    public function edit($name, $id)
    {
        try {
            //executes the update query
            $query = $this->conn->query('UPDATE Categories SET name = ?,  updatedAt = NOW() WHERE id = ?', [$name, $id]);
        }
            //catches an exception
        catch (Exception $exception)
        {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //DELETE
    public function destroy($categoryId)
    {
        try {
            //executes the update query
            $query = $this->conn->query('DELETE FROM Categories WHERE id = ?', [$categoryId]);
        }
            //catches an exception
        catch (Exception $exception)
        {
            //return exception message
            die(var_dump($exception->getMessage()));
        }

    }

}