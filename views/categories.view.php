
<?php
require("views/partials/head.partial.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="container">
            <div class="row">
                <h2 class="row justify-content-center">Categorieën</h2>
            </div>
            <div class="row justify-content-center" style="height: 100%">
                <?php
                if($noCategories)
                {
                    echo '<div class="alert alert-danger"><em>Geen categorieën.</em></div>';
                } else {
                    foreach($categories as $category)
                    {
                        require("partials/category.partial.php");
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
require("partials/foot.partial.php");
?>

