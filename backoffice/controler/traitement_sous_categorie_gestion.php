<?php
// DELETE
if (isset($_GET['sup'])
&& $_GET['sup'] != NULL) {
    $id_sous_cat = intval($_GET['sup']);

     // sélectionne l'id de l'image
    $donnees = req_img_sous_cat($bdd,$id_sous_cat);
    $id_img_site = $donnees['id_img_site'];
    $chemin = '../public/assets/img/site/'.$donnees['nom_img_site'];
    if (file_exists($chemin)) {
        unlink($chemin);
    }

    req_sup_sous_cat($bdd,$id_sous_cat);

    req_sup_img_site($bdd, $id_img_site);

}


// classement
if (isset($_GET['ordre']) && $_GET['ordre'] != NULL) {
    $ordre = intval($_GET['ordre']);
    if ($ordre == 1) {
        $ordre_req = 'ORDER BY sous_categories.nom_sous_categorie';
    }
    elseif ($ordre == 2) {
        $ordre_req = 'ORDER BY sous_categories.id_cat';
    }
    else {
        $ordre_req = 'ORDER BY sous_categories.id_sous_cat';
    }
}
else {
    $ordre_req = 'ORDER BY sous_categories.id_sous_cat';
}

// récupération des données de la BDD
    $sous_categories = req_sous_categories($bdd,$ordre_req);
    
    $table_sous_cat ='';
    foreach ($sous_categories as $donnees) {
        $table_sous_cat .= table_sous_cat_gestion($donnees);
    }
?>