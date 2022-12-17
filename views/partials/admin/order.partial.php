<div class="accordion-item">
    <h2 class="accordion-header" id="heading<?=$order['id']?>">
        <button class="accordion-button collapsed flex-column align-items-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$order['id']?>" aria-expanded="false" aria-controls="collapse<?=$order['id']?>">
            <span><?='Bestelnummer: #'.$order['id']?></span>
            <br>
            <span><?='Besteldatum: '.$order['order_date']?></span>
        </button>
    </h2>
    <div id="collapse<?=$order['id']?>" class="accordion-collapse collapse" aria-labelledby="heading<?=$order['id']?>" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <h5>Status:</h5>
            <form action="<?=Request::buildUri("/admin/bestellingen")?>" method="post">
                <input type="hidden" value="<?=$order['id']?>" name="id">
                <div class="input-group">
                    <select name="status" class="form-select" id="inputGroupSelect" aria-label="Example select with button addon">
                        <option <?=($order['status'] === 'busy') ? 'selected' : ''?> value="busy">In behandeling</option>
                        <option <?=($order['status'] === 'send') ? 'selected' : ''?> value="send">Verstuurd</option>
                        <option <?=($order['status'] === 'done') ? 'selected' : ''?> value="done">Bezorgd</option>
                    </select>
                    <button class="btn btn-outline-secondary" type="submit">Opslaan</button>
                </div>
            </form>
            <hr>
            <h5>Contact gegevens:</h5>
            <p>
                <?=$order["email"]?>
                <br>
                <?php
                if (!empty($order["phoneNumber"])) {
                    echo $order["phoneNumber"];
                }
                ?>
            </p>
            <hr>
            <h5>Adres:</h5>
            <p>
                <?=$order["firstName"]?>
                <?=$order["insertion"]?>
                <?=$order["lastName"]?>
                <br>
                <?=$order["streetName"]?>
                <?=$order["houseNumber"].$order["addition"]?>
                <br>
                <?=$order["postalCode"]?>
                <?=$order["city"]?>
            </p>
            <hr>
            <h5>Producten:</h5>
            <div class="table-responsive">
                <table class="table table-striped text-nowrap">
                    <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Aantal</th>
                        <th scope="col">Prijs</th>
                        <th scope="col" class="text-end">Totaal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($order['products'])) {
                        foreach ($order['products'] as $product) {
                            require('views/partials/admin/order.product.partial.php');
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="d-flex justify-content-end flex-nowrap">
                <div class="d-flex align-items-end flex-column">
                    <span>
                        <strong>Subtotaal:</strong>&nbsp;
                    </span>
                    <span>
                        <strong>Btw:</strong>&nbsp;
                    </span>
                    <span>
                        <strong>Totaal:</strong>&nbsp;
                    </span>
                </div>
                <div class="d-flex align-items-end flex-column">
                    <span>
                        &euro; <?=$order["subtotal"]?>
                    </span>
                    <span>
                        <?=$order['btwDisplay']?>
                    </span>
                    <span>
                        &euro; <?=$order["total"]?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>