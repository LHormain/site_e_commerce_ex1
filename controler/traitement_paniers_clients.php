<?php
//--------------------------------------------------------------------------
//         test si id_commande correspond deja a une commande payer 
//                          ou au payement refusé
//--------------------------------------------------------------------------
$id_commande = $_SESSION['id_commande'];
$test = req_test_commande_payer($bdd, $id_commande);
if ($test != 0 ) {
    $_SESSION['id_commande'] = time();
}

// -------------------------------------------------------------------------
//                              Ajout au panier 
//       utile ssi on envoie à chaque ajout au panier sur cette page
// -------------------------------------------------------------------------
if (isset($_POST['quantite_produit'],
          $_POST['id_produit'],
          $_POST['prix_unitaire_produit'])
          && $_POST['quantite_produit'] != NULL
          && $_POST['id_produit'] != NULL
          && $_POST['prix_unitaire_produit'] != NULL
) {
    $quantite_produit = htmlspecialchars($_POST['quantite_produit']);
    $id_produit = htmlspecialchars($_POST['id_produit']);
    $prix_unitaire_produit = htmlspecialchars($_POST['prix_unitaire_produit']);


    $id_commande = intval($_SESSION['id_commande']);
    if (isset($_SESSION['id_client'])) {
        // si co
        $id_client_fetch = req_id_client($bdd);
        $id_client = $id_client_fetch['id_client']; 
    }
    else {
        // si pas co crée identifiant provisoire? utilise NULL?
        $identifiant_client = time();
        $id_client = 'NULL'; 
    }

    if ($quantite_produit != 0) { 

        // test si produit existe deja dans le panier
        $test = req_test_panier($bdd,$id_produit,$id_commande);
    
        if (isset($test) && $test != NULL) {
            // UPDATE de la quantité 
            $quantite_produit = $quantite_produit + $test['quantite_produit'];
    
            req_update_panier($bdd, $id_commande,$quantite_produit,$id_produit);
            
        }
        else {
            // INSERT
    
            req_insert_panier($bdd,$id_commande,$id_client,$quantite_produit,$id_produit,$prix_unitaire_produit);
        }
    }
}

// -------------------------------------------------------------------------
//                modification d'un ancien panier
// fusionne le panier de la session en cours avec l'ancien panier sélectionner
// -------------------------------------------------------------------------
if (isset($_GET['mod']) && $_GET['mod'] != NULL) {
    $id_commande_old = intval($_GET['mod']);
    $id_commande_new = intval($_SESSION['id_commande']);
    
    req_vieux_panier($bdd,$id_commande_old,$id_commande_new);
}

// -------------------------------------------------------------------------
//                   supprimer un produit du panier
// -------------------------------------------------------------------------
if (isset($_GET['sup']) && $_GET['sup'] != NULL) {
    $id_panier = htmlspecialchars($_GET['sup']);

    req_sup_produit_panier($bdd,$id_panier);
}

// -------------------------------------------------------------------------
//             récupération d'un ancien panier
//             switch ancien et nouveau panier 
// -------------------------------------------------------------------------
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id_commande = intval($_GET['id']);

    $_SESSION['id_commande'] = $id_commande;
}

// -------------------------------------------------------------------------
//                       Affichage panier
// -------------------------------------------------------------------------
else {

    $id_commande = intval($_SESSION['id_commande']);
}

$donnees = req_panier($bdd,$id_commande);

$liste_panier = '';
$prix_total = 0.0;
if ($donnees != '') {
    foreach ($donnees as $produit) {
        $prix = $produit['quantite_produit']*$produit['prix_unitaire_produit'];
        $prix_total = $prix_total + $prix;

        $image = trouve_nom_image($bdd,$produit['id_produit']);
        $liste_panier .= panier($image, $produit, $prix);
    }
    // ajouter estimation du montant tva?
}

?>