<?php

class Auth
{
    //Fuction to check if current user is admin (returns true / false)
    public static function isAdmin() {
        if (empty($_SESSION['isAdmin'])) {
            return false;
        }
        else {
            if ($_SESSION['isAdmin'] == true) {
                return true;
            }
            else {
                return false;
            }
        }
    }

    //Fuction to check if current user is logged in (returns true / false)
    public static function isLoggedIn() {
        if (empty($_SESSION['loggedIn'])) {
            return false;
        }
        else {
            return true;
        }
    }

}