
<!--Nabbar-->
<nav class="navbar mb-5 navbar-expand-lg navbar-light bg-danger">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="<?=Request::buildUri("/public/img/Flevosap_logo.png")?>" class="w-25 img-thumbnail"
                                               alt="FlevoSap"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="<?=Request::buildUri("/")?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=Request::buildUri("/categorie")?>">Categorieën</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=Request::buildUri("/contact")?>">Contact</a>
                </li>
                <?php
                    if (Auth::isAdmin()) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=Request::buildUri("/admin/gebruikers")?>">Admin paneel</a>
                        </li>
                        <?php
                    }
                    if (Auth::isLoggedIn()) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=Request::buildUri("/uitloggen")?>">Uitloggen</a>
                            </li>
                        <?php
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=Request::buildUri("/winkelwagen")?>">
                        <span class="position-absolute top- start-25 translate-middle badge rounded-pill bg-success"><?= $CART->showSize() ?></span>
                        <img src="<?=Request::buildUri("/public/img/icons/basket.svg")?>">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=Request::buildUri("/profiel")?>">
                        <img src="<?=Request::buildUri("/public/img/icons/account.svg")?>">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--End of navbar-->
