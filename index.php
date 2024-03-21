<?php 
    session_start();
    if (!isset($_SESSION['id_commande'])) { 
        $_SESSION['id_commande'] = time();
    }

    // changement du titre de la page dans l'onglet
    if (isset($_GET['page']) && $_GET['page'] != NULL) {
        $page = intval($_GET['page']);

        if ($page == 1) {
            $title_page = 'Étoffe en ligne';
        }
        elseif (in_array($page, [20,2,3] )) {
            $title_page = 'Étoffe en ligne : Catalogue';
        }
        elseif ($page == 4) {
            $title_page = 'Étoffe en ligne : Contact';
        }
        elseif (in_array($page, [6,63])) {
            $title_page = 'Étoffe en ligne : Page client';   
        }
        elseif ($page == 61) {
            $title_page = 'Étoffe en ligne : Inscription';
        }
        elseif ($page == 62) {
            $title_page = 'Étoffe en ligne : Panier';
        }
        elseif (in_array($page, [8,15])) {
            $title_page = 'Étoffe en ligne : Tutoriels';
        }
        elseif ($page == 12) {
            $title_page = 'Étoffe en ligne : FAQ';
        }
        elseif (in_array($page, [13,131])) {
            $title_page = 'Étoffe en ligne : Ateliers';
        }
        else {
            $title_page = 'Étoffe en ligne';
        }
    }
    else {
        $title_page = 'Étoffe en ligne';
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title_page; ?></title>
    <!-- icône onglet -->
    <link rel="shortcut icon" type="image/ico" href="favicon.ico"/>
    <!-- bootstrap 5 distant puis local-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="public/assets/bootstrap_5/css/bootstrap.min.css" rel="stylesheet">
    <!-- polices -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="public/assets/css/fontawesome-6.4.0/css/all.css">
    <!-- css perso -->
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <?php  

    require_once('modele/data.php');
    // Connexion à une base de donné //
    require_once('modele/connexion_bdd.php');

    // debut des includes //

    require_once('vue/composant/vue_header.php');
    require_once('vue/composant/vue_nav.php');
    require_once('modele/fonctions.php');

    require_once('vue/composant/vue_scroll_top.php');
    
    if (isset($_GET['page']) && $_GET['page'] != NULL) {
        $page = intval($_GET['page']);


        if ($page == 1) {
            include('vue/vue_accueil.php');
        }
        elseif ($page == 20) {
            include('vue/vue_sous_cat.php');
        }
        elseif ($page == 2) {
            include('vue/vue_catalogue.php');
        }
        elseif ($page == 3) {
            include('vue/vue_produit.php');
        }
        elseif ($page == 4) {
            include('vue/vue_contact.php');
        }
        elseif ($page == 5) {
            include('vue/vue_legal.php');
        } 
        elseif ($page == 6) {
            include('vue/vue_connexion_client.php');    
        }
        elseif ($page == 60) {
            include('vue/vue_deconnexion_clients.php');
        }
        elseif ($page == 61) {
            include('vue/vue_inscription_clients.php');
        }
        elseif ($page == 610) {
            include('vue/vue_page_client.php');
        }
        elseif ($page == 62) {
            include('vue/vue_paniers_clients.php');
        }
        elseif ($page == 63) {
            include('vue/vue_commande_clients.php');
        }
        elseif ($page == 630) {
            include('vue/vue_commande_recap.php');
        }
        elseif ($page == 600) {
            include('vue/vue_mdp_oublier.php');
        }
        elseif ($page == 601) {
            include('vue/vue_mdp_reinitialise.php');
        }
        elseif ($page == 602) {
            include('vue/vue_redirection_form.php');
        }
        elseif ($page == 7) {
            include('vue/vue_presentation.php');
        }
        elseif ($page == 8) {
            include('vue/vue_tutoriel.php');
        }
        elseif ($page == 9) {
            include('vue/vue_services.php');
        }
        elseif ($page == 10) {
            include('vue/vue_plan.php');
        }
        elseif ($page == 11) {
            include('vue/vue_magasins.php');
        }
        elseif ($page == 12) {
            include('vue/vue_faq.php');
        }
        elseif ($page == 13) {
            include('vue/vue_atelier.php');
        }
        elseif ($page == 131) {
            include('vue/vue_inscription_atelier.php');
        }
        elseif ($page == 14) {
            include('vue/vue_livraison.php');
        }
        elseif ($page == 15) {
            include('vue/vue_tuto_detail.php');
        }
        else {
            include('vue/vue_accueil.php');
        }
    }
    else {
        include('vue/vue_accueil.php');
    }

    require_once('vue/composant/vue_footer.php');

    ?>

<!-- JS de bootstrap distant puis local -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
<script src="public/assets/bootstrap_5/js/bootstrap.bundle.min.js"></script>

<script src="public/assets/js/scroll_top.js"></script>
</body>
</html>