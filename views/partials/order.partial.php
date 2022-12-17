<div class="accordion-item">
    <h2 class="accordion-header" id="heading<?=$order['id']?>">
        <button class="accordion-button collapsed flex-column align-items-start" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$order['id']?>" aria-expanded="false" aria-controls="collapse<?=$order['id']?>">
            <?=$order['status']?>
            <br>
            <span><?='Bestelnummer: #'.$order['id']?></span>
            <br>
            <span><?='Besteldatum: '.$order['order_date']?></span>
        </button>
    </h2>
    <div id="collapse<?=$order['id']?>" class="accordion-collapse collapse" aria-labelledby="heading<?=$order['id']?>" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <h5>Contact gegevens:</h5>
            <p>
                <?=$user["email"]?>
                <br>
                <?php
                    if (!empty($customer["phoneNumber"])) {
                        echo $customer["phoneNumber"];
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
                                require('views/partials/order.product.partial.php');
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
                        <?=$btwDisplay?>
                    </span>
                    <span>
                        &euro; <?=$order["total"]?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>