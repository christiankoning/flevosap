<?php
require("views/partials/head.partial.php");
?>

    <div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card changeaccount ">
                <h2 class="card-title ms-1">Bedrijfs account wijzigen</h2>
                <div class="card-body">
                    <form action="<?=Request::buildUri("/profiel/veranderbedrijf")?>" method="POST">
                        <h5 class="card-title">Aanhef:</h5>
                        <p class="card-text">
                            <span>De heer</span>
                            <input type="radio" name="salutation" value="2" <?= ($customer['salutation'] === '2' ) ? 'checked' : '' ?>>
                            <br>
                            <span>Mevrouw</span>
                            <input type="radio" name="salutation" value="3" <?= ($customer['salutation'] === '3' ) ? 'checked' : '' ?>>
                            <br>
                            <span>Liever geen van beide</span>
                            <input type="radio" name="salutation" value="1" <?= ($customer['salutation'] === '1' ) ? 'checked' : '' ?>>
                        </p>

                        <h5 class="card-title">Volledige Naam:</h5>
                        <p class="card-text">
                            <input placeholder="Voornaam" type="text" name="firstName" value="<?=$customer['firstName']?>">
                            <input placeholder="Tussenvoegsel" type="text" name="insertion" value="<?=$customer['insertion']?>">
                            <input placeholder="Achternaam" type="text" name="lastName" value="<?=$customer['lastName']?>">
                        </p>

                        <h5 class="card-title">Telefoonnummer:</h5>
                        <p class="card-text">
                            <input placeholder="Telefoonnummer" type="tel" name="phoneNumber" value="<?=$customer['phoneNumber']?>">
                        </p>

                        <h5 class="card-title">Address:</h5>
                        <p class="card-text">
                            <input placeholder="Straatnaam" type="text" name="streetName" value="<?=$customer['streetName']?>">
                            <input placeholder="Huisnummer" type="number" name="houseNumber" value="<?=$customer['houseNumber']?>">
                            <input placeholder="Huisnummer toevoeging" type="text" name="houseNumberAddition" value="<?=$customer['houseNumberAddition']?>">
                            <br>
                            <input placeholder="Postcode" type="text" name="postalCode" value="<?=$customer['postalCode']?>">
                            <input placeholder="Plaats" type="text" name="place" value="<?=$customer['place']?>">
                        </p>

                        <h5 class="card-title">Bedrijfs gegevens:</h5>
                        <p class="card-text">
                            <input placeholder="KVK nummer" type="number" name="kvkNumber" value="<?=$customer['kvkNumber']?>">
                            <input placeholder="Bedrijfsnaam" type="text" name="companyName" value="<?=$customer['companyName']?>">
                            <input placeholder="BTW nummer" type="text" name="btwNumber" value="<?=$customer['btwNumber']?>">
                        </p>
                        <button type="submit" class="btn btn-danger">Opslaan</button>
                    </form>
                    <a href="<?=Request::buildUri("/profiel")?>" class="text-danger">Annuleren</a>
                </div>
                <?php
                if (!empty($error)) {
                    ?>
                    <div class="card-footer bg-danger">
                        <small class="text-white"><?=$error?></small>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
<?php
require("views/partials/foot.partial.php");
?>