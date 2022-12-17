<h2 class="card-title ms-1">Klanten account</h2>
<div class="card-body">
    <h5 class="card-title">Email: <a href="<?=Request::buildUri("/profiel/veranderemailaanvragen")?>">wijzigen</a></h5>
    <p class="card-text"><?=$user['email']?></p>
    <h5 class="card-title">Wachtwoord: <a href="<?=Request::buildUri("/profiel/veranderwachtwoord")?>">wijzigen</a></h5>
    <p class="card-text">******</p>
    <h5 class="card-title">Volledige Naam: <a href="<?=Request::buildUri("/profiel/veranderklant")?>">wijzigen</a></h5>
    <p class="card-text">
        <?php
            if ($customer["salutation"] === '3') {
                echo 'Mevrouw <br>';
            }
            else if ($customer["salutation"] === '2') {
                echo 'De heer <br>';
            }
        ?>
        <?=$customer["firstName"]?>
        <?=$customer["insertion"]?>
        <?=$customer["lastName"]?>
    </p>
    <h5 class="card-title">Telefoonnummer: <a href="<?=Request::buildUri("/profiel/veranderklant")?>">wijzigen</a></h5>
    <p class="card-text"><?=(!empty($customer["phoneNumber"]) ? $customer["phoneNumber"] : 'Onbekend')?></p>
    <h5 class="card-title">Geboortedatum: <a href="<?=Request::buildUri("/profiel/veranderklant")?>">wijzigen</a></h5>
    <p class="card-text"><?=(!empty($customer["birthDate"]) ? date_format(date_create($customer["birthDate"]), 'd-m-Y') : 'Onbekend')?></p>

    <h5 class="card-title">Adres: <a href="<?=Request::buildUri("/profiel/veranderklant")?>">wijzigen</a></h5>
    <p class="card-text">
        <?=$customer["streetName"]?>
        <?=$customer["houseNumber"].$customer["houseNumberAddition"]?>
        <br>
        <?=$customer["postalCode"]?>
        <?=$customer["place"]?>
    </p>
</div>