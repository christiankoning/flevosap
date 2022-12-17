<?php

$customer = [];

if (empty($_SESSION['id'])) {
    header('location: '.Request::buildUri( '/login'));
}

$id = $_SESSION['id'];

$user['id'] = $id;

$USER = new Users($database);
$user = $USER->showOne($user);

if (empty($user['msg'])) {
    header('location: '.Request::buildUri( '/login'));
}

$user = $user['msg'][0];

//Main function
function update($database) {

    global $user;

    //check if all required fields are filled in
    if (empty($_POST['password'])) {
        return 'Je moet je nieuwe wachtwoord invullen';
    }
    if (empty($_POST['repeatPassword'])) {
        return 'Je moet je herhaal wachtwoord invullen';
    }
    if (empty($_POST['oldPassword'])) {
        return 'Je moet je oude wachtwoord invullen';
    }

    //Validate if fields are correct
    if (!Validate::ValidateString('password', $_POST['oldPassword'])) {
        return 'Ongeldige oude wachtwoord';
    }
    if (!Validate::ValidateString('password', $_POST['password'])) {
        return 'Ongeldige wachtwoord';
    }

    //check if password is correct
    if (!password_verify($_POST['oldPassword'], $user['password'])) {
        return "Incorrect oude wachtwoord!";
    }

    //check if the password and repeat password are the same
    if ($_POST['password'] != $_POST['repeatPassword']) {
        return "Nieuwe wachtwoorden komen niet overeen";
    }

    //Options for hashing the password amount of layers of hashing
    $pwoptions = ['cost' => 9,];
    //Hash the password
    $hashPassword = password_hash($_POST['password'], PASSWORD_BCRYPT, $pwoptions);

    $USER = new Users($database);
    $user['password'] = $hashPassword;
    $USER->updatePassword($user);

    header('Location: '.Request::buildUri( '/profiel'));
    return "Success";
}

//if user submits execute
if ( !empty($_POST) ) {
    //run the main function and return any errors to the user
    $error = update($database);
}

require("views/account/profile.change.password.view.php");