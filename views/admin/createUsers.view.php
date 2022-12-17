<?php
require 'views/partials/admin/adminhead.partial.php'
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card changeaccount">
                <h2 class="card-title ms-1">Gebruiker Aanmaken</h2>
                <div class="card-body">
                    <form action="<?=Request::buildUri("/admin/gebruikers/aanmaken")?>" method="POST">
                        <h5 class="card-title">Email:</h5>
                        <p class="card-text">
                            <input type="text" name="userEmail" placeholder="email">
                        </p>
                        <h5 class="card-title">Wachtwoord:</h5>
                        <p class="card-text">
                            <input type="password" name="userPsw" placeholder="wachtwoord">
                        </p>
                        <h5 class="card-title">Wachtwoord herhalen:</h5>
                        <p class="card-text">
                            <input type="password" name="userPsw2" placeholder="wachtwoord">
                        </p>
                        <h5 class="card-title">Rol:</h5>
                        <p class="card-text">
                            <select id="isAdmin" name="isAdmin">
                                <option value="1">Beheerder</option>
                                <option value="0" selected>Gebruiker</option>
                            </select>
                        </p>
                        <button type="submit" class="btn btn-danger">Opslaan</button>
                        <a href="<?=Request::buildUri("/admin/gebruikers")?>" class="text-danger">Annuleren</a>
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
require 'views/partials/foot.partial.php'
?>