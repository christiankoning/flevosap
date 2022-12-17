
<?php
require("views/partials/head.partial.php");
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card changeaccount">
                <h2 class="card-title ms-1">login</h2>
                <div class="card-body">
                    <form action="<?=Request::buildUri("/login")?>" method="POST">
                        <h5 class="card-title">Email:</h5>
                        <p class="card-text">
                            <input type="text" name="email" placeholder="email" value="<?=$email?>">
                            <br>
                            <a href="<?=Request::buildUri("/registreren")?>" class="text-danger">Geen account?</a>
                        </p>
                        <h5 class="card-title">Wachtwoord:</h5>
                        <p class="card-text">
                            <input type="password" name="psw" placeholder="wachtwoord">
                            <br>
                            <a href="<?=Request::buildUri("/wachtwoordvergeten")?>" class="text-danger">Wachtwoord vergeten?</a>
                        </p>
                        <button type="submit" class="btn btn-danger">Login</button>
                    </form>
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
        </div>
        <div class="col-2"></div>
    </div>
</div>


<?php
require("views/partials/foot.partial.php");
?>