<?php
$stock_tampons = 5;
// -------------------------------------------------------------------------
//                    données sur le produit
// -------------------------------------------------------------------------
 //recuperation de la reference produit
 if (isset($_GET['id'], $_GET['c'], $_GET['sc']) 
 && $_GET['id'] != NULL && $_GET['c'] != NULL && $_GET['sc'] != NULL) {
     $id_produit = htmlspecialchars($_GET['id']);
     $c = htmlspecialchars($_GET['c']);
     $sc = htmlspecialchars($_GET['sc']);
     
    $donnees = req_produit($bdd,$id_produit);

    $nom_produit = $donnees['nom_produit'];
    $description_produit = $donnees['description_produit'];
    if ($donnees['promo_saison_produit'] == 1) {
        $prix = number_format($donnees['prix_produit']*(1-5/100), 2, '.', ''); // promo de -5%
        $promo = ' au lieux de '.$donnees['prix_produit'];
    }
    else {
        $prix = $donnees['prix_produit'];
        $promo = '';
    }
    
    // gestion provisoire des cas en "dur"
    if ($c == 1 || $c == 4) {
        $cat_prix = 'le mètre';
    }
    elseif ($c == 3) {
        $cat_prix ='';
    }
    else {
        $cat_prix = 'la pièce';
    }
    
    $laize = $donnees['dimension_produit'];
    if ($c == 1) {
        $cat_taille = 'Laize : ';
        $cat_taille_unit = ' cm';
    }
    elseif ($c == 2 || $c == 4) {
        $cat_taille = 'Dimension : ';
        $cat_taille_unit = '';
    }
    else {
        $cat_taille = 'Tailles : ';
        $cat_taille_unit = '';
    }
    $composition = $donnees['composition_produit'];
    $poids = $donnees['poids_produit'];
    $couleur = $donnees['nom_couleur'];
    $usage = $donnees['nom_usage'];
    
    
    if ($donnees['stock_produit'] < $stock_tampons) {
        $stock_max = 0;
        $stock = 0;
        $disponibilite = 'indisponible';
        $dispo_style = 'color:var(--rouge);';
    }
    elseif ($donnees['stock_produit'] < 50 ) {
        $stock_max = $donnees['stock_produit']-$stock_tampons;
        $stock = 1;
        $disponibilite = ' quantité limité ';
        $dispo_style = 'color:var(--orange);';
    }
    else {
        $stock_max = $donnees['stock_produit']-$stock_tampons;
        $stock = 1;
        $disponibilite = 'en stock';
        $dispo_style = 'color:var(--vert);';
    }

    // récupération des images et création du carousel
    $donnees = req_img_produit($bdd,$id_produit);
    $images = $donnees[0];
    $nbr = $donnees[1];

    $carousel_indicators = '';
    $carousel_inner = '';
    $i = 0;
    do {
        if (isset($images[$i])) {
            $nom_img = $images[$i]['nom_image'];
        }
        else {
            $nom_img = '';
        }
        $carousel_indicators .= carousel_indicators($i, $nom_img);
        $carousel_inner .= carousel_inner($i, $nom_img);
        $i++;
    } while ($i < $nbr);

    // si co cherche si produit dans favoris
    $image = recherche_si_fav($bdd,$id_produit);

 }
 
// -------------------------------------------------------------------------
//                     Suggestion produits au clients
// -------------------------------------------------------------------------
$produits = req_suggestion($bdd, $sc);

$cards_suggestions = '';
foreach ($produits as $donnees) {
    $cards_suggestions .= card($donnees['nom_produit'], $donnees['prix_produit'], $donnees['nom_image'], $donnees['id_produit'],$c,$sc);
}

// -------------------------------------------------------------------------
//                                avis clients 
// -------------------------------------------------------------------------



?>