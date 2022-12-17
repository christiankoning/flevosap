<div class="row mb-2">
    <div class="col-2"></div>
    <div class="col-8">
        <a href="#" class="productCard" onclick="document.getElementById('<?= $product['id']?>').submit();">
            <form id="<?= $product['id']?>" method="post" action="<?=Request::buildUri("/producten/detail")?>">
                <input type="hidden" value="<?= $product['id']?>" name="productId">
            </form>
            <div class="card"><input type="hidden" name="productId">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <img src="<?=Request::buildUri("/public/img/uploads/")?><?= $product['productImg'] ?>"
                                 class="card-img-left w-100 img-thumbnail productImg" alt="Product foto">
                        </div>
                        <div class="col-7">
                            <h5 class="card-title"><b><?= $product['name'] ?></b></h5>
                            <p class="card-text productDesc"><?= $product['description'] ?>
                            </p>
                        </div>
                        <div class="col-3">

                            <form method="post">
                                    <input type="hidden" value="<?= $product['id'] ?>" name="id">
                                    <input type="hidden" value="<?= $product['name'] ?>" name="name">
                                    <input type="hidden" value="<?= $product['description'] ?>" name="desc">
                                    <input type="hidden" value="1" name="amount">
                                    <input type="hidden" value="<?= $product['price'] ?>" name="price">
                                    <input type="hidden" value="<?= $product['productImg'] ?>" name="image">
                                    <input type="hidden" value="<?= $product['stock'] ?>" name="stock">
                                <div class="row mt-4 align-items-center">
                                    <span for="amount" class="col-6 col-form-label priceText" <?= ($product['stock'] > 0) ? '' : 'style="font-size: 1rem;"' ?>><?= ($product['stock'] > 0) ? '€ '.$product['price'] : 'Uitverkocht' ?></span>
                                    <div class="col-6"><?php if($product['stock'] > 0){
                                        ?>
                                        <button class="addToBasket" name="addToCart" type="submit">
                                            <img class="plusIcon" src="<?=Request::buildUri("/public/img/icons/plus.svg")?>">
                                            <img class="basketIcon" src="<?=Request::buildUri("/public/img/icons/basket.svg")?>">
                                        </button>
                                        <?php }
                                        else{
                                        ?>
                                        <button class="disableToBasket" name="addToCart" disabled type="submit">
                                            <img class="basketIcon" src="<?=Request::buildUri("/public/img/icons/basket.svg")?>">
                                        </button>
                                        <?php }?>
                                        <input type="hidden" name="categoryId" value="<?= $category['id']?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
<div class="col-2"></div>