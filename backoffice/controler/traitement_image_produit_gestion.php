<?php
// DELETE
if (isset($_GET['sup'])
&& $_GET['sup'] != NULL) {
    $id_image = intval($_GET['sup']);

    $donnees = req_select_img_produit($bdd,$id_image);
    $chemin = '../public/assets/img/produits/'.$donnees['nom_image'];
    if (file_exists($chemin)) {
        unlink($chemin);
    }

    req_sup_img_produit($bdd,$id_image);
}


// récupération des données de la BDD
if (isset($_GET['id_produit']) && $_GET['id_produit'] != NULL) {
    $id_produit = intval($_GET['id_produit']);

    $nom_produit = req_produit($bdd,$id_produit);
    $nom_page = 'Gestion des images du produit : '.$nom_produit['nom_produit'];

    $req_where = 'WHERE produits.id_produit = :id_produit';
    $images = req_images_produit($bdd,$id_produit,$req_where);

    $boutons = '
    <a  class="btn btn-primary" href="index.php?page=33&c=1&id_produit='.$id_produit.'" role="button" >Ajouter une image</a>
    <a  class="btn btn-primary" href="index.php?page=33&c=2&id_produit='.$id_produit.'" role="button">Gestion</a>
    ';
}
else {

    $nom_page = 'Gestion des images produits';
    $req_where = '';
    $id_produit = 0;

    $images = req_images_produit($bdd,$id_produit,$req_where);

    $boutons= '
    <button name="" id="" class="btn btn-primary" href="index.php?page=33&c=1" role="button" disabled>Saisie</button>
    <a name="" id="" class="btn btn-primary" href="index.php?page=33&c=2" role="button">Gestion</a>';
}

$table_img_produit = '';
foreach ($images as $donnees) {
    $table_img_produit .= table_img_produit_gestion($donnees);
}
?>