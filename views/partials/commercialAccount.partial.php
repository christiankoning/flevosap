<h2 class="card-title ms-1">Bedrijfs account</h2>
<div class="card-body">
    <h5 class="card-title">Email: <a href="<?=Request::buildUri("/profiel/veranderemail")?>">wijzigen</a></h5>
    <p class="card-text"><?=$user['email']?></p>
    <h5 class="card-title">Wachtwoord: <a href="<?=Request::buildUri("/profiel/veranderwachtwoordaanvragen")?>">wijzigen</a></h5>
    <p class="card-text">******</p>
    <h5 class="card-title">Volledige Naam: <a href="<?=Request::buildUri("/profiel/veranderbedrijf")?>">wijzigen</a></h5>
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
    <h5 class="card-title">Telefoonnummer: <a href="<?=Request::buildUri("/profiel/veranderbedrijf")?>">wijzigen</a></h5>
    <p class="card-text"><?=(!empty($customer["phoneNumber"]) ? $customer["phoneNumber"] : 'Onbekend')?></p>

    <h5 class="card-title">Adres: <a href="<?=Request::buildUri("/profiel/veranderbedrijf")?>">wijzigen</a></h5>
    <p class="card-text">
        <?=$customer["streetName"]?>
        <?=$customer["houseNumber"].$customer["houseNumberAddition"]?>
        <br>
        <?=$customer["postalCode"]?>
        <?=$customer["place"]?>
    </p>

    <h5 class="card-title">Bedrijfsnaam: <a href="<?=Request::buildUri("/profiel/veranderbedrijf")?>">wijzigen</a></h5>
    <p class="card-text">
        <?=$customer["companyName"]?>
    </p>
    <h5 class="card-title">Kvk-nummer: <a href="<?=Request::buildUri("/profiel/veranderbedrijf")?>">wijzigen</a></h5>
    <p class="card-text">
        <?=$customer["kvkNumber"]?>
    </p>
    <h5 class="card-title">Btw-nummer: <a href="<?=Request::buildUri("/profiel/veranderbedrijf")?>">wijzigen</a></h5>
    <p class="card-text">
        <?=$customer["btwNumber"]?>
    </p>
</div>