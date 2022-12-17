<?php

unset($_SESSION['loggedIn']);
unset($_SESSION['isAdmin']);
unset($_SESSION['id']);

//session_destroy();

header('Location: '.Request::buildUri( '/'));