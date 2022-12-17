<?php
require 'views/partials/admin/adminhead.partial.php'
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card ">
                <h2 class="card-title ms-1">Bestellingen</h2>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                <span class="badge bg-danger">In behandeling</span>
                            </button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                                <span class="badge bg-warning">Verstuurd</span>
                            </button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                                <span class="badge bg-success">Bezorgd</span>
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <?php
                                if (empty($ordersBusy['msg'])) {
                                    echo '<div class="card-text">';
                                    echo 'Geen bestellingen';
                                    echo '</div>';
                                }
                                else {
                                    echo '<div class="accordion" id="accordionExample">';
                                    foreach ($ordersBusy['msg'] as $order) {
                                        require('views/partials/admin/order.partial.php');
                                    }
                                    echo '</div>';
                                }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <?php
                            if (empty($ordersSend['msg'])) {
                                echo '<div class="card-text">';
                                echo 'Geen bestellingen';
                                echo '</div>';
                            }
                            else {
                                echo '<div class="accordion" id="accordionExample">';
                                foreach ($ordersSend['msg'] as $order) {
                                    require('views/partials/admin/order.partial.php');
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <?php
                            if (empty($ordersDone['msg'])) {
                                echo '<div class="card-text">';
                                echo 'Geen bestellingen';
                                echo '</div>';
                            }
                            else {
                                echo '<div class="accordion" id="accordionExample">';
                                foreach ($ordersDone['msg'] as $order) {
                                    require('views/partials/admin/order.partial.php');
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<?php
require 'views/partials/foot.partial.php'
?>