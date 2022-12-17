<?php

require 'controllers/Mail.php';

//Set value to empty so input for doesn't error out for an value not beeing set
$email = "";

//Main function

function forgotpassword() {
    //External values needed inside function
    global $email;
    global $database;

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
    $user = [];
    $user['email'] = $email;
    $DBpass = $USERS->showOne($user);

    //check if the email exists
    if (empty($DBpass['msg'])) {
        return "Email is niet bij ons bekend!";
    }

    //check if the acount is activated
    if (!$DBpass['msg'][0]['active']) {
        return "Account is nog niet geactiveerd controleer je email.";
    }

    $id = $DBpass['msg'][0]['id'];

    //generate a unique key for validation
    $code = Key::GenKey();

    //get a verify object
    $VERIFY = new Verify($database);

    //get verify codes for a email
    $verifyCheck = $VERIFY->show($email);

    //check if user already has a verify code if so edit it otherwise create a new one
    if (empty($verifyCheck['msg'])) {
        $VERIFY->create($id, $code, 2);
    }
    else {
        $VERIFY->edit($verifyCheck['msg'][0]['id'], $code, 2);
    }

    $data = [
    "EMAIL" => $email,
    "CODE" => $code
    ];

    Mail::send($email, "Wachtwoord vergeten!", "", "no-reply", 'views/partials/templates/verifyCodePasswordForgottenMail.template.php', $data);

    return 'Aanvraag verstuurd naar je email adress.';
}

//if user submits execute
if ( !empty($_POST) ) {
    //run the main function and return any errors to the user
    $error = forgotpassword();
}



require("views/forgotpassword.view.php");
