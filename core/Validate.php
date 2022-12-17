<?php

class Validate
{

    public static function ValidateString($type, $value) {
        if ($type === 'firstName') {
            return preg_match('/^[A-Za-z]{1,64}$/', $value);
        }
        elseif ($type === 'salutation') {
            return preg_match('/^[1-3]$/', $value);
        }
        elseif ($type === 'insertion') {
            return preg_match('/^[A-Za-z]{1,32}$/', $value);
        }
        elseif ($type === 'lastName') {
            return preg_match('/^[A-Za-z]{1,64}$/', $value);
        }
        elseif ($type === 'phoneNumber') {
            return preg_match('/(^\+31|^0031|^0)(\s|)(6(\s|)[0-9]{8}$)/', $value);
        }
        elseif ($type === 'postalCode') {
            return preg_match('/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i', $value);
        }
        elseif ($type === 'houseNumber') {
            return preg_match('/^[0-9]{1,8}$/', $value);
        }
        elseif ($type === 'houseNumberAddition') {
            return preg_match('/^[A-Za-z0-9]{1,8}$/', $value);
        }
        elseif ($type === 'streetName') {
            return preg_match('/^[A-Za-z]{1,64}$/', $value);
        }
        elseif ($type === 'place') {
            return preg_match('/^[A-Za-z]{1,32}$/', $value);
        }
        elseif ($type === 'birthDate') {
            return preg_match('/^(0[1-9]|1[0-9]|2[0-9]|3[0-1])-(0[1-9]|1[0-2])-([0-9]{4})$/', $value);
        }
        elseif ($type === 'kvkNumber') {
            return preg_match('/^[0-9]{8}$/', $value);
        }
        elseif ($type === 'companyName') {
            return preg_match('/^[A-Za-z ]{1,64}$/', $value);
        }
        elseif ($type === 'btwNumber') {
            return preg_match('/^NL([0-9]{9})B([0-9]{2})$/', $value);
        }
        elseif ($type === 'email') {
            if (preg_match('/^.{1,64}$/', $value)) {
                if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return true;
                }
            }
            return false;
        }
        elseif ($type === 'password') {
            return preg_match('/^.{1,64}$/', $value);
        }
    }

}
