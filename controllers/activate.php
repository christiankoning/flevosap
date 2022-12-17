<?php

//set the default return info
$header = "Onbekende error";
$info = "We konden je account niet activeren.";

//directly start checking if we can activate the account from page load

//check if email value is in the get
if (!empty($_GET["email"])) {
    //check if verify key value is in the get
    if (!empty($_GET['code'])) {
        //get a verify object
        $VERIFY = new Verify($database);
        //get verify codes for a email
        $verifyCode = $VERIFY->show($_GET["email"]);
        //check if there is a verify code for this email
        if (!empty($verifyCode['msg'])) {
            //compare the verify codes if they correct
            if ($verifyCode['msg'][0]['verifyCode'] === $_GET['code']) {
                //check if the verify code is of type register
                if ($verifyCode['msg'][0]['type'] == 1) {
                    //remove the verify code since its now used
                    $VERIFY->destroy($verifyCode['msg'][0]['id']);
                    //get a user object
                    $USERS = new Users($database);
                    //activate the user account
                    $USERS->activate($verifyCode['msg'][0]['userId']);

                    //inform the user
                    $header = "Je account is geactiveerd!";
                    $info = "Je wordt automatisch doorgestuurd...";
                    //auto redirect the user to login after 3 seconds
                    header("refresh:3; url=".Request::buildUri( '/login'));
                }
                else {
                    $header = "Incorrecte activatie code";
                    $info = "We konden je account niet activeren.";
                }
            }
            else {
                $header = "Incorrecte activatie code";
                $info = "We konden je account niet activeren.";
            }
        }
        else {
            $header = "Incorrecte activatie code";
            $info = "We konden je account niet activeren.";
        }
    }
    else {
        $header = "Incorrecte activatie code";
        $info = "We konden je account niet activeren.";
    }
}
else {
    $header = "Incorrecte gegevens";
    $info = "We konden je account niet activeren.";
}


require 'views/activate.view.php';
