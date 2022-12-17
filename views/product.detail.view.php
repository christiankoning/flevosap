<?php
require("views/partials/head.partial.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="row">
            <div class="col"></div>
            <div class="col-7"><h1><?= $product['name']?></h1></div>
            <div class="col"></div>
        </div>
        <div class="row mb-2">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="card detailCard">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="<?=Request::buildUri("/public/img/uploads/")?><?= $product['productImg']?>" class="card-img-left w-100 img-thumbnail detailImg"
                                     alt="Product foto">
                            </div>
                            <div class="col-8">
                                <h5 class="card-title"><b><?= $product['name']?></b></h5>
                                <p class="card-text detailDesc"><?= $product['description']?>
                                </p>
                                    <form method="post" action="" class="me-auto">
                                        <input type="hidden" value="<?= $product['id'] ?>" name="id">
                                        <input type="hidden" value="<?= $product['name'] ?>" name="name">
                                        <input type="hidden" value="<?= $product['description'] ?>" name="desc">
                                        <input type="hidden" value="1" name="amount">
                                        <input type="hidden" value="<?= $product['price'] ?>" name="price">
                                        <input type="hidden" value="<?= $product['productImg'] ?>" name="image">
                                        <input type="hidden" value="<?= $product['stock'] ?>" name="stock">
                                        <div class="row mt-4 align-items-center detailRowBottom">
                                            <ul class="col-6 nutritionalValues">
                                                <li>Voedingswaarden per 100 gram:</li><br>
                                                <li>Energie: <?= $nutrition['energy']?> kcal</li><br>
                                                <li>Vetten: <?= $nutrition['fats']?> g</li><br>
                                                <li>Waarvan verzadigd: <?= $nutrition['saturated']?> g</li><br>
                                                <li>Koolhydraten: <?= $nutrition['carbohydrates']?> g</li><br>
                                                <li>Waarvan suikers: <?= $nutrition['sugars']?> g</li><br>
                                                <li>Eiwitten: <?= $nutrition['protein']?> g</li><br>
                                                <li>Zout: <?= $nutrition['salt']?> g</li><br>
                                            </ul>
                                            <div class="col-6 detailButton d-flex align-items-center">
                                                <span class="col-6 priceText" <?= ($product['stock'] > 0) ? '' : 'style="font-size: 1rem;"' ?>><?= ($product['stock'] > 0) ? '€ '.$product['price'] : 'Uitverkocht' ?></span>
                                                <?php if($product['stock'] > 0){
                                                ?>
                                                <button class="detailAddToBasket" name="addToCart" type="submit">
                                                    <img class="plusIcon" src="<?=Request::buildUri("/public/img/icons/plus.svg")?>">
                                                    <img class="basketIcon" src="<?=Request::buildUri("/public/img/icons/basket.svg")?>">
                                                </button>
                                                <?php }
                                                else{
                                                ?>
                                                    <button class="detailDisableToBasket" name="addToCart" disabled type="submit">
                                                        <img class="basketIcon" src="<?=Request::buildUri("/public/img/icons/basket.svg")?>">
                                                    </button>
                                                <?php }?>
                                                <input type="hidden" name="productId" value="<?= $product['id']?>">
                                            </div>
                                        </div>
                                    </form>
                                <div class="col-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>
<?php
require("views/partials/foot.partial.php");
?>
