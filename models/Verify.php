<?php

class Verify
{
    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //CREATE
    //Creates a verify code in the database
    public function create($userId, $code, $type)
    {
        try {
            //executes the query
            $query = $this->conn->query('INSERT INTO Verify SET userId = ?, verifyCode = ?, type = ?, createdAt = NOW(), updatedAt = NOW()', [$userId, $code, $type]);

        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //UPDATE
    //Updates a verify code in the database
    public function edit($id, $code, $type) {
        try {
            //executes the query
            $query = $this->conn->query('UPDATE Verify SET verifyCode = ?, type = ?, updatedAt = NOW() WHERE id = ?', [$code, $type, $id]);

        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //READ
    //Gets a verify code from the database
    public function show($email) {
        try {
            //executes the query
            $query = $this->conn->query('SELECT Verify.verifyCode, Verify.userId, Verify.id, Verify.type FROM Verify LEFT JOIN User ON User.id=Verify.userId WHERE email = ? ', [$email]);

            return $query;

        } catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

    //DELETE
    //Deletes a verifycode from the database
    public function destroy($id)
    {
        try {
            //executes the update query
            $query = $this->conn->query('DELETE FROM Verify WHERE id = ?', [$id]);
            return $query;
        } //catches an exception
        catch (Exception $exception) {
            //return exception message
            die(var_dump($exception->getMessage()));
        }
    }

}