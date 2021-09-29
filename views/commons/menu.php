<div class="col-11 d-flex flex-column p-0 m-0">
    <p class="text-center m-0">LES ANCIENS DU COLLEGE BOBOTO - 1992</p>
    <hr class="d-none d-md-block m-1">
    <div class="d-flex flex-row justify-content-between bg-success ">
        <nav class="navbar navbar-expand-md navbar-light bg-danger m-0 p-0">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link my-0" aria-current="page" href="<?= URL ?>accueil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link my-0" aria-current="page" href="<?= URL ?>eleves">Elèves</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link my-0" aria-current="page" href="<?= URL ?>projet2022">Projet2022</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link my-0" aria-current="page" href="<?= URL ?>membres">Membres</a>
                    </li>
                </ul>
            </div>

        </nav>
        <nav class="navbar navbar-expand navbar-light bg-primary m-0 p-0">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav d-flex flex-column flex-md-row">
                    <li class="nav-item">
                        
                    <?php 
                    if(Securite::verificationAccess()) {
                        echo "<a href='". URL ."deconnexion' class='nav-link m-0 '><i class='fas fa-user-lock'></i> Se déconnecter</a>";
                    } else {
                        echo "<a href='". URL ."login' class='nav-link m-0 '><i class='fas fa-user-lock'></i> Se connecter</a>";
                    } 
                    ?>
                    </li>
                </ul>
                <!--
                <div class="collapse navbar-collapse me-5 d-none" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Rickou</span>
                                <img src="./sources/images/profil_picture.png" width="40px" class="rounded-circle">
                                <img class="rounded-circle">

                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="profil" class="nav-link dropdown-item">Profil</a>
                                <div class="dropdown-divider"></div>
                                <a href="?page=javascript:void(0)" onclick="handleClick" class="nav-link dropdown-item"><i class="fab fa-confluence"></i>Déconnexion</a>
                            </ul>

                        </li>
                    </ul>
                </div>
                -->
            </div>
        </nav>
    </div>
</div>