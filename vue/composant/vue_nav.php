<?php
    include('controler/composant/traitement_nav.php');
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light no-print">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ">
                <!-- accueil -->
                <li class="nav-item pe-5 text-center text-lg-start">
                    <a class="nav-link" href="index.php?page=1">Accueil</a>
                </li>
                <!-- tous les produits -->
                <li class="nav-item pe-5 dropdown  text-center text-lg-start">
                    <!-- <a class="nav-link active" aria-current="page" href="#"></a> -->
                    <a class="nav-link dropdown-toggle" href="index.php?page=2" id="navbarDropdownProduitLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tous nos produits
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownProduitLink">
                        <?php
                            echo $resultat;
                        ?>
                    </ul>
                </li>
                
                <!-- services -->
                <li class="nav-item pe-5 dropdown  text-center text-lg-start">
                    <a class="nav-link dropdown-toggle" href="index.php?page=9" id="navbarDropdownServicesLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Services</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownServicesLink">
                        <li><a class="dropdown-item" href="index.php?page=13">Ateliers</a></li>
                        <li><a class="dropdown-item" href="index.php?page=9#1pro">Offre pro</a></li>
                        <li><a class="dropdown-item" href="index.php?page=9#4mes">Confection sur mesure</a></li>
                        <li><a class="dropdown-item" href="index.php?page=8">Tutoriels</a></li>
                        <li><a class="dropdown-item" href="index.php?page=9#2fid">Programme de fidélité</a></li>
                        <li><a class="dropdown-item" href="index.php?page=9#3cad">Carte cadeau</a></li>
                        <!-- nouveauté -->
                        <li >
                            <a class="dropdown-item" href="index.php?page=2&promo=2">Nouveautés</a>
                        </li>
                        <!-- promotion -->
                        <li >
                            <a class="dropdown-item" href="index.php?page=2&promo=1">Promotions</a>
                        </li>
                    </ul>
                </li>
                
                <!-- contact -->
                <li class="nav-item pe-5  text-center text-lg-start">
                    <a class="nav-link" href="index.php?page=4&r=1">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>