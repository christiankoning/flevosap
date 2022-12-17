<?php
require("views/partials/head.partial.php");
?>

    <div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card changeaccount ">
                <h2 class="card-title ms-1">Wachtwoord vergeten</h2>
                <div class="card-body">
                    <form action="<?=Request::buildUri("/wachtwoordveranderen")?>" method="POST">
                        <h5 class="card-title">Email:</h5>
                        <p class="card-text">
                            <input type="text" name="email" placeholder="email" value="<?=$email?>" readonly="readonly">
                        </p>
                        <h5 class="card-title">Code:</h5>
                        <p class="card-text">
                            <input type="text" name="code" placeholder="code" value="<?=$code?>" readonly="readonly">
                        </p>
                        <h5 class="card-title">Nieuwe wachtwoord:</h5>
                        <p class="card-text">
                            <input type="password" name="password" placeholder="wachtwoord">
                        </p>
                        <p class="card-text">
                            <input type="password" name="repeatPassword" placeholder="herhaal wachtwoord">
                        </p>
                        <button type="submit" class="btn btn-danger">Opslaan</button>
                    </form>
                    <a href="<?=Request::buildUri("/login")?>" class="text-danger">Annuleren</a>
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