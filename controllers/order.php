<?php
require 'controllers/Mail.php';
require 'models/Order.php';
require 'models/OrderedProduct.php';
require 'models/User.php';
require 'models/Commercial_Customer.php';

//set the data that will be show on the page
$ORDER = $CART->showCart();
$SIZE = $CART->showSize();

$PRICE = $CART->showTotalPrice();
$TOTALPRICE = $CART->showTotalPriceIncl();
$btwDisplay = "21%";

if (!empty($_SESSION['id'])) {
    $USER = new Users($database);
    $user['id'] = $_SESSION['id'];
    $user = $USER->showOne($user)['msg'][0];
    if ($user['type'] === '2') {
        $btwDisplay = "0%";
        $TOTALPRICE = $PRICE;
    }
}

$BTW = $btwDisplay;

$firstName = '';
$insertion = '';
$lastName = '';
$email = '';
$tel = '';
$postalCode = '';
$houseNumber = '';
$addition = '';
$streetName = '';
$residence = '';

//check if user is logged in
if (Auth::isLoggedIn()) {
    //create user object
    $USER = new User($database);
    $user = $USER->showOne($_SESSION['id']);

    //check if the user is a normal customer
    if ($user['type'] == 1 || $user['type'] == 2) {
        if ($user['type'] == 1) {
            $CUSTOMER = new Customer($database);
            $customer = $CUSTOMER->getOneByUserId($user['id']);
        } //check if the user is a commercial customer
        else if ($user['type'] == 2) {
            $COMMERCIAL_CUSTOMER = new Commercial_Customer($database);
            $customer = $COMMERCIAL_CUSTOMER->getOneByUserId($user['id']);
        }

        //set the variable data to the right customer
        $firstName = $customer['firstName'];
        $insertion = $customer['insertion'];
        $lastName = $customer['lastName'];
        $email = $user['email'];
        $tel = $customer['phoneNumber'];
        $postalCode = $customer['postalCode'];
        $houseNumber = $customer['houseNumber'];
        $addition = $customer['houseNumberAddition'];
        $streetName = $customer['streetName'];
        $residence = $customer['place'];
    }
}

//check if all the data exists
if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['postalCode']) && isset($_POST['houseNumber']) && isset($_POST['streetName']) && isset($_POST['residence']) && isset($_POST['insertion']) && isset($_POST['tel']) && isset($_POST['addition'])) {

    //bind the post variables
    $firstName = $_POST['firstName'];
    $insertion = $_POST['insertion'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $postalCode = $_POST['postalCode'];
    $houseNumber = $_POST['houseNumber'];
    $addition = $_POST['addition'];
    $streetName = $_POST['streetName'];
    $residence = $_POST['residence'];

    //check if the data is not empty
    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($postalCode) && !empty($houseNumber) && !empty($streetName) && !empty($residence)) {

        //validate all the required data
        if (!Validate::ValidateString('firstName', $firstName)) {
            $error = 'De voornaam mag geen nummers of special tekens bevatten, moet beginnen met een hoofdletter en moet langer zijn dan 1 karakter';
        } else if (!Validate::ValidateString('lastName', $lastName)) {
            $error = "De achternaam mag geen spaties bevatten, moet beginnen met een hoofdletter en moet langer zijn dan 1 karakter";
        } else if (!Validate::ValidateString('email', $email)) {
            $error = 'Het emailadres is ongeldig';
        } else if (!Validate::ValidateString('postalCode', $postalCode)) {
            $error = 'De postcode komt niet overeen met een nederlands postcode';
        } else if (!Validate::ValidateString('houseNumber', $houseNumber)) {
            $error = 'Het huisnummer is geen cijfer';
        } else if (!Validate::ValidateString('streetName', $streetName)) {
            $error = 'Een straatnaam mag geen tekens of cijfers bevatten';
        } else if (!Validate::ValidateString('place', $residence)) {
            $error = 'Een woonplaats mag geen cijfers of speciale tekens bevatten en moet langer zijn dan 2 kartakters';
        } else {
            //validate all the optional data
            if (!empty($insertion) && !Validate::ValidateString('insertion', $insertion)) {
                $error = 'Tussenvoegsel mag niet beginnen met een hoofdletter en is langer dan 1 karakter';
            } else if (!empty($tel) && !Validate::ValidateString('phoneNumber', $tel)) {
                $error = 'Telefoonnummer voldoen niet aan de standaard +31 6 12345678';
            } else if (!empty($addition) && !Validate::ValidateString('houseNumberAddition', $addition)) {
                $error = 'Toevoeging van de straatnaam mag geen nummer zijn, alleen een letter en is 1 karakter lang';
            } else {
                //put all the data in an associative array used for the template data
                $data = ["{FIRST_NAME}" => $firstName,
                    "{INSERTION}" => $insertion,
                    "{LAST_NAME}" => $lastName,
                    "{EMAIL}" => $email,
                    "{TEL}" => $tel,
                    "{POSTAL_CODE}" => $postalCode,
                    "{HOUSE_NUMBER}" => $houseNumber,
                    "{ADDITION}" => $addition,
                    "{STREET_NAME}" => $streetName,
                    "{RESIDENCE}" => $residence,
                ];

                //check if the email has been send or not
                $successOrder = Mail::sendOrderMail('bestellingen@flevosap.nl', 'Nieuwe bestelling', "", $ORDER, $PRICE, $BTW, $TOTALPRICE, "no-reply", 'views/partials/templates/orderMail.template.php', $data);
                $successConfirmOrder = Mail::sendOrderMail($email, 'Uw bestelling bij flevosap', "", $ORDER, $PRICE, $BTW, $TOTALPRICE, "no-reply", 'views/partials/templates/confirmOrderMail.template.php', $data);
                if ($successOrder && $successConfirmOrder) {
                    header('HTTP/1.1 307 Temporary Redirect');
                    header('Location: '.Request::buildUri( 'betalen/succes'));
                } else {
                    $error = "Er is iets fout gegaan bij het maken van uw bestelling, probeert u het later nog eens";
                }
            }

        }

    } else {
        $error = 'Voornaam, Achternaam, Email, Postcode, Huisnummer, Straatnaam en Woonplaats mogen niet leeg zijn';
    }
}


require 'views/order.view.php';