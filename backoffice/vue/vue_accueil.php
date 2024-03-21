<?php
include('controler/traitement_accueil.php');
?>
<div class="col-10 p-5">
    <h1 class="text-center">Accueil</h1>
    <h2>Produits</h2>
    <!-- produit -->
    <div class="row mb-5">
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=31">
                <div class="card-header text-light bg-primary">
                    Catégories
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/cube.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des catégories</p>
                </div>
            </a>
        </div>
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=32">
                <div class="card-header text-light bg-primary">
                    Sous catégories
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/cube2.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des sous catégories</p>
                </div>
            </a>
        </div>
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=3">
                <div class="card-header text-light bg-primary">
                    Produits
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/modelisation-3d.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des produits</p>
                </div>
            </a>
        </div>
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=33">
                <div class="card-header text-light bg-primary">
                    Images Produits
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/outils-de-couture.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des images des produits</p>
                </div>
            </a>
        </div>
    </div>

    <h2>Gestion du site</h2>
    <div class="row mb-5">
        <!-- promotions -->
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=4">
                <div class="card-header text-light bg-secondary">
                    Carousel accueil : promotions du moment
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/rectangle.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion du carousel de la page d'accueil</p>
                </div>
            </a>
        </div>
            <!-- offres saisonnières -->
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=5">
                <div class="card-header text-light bg-secondary">
                    Jumbotron accueil : Offre saisonnière
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/fusionner.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion de l'encart promotionnel au milieux de la page d'accueil</p>
                </div>
            </a>
        </div>
            <!-- tutoriels -->
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=6">
                <div class="card-header text-light bg-secondary">
                    Tutoriels
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/lecteur-video.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des tutoriels videos</p>
                </div>
            </a>
        </div>
           <!-- atelier -->
           <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=12">
                <div class="card-header text-light bg-secondary">
                    Ateliers
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/boutons.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des ateliers coutures</p>
                </div>
            </a>
        </div>
    </div>
    <h2>Administratif</h2>
    <div class="row mb-5">
        <!-- clients -->
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=7">
                <div class="card-header text-light bg-info">
                    Clients
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/user.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des clients</p>
                </div>
            </a>
        </div>
           <!-- messages -->
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=8">
                <div class="card-header text-light  bg-info">
                    Messages<span class="badge bg-danger fs-6 position-absolute top-0 start-100 translate-middle p-2"><?php echo $nbr_messages; ?></span>
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/email.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestions des messages reçus</p>
                </div>
            </a>
        </div>
               <!-- paniers -->
        <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=9">
                <div class="card-header text-light  bg-info">
                    Paniers clients
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/panier.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des paniers clients</p>
                </div>
            </a>
        </div>
           <!-- commandes -->
           <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=10">
                <div class="card-header text-light bg-info">
                    Commandes clients
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/boite.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des commandes clients</p>
                </div>
            </a>
        </div>
           <!-- factures -->
        <!-- <div class="card text-center col-2 p-0 m-3">
            <a href="index.php?page=11">
                <div class="card-header text-light bg-info">
                    Factures clients
                </div>
                <div class="card-body text-dark">
                    <img src="public/assets/img/facture.png" class="img-fluid rounded-top" alt="">
                    <p class="card-text">Gestion des factures clients</p>
                </div>
            </a>
        </div> -->
    </div>
</div>