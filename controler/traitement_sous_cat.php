<?php
// couleur aléatoire pour l'arrière plan du titre
$titre_couleur = bandeauTitreCat();

// recuperation des données
if (isset($_GET['c']) && $_GET['c'] != NULL) {
    $c = htmlspecialchars($_GET['c']);

    $donnees = req_categories($bdd,$c);
    $categorie = $donnees['nom_categorie'];
    $texte_categorie = $donnees['description_categorie'];
}
else {
$categorie = '';
}

$sous_cat='';
$titre = titreCatalogue($categorie, $sous_cat);
$ariane = filsAriane($categorie, $sous_cat, $c);

    $sc = req_toutes_sous_cats($bdd,$c);

    $cards_sous_cat = '';
    foreach ($sc as $donnees) {
        $cards_sous_cat .= card_sous_cat($c, $donnees['id_sous_cat'], $donnees['nom_sous_categorie'], $donnees['nom_img_site']);
    }
?>