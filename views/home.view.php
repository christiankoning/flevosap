<?php
require 'views/partials/head.partial.php'
?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card text-center">
                <div class="card-body">
                    <h1 class="card-title text-danger">Welkom op de flevosap webshop</h1>
                    <p class="card-text ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, cum
                        dicta dolore dolorem enim excepturi expedita facere fugit incidunt laborum neque odio, quia
                        quo, sapiente suscipit voluptatem voluptates. Accusamus, alias!</p>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <h2 class="text-danger">Uitgelicht</h2>
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                        $c = 0;
                        foreach ($featuredProducts as $featuredProduct) {
                    ?>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?=$c?>" <?= $c === 0 ? 'class="active" aria-current="true"' : '' ?> aria-label="Slide <?=$c?>"></button>
                    <?php
                            $c = $c + 1;
                        }
                    ?>
                </div>
                <div class="carousel-inner">
                    <?php
                    if ($noFeaturedProducts) {
                        ?>
                        <div class="carousel-item active">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Geen prodcuten</h5>
                                <p>Op dit moment zijn er geen producten beschikbaar probeert u het later nog
                                    eens</p>
                            </div>
                        </div>
                        <?php
                    } else {
                        foreach ($featuredProducts as $featuredProduct) {
                            ?>
                            <div class="carousel-item <?= $featuredProducts[0] === $featuredProduct ? 'active' : '' ?>">
                                <div class="carousel-caption d-none d-md-block">
                                    <img src="<?=Request::buildUri("/public/img/uploads/")?><?= $featuredProduct['productImg'] ?>"
                                         class="w-25 img-thumbnail productImg" alt="Product foto">
                                    <h5><?= $featuredProduct['name'] ?></h5>
                                    <p><?= $featuredProduct['description'] ?></p>
                                    <form method="post" action="<?=Request::buildUri("/producten/detail")?>">
                                        <input type="hidden" name="productId"
                                               value="<?= $featuredProduct['id'] ?>">
                                        <button type="submit" class="btn btn-danger">Ga naar product</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>


<?php
require 'views/partials/foot.partial.php'
?>
