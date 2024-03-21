<?php
include('controler/composant/traitement_header.php');
?>
<header class="container-fluid no-print">
    <!-- ------------------------------------------------------------- -->
    <!--                       bandeau promotions                      -->
    <!-- ------------------------------------------------------------- -->
    <div class="bandeau_promo row">
        <h1 class="col-12 text-center p-1">Des Tissus, Des Prix, Des Possibilités Infinies.</h1>
    </div>
    <!-- ------------------------------------------------------------- -->
    <!--                             header                            -->
    <!-- ------------------------------------------------------------- -->
    <div class="row">
        <div class="offset-lg-1 col-md-2 col-5">
            <!-- logo -->
            <a href="index.php?page=1">
                <img src="<?php echo $logo_site; ?>" alt="" class="img-fluid logo_header">
            </a>
        </div>
        <!-- fonction recherche -->
        <div class="col d-none d-md-flex align-items-center justify-content-center">
            <!-- <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recherche" aria-label="recherche" aria-describedby="button-recherche">
                    <button class="btn btn-outline-secondary" type="button" id="button-recherche"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form> -->
        </div>
        <!-- bouton pour clients -->
        <div class="col-lg-4 col-6 header">
            <div class="row h-100 align-items-center justify-content-md-between justify-content-end">
                <!-- magasins -->
                <a href="index.php?page=11" class="col-2 d-none d-md-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Nos magasins"><img src="public/assets/img/icones/localisation.png" alt="" class="img-fluid icones"></a>
                <!-- inscription et connexion ou deco si co -->
                <div class="questions col-2 position-relative">
                    <img src="public/assets/img/icones/user.png" alt="" class="img-fluid icones" data-bs-toggle="tooltip" data-bs-placement="top" title="Connexion/Nouveau client">
                    <div class="position-absolute ">
                        <?php if (isset($_SESSION['id_client'])) { 
                            ?>
                            <a href="index.php?page=6" class="w-100 ">Mon compte</a>
                            <a href="index.php?page=60&dis=1" class="w-100 ">Déconnexion</a>
                            <?php
                        }
                        else {
                            ?>
                            <a href="index.php?page=6" class="w-100 ">Connexion</a>
                            <a href="index.php?page=61" class="w-100 text-nowrap">Créer un compte</a>
                            <?php
                        } ?>
                    </div>
                </div>
                <!-- coup de coeur seulement si connecté -->
                <?php if (isset($_SESSION['id_client'])) {
                    ?>
                    <a href="index.php?page=2&fav=1" class="col-2 d-none d-md-block"><img src="public/assets/img/icones/coeur.png" alt="" class="img-fluid icones" data-bs-toggle="tooltip" data-bs-placement="top" title="Coup de coeur"></a>
                    <?php
                } ?>
                <!-- panier -->
                <a href="index.php?page=62" class="col-2 position-relative"><img src="public/assets/img/icones/trolley.png" alt="" class="img-fluid icones" data-bs-toggle="tooltip" data-bs-placement="top" title="Mon panier"><?php if ($nbr_produits['nbr'] != 0 ){ ?><span class="badge bg-danger position-absolute top-0 start-50 translate-middle "><?php echo $nbr_produits['nbr']; } ?></a>
                <!-- FAQ et contact -->
                <div class="questions col-3 d-none d-md-block position-relative">
                    <img src="public/assets/img/icones/aider.png" alt="" class="img-fluid icones" data-bs-toggle="tooltip" data-bs-placement="top" title="Vous avez des questions à nous poser?">
                    <div class="position-absolute ">
                        <a href="index.php?page=4&r=1" class="w-100">Contactez-nous</a>
                        <a href="index.php?page=12" class="w-100">FAQ</a>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>