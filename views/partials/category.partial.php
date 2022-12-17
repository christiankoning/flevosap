<div class="cards-deck col-auto">
    <form id="<?= $category['name'] ?>" action="<?=Request::buildUri("/producten")?>" method="post">
        <a href="#" class="categoryForm" onclick="document.getElementById('<?= $category['name'] ?>').submit()">
            <input type="hidden" name="categoryId" value="<?= $category['id'] ?>">
            <div class="card categoryCard" style="width: 18rem; ">
                <div class="card-body">
                    <h4 class="card-title text-center category-title"><b><?= $category['name']?></b></h4>
                    <img src="<?=Request::buildUri("/public/img/uploads/Flevosap-appel.jpg")?>" class="card-img-top w-75 mx-auto d-block">
                </div>
            </div>
        </a>
    </form>
</div>

