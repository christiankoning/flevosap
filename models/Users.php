<?php

class Users
{

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //CREATE
    //Creates a user in the database
    public function create($email, $pwd, $type)
    {
        try {
            //executes the query
            $query = $this->conn->query('INSERT INTO User SET email=?, password=?, type=?, active=0, createdAt = NOW(), updatedAt = NOW()', [$email, $pwd, $type]);
            return $query;
        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //READ
    //Gets a specific user from the database by id
    public function showOne($user)
    {
        try {
            //executes the search query

            if (!empty($user['id'])) {
                $query = $this->conn->query('SELECT * FROM User WHERE id = ?', [$user['id']]);
                //returns the search query
                return $query;
            } elseif (!empty($user['email'])) {
                $query = $this->conn->query('SELECT * FROM User WHERE email = ?', [$user['email']]);
                //returns the search query
                return $query;
            }

        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //UPDATE
    //Updates user data in database by userId
    public function updateEmail($user) {
        try {

            if (!empty($user['id'])) {
                $query = $this->conn->query('UPDATE User SET
                    email=?, 
                    updatedAt = NOW()
                    WHERE id = ?',
                    [
                        $user['email'],
                        $user['id']
                    ]);
                //returns the update query
                return $query;
            }

        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //UPDATE
    //Updates user data in database by userId
    public function updatePassword($user) {
        try {

            if (!empty($user['id'])) {
                $query = $this->conn->query('UPDATE User SET
                    password=?, 
                    updatedAt = NOW()
                    WHERE id = ?',
                    [
                        $user['password'],
                        $user['id']
                    ]);
                //returns the update query
                return $query;
            }

        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //UPDATE
    //activate the users account
    public function activate($id)
    {
        try {
            //executes the update query
            $query = $this->conn->query('UPDATE User SET active = ?, updatedAt = NOW() WHERE id = ?', [true, $id]);
        } //catches an exception
        catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }


}
