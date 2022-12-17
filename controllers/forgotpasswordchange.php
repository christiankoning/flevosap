<?php

$email = "";
$code = "";
$password = "";
$passwordRepeat = "";

//Main function

function changePassword($database) {
    //External values needed inside function
    global $code;
    global $email;
    global $password;
    global $passwordRepeat;

    //check if verify key value is in the post
    if (empty($_POST['code'])) {
        return "Je moet een code invullen";
    }

    //check if email value is in the post
    if (empty($_POST['email'])) {
        return "Je moet een email invullen";
    }

    //check if password value is in the post
    if (empty($_POST['password'])) {
        return "Je moet een wachtwoord invullen";
    }

    //check if repeat password value is in the post
    if (empty($_POST['repeatPassword'])) {
        return "Je moet een wachtwoord invullen";
    }

    //set the values to email, code, password and repeat password so it gets filled in the form if there are any errors
    $code = $_POST['code'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['repeatPassword'];

    //check if email is a valid email
    if (!Validate::ValidateString('email', $email)) {
        return 'Ongeldige email';
    }

    //check if the password and repeat password are the same
    if ($password != $passwordRepeat) {
        return "Wachtwoorden komen niet overeen";
    }

    //Validate if fields are correct
    if (!Validate::ValidateString('password', $_POST['password'])) {
        return 'Ongeldige wachtwoord';
    }

    //get a verify object
    $VERIFY = new Verify($database);
    //get verify codes for a email
    $verifyCode = $VERIFY->show($email);

    //check if there is a verify code for this email
    if (empty($verifyCode['msg'])) {
        return "Ongeldige email";
    }
    //compare the verify codes if they correct
    if ($verifyCode['msg'][0]['verifyCode'] != $code) {
        return "Ongeldige code";
    }
    //check if the verify code is of type password
    if ($verifyCode['msg'][0]['type'] != 2) {
        return "Ongeldige code";
    }
    //remove the verify code since its now used
    $result = $VERIFY->destroy($verifyCode['msg'][0]['id']);

    die(var_dump($result));

    //Options for hashing the password amount of layers of hashing
    $pwoptions = ['cost' => 9,];
    //Hash the password
    $hashPassword = password_hash($password, PASSWORD_BCRYPT, $pwoptions);

    //get a user object
    $USERS = new Users($database);
    //update the password of the user
    $user['password'] = $hashPassword;
    $user['id'] = $verifyCode['msg'][0]['userId'];
    $USERS->updatePassword($user);

    //send the user to login
    header('Location: '.Request::buildUri( '/login'));

    return 'success';
}

//if user submits execute
if ( !empty($_POST) ) {
    //run the main function and return any errors to the user
    $error = changePassword($database);
}
//insert the url data in the fields from the url send in the mail
else {
    if (!empty($_GET["email"])) {
        $email = $_GET['email'];
    }
    if (!empty($_GET["code"])) {
        $code = $_GET['code'];
    }
}


require ('views/forgotpasswordchange.view.php');