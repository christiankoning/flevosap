<?php
require 'models/Crud.php';
//check if there are orders
$USERS = new Crud($database);
if ($stmt = $USERS->ShowUsers()) {
    if (sizeof($stmt) > 0) {
        //if there are orders return false
        $noUsers = false;
    } else {
        //if there are no orders return true
        $noUsers = true;
    }

}

if (isset($_POST['userStatus'])) {
    try {
        if ($_POST['userStatus'] === "edit") {
            if(isset($_POST['userId']))
            {
                try {
                    // Check if isAdmin is not empty
                    if(!empty($_POST['isAdmin'] || $_POST['isAdmin'] === "0"))
                    {
                        //execute query
                        $USERS->edit($_POST['isAdmin'], $_POST['userId']);
                        return header('location: '.Request::buildUri( '/admin/gebruikers'));
                    }
                    // if isAdmin is empty throw error
                    else
                    {
                        $error = "Geen rol gekozen!";
                    }
                } catch (Exception $exception)
                {
                    //show exception message
                    die(var_dump($exception->getMessage()));
                }
            }
        }
        // Check if categoryStatus has the correct value
        else if($_POST['userStatus'] === "delete")
        {
            if(isset($_POST['confirmDelete']))
            {
                try {
                    // Check if categoryId exists
                    if (!empty($_POST['userId'])) {

                        if($_POST['confirmDelete'] === "1")
                        {
                            //execute query
                            $USERS->destroy($_POST['userId']);
                            return header('location: '.Request::buildUri( '/admin/gebruikers'));
                        } else {
                            return header('location: '.Request::buildUri( '/admin/gebruikers'));
                        }
                    }
                } catch (Exception $exception)
                {
                    die(var_dump($exception->getMessage()));
                }
            }
        }
    } catch (Exception $exception) {
        die(var_dump($exception->getMessage()));
    }
}

require 'views/admin/viewGebruikers.view.php';
?>

