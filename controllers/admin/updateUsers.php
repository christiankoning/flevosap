<?php

require 'models/Crud.php';

$USERS = new Crud($database);

//check if the post variable has been set
if(isset($_POST['userId'])){
    try {
        //execute query
        $user = $USERS->showOne($_POST['userId']);
        echo json_encode($user);

    } catch (Exception $exception)
    {
        //show exception message
        die(var_dump($exception->getMessage()));
    }
}
