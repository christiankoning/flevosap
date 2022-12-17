<?php
//require 'models/Crud.php';
//
//
//$id = $_POST['userId'];
//$idName = 'userId';
//$query = $database->query('DELETE FROM User WHERE id = ?', [$id]);
//
//header('location: ../../admin/gebruikers');

$USERS = new Users($database);

//check if the post variable has been set
if (isset($_POST['userId'])) {
    try {
        //execute query
        $user['id'] = $_POST['userId'];
        $user = $USERS->showOne($user);
        echo json_encode($user['msg'][0]);

    } catch (Exception $exception)
    {
        //show exception message
        die(var_dump($exception->getMessage()));
    }
}

//require 'models/crud.php';
//
//$id = $_POST['userId'];
//$idName = 'userId';
//
////check if the id has been set
//if (!isset($id)) {
//    return header('location: '.Request::buildUri( '/admin/gebruikers'));
//}
////set model en model description for the view
//$model = 'gebruikers';
//$modelName = 'gebruiker';
//$modelDesc = 'deze gebruiker';
//
////select information about current user
//$USERS = new crud($database);
//$users = $USERS->showOne($id);
//
////get data from query
//$userEmail = 'Email: ' . $users['email'];
//
////check if the post variables have been set
//if (isset($id) && isset($_POST['confirmDelete'])) {
//    try {
//        //execute query
//        $USERS->DestroyUser($id);
//        return header('location: '.Request::buildUri( '/admin/gebruikers'));
//    } catch (Exception $exception) {
//        //show exception message
//        die(var_dump($exception->getMessage()));
//    }
//
//}
//
//require 'views/admin/deleteConfirm.view.php';

