<?php


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

if (empty($_SESSION['id'])) {
    header('location: '.Request::buildUri( '/login'));
}

$id = $_SESSION['id'];

$customer['userId'] = $id;

$user['id'] = $id;

$USER = new Users($database);
$user = $USER->showOne($user);

if (empty($user['msg'])) {
    header('location: '.Request::buildUri( '/login'));
}

$user = $user['msg'][0];

if ($user['type'] !== '2') {
    header('location: '.Request::buildUri( '/login'));
}

//Main function
function update($database)
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

    $CUSTOMER = new CommercialCustomer($database);
    $CUSTOMER->update($customer);

    header('Location: '.Request::buildUri( '/profiel'));
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
    //run the main function and return any errors to the user
    $error = update($database);
} else {

    $customer['userId'] = $id;

    $CUSTOMER = new CommercialCustomer($database);
    $customer = $CUSTOMER->showOne($customer)['msg'][0];

}

require("views/account/profile.change.company.view.php");