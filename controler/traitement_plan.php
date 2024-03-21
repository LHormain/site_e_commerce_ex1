<?php
$categories = req_select_cat($bdd);

$liste_cat = '';
foreach ($categories as $donnees) {
    $liste_cat .= '<li><a href="index.php?page=20&c='.$donnees['id_cat'].'">'.$donnees['nom_categorie'].'</a></li>';
}

?>