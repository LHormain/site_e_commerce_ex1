<?php
// DELETE
if (isset($_GET['sup'])
&& $_GET['sup'] != NULL) {
    $id_produit = intval($_GET['sup']);

    // supprime les images
    // dossier
    $req_where = 'WHERE produits.id_produit = :id_produit';
    $images = req_images_produit($bdd,$id_produit,$req_where);
    foreach ($images as $donnees) {
        $chemin = '../public/assets/img/produits/'.$donnees['nom_image'];
        if (file_exists($chemin)) {
            unlink($chemin);
        }
    }
    // BDD
    req_sup_produit($bdd,$id_produit);
}


// classement 
if (isset($_GET['ordre']) && $_GET['ordre'] != NULL) {
    $ordre = intval($_GET['ordre']);

    if ($ordre == 1) {
        $ordre_req = 'ORDER BY produits.nom_produit';
    }
    elseif ($ordre == 2) {
        $ordre_req = 'ORDER BY produits.id_sous_cat';
    }
    else {
        $ordre_req = '';
    }
}
else {
    $ordre_req = '';
}

// récupération des catégories pour n'afficher que les produits de cette catégorie
if (isset($_POST['id_cat']) && $_POST['id_cat'] != NULL) {
    $id_cat = intval($_POST['id_cat']);
}
elseif (isset($_GET['idcat']) && $_GET['idcat'] != NULL) {
    $id_cat = intval($_GET['idcat']);
}
else {
    $id_cat = 1; 
}
// récupération des données de la BDD
    $produits = req_produits($bdd,$id_cat,$ordre_req);

    // liste des produits sans images pour construction du tableau
    $donnees2 = req_liste_p_sans_img($bdd);

    $prod_sans_img = array();
    foreach ($donnees2 as $ligne) {
        $prod_sans_img[] = $ligne['id_produit'];
    }

    $table_produits = '';
    foreach ($produits as $donnees) {
        $table_produits.= table_produit_gestion($donnees, $prod_sans_img);
    }
?>