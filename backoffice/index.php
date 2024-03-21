<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice - Étoffe en ligne</title>
        <!-- icône onglet -->
        <link rel="shortcut icon" type="image/ico" href="favicon.ico"/>
    <!-- bootstrap 5 distant puis local-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="../public/assets/bootstrap_5/css/bootstrap.min.css" rel="stylesheet">
    <!-- polices -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- css perso -->
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
<?php
    if (isset($_SESSION['connexion']) && $_SESSION['connexion'] == 1) {
        require_once('modele/connexion_bdd.php');
        require_once('modele/fonctions.php');
        require_once('vue/composant/vue_nav.php');
        if (isset($_GET['page']) && $_GET['page'] != NULL) {
            $page = htmlspecialchars($_GET['page']);
            if ($page == 1) {
                include('vue/vue_accueil.php');
            }
            elseif ($page == 2) {
                include('controler/deconnexion.php');
            }
            elseif ($page == 3) {
                include('vue/vue_produit.php');
            }
            elseif ($page == 31) {
                include('vue/vue_categorie.php');
            }
            elseif ($page == 32) {
                include('vue/vue_sous_categorie.php');
            }
            elseif ($page == 33) {
                include('vue/vue_images_produits.php');
            }
            elseif ($page == 4) {
                include('vue/vue_promotions.php');
            }
            elseif ($page == 5) {
                include('vue/vue_offre.php');
            }
            elseif ($page == 6) {
                include('vue/vue_tuto.php');
            }
            elseif ($page == 12) {
                include('vue/vue_ateliers.php');
            }
            elseif ($page == 7) {
                include('vue/vue_clients.php');
            }
            elseif ($page == 8) {
                include('vue/vue_messages.php');
            }
            elseif ($page == 9) {
                include('vue/vue_clients_paniers.php');
            }
            elseif ($page == 91) {
                include('vue/vue_client_panier_details.php');
            }
            elseif ($page == 10) {
                include('vue/vue_clients_commandes.php');
            }
            elseif ($page == 11) {
                include('vue/vue_clients_factures.php');
            }
            else {
                include('vue/vue_accueil.php');
            }
        }
        else {
            include('vue/vue_accueil.php');
        }
    }
    else {
        require_once('vue/vue_connexion.php');
    }
?>
        </div>
    </div>
<!-- JS de bootstrap distant puis local -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
<script src="../public/assets/bootstrap_5/js/bootstrap.bundle.min.js"></script>
</body>
</html>