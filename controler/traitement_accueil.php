<?php
//--------------------------------------------------------
//            récupération des catégories
//--------------------------------------------------------
    $categories = req_select_cat($bdd);

    $cards_categories = '';
    foreach ($categories as $donnees) {
        $cards_categories .= card_cat($donnees['nom_categorie'], $donnees['id_cat'], $donnees['nom_img_site']);
    }

//--------------------------------------------------------
//               récupération des nouveautés
//--------------------------------------------------------
    $nouveau = req_select_new_produit($bdd);

    $cards_nouveaux = '';
    foreach ($nouveau as $donnees) {
        $cards_nouveaux .= card($donnees['nom_produit'], $donnees['prix_produit'], $donnees['nom_image'], $donnees['id_produit'], $donnees['id_cat'], $donnees['id_sous_cat']);
    }

//--------------------------------------------------------
//             récupération de la promo saisonnière 
//--------------------------------------------------------
    $promo = req_select_promo_produit($bdd);

    $cards_promo = '';
    foreach ($promo as $donnees) {
        $cards_promo .= card($donnees['nom_produit'], $donnees['prix_produit'], $donnees['nom_image'], $donnees['id_produit'], $donnees['id_cat'], $donnees['id_sous_cat']);
    }

//--------------------------------------------------------
//          récupération du carousel
//--------------------------------------------------------
    $donnees = req_carousel($bdd);
    
    $carousel_indicators = '';
    $carousel_inner = '';
    $i = 0;
    
    foreach ($donnees as $slide) {
        $carousel_indicators .= carousel_indicators_accueil($i);
        $carousel_inner .= carousel_inner_accueil($slide,$i);
        $i++;
    }
    
    
//--------------------------------------------------------
//                  jumbotron
//--------------------------------------------------------
$donnees = req_jumbotron($bdd);

$texte_jumbotron = '<div class="row">';
foreach ($donnees as $paragraphe) {
    if ($paragraphe['taille_paragraphe'] == 1) {
        $texte_jumbotron .= '
        <h1>'.$paragraphe['titre_paragraphe'].'</h1>
        <p>'.nl2br($paragraphe['texte_paragraphe'],false).'</p>
        ';
    }
    else {
        $texte_jumbotron .= '
        <div class="col-lg-6">
        <h2>'.$paragraphe['titre_paragraphe'].'</h2>
        <p>'.nl2br($paragraphe['texte_paragraphe'],false).'</p>
        </div>
        ';
    }
}
$texte_jumbotron .= '</div>';

/// img droite
$donnees = req_img_jumbotron($bdd, 1);
$image_jumbotron = '
<img src="public/assets/img/site/'.$donnees['nom_img_jumbotron'].'" alt="" class="img-fluid d-none d-lg-block">
';

/// img milieu 
$donnees = req_img_jumbotron($bdd, 2);
$image_jumbotron .= '
<img src="public/assets/img/site/'.$donnees['nom_img_jumbotron'].'" alt="" class="img-fluid ">
';

/// img gauche
$donnees =req_img_jumbotron($bdd, 3);
$image_jumbotron .= '
<img src="public/assets/img/site/'.$donnees['nom_img_jumbotron'].'" alt="" class="img-fluid ">
';

// -----------------------------------------------------
//              portfolio tutoriels
// -----------------------------------------------------

$portfolio = req_portfolio($bdd);
?>