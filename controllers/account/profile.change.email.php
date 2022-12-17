<?php

//set the default return info
$header = "Onbekende error";
$info = "We konden je email niet wijzigen.";

//directly start checking if we can activate the account from page load

//check if newemail value is in the get
if (!empty($_GET["newemail"])) {
    //check if oldemail value is in the get
    if (!empty($_GET["oldemail"])) {
        //check if verify key value is in the get
        if (!empty($_GET['code'])) {
            //check if newemail is a valid email
            if (Validate::ValidateString('email', $_GET["newemail"])) {
                //check if oldemail is a valid email
                if (Validate::ValidateString('email', $_GET["oldemail"])) {
                    //get the user data by email
                    $USERS = new Users($database);
                    $user2 = [];
                    $user2['email'] = $_GET["newemail"];
                    $DBpass = $USERS->showOne($user2);
                    //check if the email exists
                    if (empty($DBpass['msg'])) {
                        //get a verify object
                        $VERIFY = new Verify($database);
                        //get verify codes for a email
                        $verifyCode = $VERIFY->show($_GET["oldemail"]);
                        //check if there is a verify code for this email
                        if (!empty($verifyCode['msg'])) {
                            //compare the verify codes if they correct
                            if ($verifyCode['msg'][0]['verifyCode'] === $_GET['code']) {
                                //check if the verify code is of type register
                                if ($verifyCode['msg'][0]['type'] == 3) {
                                    //remove the verify code since its now used
                                    $VERIFY->destroy($verifyCode['msg'][0]['id']);
                                    //get a user object
                                    $USERS = new Users($database);
                                    $user = [];
                                    $user['id'] = $verifyCode['msg'][0]['userId'];
                                    $user['email'] = $_GET["newemail"];
                                    //activate the user account
                                    $USERS->updateEmail($user);

                                    //inform the user
                                    $header = "Je email is gewijzigd!";
                                    $info = "Je wordt automatisch doorgestuurd...";
                                    //auto redirect the user to profile after 3 seconds
                                    header("refresh:3; url=".Request::buildUri( '/profiel'));
                                } else {
                                    $header = "Incorrecte code9";
                                    $info = "We konden je email niet wijzigen.";
                                }
                            } else {
                                $header = "Incorrecte code8";
                                $info = "We konden je email niet wijzigen.";
                            }
                        } else {
                            $header = "Incorrecte code7";
                            $info = "We konden je email niet wijzigen.";
                        }
                    } else {
                        $header = "Incorrecte gegevens6";
                        $info = "We konden je email niet wijzigen.";
                    }
                } else {
                    $header = "Incorrecte gegevens5";
                    $info = "We konden je email niet wijzigen.";
                }
            } else {
                $header = "Incorrecte gegevens4";
                $info = "We konden je email niet wijzigen.";
            }
        } else {
            $header = "Incorrecte code3";
            $info = "We konden je email niet wijzigen.";
        }
    } else {
        $header = "Incorrecte gegevens2";
        $info = "We konden je email niet wijzigen.";
    }
} else {
    $header = "Incorrecte gegevens1";
    $info = "We konden je email niet wijzigen.";
}

require("views/account/profile.change.email.view.php");
