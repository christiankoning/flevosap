<?php
require 'models/crud.php';

if (!empty($_POST))
{
    try
    {
        //check if username and email are not empty
        if (!empty($_POST['userEmail']) && !empty($_POST['userPsw']) && !empty($_POST['userPsw2']))
        {
            $userEmail =$_POST['userEmail'];
            $userPwd = $_POST['userPsw'];
            $userPwd2 = $_POST['userPsw2'];
            $isAdmin = $_POST['isAdmin'];
            //validate the username

            //validate the email address
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL))
            {
                //show error if the email is invalid
                $error = 'Het e-mail adres is ongeldig!';
            }
            else if (!preg_match('/^.{3,31}$/', $userPwd))
            {
                //show error if password is invalid and shorter then 3 characters
                $error = 'Ongeldig wachtwoord!';
            }
            else if ($userPwd !== $userPwd2)
            {
                //show error if password is not equal to confirm password
                $error = 'De wachtwoorden komen niet overeen!';
            }
            else
            {
                //hash password
                $psw = password_hash($userPwd, PASSWORD_DEFAULT);
                //execute query
                $USERS = new crud($database);
                $USERS->createUser($userEmail,$psw, $isAdmin);
                return header('location: '.Request::buildUri( '/admin/gebruikers'));
            }
        }
        //check which input is empty
        else
        {
            if(empty($_POST['userEmail']))
            {
                //show error if e-mail is empty
                $error = "Het E-mail adres mag niet leeg zijn!";
            }
            else if(empty($_POST['userPsw']))
            {
                //show error if password is empty
                $error = "Het Wachtwoord mag niet leeg zijn!";
            }
            else if(empty($_POST['userPsw2']))
            {
                //show error if confirm password is empty
                $error = "Wachtwoord herhalen mag niet leeg zijn!";
            }
        }
    }
    catch (Exception $exception)
    {
        //show error message if an exception happens for debugging
        die(var_dump($exception->getMessage()));
    }
}


require 'views/admin/createUsers.view.php';
