<?php
require("views/partials/head.partial.php");
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card accountinfo">
                <?php
                    if ($user['type'] === '0') {
                        require("views/partials/adminAccount.partial.php");
                    }
                    if ($user['type'] === '1') {
                        require("views/partials/account.partial.php");
                    }
                    if ($user['type'] === '2') {
                        require("views/partials/commercialAccount.partial.php");
                    }
                ?>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card ">
                <h2 class="card-title ms-1">Bestellingen</h2>
                <div class="card-body">
                    <?php
                        if (empty($orders['msg'])) {
                            echo '<div class="card-text">';
                            echo 'Geen bestellingen';
                            echo '</div>';
                        }
                        else {
                            echo '<div class="accordion" id="accordionExample">';
                            foreach ($orders['msg'] as $order) {
                                require('views/partials/order.partial.php');
                            }
                            echo '</div>';
                        }
                    ?>

                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>
<?php
require("views/partials/foot.partial.php");
?>