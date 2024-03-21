<?php
// DELETE
if (isset($_GET['sup'])
&& $_GET['sup'] != NULL) {
    $id_cat = intval($_GET['sup']);

    // sélectionne l'id de l'image
    $donnees = req_img_cat_select($bdd,$id_cat);
    $id_img_site = $donnees['id_img_site'];
    $chemin = '../public/assets/img/site/'.$donnees['nom_img_site'];
    if (file_exists($chemin)) {
        unlink($chemin);
    }

    req_sup_cat($bdd,$id_cat);

    req_sup_img_site($bdd, $id_img_site);
}

// récupération des données de la BDD
    $categories = req_cat($bdd);

    $table_cat = '';
    foreach ($categories as $donnees) {
        $table_cat .= table_cat_gestion($donnees);
    }

?>