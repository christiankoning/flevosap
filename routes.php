<?php

$router->define([
    //general
    "" => ["controllers/home.php", 0],
    "categorie" => ["controllers/categories.php", 0],
    "contact" => ["controllers/contact.php", 0],
    "login" => ["controllers/login.php", 0],
    "uitloggen" => ["controllers/logout.php", 0],

    //profiel
    "profiel" => ["controllers/account/profile.php", 1],
    "profiel/veranderemail" => ["controllers/account/profile.change.email.php", 1],
    "profiel/veranderemailaanvragen" => ["controllers/account/profile.change.email.request.php", 1],
    "profiel/veranderwachtwoord" => ["controllers/account/profile.change.password.php", 1],
    "profiel/veranderklant" => ["controllers/account/profile.change.customer.php", 1],
    "profiel/veranderbedrijf" => ["controllers/account/profile.change.company.php", 1],

    "wachtwoordvergeten" => ["controllers/forgotpassword.php", 0],
    "wachtwoordveranderen" => ["controllers/forgotpasswordchange.php", 0],
    "activeer" => ["controllers/activate.php", 0],
    "registreren" => ["controllers/register.php", 0],
    "registreren-bedrijven" => ["controllers/registerBusiness.php", 0],
    "winkelwagen" => ["controllers/shoppingCart.php", 0],
    "producten" => ["controllers/products.php", 0],
    "producten/detail" => ["controllers/productDetail.php", 0],

    //order routes
    "bestelling-methode" => ["controllers/orderMethod.php", 0],
    "betalen" => ["controllers/order.php", 0],
    "betalen/succes" => ["controllers/orderSuccess.php", 0],

    //admin
    "admin/categorieen" => ["controllers/admin/viewCategory.php", 2],
    "admin/categorieen/bewerken" => ["controllers/admin/editCategory.php", 2],
    "admin/categorieen/verwijderen" => ["controllers/admin/deleteCategory.php", 2],

    'admin/producten' => ['controllers/admin/viewProducts.php', 2],
    'admin/producten/toevoegen' => ['controllers/admin/createProducts.php', 2],
    'admin/producten/bewerken' => ['controllers/admin/updateProducts.php', 2],
    'admin/producten/verwijderen' => ['controllers/admin/deleteProducts.php', 2],

    'admin/gebruikers' => ['controllers/admin/viewUsers.php', 2],
    'admin/gebruikers/verwijderen' => ['controllers/admin/deleteUsers.php', 2],
    'admin/gebruikers/aanmaken' => ['controllers/admin/createUsers.php', 2],
    'admin/gebruikers/bewerken' => ['controllers/admin/updateUsers.php', 2],

    'admin/bestellingen' => ['controllers/admin/viewOrders.php', 2]
]);
