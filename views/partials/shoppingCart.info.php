<div class="row mb-2">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <img src="<?=Request::buildUri("/public/img/uploads/")?><?=$item['image'] ?>" alt="product image"
                             class="card-img-top w-100 img-thumbnail  align-items-center mx-auto m-2">
                    </div>
                    <div class="col-6">
                        <div class="row"><?= $item['name']; ?></div>
                        <div class="row"><?= $item['desc']; ?></div>
                    </div>
                    <div class="col-2">
                        <form method="post">
                            <div class="row mt-2">
                                <input type="hidden" name="amountChanged" value="1">
                                <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                <label for="amount" class="col-6 col-form-label">aantal: </label>
                                <div class="col-6">
                                    <input onchange="this.form.submit()" type="number" class="w-75" min="1" max="<?=$item['stock'];?>"
                                           name="amount"
                                           value="<?= $item['amount']; ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">
                        <div class="row d-flex justify-content-end">€ <?= number_format((float)$item['price'], 2, ',', '');?></div>
                        <form method="post">
                            <div class="row mt-1">
                                <input type="hidden" name="deleteItem" value="1">
                                <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                <label for="delete" class="col-8 col-form-label .d-none .d-md-block .d-lg-none">verwijder</label>
                                <div class="col-4">
                                    <button class="" name="delete" type="submit"><img
                                                src="<?=Request::buildUri("/public/img/icons/trashcan.svg")?>">
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>
