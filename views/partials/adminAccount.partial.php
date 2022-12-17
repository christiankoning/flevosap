<h2 class="card-title ms-1">Account</h2>
<div class="card-body">
    <h5 class="card-title">Email: <a href="<?=Request::buildUri("/profiel/veranderemailaanvragen")?>">wijzigen</a></h5>
    <p class="card-text"><?=$user['email']?></p>
    <h5 class="card-title">Wachtwoord: <a href="<?=Request::buildUri("/profiel/veranderwachtwoord")?>">wijzigen</a></h5>
    <p class="card-text">******</p>
</div>