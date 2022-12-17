<?php
require 'views/partials/head.partial.php'
?>

<div class="container-fluid" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="container">
            <div class="row mb-2">
                <div class="col-2"></div>
                <div class="col-8">
                    <h2 class="row mx-2 text-danger justify-content-left">Je bestelling is voltooid</h2>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row mb-2">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="card-title">
                                    <h2 class="h2"> Bedankt voor je bestelling!</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-text">
                                    <p> Er is een e-mail met een overzicht van uw bestelling verstuurd naar <span class="text-secondary
"> <?= $email ?></span>.</p>
                                </div>
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
require 'views/partials/foot.partial.php'
?>
