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
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="normalOrder-tab" data-bs-toggle="tab"
                                    data-bs-target="#normalOrder"
                                    type="button" role="tab" aria-controls="normalOrder" aria-selected="true">Normale
                                Bestelling
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link disabled" id="idealOrder-tab" data-bs-toggle="tab"
                                    data-bs-target="#idealOrder"
                                    type="button" role="tab" aria-controls="idealOrder" aria-disabled="true"
                                    aria-selected="false">
                                Betalen via ideal (op dit moment niet beschikbaar)
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="normalOrder" role="tabpanel"
                             aria-labelledby="normalOrder-tab">
                            <div class="row">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <form class="row" method="post" action="<?=Request::buildUri("/betalen")?>">
                                            <div class="col-6">
                                                <div class="row">
                                                    <!--Hidden Order confirm post variable-->
                                                    <input type="hidden" id="orderConfirmed"
                                                           name="orderConfirmed"
                                                            value="orderConfirmed" />
                                                    <!--Full name-->
                                                    <label for="firstName" class="form-label">Volledige naam:</label>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" id="firstName"
                                                               name="firstName"
                                                               placeholder="Voornaam *" value="<?= $firstName ?>" />
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" id="insertion"
                                                               name="insertion"
                                                               placeholder="Tussenvoegsel" value="<?= $insertion ?>"/>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" id="lastName"
                                                               name="lastName"
                                                               placeholder="Achternaam *" value="<?= $lastName ?>"/>
                                                    </div>
                                                    <!--end of full name-->

                                                    <!--Email-->
                                                    <label for="email" class="form-label">Email:</label>
                                                    <div class="col-12">
                                                        <input type="email" class="form-control" id="email" name="email"
                                                               placeholder="example@gmail.com *" value="<?= $email ?>"/>
                                                    </div>
                                                    <!--end of Email-->

                                                    <!--Telephone-->
                                                    <label for="tel" class="form-label">Telefoonnummer:</label>
                                                    <div class="col-12">
                                                        <input type="tel" class="form-control" id="tel" name="tel"
                                                               placeholder="+31 6 12345678" value="<?= $tel ?>"/>
                                                    </div>
                                                    <!--end of Telephone-->

                                                    <!--Adress-->
                                                    <label for="postalCode" class="form-label">Adres:</label>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" id="postalCode"
                                                               name="postalCode"
                                                               placeholder="Postcode *" value="<?= $postalCode ?>"/>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" id="houseNumber"
                                                               name="houseNumber"
                                                               placeholder="Huisnummer *" value="<?= $houseNumber ?>"/>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" id="addition"
                                                               name="addition"
                                                               placeholder="Toevoeging" value="<?= $addition ?>"/>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" id="streetName"
                                                               name="streetName"
                                                               placeholder="Straatnaam *" value="<?= $streetName ?>"/>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" id="residence"
                                                               name="residence"
                                                               placeholder="Woonplaats *" value="<?= $residence ?>"/>
                                                    </div>
                                                    <!--end of Adress-->
                                                    <small id="requiredHelp" class="form-text text-muted">*
                                                        verplicht</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="row">
                                                    <h3><b>Overzicht</b></h3>
                                                    <h6>Artikelen: <?= $SIZE ?></h6>
                                                    <h6>Betaal methode: bestelling</h6>
                                                    <hr>
                                                    <h6>Subtotaal:
                                                        € <?= number_format((float)$PRICE, 2, ',', '') ?></h6>
                                                    <h6>Btw:
                                                        <?=$btwDisplay?></h6>
                                                    <h6>Totaal:
                                                        € <?= number_format((float)$TOTALPRICE, 2, ',', '') ?></h6>
                                                </div>
                                                <div class="row mt-5">
                                                    <button type="submit"
                                                            class="btn btn-danger" <?= $PRICE > 0 ? '' : 'disabled' ?>>
                                                        Bestelling afronden
                                                    </button>
                                                </div>
                                                <?php
                                                if (!empty($error)) {
                                                    echo '<div class="mt-2 alert alert-danger" role="alert">' . $error .
'</div>';
                                                }

                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="idealOrder" role="tabpanel"
                         aria-labelledby="idealOrder-tab"></div>
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
