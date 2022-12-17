<?php
require("views/partials/head.partial.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row mb-2">
                <div class="col-2"></div>
                <div class="col-8">
                    <h2 class="row mx-2 text-danger justify-content-left">Winkelmandje</h2>
                </div>
                <div class="col-2"></div>
            </div>
            <?php

            if ($noItems) {
                ?>
                <div class="row mb-2">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-text">
                                    <h2 class="h2"> Op dit moment zitten er geen producten in uw winkelmandje! </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </div>

                <?php
            } else {
                foreach ($stmt as $item) {
                    require("partials/shoppingCart.info.php");
                }
            }
            ?>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8"></div>
                                <div class="col-4">
                                    <div class="row ">
                                        <p class="card-text d-flex justify-content-end"> Subtotaal
                                            € <?= number_format((float)$subtotalPrice, 2, ',', '') ?></p>
                                    </div>
                                    <div class="row ">
                                        <p class="card-text d-flex justify-content-end"> Btw
                                            <?=$btwDisplay?></p>
                                    </div>
                                    <div class="row ">
                                        <p class="card-text d-flex justify-content-end"> Totaal
                                            € <?= number_format((float)$totalPrice, 2, ',', '') ?></p>
                                    </div>
                                    <div class="row">
                                        <a <?= !Auth::isLoggedIn() ? 'href="'.Request::buildUri("/bestelling-methode").'"' : 'href="'.Request::buildUri("/betalen").'"' ?>class="btn btn-danger <?= $totalPrice > 0 ? '' : 'disabled' ?> d-inline float-right">
                                            Verder naar bestellen</a>
                                    </div>
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
require("views/partials/foot.partial.php");

?>
