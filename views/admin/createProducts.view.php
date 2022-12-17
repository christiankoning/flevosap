<?php
require 'views/partials/admin/adminhead.partial.php'
?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card changeaccount">
                <h2 class="card-title ms-1">Product Aanmaken</h2>
                <div class="card-body">
                    <form action="<?=Request::buildUri("/admin/producten/toevoegen")?>" enctype="multipart/form-data" method="POST">
                        <h5 class="card-title">Product naam:</h5>
                        <p class="card-text">
                            <input type="text" name="productName" placeholder="Product naam">
                        </p>
                        <h5 class="card-title">Omschrijving:</h5>
                        <p class="card-text">
                            <textarea value="" name="productDesc"></textarea>
                        </p>
                        <h5 class="card-title">Afbeelding:</h5>
                        <p class="card-text">
                            <input type="file" accept="image/*" name="productImg[]">
                        </p>
                        <h5 class="card-title">Categorie:</h5>
                        <p class="card-text">
                            <select name="categoryId"><?php
                                foreach ($categories as $category)
                                {
                                    echo "<option value='".$category['id']."'>".$category['name']."</option>";

                                }
                                ?>
                            </select>
                        </p>
                        <h5 class="card-title">Aanbevolen:</h5>
                        <p class="card-text">
                            <select name="isFeatured">
                                <option value="1">Ja</option>
                                <option value="0" selected>Nee</option>
                            </select>
                        </p>
                        <h5 class="card-title">Prijs:</h5>
                        <p class="card-text">
                            <input type="number" value ="0" step="0.01" name="productPrice">
                        </p>
                        <h5 class="card-title">Voorraad:</h5>
                        <p class="card-text">
                            <input type="number" value ="0" name="productStock">
                        </p>
                        <h5 class="card-title">Energie (kcal per 100 gram):</h5>
                        <p class="card-text">
                            <input type="number" value ="0" step="0.01" name="nutritionEnergy">
                        </p>
                        <h5 class="card-title">Vetten (per 100 gram):</h5>
                        <p class="card-text">
                            <input type="number" value ="0" step="0.01" name="nutritionFats">
                        </p>
                        <h5 class="card-title">Waarvan verzadigd (per 100 gram):</h5>
                        <p class="card-text">
                            <input type="number" value ="0" step="0.01" name="nutritionSaturated">
                        </p>
                        <h5 class="card-title">Koolhydraten (per 100 gram):</h5>
                        <p class="card-text">
                            <input type="number" value ="0" step="0.01" name="nutritionCarbs">
                        </p>
                        <h5 class="card-title">Waarvan suikers (per 100 gram):</h5>
                        <p class="card-text">
                            <input type="number" value ="0" step="0.01" name="nutritionSugars">
                        </p>
                        <h5 class="card-title">Eiwitten (per 100 gram):</h5>
                        <p class="card-text">
                            <input type="number" value ="0" step="0.01" name="nutritionProtein">
                        </p>
                        <h5 class="card-title">Zout (per 100 gram):</h5>
                        <p class="card-text">
                            <input type="number" value ="0" step="0.01" name="nutritionSalt">
                        </p>

                        <button type="submit" class="btn btn-danger">Opslaan</button>
                        <a href="<?=Request::buildUri("/admin/producten")?>" class="text-danger">Annuleren</a>
                    </form>
                </div>
                <?php
                if (!empty($error)) {
                    ?>
                    <div class="card-footer bg-danger">
                        <small class="text-white"><?=$error?></small>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>

    <?php
    require 'views/partials/foot.partial.php'
    ?>

