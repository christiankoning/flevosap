<?php
require("views/partials/head.partial.php");
?>

    <div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card changeaccount ">
                <h2 class="card-title ms-1">Wachtwoord wijzigen</h2>
                <div class="card-body">
                    <form action="<?=Request::buildUri("/profiel/veranderwachtwoord")?>" method="POST">
                        <h5 class="card-title">Oude wachtwoord:</h5>
                        <p class="card-text">
                            <input type="password" name="oldPassword" placeholder="oude wachtwoord">
                        </p>
                        <h5 class="card-title">Nieuwe wachtwoord:</h5>
                        <p class="card-text">
                            <input type="password" name="password" placeholder="nieuwe wachtwoord">
                        </p>
                        <p class="card-text">
                            <input type="password" name="repeatPassword" placeholder="herhaal wachtwoord">
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