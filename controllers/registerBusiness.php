<?php

require 'controllers/Mail.php';

//Set values to empty so input for doesn't error out for an value not beeing set
$customer = [];
$customer['salutation'] = '1';
$customer['firstName'] = '';
$customer['insertion'] = '';
$customer['lastName'] = '';
$customer['phoneNumber'] = '';
$customer['postalCode'] = '';
$customer['houseNumber'] = '';
$customer['houseNumberAddition'] = '';
$customer['streetName'] = '';
$customer['place'] = '';
$customer['kvkNumber'] = '';
$customer['companyName'] = '';
$customer['btwNumber'] = '';
$customer['email'] = '';


//Main function
function register($database)
{

    global $customer;

    //check if all required fields are filled in
    if (empty($_POST['salutation'])) {
        return 'Je moet een aanhef invullen';
    }
    if (empty($_POST['firstName'])) {
        return 'Je moet je voornaam invullen';
    }
    if (empty($_POST['lastName'])) {
        return 'Je moet je achternaam invullen';
    }
    if (empty($_POST['postalCode'])) {
        return 'Je moet je postcode invullen';
    }
    if (empty($_POST['houseNumber'])) {
        return 'Je moet je huisnummer invullen';
    }
    if (empty($_POST['streetName'])) {
        return 'Je moet je straatnaam invullen';
    }
    if (empty($_POST['place'])) {
        return 'Je moet je plaats invullen';
    }
    if (empty($_POST['kvkNumber'])) {
        return 'Je moet je kvk nummer invullen';
    }
    if (empty($_POST['companyName'])) {
        return 'Je moet je bedrijfsnaam invullen';
    }
    if (empty($_POST['btwNumber'])) {
        return 'Je moet je btw nummer invullen';
    }
    if (empty($_POST['email'])) {
        return 'Je moet je email invullen';
    }
    if (empty($_POST['password'])) {
        return 'Je moet je wachtwoord invullen';
    }
    if (empty($_POST['repeatPassword'])) {
        return 'Je moet je herhaal wachtwoord invullen';
    }

    //check if there is already an account with this email
    $USERS = new Users($database);
    $user['email'] = $_POST['email'];
    $dbUser = $USERS->showOne($user);
    if (!empty($dbUser['msg'])) {
        return "Email is bij ons al geregistreerd";
    }

    //Validate if fields are correct
    if (!Validate::ValidateString('salutation', $_POST['salutation'])) {
        return 'Ongeldige aanhef';
    }
    if (!Validate::ValidateString('firstName', $_POST['firstName'])) {
        return 'Ongeldige voornaam';
    }
    if (!Validate::ValidateString('lastName', $_POST['lastName'])) {
        return 'Ongeldige achternaam';
    }
    if (!Validate::ValidateString('postalCode', $_POST['postalCode'])) {
        return 'Ongeldige postcode';
    }
    if (!Validate::ValidateString('houseNumber', $_POST['houseNumber'])) {
        return 'Ongeldig huisnummer';
    }
    if (!Validate::ValidateString('streetName', $_POST['streetName'])) {
        return 'Ongeldige straat';
    }
    if (!Validate::ValidateString('place', $_POST['place'])) {
        return 'Ongeldige woonplaats';
    }
    if (!Validate::ValidateString('kvkNumber', $_POST['kvkNumber'])) {
        return 'Ongeldig kvk nummer';
    }
    if (!Validate::ValidateString('companyName', $_POST['companyName'])) {
        return 'Ongeldig bedrijfsnaam';
    }
    if (!Validate::ValidateString('btwNumber', $_POST['btwNumber'])) {
        return 'Ongeldig btw nummer';
    }
    if (!Validate::ValidateString('email', $_POST['email'])) {
        return 'Ongeldige email';
    }
    if (!Validate::ValidateString('password', $_POST['password'])) {
        return 'Ongeldig wachtwoord';
    }

    //Validate if the optional fields are correct
    if (!empty($_POST['insertion'])) {
        if (!Validate::ValidateString('insertion', $_POST['insertion'])) {
            return 'Ongeldig tussenvoegsel';
        }
    }
    if (!empty($_POST['phoneNumber'])) {
        if (!Validate::ValidateString('phoneNumber', $_POST['phoneNumber'])) {
            return 'Ongeldig telefoonnummer';
        }
    }
    if (!empty($_POST['houseNumberAddition'])) {
        if (!Validate::ValidateString('houseNumberAddition', $_POST['houseNumberAddition'])) {
            return 'Ongeldige huisnummer toevoeging';
        }
    }

    //check if the password and repeat password are the same
    if ($_POST['password'] != $_POST['repeatPassword']) {
        return "Wachtwoorden komen niet overeen";
    }

    //Options for hashing the password amount of layers of hashing
    $pwoptions = ['cost' => 9,];
    //Hash the password
    $hashPassword = password_hash($_POST['password'], PASSWORD_BCRYPT, $pwoptions);

    //register the user
    $USERS->create($_POST['email'], $hashPassword, 2);

    //get the user id of the user that just registerd
    $dbUser2 = $USERS->showOne($user);;

    //generate a unique key for validation
    $code = Key::GenKey();

    //get a verify object
    $VERIFY = new Verify($database);
    //store the verify code for the just registered user
    $VERIFY->create($dbUser2['msg'][0]['id'], $code, 1);

    $data = [
        "EMAIL" => $_POST['email'],
        "CODE" => $code
    ];

    Mail::send($_POST['email'], "Activeer je account!", "", "no-reply", 'views/partials/templates/verifyCodeRegistrationMail.template.php', $data);

    $customer['userId'] = $dbUser2['msg'][0]['id'];

    $CUSTOMER = new CommercialCustomer($database);
    $CUSTOMER->create($customer);

    header('Location: '.Request::buildUri( '/login'));
    return "Success";
}

//if user submits execute
if (!empty($_POST)) {
    if (!empty($_POST['salutation'])) {
        $customer['salutation'] = $_POST['salutation'];
    }
    if (!empty($_POST['firstName'])) {
        $customer['firstName'] = $_POST['firstName'];
    }
    if (!empty($_POST['insertion'])) {
        $customer['insertion'] = $_POST['insertion'];
    }
    if (!empty($_POST['lastName'])) {
        $customer['lastName'] = $_POST['lastName'];
    }
    if (!empty($_POST['phoneNumber'])) {
        $customer['phoneNumber'] = $_POST['phoneNumber'];
    }
    if (!empty($_POST['postalCode'])) {
        $customer['postalCode'] = $_POST['postalCode'];
    }
    if (!empty($_POST['houseNumber'])) {
        $customer['houseNumber'] = $_POST['houseNumber'];
    }
    if (!empty($_POST['houseNumberAddition'])) {
        $customer['houseNumberAddition'] = $_POST['houseNumberAddition'];
    }
    if (!empty($_POST['streetName'])) {
        $customer['streetName'] = $_POST['streetName'];
    }
    if (!empty($_POST['place'])) {
        $customer['place'] = $_POST['place'];
    }
    if (!empty($_POST['kvkNumber'])) {
        $customer['kvkNumber'] = $_POST['kvkNumber'];
    }
    if (!empty($_POST['companyName'])) {
        $customer['companyName'] = $_POST['companyName'];
    }
    if (!empty($_POST['btwNumber'])) {
        $customer['btwNumber'] = $_POST['btwNumber'];
    }
    if (!empty($_POST['email'])) {
        $customer['email'] = $_POST['email'];
    }
    //run the main function and return any errors to the user
    $error = register($database);
}

require("views/registerbusiness.view.php");
