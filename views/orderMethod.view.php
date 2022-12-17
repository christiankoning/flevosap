<?php
require("views/partials/head.partial.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row mb-2">
                <div class="col-2"></div>
                <div class="col-8">
                <h2 class="row mx-2 text-danger justify-content-left">Bestellen</h2>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card text-center">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-3">
                                <div class="row">
                                <a href="<?=Request::buildUri("/login")?>" class="btn btn-danger">Inloggen</a>
                                <a href="<?=Request::buildUri("/registreren")?>" class="card-link">Geen account?</a>
                                </div>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-3"><a href="<?=Request::buildUri("/betalen")?>" class="btn btn-danger">Zonder account verder</a></div>
                            <div class="col-2"></div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</div>

<?php
require("partials/foot.partial.php");
?>
