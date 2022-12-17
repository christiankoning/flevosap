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
                    <form action="<?=Request::buildUri("/wachtwoordvergeten")?>" method="POST">
                        <h5 class="card-title">Email:</h5>
                        <p class="card-text">
                            <input type="text" name="email" placeholder="email" value="<?=$email?>">
                        </p>
                        <button type="submit" class="btn btn-danger">Aanvragen</button>
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