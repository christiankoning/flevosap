<?php
require("views/partials/head.partial.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="row">
            <div class="col"></div>
            <div class="col-7"><h1><?= $category['name']?></h1></div>
            <div class="col">
                <form method="post" id="orderByForm">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter
                    </button>
                    <ul class="dropdown-menu" id="filter" aria-labelledby="dropdownMenuButton1">
                        <li class="dropdown-item" id="ASC">A-Z</li>
                        <li class="dropdown-item" id="DESC">Z-A</li>
                        <li class="dropdown-item" id="priceHigh">Prijs van hoog naar laag</li>
                        <li class="dropdown-item" id="priceLow">Prijs van laag naar hoog</li>
                    </ul>
                </div>
                    <input type="hidden" id="filterInput" name="orderBy" value="">
                    <input type="hidden" name="categoryId" value="<?= $category['id']?>">
                </form>
            </div>
        </div>
        <?php
        if ($noProducts) {
            ?>
            <div class="row mb-2">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-text">
                                <h2 class="h2"> Op dit moment zijn er geen producten voor deze categorie </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            <?php
        } else {
            foreach ($products as $product) {
                require("partials/products.partial.php");
            }
        }
        ?>
    </div>
</div>
    <script src="public/js/index.js"></script>
<?php
require("views/partials/foot.partial.php");
?>