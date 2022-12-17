<?php

require 'controllers/Mail.php';

//Set value to empty so input for doesn't error out for an value not beeing set
$email = "";

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

function requestemailchange() {

    //External values needed inside function
    global $email;
    global $database;
    global $user;

    //check if email value is in the post
    if (!isset($_POST['email'])) {
        return "Je moet een email invullen!";
    }
    //set the value to email so it gets filled in the form if there are any errors
    $email = $_POST['email'];

    //check if email is a valid email
    if (!Validate::ValidateString('email', $email)) {
        return 'Ongeldige email';
    }

    //get the user data by email
    $USERS = new Users($database);
    $user2 = [];
    $user2['email'] = $email;
    $DBpass = $USERS->showOne($user2);

    //check if the email exists
    if (!empty($DBpass['msg'])) {
        return "Dit email is al bij ons bekend!";
    }

    $id = $user['id'];

    //generate a unique key for validation
    $code = Key::GenKey();

    //get a verify object
    $VERIFY = new Verify($database);

    //get user thats logged in


    //get verify codes for a email
    $verifyCheck = $VERIFY->show($user['email']);

    //check if user already has a verify code if so edit it otherwise create a new one
    if (empty($verifyCheck['msg'])) {
        $VERIFY->create($id, $code, 3);
    } else {
        $VERIFY->edit($verifyCheck['msg'][0]['id'], $code, 3);
    }

    $data = [
        "OLDEMAIL" => $user['email'],
        "CODE" => $code,
        "NEWEMAIL" => $email
    ];

    Mail::send($email, "Wijzig je email!", "", "no-reply", 'views/partials/templates/verifyCodeUpdateEmailMail.template.php', $data);

    return 'Aanvraag verstuurd naar je email adress.';
}

//if user submits execute
if (!empty($_POST)) {
    //run the main function and return any errors to the user
    $error = requestemailchange();
}

require("views/account/profile.change.email.request.view.php");