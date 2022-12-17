<?php

require 'controllers/Mail.php';

$email = '';
$message = '';

function contact()
{
    //External values needed inside function
    global $email;
    global $message;

    //check if email value is in the post
    if (empty($_POST['email'])) {
        return "Je moet een email invullen!";
    }

    //check if email value is in the post
    if (empty($_POST['message'])) {
        return "Je bericht is leeg!";
    }

    //check if email is a valid email
    if (!Validate::ValidateString('email', $email)) {
        return 'Ongeldige email';
    }

    if (!preg_match('/^[A-Za-z0-9\s,.?!_\-]{1,256}$/', $message)) {
        return 'Ongeldig bericht';
    }

    $data = [
        "EMAIL" => $_POST['email'],
        "MESSAGE" => $_POST['message']
    ];

    Mail::send("contact@flevosap.nl", "Nieuw bericht", "", "no-reply", 'views/partials/templates/contactInternMail.template.php', $data);

    Mail::send($_POST['email'], "Je bericht is ontvangen", "", "no-reply", 'views/partials/templates/contactExternMail.template.php', $data);

    $email = '';
    $message = '';

    return 'Je bericht is verstuurd!';
}

//if user submits execute
if (!empty($_POST)) {
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (!empty($_POST['message'])) {
        $message = $_POST['message'];
    }
    //run the main function and return any errors to the user
    $error = contact($database);
}

require("views/contact.view.php");