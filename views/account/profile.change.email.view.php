<?php
require("views/partials/head.partial.php");
?>

    <div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card">
                <h2 class="card-title ms-1"><?=$header?></h2>
                <div class="card-body">
                    <p class="card-text"><?=$info?></p>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

<?php
require("views/partials/foot.partial.php");
?>