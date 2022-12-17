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
                    <a class="nav-link " aria-current="page" href="<?=Request::buildUri("/admin/categorieen")?>">Categorieën</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="<?=Request::buildUri("/admin/gebruikers")?>">Gebruikers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="<?=Request::buildUri("/admin/bestellingen")?>">Bestellingen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="<?=Request::buildUri("/admin/producten")?>">Producten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="<?=Request::buildUri("/")?>">Sluit Admin</a>
                </li>
                <?php
                if (Auth::isLoggedIn()) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=Request::buildUri("/uitloggen")?>">Uitloggen</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<!--End of navbar-->
